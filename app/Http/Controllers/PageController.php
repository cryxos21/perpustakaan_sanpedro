<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function tentang()
    {
        return view('public.tentang');
    }

    public function layanan()
    {
        return view('public.layanan');
    }

    public function tataTertib()
    {
        return view('public.tata-tertib');
    }

    public function kontak()
    {
        return view('public.kontak');
    }
}
