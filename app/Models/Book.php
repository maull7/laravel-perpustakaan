<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'slug', 'image', 'pengarang', 'penerbit', 'stok', 'genre_id'];


    public function transactions()
    {
        return $this->hasMany(TransactionBook::class, 'book_id');
    }
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'book_id');
    }
}
