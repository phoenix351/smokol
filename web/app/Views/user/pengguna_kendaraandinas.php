<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<style>
    #daftar-pegawai {
        font-size: 0.93em;
    }

    .table-title {
        background-color: rgb(75, 0, 130);
    }

    .bg-primary {
        background-color: rgb(75, 0, 130) !important;
    }

    .id {
        display: none;
    }
</style>
<!-- modal add form -->
<div class="modal fade" id="modal-add-barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="delete-modal-label">Tambah Data Barang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="<?= esc(base_url('user/tambah_kendaraan')); ?>" method="post" role="form">
                    <?= csrf_field() ?>
                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="nama">Nama Barang</label>
                        </div>
                        <div class="col-7">
                            <input type="text" class="form-control" name="nama" required></input>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5"><label for="tipe" class="col-form-label">Tipe </label></div>
                        <div class="col-7"><select class="form-select" name="tipe" required>
                                <?php foreach ($type_list as $type) : ?>
                                    <option><?= esc($type) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5"><label for="merk" class="col-form-label">Merk</label></div>
                        <div class="col-7"><select class="form-select" name="merk" required>
                                <?php foreach ($merk_list as $merk) : ?>
                                    <option><?= esc($merk) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5"><label for="tahun_peroleh" class="col-form-label">Tahun</label></div>
                        <div class="col-7"><select class="form-select" name="tahun_peroleh" required>
                                <?php
                                $e = (int)date("Y");
                                for ($x = $e; $x >= ($e - 15); $x -= 1) : ?>
                                    <option><?= esc($x) ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group mb-3 d-none">
                        <div class="col-5">
                            <label class="col-form-label" for="nip_pemakai">NIP Pemakai (18 Digit)</label>
                        </div>
                        <div class="col-7">
                            <input type="text" name="nip_pemakai" class="form-control" value="<?= esc(user()->nip); ?>">
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="kondisi">Kondisi Barang</label>
                        </div>
                        <div class="col-7">
                            <select class="form-select" name="kondisi" required>
                                <?php foreach ($kondisi_list as $kondisi) : ?>
                                    <option><?= esc($kondisi); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="status">Status Barang</label>
                        </div>
                        <div class="col-7">
                            <select class="form-select" name="status" required>
                                <option>Operasional</option>
                                <option>Perbaikan</option>
                                <option>Tidak digunakan</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group mb-3">
                        <div class="col-5"><label for="lokasi" class="col-form-label">Lokasi Barang</label></div>
                        <div class="col-7"><select class="form-select" name="lokasi" required>
                                <?php foreach ($room_list as $room) : ?>
                                    <option><?= esc($room) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="nomor_plat">Nomor Plat</label>
                        </div>
                        <div class="col-7">
                            <input type="text" class="form-control form-control-sm" name="nomor_plat" required></input>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="besar_cc">Besar CC</label>
                        </div>
                        <div class="col-7">
                            <input type="text" class="form-control form-control-sm" name="besar_cc" required></input>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="nomor_seri">Nomor Seri</label>
                        </div>
                        <div class="col-7">
                            <input type="text" class="form-control form-control-sm" name="nomor_seri" required></input>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="nib">NIB</label>
                        </div>
                        <div class="col-7">
                            <input type="text" class="form-control form-control-sm" name="nib" required></input>
                        </div>
                        <input type="text" name="url" class="d-none" value="<?= esc(base_url($uri->getPath())); ?>">

                    </div>
            </div>


            <div class="modal-footer">
                <input type="button" class="btn btn-sm btn-default" data-bs-dismiss="modal" value="Batalkan">
                <input type="submit" id="submit-add" class="btn btn-sm btn-success" value="Simpan">
            </div>
            </form>
        </div>
    </div>
</div>


<!-- end modal add -->


<!-- Modal Pengajuan form -->
<div class="modal fade" id="modal-submit-barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="edit-modal-label">Formulir Pengajuan Barang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-edit-barang" method="post">
                    <div class="form-group mb-3">
                        <label for="id1">ID Barang</label>
                        <input type="text" class="form-control form-control-sm" id="id1" disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label for="keluhan">Keluhan</label>
                        <textarea name="keluhan" id="keluhan" cols="30" rows="10" class="form-control form-control-sm"></textarea>
                    </div>
            </div>

            </form>
            <div class="modal-footer">
                <input type="button" class="btn btn-sm btn-default" data-bs-dismiss="modal" value="Batalkan">
                <input type="submit" id="submit" class="btn btn-sm btn-success" value="Simpan Perubahan">
            </div>
        </div>
    </div>
</div>
<!-- end modal edit -->



<h3><?php echo esc($title); ?></h3>


<button href="#" class="btn btn-sm btn-success mb-3 mt-2" id="tambah-barang">Tambah Barang</button>
<div class="table-responsive">
    <table class="table table-bordered  table-hover" id="daftar-barang">
        <thead>
            <tr>

                <th class="id">ID Barang</th>
                <th>Tipe</th>
                <th>Merk</th>
                <th>Nomor Plat</th>
                <th>satuan CC</th>
                <th>Tahun Peroleh</th>
                <th>Kondisi</th>


                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barang as $brg) : ?>
                <tr>


                    <td class="id"><?= esc($brg['id']); ?></td>
                    <td class="tipe"><?= esc($brg['tipe']); ?></td>
                    <td class="merk"><?= esc($brg['merk']); ?></td>
                    <td class="nomor-plat"><?= esc($brg['nomor_plat']); ?></td>
                    <td class="besar-cc"><?= esc($brg['besar_cc']); ?></td>
                    <td class='tahun_peroleh'><?= esc($brg['tahun_peroleh']); ?></td>
                    <td class="kondisi"><?= esc($brg['kondisi']); ?></td>

                    <td>
                        <a href="#" class="btn btn-sm btn-primary submit" data-toggle="modal">Pengajuan</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('#daftar-barang').DataTable();

    });

    // fungsi pengajuan ter klik
    $(".submit").click(function() {
        // ambil data di row
        let row = $(this).closest("tr");
        let id = row.find(".id").text();

        // taruh di form edit
        $("#id1").val(id);
        $("#modal-submit-barang").modal('show');

    });

    // function edit clicked
    $("#submit").click(function(tipe = 0) {

        let data = {
            id_barang: $("#id1").val(),
            type: tipe,
            complain: $("#keluhan").val()
        }

        //alert(JSON.stringify(data));

        $.ajax({
                method: "POST",
                url: "<?= esc(base_url()); ?>/user/ajukan",
                data: data
            })
            .done(function(msg) {
                console.log(msg);
                location.reload();
            })
            .fail(function(err) {
                alert("barang tersebut sudah dalam proses pangajuan");
            })
    });

    $("#tambah-barang").click(function() {
        $("#modal-add-barang").modal('show');


    });
</script>


<?= $this->endSection(); ?>