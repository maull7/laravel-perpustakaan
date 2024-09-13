@extends('layouts.admin')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    {{-- {{ dd($books) }} --}}

    <div class="orders mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">DAFTAR PEMINJAM</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama peminjam</th>
                                        <th>No Pinjam</th>
                                        <th>Buku</th>
                                        <th>Tanggal dipinjam</th>
                                        <th>Batas peminjaman</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($books as $book)
                                        <tr>
                                            <td>{{ $book->id }}</td>
                                            <td>{{ $book->user->name }}</td>
                                            <td>{{ $book->uuid }}</td>
                                            <td>{{ $book->book->judul }}</td>
                                            <td>{{ $book->tanggal_di_pinjam }}</td>
                                            <td>{{ $book->batas_pinjam }} hari</td>
                                            <td>
                                                @if ($book->status == 'PENDING')
                                                    <a href="{{ route('transactionBook.status', $book->id) }}?status=SUCCESS"
                                                        class="btn btn-success mx-1 btn-sm">
                                                        <i class="fa fa-check"></i></a>
                                                    <a href="{{ route('transactionBook.status', $book->id) }}?status=FAILLED"
                                                        class="btn btn-warning mx-1 btn-sm">
                                                        <i class="fa fa-times"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Data belum tersedia!</td>
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
