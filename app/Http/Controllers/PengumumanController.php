<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::terbit()->latest('published_at')->paginate(10);

        return view('public.pengumuman', compact('pengumuman'));
    }
}
