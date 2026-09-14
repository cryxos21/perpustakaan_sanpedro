<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswa = $request->user()->mahasiswa;

        $stats = [
            'sedang_dipinjam' => $mahasiswa->peminjaman()->where('status', 'dipinjam')->count(),
            'total_riwayat' => $mahasiswa->peminjaman()->count(),
            'terlambat' => $mahasiswa->peminjaman()
                ->where('status', 'dipinjam')
                ->whereDate('tanggal_jatuh_tempo', '<', now()->toDateString())
                ->count(),
            'total_denda' => $mahasiswa->peminjaman()->sum('total_denda'),
        ];

        $peminjamanAktif = $mahasiswa->peminjaman()
            ->with('detailPeminjaman.buku')
            ->whereIn('status', ['menunggu', 'dipinjam'])
            ->latest()
            ->get();

        return view('mahasiswa.dashboard', compact('stats', 'peminjamanAktif'));
    }
}
