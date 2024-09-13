<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function member()
    {
        // Mengambil 3 buku terbaru dari database
        $books = Book::take(3)->get();

        // Atau, jika Anda ingin mengurutkan buku berdasarkan ID terbaru, misalnya:
        $books = Book::latest()->take(3)->get();

        return view('page.page-member.index', ['books' => $books]);
    }
}
