@extends('layouts.admin')

@section('content')
    <section class="hero-section mt-5 animate-on-scroll" data-animation="animate-slide-in-bottom">
        <div class="container">
            <h1>Selamat Datang {{ Auth::user()->name }}</h1>
            <p>Temukan buku-buku terbaru dan favorit Anda di sini.</p>
            <a href="{{ route('show.book') }}" class="btn btn-light btn-lg">Jelajahi Buku</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section text-center animate-on-scroll" data-animation="animate-slide-in-left">
        <div class="container">
            <h2 class="mb-4">Fitur Kami</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3>Beragam Koleksi</h3>
                    <p>Koleksi buku yang beragam dari berbagai genre dan penulis terkenal.</p>
                </div>
                <div class="col-md-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>Peminjaman Mudah</h3>
                    <p>Peminjaman buku yang mudah dan cepat dengan sistem online kami.</p>
                </div>
                <div class="col-md-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3>Customer Support</h3>
                    <p>Dukungan pelanggan yang ramah dan siap membantu Anda kapan saja.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- New Books Section -->
    <section class="new-books py-5 animate-on-scroll" data-animation="animate-slide-in-bottom">
        <div class="container">
            <h2 class="text-center mb-4">Buku Terbaru</h2>
            <div class="row">
                @foreach ($books as $book)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-light">
                            <img class="card-img-top card-book w-100" src="{{ asset('storage/' . $book->image) }}"
                                alt="{{ $book->judul }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->judul }}</h5>
                                <p class="card-text"><strong>PENGARANG :</strong> {{ $book->pengarang }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

<style>
    /* Keyframes for animations */
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

    /* Hero Section */
    .hero-section {
        background: url('assets/img/rak-buku-cover.jpg') no-repeat center center;
        background-size: cover;
        color: #fff;
        padding: 120px 0;
        text-align: center;
        border-bottom: 5px solid #007bff;
        position: relative;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .hero-section .container {
        position: relative;
        z-index: 2;
    }

    .hero-section h1 {
        font-size: 3.5rem;
        font-weight: bold;
    }

    .hero-section p {
        font-size: 1.5rem;
        margin: 20px 0;
    }

    .hero-section .btn {
        font-size: 1.25rem;
        padding: 10px 30px;
        border-radius: 50px;
    }

    /* Features Section */
    .features-section {
        padding: 60px 0;
    }

    .features-section h2 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 40px;
    }

    .features-section .feature-icon {
        font-size: 3rem;
        color: #007bff;
        margin-bottom: 15px;
    }

    .features-section .feature-icon i {
        transition: color 0.3s;
    }

    .features-section .feature-icon i:hover {
        color: #0056b3;
    }

    /* New Books Section */
    .new-books {
        background: #f8f9fa;
        padding: 60px 0;
    }

    .new-books h2 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 40px;
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
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const elementsToAnimate = document.querySelectorAll('.animate-on-scroll');

        const isInViewport = (element) => {
            const rect = element.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        };

        const handleScroll = () => {
            elementsToAnimate.forEach((element) => {
                if (isInViewport(element)) {
                    const animationClass = element.getAttribute('data-animation');
                    if (animationClass) {
                        element.classList.add(animationClass);
                    }
                }
            });
        };

        // Initial check
        handleScroll();

        // Event listener for scroll
        window.addEventListener('scroll', handleScroll);
    });
</script>
