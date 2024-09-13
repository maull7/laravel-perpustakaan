<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\String_;

class CommentController extends Controller
{
    public function store(Request $request, String $id)
    {

        $book = Book::find($id);
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);
        if (Auth::check()) {
            // Dapatkan ID pengguna
            $userId = Auth::user()->id;
        }
        // Menyimpan komentar baru
        $book->comments()->create([
            'user_id' => $userId,
            'comment' => $request->input('comment'),
            'book_id' => $book->id,  // Pastikan book_id diisi
        ]);

        // Redirect kembali ke halaman detail buku
        return redirect()->route('book.show', $book->id)
            ->with('success', 'Komentar berhasil ditambahkan.');
    }
}
