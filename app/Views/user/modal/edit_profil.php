<!-- modal lihat rincian -->
<div class="modal fade" id="modal-edit-profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="rincian-modal-label">Edit Data Profil</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= esc(base_url('user')); ?>/ubah_profil_data" method="post" role="form">
                    <?= csrf_field() ?>

                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="nama_lengkap">Nama Lengkap</label>
                        </div>
                        <div class="col-7">
                            <input type="text" name="nama_lengkap" class="form-control" value="<?= user()->nama_lengkap ?>" required>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="nama_lengkap">E-mail</label>
                        </div>
                        <div class="col-7">
                            <input type="email" name="email" class="form-control" value="<?= user()->email ?>">
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="bidang">Bidang</label>
                        </div>
                        <div class="col-7">
                            <input type="text" name="bidang" class="form-control" value="<?= user()->bidang ?>">
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="nip">NIP</label>
                        </div>
                        <div class="col-7">
                            <input type="text" name="nip" class="form-control" value="<?= user()->nip ?>">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-sm" data-bs-dismiss="modal" value="Batal">
                <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
                <input type="hidden" name="id" class="form-control" value="<?= user()->id ?>">
                </form>

            </div>
        </div>
    </div>
</div>
<!-- end modal lihat rincian -->