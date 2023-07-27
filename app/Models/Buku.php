<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $fillable = ['judul', 'deskripsi', 'jumlah', 'file', 'cover', 'kategori_id', 'user_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    function user()
    {
        return $this->belongsTo(User::class);
    }
}
