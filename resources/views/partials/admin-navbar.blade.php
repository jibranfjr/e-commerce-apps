<nav class="navbar navbar-expand-lg bg-dark-subtle">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item me-4">
                    <a class="nav-link" href="{{ url('/admin') }}">Home</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="{{ url('/admin/kategori') }}">Kategori</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="{{ url('/admin/produk') }}">Produk</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="{{ url('/admin/transaksi') }}">Transaksi</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="{{ url('admin/users') }}">Users</a>
                </li>
                <li>
                    <a class='nav-link' href="{{ route('admin.laporan.transaksi.pdf') }}" target="_blank" class="btn btn-primary">
                        Cetak Laporan Transaksi (PDF)
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link" style="display:inline; padding:0; border:none; background:none;">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>