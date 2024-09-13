@extends('layouts.admin')
@section('content')
    <div class="orders mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="text-center">TAMBAH DATA BUKU</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="Books" class="form-label">JUDUL BUKU</label>
                                <input type="text" name="judul" class="form-control" id="Books"
                                    placeholder="Masukan nama produk" value="{{ old('judul') }}">
                                @error('judul')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="Type" class="form-label">GAMBAR</label>
                                <input type="file" name="image" class="form-control" id="Type"
                                    placeholder="Masukan tipe produk" value="{{ old('image') }}">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="Price" class="form-label">PENGARANG BUKU</label>
                                <input type="text" name="pengarang" class="form-control" id="Price"
                                    placeholder="Masukan harga produk" value="{{ old('pengarang') }}">
                                @error('pengarang')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="Price" class="form-label">PENERBIT BUKU</label>
                                <input type="text" name="penerbit" class="form-control" id="Price"
                                    placeholder="Masukan harga produk" value="{{ old('penerbit') }}">
                                @error('penerbit')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="Quantity" class="form-label">STOK BUKU</label>
                                <input type="number" name="stok" class="form-control" id="Quantity"
                                    placeholder="Masukan stok produk" value="{{ old('stok') }}">
                                @error('stok')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="Genre" class="form-label">GENRE BUKU</label>
                                <select name="genre_id" id="Genre" class="form-control">
                                    <option value="">PILIH GENRE BUKU</option>
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
                                    @endforeach
                                </select>
                                @error('genre')
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
