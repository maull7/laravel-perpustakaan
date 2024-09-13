<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionBook extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'book_id', 'uuid', 'tanggal_di_pinjam', 'batas_pinjam', 'status'];


    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lending()
    {
        return $this->hasMany(booksLending::class, 'transaction_book_id');
    }
}
