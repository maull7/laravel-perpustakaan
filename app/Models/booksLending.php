<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booksLending extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_book_id', 'denda'];


    public function transactionBook()
    {
        return $this->belongsTo(TransactionBook::class, 'transaction_book_id');
    }
}
