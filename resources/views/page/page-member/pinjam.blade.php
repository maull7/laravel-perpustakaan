@extends('layouts.admin')
@section('content')
    <div class="orders mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="text-center"> FORM PEMINJAMAN BUKU</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('transactionBook.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="Price" class="form-label">BUKU</label>
                                <input type="hidden" name="book_id" class="form-control" id="Price"
                                    placeholder="Masukan harga produk" value="{{ old('book_id', $book->id) }}">
                                @error('book_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="Quantity" class="form-label">BATAS PINJAM BUKU</label>
                                <input type="number" name="batas_pinjam" class="form-control" id="Quantity"
                                    placeholder="Masukan batas_pinjam produk" value="{{ old('batas_pinjam') }}">
                                @error('batas_pinjam')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-success" type="submit">TAMBAH</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
