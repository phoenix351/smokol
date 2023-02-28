<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<style>
    #daftar-pegawai {
        font-size: 0.93em;
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
    <div class="modal-dialog modal-dialog-scrollable" style="max-width:32vw">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="delete-modal-label">Tambah Data Barang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
<?=$this->include('templates/formTambahBarang')?>

            </div>
        </div>
    </div>
</div>
<!-- end modal add -->


<!-- modal delete -->
<div class="modal fade" id="modal-delete-barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
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
            <form action="<?= esc(base_url('user')); ?>/hapusBarangit" method="post" role="form">
                <div class="modal-footer">
                    <input type="button" class="btn btn-sm btn-default" data-bs-dismiss="modal" value="Batalkan">

                    <?= csrf_field() ?>
                    <input type="text" name="id" id="id" class="d-none">
                    <input name="url" type="text" class="d-none" value="<?= base_url($uri->getPath()); ?>">
                    <input type="submit" class="btn btn-sm btn-danger">


                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal delete -->


<h2><?php echo esc($title); ?></h2>

<button href="#" class="btn btn-sm btn-success mb-3 mt-2" id="tambah-barang">Tambah Barang</button>
<?= view('Myth\Auth\Views\_message_block') ?>
<div class="table-responsive pb-2" style="margin-bottom:80px;">
    <table class="table table-bordered table-hover" id="daftar-barang" data-search="false" data-striped="true" data-pagination="true" data-filter-control="true" data-side-pagination="client" data-page-size="10" data-page-list="[10, 25, 50, 100, ALL]">
        <thead>
            <tr>
                <th data-filter-control="input" data-field="Jenis Barang">Jenis Barang</th>
                <th data-filter-control="input" data-field="Nama Barang">Nama Barang</th>

                <th class="id">ID Barang</th>
                <th data-filter-control="input" data-field="Tahun Peroleh">Tahun Peroleh</th>
                <th data-filter-control="input" data-field="Kondisi">Kondisi</th>
                <th data-filter-control="input" data-field="Lokasi Barang">Lokasi Barang</th>
                <th data-filter-control="input" data-field="NIP Pemakai">Nama Pemakai</th>
                <th data-filter-control="input" data-field="OS">OS</th>
                <th data-filter-control="input" data-field="Nomor Seri">Nomor Seri</th>
                <th data-filter-control="input" data-field="NIB">NIB</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barang as $brg) : ?>
                <tr>
                    <td class="jenis"><?= esc($brg['jenis']) ?></td>
                    <td class="nama"><?= esc($brg['merk'] . ' ' . $brg['tipe']); ?></td>
                    <td class="id"><?= esc($brg['id']); ?></td>
                    <td class="tahun_peroleh"><?= esc($brg["tahun_peroleh"]); ?></td>
                    <td class="kondisi"><?= esc($brg['kondisi']); ?></td>
                    <td class="lokasi"><?= esc($brg['lokasi']); ?></td>
                    <td class="nip-pemakai"><?= esc($brg['nama_lengkap']); ?></td>
                    <td class="os"><?= esc($brg['os']); ?></td>
                    <td class="nomor-seri"><?= esc($brg['nomor_seri']); ?></td>
                    <td class="nib"><?= esc($brg['nib']); ?></td>

                    <td>

                        <div class="row">
                            <div class="col-6">
                                <a href="<?= base_url('user/admin_ubah_barang') .'/'. $brg['id'] ?>" class="text-dark"><i class='fas fa-edit'></i></a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="text-dark"><i class="fas fa-trash" onclick="hapus(this)"></i></a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#daftar-barang').bootstrapTable();

    });

    // edit employee
    function ubah(t) {
        // ambil data di row
        let row = $(t).closest("tr");
        let id = row.find(".id").text();
        let merk = row.find(".merk").text();
        let tahun = row.find(".tahun_peroleh").text();
        let nama_lengkap = row.find(".nama_lengkap").text();
        let nib = row.find(".nib").text();
        let nomor_seri = row.find(".nomor-seri").text();
        let lokasi = row.find(".lokasi").text();
        let tipe = row.find(".tipe").text();
        let os = row.find(".os").text();

        // taruh di form edit
        $("#id1").val(id);
        $("#merk1").val(merk);
        $("#tahun1").val(tahun);
        $("#nip-pemakai1").val(nama_lengkap);
        $("#nib1").val(nib);
        $("#nomor-seri1").val(nomor_seri);
        $("#lokasi1").val(lokasi);
        $("#tipe1").val(tipe);
        $("#os1").val(os);

        $("#modal-edit-barang").modal('show');
        $('#merk1').focus();
    };


    function hapus(t) {
        // cari baris
        let row = $(t).closest("tr");
        // ambil data
        let id = row.find(".id").text();
        let merk = row.find(".merk").text();
        let kondisi = row.find(".kondisi").text();
        let nomorSeri = row.find(".nomor-seri").text();

        // taruh di modal

        $("#id-barang-del").text(id);
        $('#id').val(id);
        $("#merk-del").text(merk);
        $("#kondisi-del").text(kondisi);
        $("#nomor-seri-del").text(nomorSeri);
        // show modal
        $("#modal-delete-barang").modal('show');

    };

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

    // function add click
    $("#submit-add").click(function() {


        let data = {
            "merk": $("#merk").val(),
            "tahun_peroleh": $("#tahun").val(),
            "kondisi": $("#kondisi").val(),
            "nomor_seri": $("#nomor-seri").val(),
            "nib": $("#nib").val(),
            "lokasi": $("#lokasi").val(),
            "user_id": $("#user-id").val(),
            "tipe": $("#tipe").val(),
            "os": $("#os").val()
        };

        $.ajax({
                method: "POST",
                url: "<?= esc(base_url()); ?>/user/tambahBarangit",
                data: data
            })
            .done(function(msg) {
                console.log(msg);
                location.reload();
            })
            .fail(function(err) {
                console.log(err);
            })
    });


    // submit delete clicked
    // function edit clicked
    $("#submit-delete").click(function() {


        let data = {
            id: $("#id-barang-del").text()
        };

        $.ajax({
                method: "POST",
                url: "<?= esc(base_url()); ?>/user/hapusBarangit",
                data: data
            })
            .done(function(msg) {
                console.log(msg);
                location.reload();

            })
            .fail(function(err) {
                alert(err);
            })
    });
</script>
<?= $this->endSection(); ?>