<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function edit()
    {
        $pengaturan = Pengaturan::current();

        return view('admin.pengaturan', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $pengaturan = Pengaturan::current();

        $data = $request->validate([
            'nama_perpustakaan' => ['required', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
            'email' => ['nullable', 'email', 'max:255'],
            'telepon' => ['nullable', 'string', 'max:30'],
            'jam_pelayanan' => ['nullable', 'string', 'max:255'],
            'tarif_denda_per_hari' => ['required', 'integer', 'min:0'],
            'lama_peminjaman_hari' => ['required', 'integer', 'min:1'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            if ($pengaturan->logo) {
                Storage::disk('public')->delete($pengaturan->logo);
            }
            $data['logo'] = $request->file('logo')->store('pengaturan', 'public');
        }

        $pengaturan->update($data);

        return back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
