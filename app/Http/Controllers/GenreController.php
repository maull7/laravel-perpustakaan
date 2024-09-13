<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genre = Genre::all();
        return view('page.page-admin.genre.index', ['genres' => $genre]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.page-admin.genre.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'genre' => 'required|string'
        ]);

        Genre::create($data);
        return redirect()->route('genre.index')->with('success', 'genre buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $genre = Genre::findOrFail($id);
        return view('page.page-admin.genre.edit', ['genre' => $genre]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'genre' => 'required|string'
        ]);

        $genre = Genre::findOrFail($id);
        $genre->update($data);
        return redirect()->route('genre.index')->with('success', 'genre buku berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return redirect()->route('genre.index')->with('success', 'genre buku berhasil dihapus');
    }
}
