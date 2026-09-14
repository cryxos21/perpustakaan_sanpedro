<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $riwayat = $request->user()->mahasiswa->peminjaman()
            ->with('detailPeminjaman.buku')
            ->whereIn('status', ['dikembalikan', 'ditolak', 'terlambat'])
            ->latest()
            ->paginate(10);

        return view('mahasiswa.riwayat', compact('riwayat'));
    }
}
