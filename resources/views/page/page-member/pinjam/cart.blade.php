@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Keranjang Belanja</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (empty($cart))
            <p>Keranjang Anda kosong.</p>
        @else
            <form action="{{ route('transactionBook.store') }}" method="POST">
                @csrf
                <table class="table">
                    <thead>
                        <tr>
                            <th>Judul Buku</th>
                            <th>Kuantitas</th>
                            <th>Update Kuantitas</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        @foreach ($cart as $bookId => $item)
                            <tr data-book-id="{{ $bookId }}">
                                <td>{{ $item['book']->judul }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>
                                    <input type="number" class="quantity-input form-control"
                                        data-book-id="{{ $bookId }}" value="{{ $item['quantity'] }}" min="1"
                                        style="width: 100px;">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-delete"
                                        data-book-id="{{ $bookId }}">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="form-group">
                    <label for="batas_pinjam">Pinjam dalam (hari):</label>
                    <input type="number" name="batas_pinjam" id="batas_pinjam" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success mt-4">Konfirmasi Peminjaman</button>
            </form>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Handle quantity update
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    const bookId = this.getAttribute('data-book-id');
                    const quantity = this.value;

                    const url = "{{ route('cart.update') }}";

                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                book_id: bookId,
                                quantity: quantity
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.reload();
                            } else {
                                alert('Terjadi kesalahan.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });

            // Handle item removal
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function() {
                    const bookId = this.getAttribute('data-book-id');

                    const url = "{{ route('cart.remove') }}";

                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                book_id: bookId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.reload();
                                // Remove the table row
                                document.querySelector(`tr[data-book-id="${bookId}"]`).remove();

                                // Optionally, update the cart status if needed
                            } else {
                                alert('Terjadi kesalahan.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
@endsection
