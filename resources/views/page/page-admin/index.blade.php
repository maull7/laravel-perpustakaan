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
                        <h3 class="text-center">DAFTAR BUKU TERSEDIA</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Gambar</th>
                                        <th>Pengarang</th>
                                        <th>Peneribit</th>
                                        <th>Stok</th>
                                        <th>Genre</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($books as $book)
                                        <tr>
                                            <td>{{ $book->id }}</td>
                                            <td>{{ $book->judul }}</td>
                                            <td><img class="gambar" src="{{ asset('storage/' . $book->image) }}"
                                                    alt=""></td>
                                            <td>{{ $book->pengarang }}</td>
                                            <td>{{ $book->penerbit }}</td>
                                            <td>{{ $book->stok }}</td>
                                            <td> {{ $book->quantity }}</td>
                                            <td>{{ $book->genre->genre }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('book.edit', $book->id) }}" class="btn btn-info"><i
                                                            class="fa fa-pencil-square"></i></a>
                                                    <form action="{{ route('book.destroy', $book->id) }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger mx-1"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>

                                            </td>
                                        </tr>
                                    @empty
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="alert alert-danger" role="alert">
                                                    data belum tersedia!
                                                </div>
                                            </div>
                                        </div>
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
<style>
    img.gambar {
        width: 70px;
        height: 50px;
    }
</style>
