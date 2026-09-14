<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = ['user_id', 'judul', 'slug', 'thumbnail', 'isi', 'status', 'published_at'];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeTerbit($query)
    {
        return $query->where('status', 'terbit')->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    public function thumbnailUrl(): string
    {
        return $this->thumbnail ? asset('storage/'.$this->thumbnail) : asset('images/news-placeholder.png');
    }
}
