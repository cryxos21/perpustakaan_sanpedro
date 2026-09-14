<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function index()
    {
        $penerbit = Penerbit::withCount('buku')->orderBy('nama')->paginate(15);

        return view('admin.penerbit.index', compact('penerbit'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Penerbit::create($data);

        return back()->with('success', 'Penerbit berhasil ditambahkan.');
    }

    public function update(Request $request, Penerbit $penerbit)
    {
        $data = $this->validated($request);
        $penerbit->update($data);

        return back()->with('success', 'Penerbit berhasil diperbarui.');
    }

    public function destroy(Penerbit $penerbit)
    {
        if ($penerbit->buku()->exists()) {
            return back()->with('error', 'Penerbit tidak dapat dihapus karena masih memiliki buku.');
        }

        $penerbit->delete();

        return back()->with('success', 'Penerbit berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
            'email' => ['nullable', 'email', 'max:255'],
            'telepon' => ['nullable', 'string', 'max:30'],
            'website' => ['nullable', 'url', 'max:255'],
        ]);
    }
}
