<!-- modal lihat rincian -->
<div class="modal fade" id="modal-lihat-rincian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="rincian-modal-label">Rincian Barang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-4">
                        <b>Nomor Tiket</b>
                    </div>
                    <div class="col-8">
                        <span id="nomor-tiket"></span>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-4">
                        <b>Status Pengajuan</b>
                    </div>
                    <div class="col-8">
                        <span id="status"></span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <b>Tanggal Pengajuan</b>
                    </div>

                    <div class="col-8">
                        <span id="tanggal-pengajuan"></span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <b>Tanggal Mulai Diproses</b>
                    </div>
                    <div class="col-8">
                        <span id="tanggal-proses"></span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <b>Tanggal Selesai</b>
                    </div>
                    <div class="col-8">
                        <span id="tanggal-selesai"></span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <b>Keluhan</b>
                    </div>
                    <div class="col-8">
                        <span id="keluhan"></span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <b>Total Biaya</b>
                    </div>
                    <div class="col-8">
                        <span id="biaya"></span>
                    </div>
                </div>
                 <div class="row mb-2">
                    <div class="col-4">
                        <b>Bukti Rusak Berat</b>
                    </div>
                    <div class="col-8">
                        <a id="bukti-rusak-berat" href="#">Download bukti</a>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal" value="Oke">
            </div>


        </div>
    </div>
</div>
<!-- end modal lihat rincian -->