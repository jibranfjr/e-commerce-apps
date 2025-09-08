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
                    {{-- Kolom Kiri: Detail Produk --}}
                    <div class="col-md-6 border-end">
                        <h6 class="fw-bold mb-3">Transfer Ke Rekening Toko</h6>
                        <p class="mb-1">Bank: BRI</p>
                        <p class="mb-1">No. Rekening: <strong>0017 0101 4827 530</strong></p>
                        <p class="mb-3">Atas Nama: Toko Permata Puri Bali</p>
                        <hr>
                        <h6 class="fw-bold mb-2">Detail Produk</h6>
                        <div id="produkList"></div>
                        <p class="mb-1 mt-2">Total Harga:</p>
                        <input type="text" id="total_harga" class="form-control" readonly>
                    </div>

                    {{-- Kolom Kanan: Data Pemesan --}}
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
@if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

@if(session('invoice_id'))
    <script>
        window.onload = function() {
            // otomatis buka tab baru untuk download invoice
            window.open("{{ route('invoice.generate', session('invoice_id')) }}", "_blank");
        }
    </script>
@endif

<script>
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("formCheckoutModal");
    modal.addEventListener("show.bs.modal", function () {
        let produkList = document.getElementById("produkList");
        produkList.innerHTML = "";
        let total = 0;

        document.querySelectorAll('input[name="selected_carts[]"]:checked').forEach(cb => {
            let id = cb.getAttribute("data-produk-id");
            let nama = cb.getAttribute("data-nama");
            let harga = parseInt(cb.getAttribute("data-harga"));
            let qty = parseInt(cb.getAttribute("data-qty"));
            let subtotal = harga * qty;
            total += subtotal;

            produkList.innerHTML += `
                <input type="hidden" name="id_produk[]" value="${id}">
                <input type="hidden" name="jumlah[]" value="${qty}">
                <p class="mb-1">${nama} (x${qty})</p>
                <input type="text" class="form-control mb-2" value="Rp ${subtotal.toLocaleString('id-ID')}" readonly>
            `;
        });

        document.getElementById("total_harga").value = "Rp " + total.toLocaleString("id-ID");
    });
});
</script>