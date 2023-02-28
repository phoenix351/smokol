<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<!-- modal lihat rincian -->
<?= $this->include('templates/modal_rincian_pengajuan'); ?>
<!-- end modal lihat rincian -->



<style>
    .bg-primary {
        background-color: rgb(75, 0, 130) !important;
    }
</style>



<h3 class="mb-3">Daftar Pengajuan Barang</h3>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="#" class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Pending</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="#" class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Diproses</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="#" class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Selesai</a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <!-- Pengajuan Pending -->
        <table class="table table-bordered  table-hover table-sm" id="pengajuan-pending" data-search="false" data-striped="true" data-pagination="true" data-filter-control="true" data-side-pagination="client" data-page-size="10" data-page-list="[10, 25, 50, 100, ALL]">
            <thead>
                <tr>
                    <th data-filter-control="input" data-field="ID Barang">ID Barang</th>
                    <th data-filter-control="input" data-field="Nomor Tiket">Nomor Tiket </th>
                    <th data-filter-control="input" data-field="Nama Barang">Nama Barang</th>
                    <th data-filter-control="input" data-field="Nama Pengguna">Nama Pengguna</th>
                    <th data-filter-control="input" data-field="Keluhan">Keluhan</th>
                    <th data-filter-control="select" data-field="Status Pengajuan">Status Pengajuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pending as $pengajuan) : ?>
                    <tr>
                        <td class="nomor-tiket"><?= esc($pengajuan['id']); ?></td>
                        <td class="id-barang"><?= esc($pengajuan['id_barang']); ?></td>
                        <td class="nama"><?= esc($pengajuan['merk'] . ' ' . $pengajuan['tipe_barang']); ?></td>
                        <td class="nama-pengguna"><?= esc($pengajuan['nama_pengguna']); ?></td>
                        <td class="keluhan"><?= esc($pengajuan['keluhan']); ?></td>
                        <td class="status"><?= esc($pengajuan['status']); ?></td>

                        <td>
                             <div class="row my-1">
                                <a href="<?= base_url('user/cetak/' . $pengajuan['id'] . '?'); ?>" class="btn btn-sm btn-secondary cetak w-100">Cetak Memo</a>
                            </div>
                             <div class="row my-1">
                            <input type="button" class="btn btn-sm btn-info w-100" value="Rincian" onclick="getRincian(this);">
                            </div>

                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <!-- Pengajuan Prccessed -->
        <table class="table table-bordered  table-hover table-sm" id="pengajuan-processed" data-search="false" data-striped="true" data-pagination="true" data-filter-control="true" data-side-pagination="client" data-page-size="10" data-page-list="[10, 25, 50, 100, ALL]">
            <thead>
                <tr>
                    <th data-filter-control="input" data-field="ID Barang">ID Barang</th>
                    <th data-filter-control="input" data-field="Nomor Tiket">Nomor Tiket </th>
                    <th data-filter-control="input" data-field="Nama Barang">Nama Barang</th>
                    <th data-filter-control="input" data-field="Nama Pengguna">Nama Pengguna</th>
                    <th data-filter-control="input" data-field="Keluhan">Keluhan</th>
                    <th data-filter-control="select" data-field="Status Pengajuan">Status Pengajuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($processed as $pengajuan) : ?>

                    <tr>
                        <td class="nomor-tiket"><?= esc($pengajuan['id']); ?></td>
                        <td class="id-barang"><?= esc($pengajuan['id_barang']); ?></td>
                        <td class="nama"><?= esc($pengajuan['merk'] . ' ' . $pengajuan['tipe_barang']); ?></td>
                        <td class="nama-pengguna"><?= esc($pengajuan['nama_pengguna']); ?></td>
                        <td class="keluhan"><?= esc($pengajuan['keluhan']); ?></td>
                        <td class="status"><?= esc($pengajuan['status']); ?></td>

                        <td> <input type="button" class="btn btn-sm btn-info" value="Rincian" onclick="getRincian(this);"></td>


                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        <!-- Pengajuan Prccessed -->
        <table class="table table-bordered  table-hover table-sm" id="pengajuan-done" data-search="false" data-striped="true" data-pagination="true" data-filter-control="true" data-side-pagination="client" data-page-size="10" data-page-list="[10, 25, 50, 100, ALL]">
            <thead>
                <tr>
                    <th data-filter-control="input" data-field="ID Barang">ID Barang</th>
                    <th data-filter-control="input" data-field="Nomor Tiket">Nomor Tiket </th>
                    <th data-filter-control="select" data-field="Nama Barang">Nama Barang</th>
                    <th data-filter-control="select" data-field="Nama Pengguna">Nama Pengguna</th>
                    <th data-filter-control="select" data-field="Keluhan">Keluhan</th>
                    <th data-filter-control="select" data-field="Status Pengajuan">Status Pengajuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($done as $pengajuan) : ?>
                    <tr>
                        <td class="nomor-tiket"><?= esc($pengajuan['id']); ?></td>
                        <td class="id-barang"><?= esc($pengajuan['id_barang']); ?></td>
                        <td class="nama"><?= esc($pengajuan['merk'] . ' ' . $pengajuan['tipe_barang']); ?></td>
                        <td class="nama-pengguna"><?= esc($pengajuan['nama_pengguna']); ?></td>
                        <td class="keluhan"><?= esc($pengajuan['keluhan']); ?></td>
                        <td class="status"><?= esc($pengajuan['status']); ?></td>
                        <td>
                           
                             <div class="row my-1">
                            <input type="button" class="btn btn-sm btn-info" value="Rincian" onclick="getRincian(this);">
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>




<script>
 
$( document ).ready(function() {
   $("#pengajuan-pending").bootstrapTable();
    $("#pengajuan-processed").bootstrapTable();
    $("#pengajuan-done").bootstrapTable();
});
   
    $(".kelola-pending").click(function() {
        let row = $(this).closest('tr');
        let no_tiket = row.find(".nomor-tiket").text();
        let status = row.find(".status").text();

        $("#id-pending").val(no_tiket);
        $("#status-pending").val(status);


        $("#modal-kelola-pending").modal('show');
    });
    $("#submit-pending").click(function() {
        let data = {
            id: $("#id-pending").val(),
            start_date: $("#start-date-pending").val()
        };

        $.ajax({
                method: "POST",
                url: "<?= esc(base_url()); ?>/user/update_pending",
                data: data
            })
            .done(function(response) {
                location.reload();
            })
            .fail(function(err) {
                console.log(JSON.stringify(err));
            })



    });

    $(".kelola-processed").click(function() {
        let row = $(this).closest('tr');
        let no_tiket = row.find(".nomor-tiket").text();
        let status = row.find(".status").text();

        $("#id-processed").val(no_tiket);
        $("#status-processed").val(status);


        $("#modal-kelola-processed").modal('show');
    });

    $("#submit-processed").click(function() {
        let data = {
            id: $("#id-processed").val(),
            end_date: $("#end-date-processed").val(),
            kondisi_sesudah: $("#kondisi-processed").val(),
            biaya: $("#biaya-processed").val(),
            description: $("#description-processed").val(),
        };

        $.ajax({
                method: "POST",
                url: "<?= esc(base_url()); ?>/user/update_processed",
                data: data
            })
            .done(function(response) {
                location.reload();
            })
            .fail(function(err) {
                console.log(JSON.stringify(err));
            })
    });

    function getRincian(obj) {
        //ambil  nilai id tiket dan id_barang
        let row = $(obj).closest('tr');
        let no_tiket = row.find(".nomor-tiket").text();
        //let id_barang = row.find(".id-barang").text();
        // manggil api ke lihat rincian 
        $.ajax({
                method: "POST",
                url: "<?= esc(base_url()); ?>/user/pengajuan_detail/" + no_tiket,
            })
            .done(function(response) {

                console.log(response.data[0]);
                let id = response.data[0].id;
                let status = response.data[0].status;
                let complain = response.data[0].keluhan;
                let created_at = response.data[0].created_at;
                let biaya = response.data[0].biaya;
                let start_date = (response.data[0].start_date ? response.data[0].start_date : "Belum Tersedia");
                let end_date = (response.data[0].end_date ? response.data[0].end_date : "Belum Tersedia");
                $("#nomor-tiket").text(id);
                $("#status").text(status);
                $("#tanggal-pengajuan").text(created_at);
                $("#tanggal-proses").text(start_date);
                $("#tanggal-selesai").text(end_date);
                $("#keluhan").text(complain);
                $("#total-biaya").text(biaya);
                // munculkan modal
                $("#modal-lihat-rincian").modal('show');


            })
            .fail(function(err) {
                console.log(JSON.stringify(err));
            })

        // masukan hasilnya ke span - span

    };
    
</script>
<?= $this->endSection(); ?>