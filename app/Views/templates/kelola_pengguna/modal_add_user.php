<div class="modal fade" id="modal-add-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="delete-modal-label">Tambah Pengguna Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="<?= esc(route_to('register')) ?>" method="post" role="form text-left">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <input name="nama_lengkap" type="text" class="form-control" placeholder="Nama Lengkap" aria-label="Name" aria-describedby="email-addon" autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control " name="nip" placeholder="NIP Pengguna" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="bidang">
                            <option selected disabled>Pilih Fungsi</option>
                            <?php foreach ($fungsi_list as $fungsi) : ?>
                                <option><?= esc($fungsi) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input name="email" type="email" class="form-control " aria-label="Email" aria-describedby="email-addon" autocomplete="off" placeholder="E-mail">
                        <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" autocomplete="off" aria-label="Password" aria-describedby="password-addon" placeholder="Password">
                    </div>

                    <input name="url" type="text" class="d-none" value="<?= base_url($uri->getPath()); ?>">

            </div>

            <div class="modal-footer">
                <input type="button" class="btn btn-sm btn-default" data-bs-dismiss="modal" value="Batalkan">
                <input type="submit" class="btn btn-sm btn-primary" value="Daftarkan"></input>
            </div>
            </form>
        </div>
    </div>
</div>