<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'mahasiswa_id', 'kode_peminjaman', 'tanggal_pinjam', 'tanggal_jatuh_tempo',
        'tanggal_kembali', 'status', 'total_denda',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pinjam' => 'date',
            'tanggal_jatuh_tempo' => 'date',
            'tanggal_kembali' => 'date',
        ];
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }

    public function isTerlambat(): bool
    {
        return $this->status === 'dipinjam'
            && $this->tanggal_jatuh_tempo
            && $this->tanggal_jatuh_tempo->isPast();
    }

    public function statusBadge(): string
    {
        return match ($this->status) {
            'menunggu' => 'Menunggu',
            'dipinjam' => $this->isTerlambat() ? 'Terlambat' : 'Dipinjam',
            'ditolak' => 'Ditolak',
            'dikembalikan' => 'Dikembalikan',
            'terlambat' => 'Terlambat',
            default => ucfirst($this->status),
        };
    }
}
