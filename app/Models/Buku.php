<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'kategori_id', 'penulis_id', 'penerbit_id', 'judul', 'slug', 'isbn',
        'tahun_terbit', 'jumlah_halaman', 'deskripsi', 'cover', 'stok',
        'tersedia', 'lokasi_rak',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function penulis()
    {
        return $this->belongsTo(Penulis::class);
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class);
    }

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }

    public function isTersedia(): bool
    {
        return $this->tersedia > 0;
    }

    public function coverUrl(): string
    {
        return $this->cover ? asset('storage/'.$this->cover) : asset('images/cover-placeholder.png');
    }
}
