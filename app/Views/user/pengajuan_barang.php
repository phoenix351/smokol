<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<!-- modal lihat rincian -->
<!-- end modal lihat rincian -->



<h3 class="mb-3">Daftar Pengajuan Barang</h3>

<button href="#" class="btn btn-sm btn-sm btn-success mb-3 mt-2" id="tambah-pengajuan">Tambah Pengajuan</button>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="#" class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Aktif</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="#" class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Riwayat</a>
    </li>

</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <!-- Pengajuan Pending -->
        <table class="table table-bordered  table-hover table-sm" id="pengajuan-pending" data-search="false" data-striped="true" data-pagination="true" data-filter-control="true" data-side-pagination="client" data-page-size="10" data-page-list="[10, 25, 50, 100, ALL]">
            <thead>
                <tr>
                    <th data-filter-control="input" class="d-none" data-field="ID Pengajuan">ID Pengajuan</th>
                    <th data-filter-control="input" data-field="Nomor Tiket">Nama Barang</th>
                    <th data-filter-control="select" data-field="Nama Barang">Keluhan</th>
                    <th data-filter-control="select" data-field="Status">Status</th>
                    <th data-filter-control="select" data-field="Keluhan">Keluhan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($active as $pengajuan) : ?>
                    <tr>
                        <td class="nomor-tiket"><?= esc($pengajuan['id']); ?></td>
                        <td class="nama"><?= esc($pengajuan['merk'] . ' ' . $pengajuan['tipe_barang']); ?></td>
                        <td class="nama-pengguna"><?= esc($pengajuan['nama_pengguna']); ?></td>
                        <td class="keluhan"><?= esc($pengajuan['keluhan']); ?></td>
                        <td class="status"><?= esc($pengajuan['status']); ?></td>
                        <td>
                            <input type="button" class="btn btn-sm btn-info" value="Rincian" onclick="getRincian(this);">
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
                    <th data-filter-control="input" class="d-none" data-field="ID Pengajuan">ID Pengajuan</th>
                    <th data-filter-control="input" data-field="Nomor Tiket">Nama Barang</th>
                    <th data-filter-control="select" data-field="Nama Barang">Keluhan</th>
                    <th data-filter-control="select" data-field="Status">Status</th>
                    <th data-filter-control="select" data-field="Keluhan">Keluhan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($history as $pengajuan) : ?>

                    <tr>
                        <td class="nomor-tiket"><?= esc($pengajuan['id']); ?></td>
                        <td class="nama"><?= esc($pengajuan['merk'] . ' ' . $pengajuan['tipe_barang']); ?></td>
                        <td class="nama-pengguna"><?= esc($pengajuan['nama_pengguna']); ?></td>
                        <td class="keluhan"><?= esc($pengajuan['keluhan']); ?></td>
                        <td class="status"><?= esc($pengajuan['status']); ?></td>
                        <td>
                            <input type="button" class="btn btn-sm btn-info" value="Rincian" onclick="getRincian(this);">
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

</div>
<?= $this->endSection(); ?>