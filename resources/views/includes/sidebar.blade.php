<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            @if (Auth::check() && Auth::user()->is_admin)
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">HOME</div>
                    <a class="nav-link" href="{{ route('admin') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">BUKU</div>
                    <a class="nav-link" href="{{ route('book.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        BUKU
                    </a>
                    <a class="nav-link" href="{{ route('book.create') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        TAMBAH BUKU
                    </a>


                    <div class="sb-sidenav-menu-heading">PEMINJAMAN</div>
                    <a class="nav-link" href="{{ route('admin.peminjam') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        DAFTAR PEMINJAM
                    </a>

                    <a class="nav-link" href="{{ route('admin.kembali') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        BUKU DIKEMBALIKAN
                    </a>

                    <div class="sb-sidenav-menu-heading">GENRE</div>
                    <a class="nav-link" href="{{ route('genre.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        GENRE BUKU
                    </a>
                    <a class="nav-link" href="{{ route('genre.create') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        TAMBAH GENRE BUKU
                    </a>


                </div>
            @else
                <div class="nav">
                    <a class="nav-link" href="{{ route('home') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        HOME
                    </a>
                    <div class="sb-sidenav-menu-heading">BUKU</div>
                    <a class="nav-link" href="{{ route('show.book') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        BUKU
                    </a>
                    <a class="nav-link" href="{{ route('cart.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        KERANJANG
                    </a>


                    <div class="sb-sidenav-menu-heading">PEMINJAMAN</div>
                    <a class="nav-link" href="{{ route('transactionBook.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        PINJAM BUKU
                    </a>

                    <a class="nav-link" href="{{ route('transactionBook.lendings') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        KEMBALIKAN BUKU
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        <button class="btn btn-primary">LOGOUT</button>
                    </form>
                </div>
            @endif
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>
