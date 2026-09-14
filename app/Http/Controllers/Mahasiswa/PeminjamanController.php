<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Services\PeminjamanService;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function __construct(private PeminjamanService $service) {}

    public function index(Request $request)
    {
        $peminjaman = $request->user()->mahasiswa->peminjaman()
            ->with('detailPeminjaman.buku')
            ->whereIn('status', ['menunggu', 'dipinjam'])
            ->latest()
            ->paginate(10);

        return view('mahasiswa.peminjaman', compact('peminjaman'));
    }

    public function store(Request $request, Buku $buku)
    {
        $mahasiswa = $request->user()->mahasiswa;

        try {
            $this->service->ajukan($mahasiswa, $buku);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', collect($e->errors())->flatten()->first());
        }

        return back()->with('success', 'Pengajuan peminjaman berhasil dikirim. Menunggu persetujuan petugas.');
    }
}
