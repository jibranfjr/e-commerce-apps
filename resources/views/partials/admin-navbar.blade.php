<nav class="navbar navbar-expand-lg navbar-dark warna1 font-custom">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/admin') }}">
            <img src="{{ asset('image/logo1.png') }}" alt="Logo" width="70" height="70" class="d-inline-block align-text-top">
        </a>

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
                    <a class="nav-link" href="{{ url('/admin/transaksi') }}">
                        Transaksi
                    @if($pendingTransaksi > 0)
                            <span class="badge bg-danger">{{ $pendingTransaksi }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="{{ url('admin/users') }}">Users</a>
                </li>
                <li class="nav-item dropdown me-4">
                    <a class="nav-link dropdown-toggle" href="#" id="laporanDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Cetak Laporan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="laporanDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.laporan.transaksi.pdf', ['filter' => 'minggu']) }}" target="_blank">
                                Laporan Minggu Ini
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.laporan.transaksi.pdf', ['filter' => 'bulan']) }}" target="_blank">
                                Laporan Bulan Ini
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('admin.laporan.transaksi.pdf') }}" method="GET" target="_blank" class="px-3 py-2">
                                <label class="form-label">Custom Range</label>
                                <input type="date" name="start_date" class="form-control mb-2" required>
                                <input type="date" name="end_date" class="form-control mb-2" required>
                                <input type="hidden" name="filter" value="custom">
                                <button type="submit" class="btn btn-sm warna2 text-white button-click w-100">Cetak</button>
                            </form>
                        </li>
                    </ul>
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