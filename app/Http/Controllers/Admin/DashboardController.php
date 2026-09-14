<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Mahasiswa;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_buku' => Buku::count(),
            'total_anggota' => Mahasiswa::count(),
            'total_peminjaman' => Peminjaman::count(),
            'total_pengembalian' => Peminjaman::where('status', 'dikembalikan')->count(),
            'buku_terlambat' => Peminjaman::where('status', 'dipinjam')
                ->whereDate('tanggal_jatuh_tempo', '<', now()->toDateString())
                ->count(),
            'menunggu_persetujuan' => Peminjaman::where('status', 'menunggu')->count(),
        ];

        $peminjamanPerBulan = Peminjaman::selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->pluck('jumlah', 'bulan');

        $pengembalianPerBulan = Peminjaman::selectRaw('MONTH(tanggal_kembali) as bulan, COUNT(*) as jumlah')
            ->whereYear('tanggal_kembali', now()->year)
            ->whereNotNull('tanggal_kembali')
            ->groupBy('bulan')
            ->pluck('jumlah', 'bulan');

        $bukuPopuler = DB::table('detail_peminjaman')
            ->join('buku', 'buku.id', '=', 'detail_peminjaman.buku_id')
            ->select('buku.judul', DB::raw('SUM(detail_peminjaman.jumlah) as total'))
            ->groupBy('buku.judul')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $kategoriPopuler = DB::table('detail_peminjaman')
            ->join('buku', 'buku.id', '=', 'detail_peminjaman.buku_id')
            ->join('kategori', 'kategori.id', '=', 'buku.kategori_id')
            ->select('kategori.nama', DB::raw('SUM(detail_peminjaman.jumlah) as total'))
            ->groupBy('kategori.nama')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $peminjamanTerbaru = Peminjaman::with(['mahasiswa', 'detailPeminjaman.buku'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats', 'peminjamanPerBulan', 'pengembalianPerBulan',
            'bukuPopuler', 'kategoriPopuler', 'peminjamanTerbaru'
        ));
    }
}
