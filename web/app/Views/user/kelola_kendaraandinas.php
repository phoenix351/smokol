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
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="delete-modal-label">Tambah Data Barang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="<?= esc(base_url('user/tambah_kendaraan')); ?>" method="post" role="form">
                    <?= csrf_field() ?>
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
                        <div class="col-5"><label for="tahun" class="col-form-label">Tahun</label></div>
                        <div class="col-7"><select class="form-select" name="tahun" required>
                                <?php
                                $e = (int)date("Y");
                                for ($x = $e; $x >= ($e - 15); $x -= 1) : ?>
                                    <option><?= esc($x) ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="nip">NIP Pemakai (18 Digit)</label>
                        </div>
                        <div class="col-7">
                            <select class="form-select" name="nip">
                                <?php foreach ($daftar_nip as $nip) : ?>
                                    <option><?= esc($nip['nip']); ?></option>
                                <?php endforeach; ?>

                            </select>
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


<!-- Modal edit form -->
<div class="modal fade" id="modal-edit-barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="edit-modal-label">Ubah Data Barang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-edit-barang" method="post">
                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="id1">ID Barang</label>
                        </div>
                        <div class="col-7">
                            <input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="id1" disabled>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5"><label for="tipe1" class="col-form-label">Tipe </label></div>
                        <div class="col-7"><select class="form-select" id="tipe1" required>
                                <option>Motor</option>
                                <option>Mobil</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5"><label for="merk1" class="col-form-label">Merk</label></div>
                        <div class="col-7"><select class="form-select" id="merk1" required>
                                <?php foreach ($merk_list as $merk) : ?>
                                    <option><?= esc($merk) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5"><label for="tahun1" class="col-form-label">Tahun</label></div>
                        <div class="col-7"><select class="form-select" id="tahun1" required>
                                <?php
                                $e = (int)date("Y");
                                for ($x = $e; $x >= ($e - 15); $x -= 1) : ?>
                                    <option><?= esc($x) ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="nip-pemakai1">NIP Pemakai (18 Digit)</label>
                        </div>
                        <div class="col-7">
                            <select class="form-select" id="nip-pemakai1">
                                <?php foreach ($daftar_nip as $nip) : ?>
                                    <option><?= esc($nip['nip']); ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="kondisi1">Kondisi Barang</label>
                        </div>
                        <div class="col-7">
                            <select class="form-select" id="kondisi1">
                                <option>Baik</option>
                                <option>Rusak Ringan</option>
                                <option>Rusak Berat</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group mb-3">
                        <div class="col-5"><label for="lokasi1" class="col-form-label">Lokasi Barang</label></div>
                        <div class="col-7"><select class="form-select" id="lokasi1" required>
                                <?php foreach ($room_list as $room) : ?>
                                    <option><?= esc($room) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="nomor-plat1">Nomor Plat</label>
                        </div>
                        <div class="col-7">
                            <input type="text" class="form-control form-control-sm" id="nomor-plat1" required></input>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="besar-cc1">Besar CC</label>
                        </div>
                        <div class="col-7">
                            <input type="text" class="form-control form-control-sm" id="besar-cc1" required></input>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="nomor-seri1">Nomor Seri</label>
                        </div>
                        <div class="col-7">
                            <input type="text" class="form-control form-control-sm" id="nomor-seri1" required></input>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-5">
                            <label class="col-form-label" for="nib1">NIB</label>
                        </div>
                        <div class="col-7">
                            <input type="text" class="form-control form-control-sm" id="nib1" required></input>
                        </div>
                    </div>
            </div>

            </form>
            <div class="modal-footer">
                <input type="button" class="btn btn-sm btn-default" data-bs-dismiss="modal" value="Batalkan">
                <input type="submit" id="submit-edit" class="btn btn-sm btn-success" value="Simpan Perubahan">
            </div>
        </div>
    </div>
</div>
<!-- end modal edit -->


<!-- modal delete -->
<div class="modal fade" id="modal-delete-barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="delete-modal-label">Hapus Data Barang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Apakah yakin akan menghapus barang dengan rincian sebagai berikut :</h6>
                <table>
                    <tbody>
                        <tr>
                            <td class="px-4"> Nomor Seri </td>
                            <td id="nomor-seri-del"></span></td>
                        </tr>
                        <tr>
                            <td class="px-4">Merk </td>
                            <td id="merk-del"></td>
                        </tr>
                        <tr>
                            <td class="px-4">
                                Kondisi </td>
                            <td id="kondisi-del"></td>
                        </tr>
                        <tr>
                            <td class="px-4">
                                ID Barang </td>
                            <td id="id-barang-del"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-sm btn-default" data-bs-dismiss="modal" value="Batalkan">
                <button id="submit-delete" class="btn btn-sm btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal delete -->


<h3><?php echo esc($title); ?></h3>


<button href="#" class="btn btn-sm btn-success mb-3 mt-2" id="tambah-barang">Tambah Barang</button>
<div class="table-responsive">
    <table class="table table-bordered  table-hover table-sm" id="daftar-barang">
        <thead>
            <tr>
                <th>Nomor Seri</th>
                <th>NIB</th>
                <th class="id">ID Barang</th>
                <th>Merk</th>
                <th>Tahun Peroleh</th>
                <th>Kondisi</th>
                <th>Lokasi Barang</th>
                <th>NIP Pemakai</th>
                <th>Tipe</th>
                <th>Nomor Plat</th>
                <th>Besaran CC</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barang as $brg) : ?>
                <tr>
                    <td class="nomor-seri"><?= esc($brg['nomor_seri']); ?></td>
                    <td class="nib"><?= esc($brg['nib']); ?></td>
                    <td class="id"><?= esc($brg['id']); ?></td>
                    <td class="merk"><?= esc($brg['merk']); ?></td>
                    <td class="tahun"><?= esc($brg['tahun']); ?></td>
                    <td class="kondisi"><?= esc($brg['kondisi']); ?></td>

                    <td class="lokasi"><?= esc($brg['lokasi']); ?></td>
                    <td class="nip-pemakai"><?= esc($brg['nip_pemakai']); ?></td>
                    <td class="tipe"><?= esc($brg['tipe']); ?></td>
                    <td class="nomor-plat"><?= esc($brg['nomor_plat']); ?></td>
                    <td class="besar-cc"><?= esc($brg['besar_cc']); ?></td>


                    <td>
                        <a href="#" class="edit" data-toggle="modal"><i class="fas fa-edit"></i></a>
                        <a href="#" class="delete" data-toggle="modal"><i class="fas fa-trash"></i></a>
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

    // edit employee
    $(".edit").click(function() {
        // ambil data di row
        let row = $(this).closest("tr");
        let id = row.find(".id").text();
        let merk = row.find(".merk").text();
        let tahun = row.find(".tahun").text();
        let nip_pemakai = row.find(".nip-pemakai").text();
        let nib = row.find(".nib").text();
        let nomor_seri = row.find(".nomor-seri").text();
        let lokasi = row.find(".lokasi").text();
        let tipe = row.find(".tipe").text();
        let nomor_plat = row.find(".nomor-plat").text();
        let besar_cc = row.find(".besar-cc").text();

        // taruh di form edit
        $("#id1").val(id);
        $("#merk1").val(merk);
        $("#tahun1").val(tahun);
        $("#nip-pemakai1").val(nip_pemakai);
        $("#nib1").val(nib);
        $("#nomor-seri1").val(nomor_seri);
        $("#lokasi1").val(lokasi);
        $("#tipe1").val(tipe);
        $("#nomor-plat1").val(nomor_plat);
        $("#besar-cc1").val(besar_cc);

        $("#modal-edit-barang").modal('show');
        $('#merk1').focus();
    });

    // function edit clicked
    $("#submit-edit").click(function() {

        let data = {
            id: $("#id1").val(),
            merk: $("#merk1").val(),
            kondisi: $("#kondisi1").val(),
            tahun: $("#tahun1").val(),
            nip_pemakai: $("#nip-pemakai1").val(),
            nib: $("#nib1").val(),
            nomor_seri: $("#nomor-seri1").val(),
            lokasi: $("#lokasi1").val(),
            tipe: $("#tipe1").val(),
            nomor_plat: $("#nomor-plat1").val(),
            besar_cc: $("#besar-cc1").val()
        }

        alert(JSON.stringify(data));

        $.ajax({
                method: "POST",
                url: "/admin/ubahKendaraan",
                data: data
            })
            .done(function(msg) {
                console.log(msg);
                location.reload();
            })
            .fail(function(err) {
                alert(JSON.stringify(err));
            })
    });



    function makeid(length) {
        var result = '';
        var characters = '0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() *
                charactersLength));
        }
        return result;
    }
    $("#tambah-barang").click(function() {

        // show modal
        $("#modal-add-barang").modal('show');


    });




    // delete func cliced
    $(".delete").click(function() {
        // cari baris
        let row = $(this).closest("tr");
        // ambil data
        let id = row.find(".id").text();
        let merk = row.find(".merk").text();
        let kondisi = row.find(".kondisi").text();
        let nomorSeri = row.find(".nomor-seri").text();

        // taruh di modal

        $("#id-barang-del").text(id);
        $("#merk-del").text(merk);
        $("#kondisi-del").text(kondisi);
        $("#nomor-seri-del").text(nomorSeri);
        // show modal
        $("#modal-delete-barang").modal('show');

    });

    // submit delete clicked

    $("#submit-delete").click(function() {


        let data = {
            id: $("#id-barang-del").text()
        };

        $.ajax({
                method: "POST",
                url: "/admin/hapusKendaraan",
                data: data
            })
            .done(function(msg) {
                console.log(msg);
                location.reload();

            })
            .fail(function(err) {
                console.log(JSON.stringify(err));
            })
    });
</script>
<?= $this->endSection('content'); ?>