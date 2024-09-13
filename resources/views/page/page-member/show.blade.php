@extends('layouts.admin')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container my-5">
        <div class="row">
            <!-- Gambar Buku dan Informasi -->
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="card border-0 shadow-sm">
                    <img class="card-img-top img-fluid rounded" style="max-height: 20rem; object-fit: cover;"
                        src="{{ asset('storage/' . $book->image) }}" alt="Cover Buku">
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm p-4">
                    <h1 class="card-title mb-4">{{ $book->judul }}</h1>
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <th scope="row" class="font-weight-bold">Penulis</th>
                                <td>{{ $book->pengarang }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="font-weight-bold">Penerbit</th>
                                <td>{{ $book->penerbit }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="font-weight-bold">Stok Buku</th>
                                <td>{{ $book->stok }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Form Komentar -->
        <div class="comment-section mt-5">
            <h2 class="mb-4">Komentar</h2>
            <div class="card border-0 shadow-sm p-4">
                <form action="{{ route('book.comment', $book->id) }}" method="post">
                    @csrf <!-- Tambahkan token CSRF untuk keamanan -->

                    <div class="form-group">
                        <label for="comment">Komentar:</label>
                        <textarea id="comment" name="comment" class="form-control" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Kirim Komentar</button>
                </form>

                <!-- Daftar Komentar -->
                <div class="comments-list mt-4">
                    @forelse ($book->comments as $comment)
                        <div class="comment mb-3 p-3 border rounded shadow-sm">
                            <p><strong>{{ $comment->user->name }}</strong> : {{ $comment->comment }}</p>
                        </div>
                    @empty
                        <p>Belum ada komentar.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .container {
        max-width: 1140px;
    }

    .card-img-top {
        object-fit: cover;
    }

    .comment-section {
        border-top: 1px solid #ddd;
        padding-top: 20px;
    }

    .comment-section h2 {
        margin-top: 0;
    }

    .comment {
        background-color: #f9f9f9;
    }

    .shadow-sm {
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
    }

    .card {
        border-radius: .375rem;
    }

    .card-title {
        font-size: 1.5rem;
        margin-bottom: .75rem;
    }
</style>
