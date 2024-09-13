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
                        <h3 class="text-center">DAFTAR GENRE BUKU</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>GENRE BUKU</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($genres as $genre)
                                        <tr>
                                            <td>{{ $genre->id }}</td>
                                            <td>{{ $genre->genre }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('genre.edit', $genre->id) }}" class="btn btn-info"><i
                                                            class="fa fa-pencil-square"></i></a>
                                                    <form action="{{ route('genre.destroy', $genre->id) }}" method="POST">
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
