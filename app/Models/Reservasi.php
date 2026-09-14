<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';

    protected $fillable = ['mahasiswa_id', 'buku_id', 'tanggal_reservasi', 'status'];

    protected function casts(): array
    {
        return [
            'tanggal_reservasi' => 'date',
        ];
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
