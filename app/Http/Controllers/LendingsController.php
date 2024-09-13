<?php

namespace App\Http\Controllers;

use App\Models\booksLending;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TransactionBook;

class LendingsController extends Controller
{
    public function lendings($id)
    {
        // Temukan entri TransactionBook
        $book = TransactionBook::findOrFail($id);

        // Menghitung denda jika terlambat
        $batasPinjam = $book->batas_pinjam; // Misalnya batas pinjam 2 hari
        $tanggalPinjam = Carbon::parse($book->tanggal_di_pinjam);
        $tanggalKembali = Carbon::now();
        $selisihHari = $tanggalKembali->diffInDays($tanggalPinjam);

        if ($selisihHari > $batasPinjam) {
            $denda = ($selisihHari - $batasPinjam) * 5000; // Contoh denda per hari
        } else {
            $denda = 0;
        }

        // Menyimpan data pengembalian buku ke dalam tabel books_lendings
        BooksLending::create([
            'transaction_book_id' => $book->id,
            'denda' => $denda,
        ]);

        return redirect()->route('book.index')->with('success', 'Buku berhasil dikembalikan.');
    }
}
