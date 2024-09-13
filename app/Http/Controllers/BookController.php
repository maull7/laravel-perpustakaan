<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('page.page-admin.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        return view('page.page-admin.create', ['genres' => $genres]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        $data = $request->all();
        $data['image'] = $request->file('image')->store('assets/books', 'public');
        $data['slug'] = Str::slug($request->judul);

        Book::create($data);

        return redirect()->route('book.index')->with('success', 'Berhasil melakukan tambah buku');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $book = Book::findOrFail($id);

        return view('page.page-member.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $genre = Genre::all();
        $book = Book::findOrFail($id);
        return view('page.page-admin.edit', ['book' => $book, 'genres' => $genre]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Book::findOrFail($id);
        $data = $request->all();
        $data = $request->except('image');

        // Periksa jika file gambar diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika perlu
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }

            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('assets/books', 'public');
        }

        $data['slug'] = Str::slug($request->judul);

        $item->update($data);

        return redirect()->route('book.index')->with('success', 'Berhasil melakukan edit buku');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        $book->delete();
        return redirect()->route('book.index')->with('success', 'berhasil hapus buku');
    }
    // app/Http/Controllers/BookController.php
    public function search(Request $request)
    {
        $query = $request->get('query');
        $books = Book::where('judul', 'like', "%$query%")
            ->orWhere('pengarang', 'like', "%$query%")
            ->get();

        return response()->json([
            'books' => $books
        ]);
    }
    public function detail(string $id)
    {
        $book = Book::findOrFail($id);

        return view('page.page-member.show', ['book' => $book]);
    }
}
