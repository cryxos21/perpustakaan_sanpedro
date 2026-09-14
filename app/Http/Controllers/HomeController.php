<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Mahasiswa;
use App\Models\Peminjaman;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total_buku' => Buku::sum('stok'),
            'total_anggota' => Mahasiswa::count(),
            'buku_tersedia' => Buku::sum('tersedia'),
            'buku_dipinjam' => Peminjaman::where('status', 'dipinjam')->count(),
        ];

        $bukuTerbaru = Buku::with(['kategori', 'penulis'])->latest()->take(8)->get();
        $kategori = Kategori::withCount('buku')->orderBy('nama')->take(8)->get();
        $berita = Berita::terbit()->latest('published_at')->take(3)->get();
        $pengumuman = Pengumuman::terbit()->latest('published_at')->take(3)->get();

        return view('public.home', compact('stats', 'bukuTerbaru', 'kategori', 'berita', 'pengumuman'));
    }

    public function search(Request $request)
    {
        return redirect()->route('katalog.index', ['q' => $request->input('q')]);
    }
}
