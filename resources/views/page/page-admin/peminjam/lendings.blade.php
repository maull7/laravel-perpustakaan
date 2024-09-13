@extends('layouts.admin')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="orders mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">DAFTAR BUKU YANG TELAH DIKEMBALIKAN</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Peminjam</th>
                                        <th>Nama Buku</th>
                                        <th>Pengarang</th>
                                        <th>Penerbit</th>
                                        <th>Genre</th>
                                        <th>Denda</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($lendings as $lending)
                                        @php
                                            $transaction = $lending->transactionBook; // Relasi dengan TransactionBook
                                            $book = $transaction->book; // Mengambil data buku dari TransactionBook
                                            $user = $transaction->user; // Mengambil data peminjam dari TransactionBook
                                        @endphp
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $book->judul }}</td>
                                            <td>{{ $book->pengarang }}</td>
                                            <td>{{ $book->penerbit }}</td>
                                            <td>{{ $book->genre->genre }}</td>
                                            <td>Rp {{ number_format($lending->denda, 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Data belum tersedia!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
