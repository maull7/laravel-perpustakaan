<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsAdmin;
use App\Models\booksLending;
use App\Models\TransactionBook;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(IsAdmin::class);
    }


    public function dashboard()
    {
        return view('layouts.admin');
    }
    public function peminjam()
    {
        $peminjam = TransactionBook::all();
        return view('page.page-admin.peminjam.index', ['books' => $peminjam]);
    }
    public function kembali()
    {
        $lendings = booksLending::all();
        return view('page.page-admin.peminjam.lendings', ['lendings' => $lendings]);
    }
}
