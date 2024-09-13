<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\booksLending;
use App\Models\TransactionBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Periksa apakah pengguna terautentikasi
        if (Auth::check()) {
            // Dapatkan ID pengguna
            $userId = Auth::user()->id;

            // Ambil data buku yang dipinjam berdasarkan ID pengguna
            $bookBorrows = TransactionBook::where('user_id', $userId)
                ->doesntHave('lending') // Pastikan buku tidak ada di books_lendings
                ->get();
        } else {
            // Jika pengguna tidak terautentikasi, berikan respons yang sesuai
            $bookBorrows = collect(); // Mengembalikan koleksi kosong
        }

        // Kembalikan view dengan data buku yang dipinjam
        return view('page.page-member.pinjam.index', ['books' => $bookBorrows]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(String $id) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'batas_pinjam' => 'required|integer|min:1',
            'status' => 'in:PENDING,FAILED,SUCCESS'
        ]);

        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('show.book')->with('error', 'Keranjang kosong.');
        }

        // Tambahkan data tambahan
        $data['uuid'] = 'NPMB' . mt_rand(1000, 9999) . mt_rand(100, 999);
        $data['tanggal_di_pinjam'] = date('Y-m-d');
        $data['batas_pinjam'] = $request->batas_pinjam;

        // Periksa apakah pengguna terautentikasi dan ambil ID pengguna
        if (Auth::check()) {
            $data['user_id'] = Auth::user()->id;
        } else {
            return redirect()->route('show.book')->with('error', 'Anda harus login untuk meminjam buku.');
        }

        // Proses setiap item dalam keranjang
        foreach ($cart as $bookId => $item) {
            // Temukan buku yang dipinjam
            $buku = Book::findOrFail($bookId);

            $quantity = intval($item['quantity']);

            for ($total = 0; $total < $quantity; $total++) {
                TransactionBook::create([
                    'user_id' => $data['user_id'],
                    'book_id' => $bookId,
                    'batas_pinjam' => $data['batas_pinjam'],
                    'tanggal_di_pinjam' => $data['tanggal_di_pinjam'],
                    'uuid' => $data['uuid'],
                    'status' => 'PENDING'

                ]);
            }




            // $total = $item['quantity'];


            // Kurangi stok buku sesuai dengan kuantitas
            $buku->decrement('stok', $item['quantity']);
        }

        // Kosongkan keranjang
        session()->forget('cart');

        // Redirect ke route yang diinginkan
        return redirect()->route('show.book')->with('success', 'Peminjaman berhasil.');
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
        $Book = Book::findOrFail($id);
        return view('page.page-member.pinjam', ['book' => $Book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function pinjam(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'book_id' => 'required|exists:books,id',
            'batas_pinjam' => 'required|integer|min:1',
            'status' => 'in:PENDING,FAILED,SUCCESS'
        ]);

        // Temukan buku yang dipinjam
        $buku = Book::findOrFail($data['book_id']);

        // Pastikan buku tersedia
        if ($buku->stok < 1) {
            return response()->json(['error' => 'Buku tidak tersedia.'], 400);
        }

        // Tambahkan data tambahan untuk transaksi
        $transactionData = [
            'uuid' => 'NPMB' . mt_rand(1000, 9999) . mt_rand(100, 999),
            'tanggal_di_pinjam' => date('Y-m-d'),
            'batas_pinjam' => $data['batas_pinjam'],
            'user_id' => Auth::check() ? Auth::user()->id : null,
            'status' => 'PENDING'
        ];

        // Simpan data transaksi
        TransactionBook::create(array_merge($transactionData, ['book_id' => $data['book_id']]));

        // Kurangi stok buku
        $buku->decrement('stok');

        // Kembalikan respon sukses
        return response()->json(['success' => 'Buku berhasil dipinjam.'], 200);
    }

    public function setStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:PENDING,SUCCESS,FAILED'
        ]);

        $item = TransactionBook::findOrFail($id);
        $item->status = $request->status;

        $item->save();

        return redirect()->route('book.index');
    }

    public function userLendings()
    {
        if (Auth::check()) {
            // Dapatkan ID pengguna
            $userId = Auth::user()->id;

            // Ambil data buku yang dipinjam berdasarkan ID pengguna
            $transaction = TransactionBook::where('user_id', $userId)
                ->whereHas('lending') // Pastikan hanya pinjaman yang sudah ada di books_lendings
                ->get();

            // Ambil data pinjaman yang terkait dengan buku yang dipinjam
            $lendings = BooksLending::whereIn('transaction_book_id', $transaction->pluck('id'))->get();
        } else {
            // Jika pengguna tidak terautentikasi, berikan respons yang sesuai
            $lendings = collect(); // Mengembalikan koleksi kosong
        }

        // Kembalikan view dengan data buku yang dipinjam
        return view('page.page-member.pinjam.lendings', ['lendings' => $lendings]);
    }
}
