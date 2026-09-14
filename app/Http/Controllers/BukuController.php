<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Penulis;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Katalog buku publik: search + filter + pagination.
     */
    public function index(Request $request)
    {
        $query = Buku::with(['kategori', 'penulis', 'penerbit']);

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%")
                    ->orWhereHas('penulis', fn ($p) => $p->where('nama', 'like', "%{$search}%"))
                    ->orWhereHas('penerbit', fn ($p) => $p->where('nama', 'like', "%{$search}%"));
            });
        }

        if ($kategoriId = $request->input('kategori')) {
            $query->where('kategori_id', $kategoriId);
        }

        if ($penulisId = $request->input('penulis')) {
            $query->where('penulis_id', $penulisId);
        }

        if ($penerbitId = $request->input('penerbit')) {
            $query->where('penerbit_id', $penerbitId);
        }

        if ($tahun = $request->input('tahun')) {
            $query->where('tahun_terbit', $tahun);
        }

        if ($request->input('ketersediaan') === 'tersedia') {
            $query->where('tersedia', '>', 0);
        } elseif ($request->input('ketersediaan') === 'dipinjam') {
            $query->where('tersedia', 0);
        }

        $buku = $query->orderBy('judul')->paginate(12)->withQueryString();

        $kategori = Kategori::orderBy('nama')->get();
        $penulis = Penulis::orderBy('nama')->get();
        $penerbit = Penerbit::orderBy('nama')->get();
        $tahunList = Buku::select('tahun_terbit')->distinct()->orderByDesc('tahun_terbit')->pluck('tahun_terbit');

        return view('public.katalog', compact('buku', 'kategori', 'penulis', 'penerbit', 'tahunList'));
    }

    public function show(Buku $buku)
    {
        $buku->load(['kategori', 'penulis', 'penerbit']);
        $sudahDiajukan = false;

        if (auth()->check() && auth()->user()->isMahasiswa()) {
            $mahasiswa = auth()->user()->mahasiswa;
            $sudahDiajukan = $mahasiswa && $mahasiswa->peminjaman()
                ->whereIn('status', ['menunggu', 'dipinjam'])
                ->whereHas('detailPeminjaman', fn ($q) => $q->where('buku_id', $buku->id))
                ->exists();
        }

        $bukuTerkait = Buku::where('kategori_id', $buku->kategori_id)
            ->where('id', '!=', $buku->id)
            ->take(4)
            ->get();

        return view('public.buku-detail', compact('buku', 'sudahDiajukan', 'bukuTerkait'));
    }
}
