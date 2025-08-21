{{-- resources/views/transaksi.blade.php --}}

@auth
<div class="modal fade font-custom" id="formCheckoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="checkoutModalLabel">Formulir Pembelian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6 border-end">
                        <h6 class="fw-bold mb-3">Transfer Ke Rekening Toko</h6>
                        <p class="mb-1">Bank: BRI</p>
                        <p class="mb-1">No. Rekening: <strong>0017 0101 4827 530</strong></p>
                        <p class="mb-3">Atas Nama: Toko Permata Puri Bali</p>
                        <hr>
                        <h6 class="fw-bold mb-2">Detail Produk</h6>
                        <input type="hidden" name="id_produk" value="{{ $produk->id }}">
                        <p class="mb-1">Nama Produk:</p>
                        <input type="text" class="form-control mb-2" value="{{ $produk->nama }}" readonly>
                        <p class="mb-1">Harga:</p>
                        <input type="text" class="form-control mb-2" value="Rp {{ number_format($produk->harga, 0, ',', '.') }}" readonly>
                        <input type="hidden" id="harga_satuan" value="{{ $produk->harga }}">
                        <p class="mb-1">Jumlah:</p>
                        <input type="number" id="checkout_qty" name="jumlah" class="form-control mb-2" value="1" min="1" readonly>
                        <p class="mb-1">Total Harga:</p>
                        <input type="text" id="total_harga" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3">Data Pemesan</h6>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control mb-2" value="{{ Auth::user()->username }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                            <textarea id="alamat" name="alamat" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="bank" class="form-label">Transfer dari Bank</label>
                            <select id="bank" name="bank" class="form-select" required>
                                <option value="" selected disabled>Pilih Bank Anda</option>
                                <option value="BRI">BRI</option>
                                <option value="BNI">BNI</option>
                                <option value="BCA">BCA</option>
                                <option value="Mandiri">Mandiri</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nomor_rekening" class="form-label">No. Rekening Anda</label>
                            <input id="nomor_rekening" name="nomor_rekening" type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_rekening" class="form-label">Nama di Rekening Anda</label>
                            <input id="nama_rekening" name="nama_rekening" type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="bukti_pembayaran" class="form-label">Upload Bukti Transfer</label>
                            <input id="bukti_pembayaran" name="bukti_pembayaran" type="file" class="form-control" accept="image/*" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <small class="text-muted">Setelah klik “Buat Pesanan”, tim kami akan memverifikasi pembayaran Anda.</small>
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn warna2 button-click text-white">Buat Pesanan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth