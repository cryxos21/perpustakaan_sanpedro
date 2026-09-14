<?php

use App\Services\PeminjamanService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Menandai peminjaman yang lewat jatuh tempo sebagai "terlambat" setiap hari jam 00:05.
Schedule::call(function () {
    app(PeminjamanService::class)->tandaiTerlambat();
})->dailyAt('00:05');
