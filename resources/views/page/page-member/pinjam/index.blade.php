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
                        <h3 class="text-center">DAFTAR PINJAMAN ANDA</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama peminjam</th>
                                        <th>No Pinjam</th>
                                        <th>Buku</th>
                                        <th>Genre</th>
                                        <th>Tanggal dipinjam</th>
                                        <th>Status</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $hasPending = $books->contains('status', 'PENDING');
                                        $hasFailed = $books->contains('status', 'FAILED');
                                    @endphp

                                    @if ($hasFailed)
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                <img src="{{ asset('assets/img/gagal.png') }}" alt="Failed"
                                                    style="width: 20rem; height: 20rem;">
                                                <h5>Data Anda gagal diproses. Silakan hubungi admin.</h5>
                                            </td>
                                        </tr>
                                    @elseif ($hasPending)
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                <img src="{{ asset('assets/img/pending.png') }}" alt="Pending"
                                                    style="width: 20rem; height: 20rem;">
                                                <h5>Data Anda sedang diproses oleh admin</h5>
                                            </td>
                                        </tr>
                                    @endif

                                    @forelse ($books as $book)
                                        @if ($book->status != 'PENDING' && $book->status != 'FAILED')
                                            <tr>
                                                <td>{{ $book->user->name }}</td>
                                                <td>{{ $book->uuid }}</td>
                                                <td>{{ $book->book->judul }}</td>
                                                <td>{{ $book->book->genre->genre }}</td>
                                                <td>{{ $book->tanggal_di_pinjam }}</td>
                                                <td>{{ $book->status }}</td>
                                                <td>
                                                    <form action="{{ route('lendings', $book->id) }}" method="POST"
                                                        style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">Kembalikan
                                                            Buku</button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endif
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
