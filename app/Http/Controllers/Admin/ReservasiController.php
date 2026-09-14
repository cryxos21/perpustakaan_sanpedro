<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index(Request $request)
    {
        $reservasi = Reservasi::with(['mahasiswa', 'buku'])
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->orderBy('tanggal_reservasi')
            ->paginate(15)
            ->withQueryString();

        return view('admin.reservasi.index', compact('reservasi'));
    }

    public function destroy(Reservasi $reservasi)
    {
        $reservasi->update(['status' => 'dibatalkan']);

        return back()->with('success', 'Reservasi dibatalkan.');
    }
}
