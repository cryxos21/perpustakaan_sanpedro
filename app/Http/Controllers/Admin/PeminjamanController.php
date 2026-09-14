<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Services\PeminjamanService;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function __construct(private PeminjamanService $service) {}

    public function index(Request $request)
    {
        $peminjaman = Peminjaman::with(['mahasiswa', 'detailPeminjaman.buku'])
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->when($request->q, function ($q) use ($request) {
                $q->whereHas('mahasiswa', fn ($m) => $m->where('nama', 'like', "%{$request->q}%")
                    ->orWhere('nim', 'like', "%{$request->q}%"));
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.peminjaman.index', compact('peminjaman'));
    }

    public function setujui(Peminjaman $peminjaman)
    {
        try {
            $this->service->setujui($peminjaman);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', collect($e->errors())->flatten()->first());
        }

        return back()->with('success', 'Peminjaman disetujui.');
    }

    public function tolak(Peminjaman $peminjaman)
    {
        try {
            $this->service->tolak($peminjaman);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', collect($e->errors())->flatten()->first());
        }

        return back()->with('success', 'Peminjaman ditolak.');
    }
}
