<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class TransactionBooksController extends Controller
{
    public function index()
    {
        return view('page.page-member.book', ['books' => Book::all()]);
    }
}
