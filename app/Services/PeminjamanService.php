<?php

namespace App\Services;

use App\Models\Buku;
use App\Models\Mahasiswa;
use App\Models\Peminjaman;
use App\Models\Pengaturan;
use App\Models\Reservasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PeminjamanService
{
    /**
     * Mahasiswa mengajukan peminjaman satu buku.
     */
    public function ajukan(Mahasiswa $mahasiswa, Buku $buku): Peminjaman
    {
        return DB::transaction(function () use ($mahasiswa, $buku) {
            // Kunci baris buku agar stok tidak race-condition.
            $buku = Buku::whereKey($buku->id)->lockForUpdate()->firstOrFail();

            if ($buku->tersedia < 1) {
                throw ValidationException::withMessages([
                    'buku' => 'Buku sedang tidak tersedia. Silakan lakukan reservasi.',
                ]);
            }

            $sudahMengajukan = Peminjaman::where('mahasiswa_id', $mahasiswa->id)
                ->whereIn('status', ['menunggu', 'dipinjam'])
                ->whereHas('detailPeminjaman', fn ($q) => $q->where('buku_id', $buku->id))
                ->exists();

            if ($sudahMengajukan) {
                throw ValidationException::withMessages([
                    'buku' => 'Anda sudah mengajukan/meminjam buku ini.',
                ]);
            }

            $peminjaman = Peminjaman::create([
                'mahasiswa_id' => $mahasiswa->id,
                'kode_peminjaman' => 'PMJ-'.now()->format('Ymd').'-'.Str::upper(Str::random(5)),
                'status' => 'menunggu',
                'total_denda' => 0,
            ]);

            $peminjaman->detailPeminjaman()->create([
                'buku_id' => $buku->id,
                'jumlah' => 1,
            ]);

            return $peminjaman;
        });
    }

    /**
     * Petugas menyetujui peminjaman: stok berkurang, status -> dipinjam.
     */
    public function setujui(Peminjaman $peminjaman): Peminjaman
    {
        return DB::transaction(function () use ($peminjaman) {
            if ($peminjaman->status !== 'menunggu') {
                throw ValidationException::withMessages(['status' => 'Peminjaman ini sudah diproses.']);
            }

            $pengaturan = Pengaturan::current();

            foreach ($peminjaman->detailPeminjaman as $detail) {
                $buku = Buku::whereKey($detail->buku_id)->lockForUpdate()->firstOrFail();

                if ($buku->tersedia < $detail->jumlah) {
                    throw ValidationException::withMessages(['buku' => "Stok buku {$buku->judul} tidak mencukupi."]);
                }

                $buku->decrement('tersedia', $detail->jumlah);
            }

            $peminjaman->update([
                'status' => 'dipinjam',
                'tanggal_pinjam' => now()->toDateString(),
                'tanggal_jatuh_tempo' => now()->addDays($pengaturan->lama_peminjaman_hari)->toDateString(),
            ]);

            return $peminjaman->fresh();
        });
    }

    /**
     * Petugas menolak peminjaman.
     */
    public function tolak(Peminjaman $peminjaman): Peminjaman
    {
        if ($peminjaman->status !== 'menunggu') {
            throw ValidationException::withMessages(['status' => 'Peminjaman ini sudah diproses.']);
        }

        $peminjaman->update(['status' => 'ditolak']);

        return $peminjaman;
    }

    /**
     * Petugas memproses pengembalian: hitung denda otomatis, stok bertambah,
     * dan beri tahu reservasi berikutnya bahwa buku sudah tersedia.
     */
    public function kembalikan(Peminjaman $peminjaman): Peminjaman
    {
        return DB::transaction(function () use ($peminjaman) {
            if ($peminjaman->status !== 'dipinjam') {
                throw ValidationException::withMessages(['status' => 'Peminjaman ini tidak sedang dipinjam.']);
            }

            $pengaturan = Pengaturan::current();
            $tanggalKembali = now()->startOfDay();
            $jatuhTempo = $peminjaman->tanggal_jatuh_tempo->startOfDay();

            $hariTerlambat = $tanggalKembali->gt($jatuhTempo)
                ? $jatuhTempo->diffInDays($tanggalKembali)
                : 0;

            $denda = $hariTerlambat * $pengaturan->tarif_denda_per_hari;

            foreach ($peminjaman->detailPeminjaman as $detail) {
                $buku = Buku::whereKey($detail->buku_id)->lockForUpdate()->firstOrFail();
                $buku->increment('tersedia', $detail->jumlah);

                // Beritahu reservasi tertua yang masih menunggu buku ini.
                Reservasi::where('buku_id', $buku->id)
                    ->where('status', 'menunggu')
                    ->orderBy('tanggal_reservasi')
                    ->limit($detail->jumlah)
                    ->update(['status' => 'tersedia']);
            }

            $peminjaman->update([
                'status' => 'dikembalikan',
                'tanggal_kembali' => $tanggalKembali->toDateString(),
                'total_denda' => $denda,
            ]);

            return $peminjaman->fresh();
        });
    }

    /**
     * Tandai peminjaman yang lewat jatuh tempo sebagai terlambat (dipanggil via scheduler/cron).
     */
    public function tandaiTerlambat(): int
    {
        return Peminjaman::where('status', 'dipinjam')
            ->whereDate('tanggal_jatuh_tempo', '<', now()->toDateString())
            ->update(['status' => 'terlambat']);
    }
}
