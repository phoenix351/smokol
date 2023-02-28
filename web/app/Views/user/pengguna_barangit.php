<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<style>
    #daftar-pegawai {
        font-size: 0.93em;
    }


    .id {
        display: none;
    }
</style>


<!-- modal add form -->
<div class="modal fade" id="modal-add-barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" style="max-width:32vw">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="delete-modal-label">Tambah Data Barang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
            <?=$this->include('templates/formTambahBarangUser');?>
            </div>
        </div>
    </div>
</div>

<!-- end modal add -->



<!-- Modal Kembalikan Barang -->
<div class="modal fade" id="modal-kembalikan-barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="edit-modal-label">Apakah Anda Yakin Akan Mengembalikan Barang Berikut Kepada Admin ? </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td>Jenis Barang</td>
                        <td id="balik_jenis"></td>
                    </tr>
                    <tr>
                        <td>Nama Barang</td>
                        <td id="balik_nama"></td>
                    </tr>
                    <tr>
                        <td>Tahun Peroleh</td>
                        <td id="balik_tahun"></td>
                    </tr>
                    <tr>
                        <td>Sistem Operasi</td>
                        <td id="balik_os"></td>
                    </tr>
                </table>
                <form action=" <?= base_url('user') ?>/pengguna_balik_barang" method="post" role="form">
                    <?= csrf_field() ?>
                    <input type="text" class="" name="barang_id" id="barang_id">

                    <div class="modal-footer">
                        <input type="button" class="btn btn-sm btn-sm btn-default" data-bs-dismiss="modal" value="Batalkan">
                        <input type="submit" name="submit" class="btn btn-sm btn-sm btn-success" value="Konfirmasi">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Modal Tidak Kuasa -->
<div class="modal fade" id="modal-tidak-kuasa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">

                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title text-dark" id="edit-modal-label">Apakah Anda Yakin akan Mengatur Akun ini Sebagai Bukan Penguasa Barang IT ? </h5>
                <form action=" <?= base_url('user') ?>/pengguna_tidak_kuasa" method="post" role="form">
                    <?= csrf_field() ?>
                    <input type="text" class="d-none" name="user_id" id="barang_id">

                    <div class="modal-footer">
                        <input type="button" class="btn btn-sm btn-sm btn-default" data-bs-dismiss="modal" value="Batalkan">
                        <input type="submit" name="submit" class="btn btn-sm btn-sm btn-success" value="Konfirmasi">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<!-- End modal Kembalikan Barang -->

<!-- Modal pengajuan form -->
<div class="modal fade" id="modal-edit-barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="edit-modal-label">Pengajuan Keluhan Barang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('user') ?>/ajukan" method="post" role="form">
                    <?= csrf_field() ?>
                    <div class="row form-group mb-3">
                        <label class="col-form-label" for="id_barang">ID Barang</label>
                        <input type="text" id="id1" name="id_barang" class="form-control form-control-sm">
                    </div>
                    <div class="row form-group mb-3">
                        <label class="col-form-label" for="type">Type Barang</label>
                        <input type="text" name="type" class="form-control form-control-sm" value="1">
                    </div>
                    <div class="row form-group mb-3">
                        <label class="col-form-label" for="complain">Keluhan</label>
                        <textarea name="complain" cols=" 30" rows="10" class="form form-control form-control-sm"></textarea>
                    </div>

            </div>


            <div class="modal-footer">
                <input type="button" class="btn btn-sm btn-sm btn-default" data-bs-dismiss="modal" value="Batalkan">
                <input type="submit" id="submit-edit" name="submit" class="btn btn-sm btn-sm btn-success" value="Ajukan">
            </div>
            </form>

        </div>
    </div>
</div>
<!-- end modal pengajuan -->


<h2><?php echo esc("$title"); ?></h2>

<?= view('Myth\Auth\Views\_message_block') ?>
<button href="#" class="btn btn-sm btn-sm btn-success mb-3 mt-2" id="tambah-barang">Tambah Barang</button>
<?php if (user()->kuasa == '1') : ?>
    <button href="#" class="btn btn-sm btn-sm btn-secondary mb-3 mt-2" id="tidak-kuasa">Tidak Menguasai</button>
    <div class="table-responsive">
        <table class="table table-hover" id="daftar-barang" data-search="false" data-striped="true" data-pagination="true" data-filter-control="true" data-side-pagination="client" data-page-size="10" data-page-list="[10, 25, 50, 100, ALL]">
            <thead>
                <tr>
                    <th class="id">ID Barang</th>
                    <th data-filter-control="input" data-field="Jenis Barang">Jenis Barang</th>
                    <th data-filter-control="input" data-field="Nama Barang">Nama Barang</th>
                    <th data-filter-control="input" data-field="Tipe">Tipe</th>
                    <th data-filter-control="input" data-field="Merk">Merk</th>
                    <th data-filter-control="input" data-field="OS">OS</th>
                    <th data-filter-control="input" data-field="Tahun Peroleh">Tahun Peroleh</th>
                    <th data-filter-control="input" data-field="Lokasi Barang">Lokasi Barang</th>
                    <th data-filter-control="input" data-field="Kondisi">Kondisi</th>
                    <th data-filter-control="input" data-field="Nomor Induk Barang">Nomor Induk Barang</th>
                    <th data-filter-control="input" data-field="Nomor Seri">Nomor Seri</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barang as $brg) : ?>
                    <tr>

                        <td class="id"><?= esc($brg['id']); ?></td>
                        <td class="jenis"><?= esc($brg['jenis']); ?></td>
                        <td class="nama"><?= esc($brg['merk'] . ' ' . $brg['tipe']); ?></td>
                        <td class="tipe"><?= esc($brg['tipe']); ?></td>
                        <td class="merk"><?= esc($brg['merk']); ?></td>
                        <td class="os"><?= esc($brg['os']); ?></td>
                        <td class="tahun"><?= esc($brg['tahun_peroleh']); ?></td>
                        <td class="lokasi"><?= esc($brg['lokasi']); ?></td>
                        <td class="kondisi"><?= esc($brg['kondisi']); ?></td>
                        <td class="nib"><?= esc($brg['nib']); ?></td>
                        <td class="nomor_seri"><?= esc($brg['nomor_seri']); ?></td>
                        <td class="text-center">
                            <div class="row my-1">
                                <form action="<?= base_url('user') ?>/tambah_pengajuan/<?= esc($brg['id']); ?>" method="get" role="form" class="w-100">
                                    <button class="btn btn-sm btn-block btn-success" type="submit">Pengajuan</button>
                                </form>
                            </div>
                            <div class="row my-1">
                                <form action="<?= base_url('user') ?>/ubah_barangit_pengguna/<?= esc($brg['id']); ?>" method="get" role="form" class="w-100">
                                    <button class="btn btn-sm btn-primary w-100" type="submit">Ubah</button>
                                </form>
                            </div>
                            <div class="row my-1">
                                <button class="btn btn-sm btn-block btn-danger" onclick="Kembalikan(this)">Kembalikan</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php if (user()->kuasa == '0') : ?>
    <p> Anda tidak dapat mengakses data ini karena anda tidak menguasai barang IT, silahkan tambahkan barang untuk mengaktifkan atau hubungin admin</p>
<?php endif; ?>




<script>
    $(document).ready(function() {
        $('#daftar-barang').bootstrapTable();
        $('#tambah-barang').click(function() {
            $("#modal-add-barang").modal('show');
        });
          
          $("form[name=form-add]").submit(function() {
            $(this).submit(function() {
                return false;
            });
            return true;
        });
        
        $('#tidak-kuasa').click(function() {
            let user_id = "<?= user()->id ?>";
            $("#user_id").val(user_id);
            $("#modal-tidak-kuasa").modal('show');
        });




    });



    function Kembalikan(t) {
        let row = $(t).closest("tr");
        // ambil data
        let id = row.find(".id").text();
        let nama = row.find(".nama").text();
        let jenis = row.find(".jenis").text();
        let os = row.find(".os").text();
        let tahun = row.find(".tahun").text();

        // insert data dan buka modal 

        $("#balik_nama").text(nama);
        $("#balik_jenis").text(jenis);
        $("#balik_os").text(os);
        $("#balik_tahun").text(tahun);
        $("#barang_id").val(id);
        $("#modal-kembalikan-barang").modal('show');

    };


    function getTipeByMerk(merk, jenis) {
        //delete all child

        $("option[class='tipe_list']").remove();
        console.log(merk, jenis);
        //panggil api
        $.ajax({
                method: "GET",
                url: "<?= esc(base_url()); ?>/user/getTipeListByMerk/",
                data: {
                    'merk': merk,
                    'jenis': jenis
                }
            })
            .done(function(msg) {
                console.log(msg)

                msg.data.forEach(function(item, index) {




                    $("#tipe_select").append('<option class="tipe_list">' + item.tipe + '</option>');
                });


            })
            .fail(function(err) {
                console.log(err);
            });

    }


    function getTipeByJenis(jenis) {
        //delete all child
        $("option[class='tipe_list']").remove();
        //panggil api
        $.ajax({
                method: "GET",
                url: "<?= esc(base_url()); ?>/user/getTipeListByJenis/" + jenis,
            })
            .done(function(msg) {
                ;

                msg.data.forEach(function(item, index) {

                    $("#tipe_select").append('<option class="tipe_list">' + item.tipe + '</option>');
                });
            })
            .fail(function(err) {
                console.log(err);
            });

    }

    function getMerkByJenis(jenis) {
        //delete all child
        $("option[class='merk_list']").remove();
        //panggil api
        $.ajax({
                method: "GET",
                url: "<?= esc(base_url()); ?>/user/getMerkByJenis/" + jenis,
            })
            .done(function(msg) {
                ;
                msg.data.forEach(function(item, index) {

                    $("#merk_select").append('<option class="merk_list">' + item.merk + '</option>');
                });


            })
            .fail(function(err) {
                console.log(err);
            });


    }


    // edit employee
</script>


<?= $this->endSection(); ?>