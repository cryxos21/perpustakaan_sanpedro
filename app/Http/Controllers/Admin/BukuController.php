<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Penulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $buku = Buku::with(['kategori', 'penulis', 'penerbit'])
            ->when($request->q, fn ($q) => $q->where('judul', 'like', "%{$request->q}%"))
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.buku.index', compact('buku'));
    }

    public function create()
    {
        return view('admin.buku.form', [
            'buku' => new Buku(),
            'kategori' => Kategori::orderBy('nama')->get(),
            'penulis' => Penulis::orderBy('nama')->get(),
            'penerbit' => Penerbit::orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['judul']);
        $data['tersedia'] = $data['stok'];

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('cover-buku', 'public');
        }

        Buku::create($data);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Buku $buku)
    {
        return view('admin.buku.form', [
            'buku' => $buku,
            'kategori' => Kategori::orderBy('nama')->get(),
            'penulis' => Penulis::orderBy('nama')->get(),
            'penerbit' => Penerbit::orderBy('nama')->get(),
        ]);
    }

    public function update(Request $request, Buku $buku)
    {
        $data = $this->validated($request, $buku->id);

        if ($data['judul'] !== $buku->judul) {
            $data['slug'] = $this->uniqueSlug($data['judul'], $buku->id);
        }

        // Sesuaikan jumlah tersedia jika stok berubah (selisih ditambahkan/dikurangi).
        $selisih = $data['stok'] - $buku->stok;
        $data['tersedia'] = max(0, $buku->tersedia + $selisih);

        if ($request->hasFile('cover')) {
            if ($buku->cover) {
                Storage::disk('public')->delete($buku->cover);
            }
            $data['cover'] = $request->file('cover')->store('cover-buku', 'public');
        }

        $buku->update($data);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        if ($buku->cover) {
            Storage::disk('public')->delete($buku->cover);
        }
        $buku->delete();

        return back()->with('success', 'Buku berhasil dihapus.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'kategori_id' => ['required', 'exists:kategori,id'],
            'penulis_id' => ['required', 'exists:penulis,id'],
            'penerbit_id' => ['required', 'exists:penerbit,id'],
            'judul' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:50', 'unique:buku,isbn,'.$ignoreId],
            'tahun_terbit' => ['nullable', 'digits:4'],
            'jumlah_halaman' => ['nullable', 'integer', 'min:1'],
            'deskripsi' => ['nullable', 'string'],
            'stok' => ['required', 'integer', 'min:0'],
            'lokasi_rak' => ['nullable', 'string', 'max:100'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }

    private function uniqueSlug(string $judul, ?int $ignoreId = null): string
    {
        $base = Str::slug($judul);
        $slug = $base;
        $i = 1;

        while (Buku::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
