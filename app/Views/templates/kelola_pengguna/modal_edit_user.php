<div class="modal fade" id="modal-edit-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="delete-modal-label">Ubah Data Pengguna</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="<?= esc(base_url('user/ubah_pengguna')) ?>" method="post" role="form text-left">
                    <?= csrf_field() ?>

                    <div class="mb-3 d-none">
                        <div class="col-5">
                            <label for="id">User ID</label>
                        </div>
                        <div class="col-7">
                            <input name="id" id="id-edit" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">
                            <label for="nama_lengkap">Nama Lengkap</label>
                        </div>
                        <div class="col-7">
                            <input name="nama_lengkap" id="nama_lengkap-edit" type="text" class="form-control" placeholder="Nama Lengkap" aria-label="Name" aria-describedby="email-addon">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">
                            <label for="role">Role</label>
                        </div>
                        <div class="col-7">
                            <input name="role" id="role-edit" type="text" class="form-control" placeholder="Nama Lengkap" aria-label="Role" aria-describedby="role-addon">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-5">
                            <label for="nip">NIP 18 digit</label>
                        </div>
                        <div class="col-7">
                            <input type="text" class="form-control " id="nip-edit" name="nip" placeholder="NIP Pengguna">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">
                            <label for="bidang">Bidang</label>
                        </div>
                        <div class="col-7">
                            <select class="form-select" id="bidang-edit" name="bidang">
                                <option selected disabled>Pilih Fungsi</option>
                                <option>Kepala</option>
                                <option>Bagian Tata Usaha</option>
                                <option>Bagian Umum</option>
                                <option>Fungsi Statistik Sosial</option>
                                <option>Fungsi Statistik Produksi</option>
                                <option>Fungsi Statistik Distribusi</option>
                                <option>Fungsi Neraca Wilayah dan Analisis</option>
                                <option>Fungsi Integrasi Pengolahan dan Diseminasi Statistik</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">
                            <label for="email">E-mail</label>
                        </div>
                        <div class="col-7">
                            <input name="email" type="email" id="email-edit" class="form-control " aria-label="Email" aria-describedby="email-addon">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">
                            <label for="password">Password</label>
                        </div>
                        <div class="col-7">
                            <input type="password" name="password" placeholder="Isi dengan Password yang baru" class="form-control" autocomplete="off" aria-label="Password" aria-describedby="password-addon">
                        </div>
                    </div>

                    <input name="url" type="text" class="d-none" value="<?= base_url($uri->getPath()); ?>">

            </div>

            <div class="modal-footer">
                <input type="button" class="btn btn-sm btn-default" data-bs-dismiss="modal" value="Batalkan">
                <input type="submit" class="btn btn-sm btn-warning" value="Konfirmasi"></input>
            </div>
            </form>
        </div>
    </div>
</div>