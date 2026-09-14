<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $berita = Berita::terbit()
            ->when($request->q, fn ($q) => $q->where('judul', 'like', "%{$request->q}%"))
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        $featured = Berita::terbit()->latest('published_at')->first();

        return view('public.berita', compact('berita', 'featured'));
    }

    public function show(Berita $berita)
    {
        abort_unless($berita->status === 'terbit', 404);

        $lainnya = Berita::terbit()->where('id', '!=', $berita->id)->latest('published_at')->take(3)->get();

        return view('public.berita-detail', compact('berita', 'lainnya'));
    }
}
