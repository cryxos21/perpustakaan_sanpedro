<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    protected $fillable = [
        'nama_perpustakaan', 'alamat', 'email', 'telepon', 'jam_pelayanan',
        'logo', 'tarif_denda_per_hari', 'lama_peminjaman_hari',
    ];

    public static function current(): self
    {
        return static::first() ?? static::create([]);
    }
}
