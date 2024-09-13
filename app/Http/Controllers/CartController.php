<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'book_id' => 'required|integer|exists:books,id',
        ]);

        $bookId = $request->input('book_id');

        // Retrieve the cart from session
        $cart = session()->get('cart', []);

        // Check if the book is already in the cart
        if (isset($cart[$bookId])) {
            $cart[$bookId]['quantity'] += 1; // Increment quantity if the book is already in the cart
        } else {
            $book = Book::findOrFail($bookId);
            $cart[$bookId] = [
                'book' => $book,
                'quantity' => 1,
            ];
        }

        // Save the updated cart to session
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Buku berhasil ditambahkan ke keranjang.');
    }
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('page.page-member.pinjam.cart', ['cart' => $cart]);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'book_id' => 'required|integer|exists:books,id',
        ]);

        $bookId = $request->book_id;

        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);

        if (isset($cart[$bookId])) {
            unset($cart[$bookId]); // Hapus item dari keranjang
            session()->put('cart', $cart); // Simpan kembali ke session

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
    public function update(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'book_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        // Ambil cart dari session
        $cart = session('cart', []);

        if (isset($cart[$data['book_id']])) {
            // Update kuantitas
            $cart[$data['book_id']]['quantity'] = $data['quantity'];
            session(['cart' => $cart]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
}
