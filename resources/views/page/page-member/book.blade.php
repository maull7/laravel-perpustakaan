@extends('layouts.admin')

@section('content')
    @if (session('success'))
        <div class="alert alert-success mt-5">
            {{ session('success') }}
        </div>
    @endif


    <h3 class="text-center mt-4 mb-4">PEMINJAMAN BUKU</h3>

    <!-- Bagian Carousel -->
    <div id="carouselExampleCaptions" class="carousel slide animate-slide-in-right" data-animation="animate-slide-in-bottom"">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/img/gambar-buku.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>BUKU ITU JEMBATAN ILMU</h5>
                    <p>Untuk mendapatkan ilmu kita bisa membaca buku, buku apapun itu pasti bermanfaat</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/img/jd.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>BUKU ITU JENDELA</h5>
                    <p>Buku itu jendela untuk membuka pintu dunia</p>
                </div>
            </div>

            <div class="carousel-item">
                <img src="{{ asset('assets/img/rak-buku-cover.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>TENTANG BUKU</h5>
                    <p>Tanpa buku kita tidak akan mendapatkan ilmu ilmu yang ada dalam kehidupan</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="false"></span>
            <span class="visually-hidden">Sebelumnya</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="false"></span>
            <span class="visually-hidden">Berikutnya</span>
        </button>
    </div>

    <!-- Judul dan Hiasan di Bawah Carousel -->
    <div class="container mt-5 animate-slide-in-bottom" data-animation="animate-slide-in-bottom"">
        <h4 class="text-center mb-4">Daftar Buku Kami</h4>
        <div class="text-center mb-4">
            <p>Kami memiliki berbagai koleksi buku menarik untuk Anda pinjam. Jelajahi koleksi kami di bawah ini.</p>
            <div class="border-top border-secondary w-50 mx-auto"></div> <!-- Garis hiasan -->
        </div>


        <div class="container mt-4 mb-4">
            <div class="row">
                <div class="col-md-12">
                    <input type="text" id="search" class="form-control" placeholder="Cari buku...">
                </div>
            </div>
        </div>

        <!-- Bagian Hasil Pencarian -->
        <div class="container">
            <div class="row" id="book-results">
                <!-- Hasil pencarian akan muncul di sini -->
                @foreach ($books as $book)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-light">
                            <img class="card-img-top card-book w-100" src="{{ asset('storage/' . $book->image) }}"
                                alt="{{ $book->judul }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->judul }}</h5>
                                <p class="card-text"><strong>PENGARANG :</strong> {{ $book->pengarang }}</p>
                                <button type="button" class="btn btn-primary btn-pinjam"
                                    data-id="{{ $book->id }}">PINJAM</button>
                                <div class="form-container" id="form-container-{{ $book->id }}" style="display:none;">
                                    <form class="pinjam-form" data-id="{{ $book->id }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        <div class="form-group">
                                            <label for="durasi-{{ $book->id }}">Durasi Peminjaman (hari):</label>
                                            <input type="number" name="batas_pinjam" id="durasi-{{ $book->id }}"
                                                class="form-control" min="1" required>
                                        </div>
                                        <button type="submit" class="btn btn-success mt-4">LAKUKAN PEMINJAMAN</button>
                                    </form>
                                </div>
                                <form method="POST" action="{{ route('cart.add') }}" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="btn btn-secondary">TAMBAH</button>
                                </form>
                                <a href="{{ route('book.show', $book->id) }}" class="btn btn-warning">DETAIL</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    </div>

    </div>
    </div>
@endsection
<style>
    #book-results {
        margin-top: 20px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes slideInFromLeft {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideInFromRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideInFromBottom {
        from {
            transform: translateY(100%);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Animation classes */
    .animate-fade-in {
        animation: fadeIn 1s ease-out;
    }

    .animate-slide-in-left {
        animation: slideInFromLeft 1s ease-out;
    }

    .animate-slide-in-right {
        animation: slideInFromRight 1s ease-out;
    }

    .animate-slide-in-bottom {
        animation: slideInFromBottom 1s ease-out;
    }

    .card-img-top.card-book {
        height: 30rem;

        /* Pastikan semua gambar memiliki tinggi yang seragam */
        object-fit: cover;
        /* Pertahankan rasio aspek tanpa distorsi */
    }

    .card {
        border-radius: 10px;
        /* Sudut membulat untuk tampilan modern */
        overflow: hidden;
        /* Pastikan konten tidak meluap dari sudut kartu */
        transition: transform 0.3s, box-shadow 0.3s;
        /* Transisi halus untuk efek hover */
    }

    .card:hover {
        transform: scale(1.02);
        /* Efek zoom sedikit saat hover */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Bayangan halus untuk kedalaman */
    }

    .card-body {
        text-align: center;
        /* Pusatkan teks dan tombol */
    }

    .btn-primary {
        background-color: #007bff;
        /* Warna primer bootstrap */
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        /* Warna sekunder bootstrap */
        border: none;
    }

    .carousel {
        width: 80%;
        /* Sesuaikan lebar sesuai kebutuhan */
        margin: auto;
        /* Pusatkan carousel */
    }

    .carousel-item>img {
        height: 400px;
        /* Atur tinggi yang konsisten untuk gambar */
        object-fit: cover;
        /* Pastikan gambar menutupi area tanpa distorsi */
    }

    .carousel-caption {
        background: rgba(0, 0, 0, 0.5);
        /* Latar belakang semi-transparan untuk keterbacaan teks yang lebih baik */
        padding: 10px;
    }

    .carousel-caption h5 {
        color: #fff;
        /* Warna teks putih untuk kontras yang lebih baik */
    }

    /* Hiasan tambahan */
    .border-top {
        border-top-width: 3px;
        /* Lebar garis hiasan */
    }

    .carousel-control-prev-icon {
        height: 10rem;
        width: 5rem;
        border-radius: 50%;
        padding: 0.4rem;
        border: 1px 1px solid white;

    }



    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 24px;
        /* Width of the icon */
        height: 24px;
        /* Height of the icon */
        background-color: black;
        /* White background for the icon */
        border-radius: 50%;
        /* Circular icon */
        background-size: 50%;
        /* Icon size fits well in the button */
        background-repeat: no-repeat;
        /* No repeating of the icon image */
        background-position: center;
        /* Center the icon image */
        border: 2px solid white;
        /* White border around the icon */
    }

    /* SVG images for the previous and next icons */

    /* Hover effects */
    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        /* Slightly lighter black on hover */

        /* Deeper shadow on hover */
        transform: scale(1.1);
        /* Slight zoom effect on hover */
    }




    */
</style>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> <!-- Menyertakan Bootstrap JS -->
<script>
    $(document).ready(function() {
        // Event delegation untuk tombol "PINJAM"
        $(document).on('click', '.btn-pinjam', function() {
            var bookId = $(this).data('id');
            var formContainer = $('#form-container-' + bookId);

            // Toggle visibility of the form
            formContainer.toggle();
        });

        // Event delegation untuk form peminjaman
        $(document).on('submit', '.pinjam-form', function(event) {
            event.preventDefault();

            var form = $(this);
            var url =
            "{{ route('transactionBook.pinjam') }}"; // Pastikan URL ini sesuai dengan route yang Anda buat

            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(),
                success: function(response) {
                    console.log('Response:', response);
                    alert('Buku berhasil dipinjam.');
                    form.closest('.form-container').hide();
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                    alert('Buku atau stok telah habis');
                }
            });
        });

        // Event untuk pencarian
        $('#search').on('input', function() {
            var query = $(this).val(); // Ambil nilai dari kotak pencarian

            $.ajax({
                url: '{{ route('books.search') }}',
                method: 'GET',
                data: {
                    query: query
                },
                success: function(response) {
                    var books = response.books;
                    var output = '';
                    if (books.length > 0) {
                        books.forEach(function(book) {
                            var detailUrl =
                                '{{ route('book.show', ['book' => '__BOOK_ID__']) }}'
                                .replace('__BOOK_ID__', book.id);

                            output += `
                                <div class="col-md-4 mb-4">
                                    <div class="card shadow-sm border-light">
                                        <img class="card-img-top card-book w-100" src="{{ asset('storage/') }}/${book.image}" alt="${book.judul}">
                                        <div class="card-body">
                                            <h5 class="card-title">${book.judul}</h5>
                                            <p class="card-text"><strong>PENGARANG :</strong> ${book.pengarang}</p>
                                            <button type="button" class="btn btn-primary btn-pinjam" data-id="${book.id}">PINJAM</button>
                                            <div class="form-container" id="form-container-${book.id}" style="display:none;">
                                                <form class="pinjam-form" data-id="${book.id}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="book_id" value="${book.id}">
                                                    <div class="form-group">
                                                        <label for="durasi-${book.id}">Durasi Peminjaman (hari):</label>
                                                        <input type="number" name="batas_pinjam" id="durasi-${book.id}" class="form-control" min="1" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-success mt-4">LAKUKAN PEMINJAMAN</button>
                                                </form>
                                            </div>
                                            <form method="POST" action="{{ route('cart.add') }}" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="book_id" value="${book.id}">
                                                <button type="submit" class="btn btn-secondary">TAMBAH</button>
                                            </form>
                                            <a href="${detailUrl}" class="btn btn-warning">DETAIL</a>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                    } else {
                        output =
                            '<p class="text-center">Tidak ada buku yang ditemukan.</p>';
                    }
                    $('#book-results').html(output);
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                }
            });
        });
    });
</script>


{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi IntersectionObserver
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Tambahkan kelas animasi jika elemen muncul di viewport
                    entry.target.classList.add('animate-slide-in-bottom');
                    // Hentikan observasi elemen setelah animasi diterapkan
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1 // Persentase elemen yang harus terlihat sebelum animasi dimulai
        });

        // Pilih semua elemen dengan kelas yang memerlukan animasi
        document.querySelectorAll('[data-animation="animate-slide-in-bottom"]').forEach((element) => {
            observer.observe(element);
        });
    });
</script> --}}
{{-- 
<script>
    $('#search').on('input', function() {
        var query = $(this).val(); // Ambil nilai dari kotak pencarian

        $.ajax({
            url: '{{ route('books.search') }}',
            method: 'GET',
            data: {
                query: query
            },
            success: function(response) {
                var books = response.books;
                var output = '';
                if (books.length > 0) {
                    books.forEach(function(book) {
                        var detailUrl =
                            '{{ route('book.detail', ['book' => '__BOOK_ID__']) }}'
                            .replace('__BOOK_ID__', book.id);

                        output += `
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm border-light">
                                <img class="card-img-top card-book w-100" src="{{ asset('storage/') }}/${book.image}" alt="${book.judul}">
                                <div class="card-body">
                                    <h5 class="card-title">${book.judul}</h5>
                                    <p class="card-text"><strong>PENGARANG :</strong> ${book.pengarang}</p>
                                    <button type="button" class="btn btn-primary btn-pinjam" data-id="${book.id}">PINJAM</button>
                                    <div class="form-container" id="form-container-${book.id}" style="display:none;">
                                        <form class="pinjam-form" data-id="${book.id}" method="POST">
                                            @csrf
                                            <input type="hidden" name="book_id" value="${book.id}">
                                            <div class="form-group">
                                                <label for="durasi-${book.id}">Durasi Peminjaman (hari):</label>
                                                <input type="number" name="batas_pinjam" id="durasi-${book.id}" class="form-control" min="1" required>
                                            </div>
                                            <button type="submit" class="btn btn-success mt-4">LAKUKAN PEMINJAMAN</button>
                                        </form>
                                    </div>
                                    <form method="POST" action="{{ route('cart.add') }}" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="book_id" value="${book.id}">
                                        <button type="submit" class="btn btn-secondary">TAMBAH</button>
                                    </form>
                                    <a href="${detailUrl}" class="btn btn-warning">DETAIL</a>
                                </div>
                            </div>
                        </div>
                    `;
                    });
                } else {
                    output = '<p class="text-center">Tidak ada buku yang ditemukan.</p>';
                }
                $('#book-results').html(
                    output); // Pastikan ID yang digunakan di sini sama dengan ID elemen di HTML
            },
            error: function(xhr) {
                console.log('Error:', xhr.responseText);
            }
        });
    });
</script> --}}
