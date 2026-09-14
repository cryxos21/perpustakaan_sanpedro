<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReservasiController extends Controller
{
    public function index(Request $request)
    {
        $reservasi = $request->user()->mahasiswa->reservasi()
            ->with('buku')
            ->latest('tanggal_reservasi')
            ->paginate(10);

        return view('mahasiswa.reservasi', compact('reservasi'));
    }

    public function store(Request $request, Buku $buku)
    {
        $mahasiswa = $request->user()->mahasiswa;

        if ($buku->isTersedia()) {
            return back()->with('error', 'Buku sedang tersedia, silakan ajukan peminjaman langsung.');
        }

        $sudahReservasi = $mahasiswa->reservasi()
            ->where('buku_id', $buku->id)
            ->whereIn('status', ['menunggu', 'tersedia'])
            ->exists();

        if ($sudahReservasi) {
            return back()->with('error', 'Anda sudah memiliki reservasi aktif untuk buku ini.');
        }

        Reservasi::create([
            'mahasiswa_id' => $mahasiswa->id,
            'buku_id' => $buku->id,
            'tanggal_reservasi' => now()->toDateString(),
            'status' => 'menunggu',
        ]);

        return back()->with('success', 'Reservasi berhasil dibuat. Anda akan diberi tahu ketika buku tersedia.');
    }

    public function destroy(Request $request, Reservasi $reservasi)
    {
        abort_unless($reservasi->mahasiswa_id === $request->user()->mahasiswa->id, 403);

        $reservasi->update(['status' => 'dibatalkan']);

        return back()->with('success', 'Reservasi dibatalkan.');
    }
}
