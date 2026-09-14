<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Services\PeminjamanService;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function __construct(private PeminjamanService $service) {}

    public function index(Request $request)
    {
        $peminjaman = Peminjaman::with(['mahasiswa', 'detailPeminjaman.buku'])
            ->where('status', 'dipinjam')
            ->when($request->q, function ($q) use ($request) {
                $q->whereHas('mahasiswa', fn ($m) => $m->where('nama', 'like', "%{$request->q}%")
                    ->orWhere('nim', 'like', "%{$request->q}%"));
            })
            ->orderBy('tanggal_jatuh_tempo')
            ->paginate(15)
            ->withQueryString();

        return view('admin.pengembalian.index', compact('peminjaman'));
    }

    public function store(Peminjaman $peminjaman)
    {
        try {
            $result = $this->service->kembalikan($peminjaman);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', collect($e->errors())->flatten()->first());
        }

        $pesan = $result->total_denda > 0
            ? 'Buku berhasil dikembalikan. Denda: Rp '.number_format($result->total_denda, 0, ',', '.')
            : 'Buku berhasil dikembalikan.';

        return back()->with('success', $pesan);
    }
}
