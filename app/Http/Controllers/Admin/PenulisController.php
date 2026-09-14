<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenulisController extends Controller
{
    public function index()
    {
        $penulis = Penulis::withCount('buku')->orderBy('nama')->paginate(15);

        return view('admin.penulis.index', compact('penulis'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-penulis', 'public');
        }

        Penulis::create($data);

        return back()->with('success', 'Penulis berhasil ditambahkan.');
    }

    public function update(Request $request, Penulis $penulis)
    {
        $data = $this->validated($request);

        if ($request->hasFile('foto')) {
            if ($penulis->foto) {
                Storage::disk('public')->delete($penulis->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-penulis', 'public');
        }

        $penulis->update($data);

        return back()->with('success', 'Penulis berhasil diperbarui.');
    }

    public function destroy(Penulis $penulis)
    {
        if ($penulis->buku()->exists()) {
            return back()->with('error', 'Penulis tidak dapat dihapus karena masih memiliki buku.');
        }

        if ($penulis->foto) {
            Storage::disk('public')->delete($penulis->foto);
        }
        $penulis->delete();

        return back()->with('success', 'Penulis berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'biografi' => ['nullable', 'string'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }
}
