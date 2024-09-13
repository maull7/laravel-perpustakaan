@extends('layouts.admin')
@section('content')
    <div class="orders mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="text-center">TAMBAH GENRE BUKU</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('genre.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="Books" class="form-label">GENRE BUKU</label>
                                <input type="text" name="genre" class="form-control" id="Books"
                                    placeholder="Masukan genre buku" value="{{ old('genre') }}">
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
