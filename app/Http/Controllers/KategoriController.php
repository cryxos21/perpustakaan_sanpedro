<?php

namespace App\Http\Controllers;

use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('buku')->orderBy('nama')->get();

        return view('public.kategori', compact('kategori'));
    }

    public function show(Kategori $kategori)
    {
        $buku = $kategori->buku()->with(['penulis', 'penerbit'])->paginate(12);

        return view('public.kategori-detail', compact('kategori', 'buku'));
    }
}
