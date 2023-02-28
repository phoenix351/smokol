<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<h2>Sistem Monitoring Perangkat Teknologi Informasi Online</h2>
<?php if (logged_in()) : ?>
    <h6><?= user()->nama_lengkap ?></h6>
<?php endif; ?>

<style>
    .papan-kartu {
        color: #fff;
        text-align: center;
    }
</style>
<!--Barang menurut kondisi-->
<div class="card mt-5  mb-4">
    <div class="card-header">
        <h5><i class="fas fa-stethoscope"></i> Barang IT Menurut Kondisi</h5>
    </div>
    <div class="card-body">
        <div class="row py-4">
            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-header">
                        <h4 class="papan-kartu">Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="papan-kartu"><?php echo esc($sum['Total']); ?> </h5>
                    </div>

                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="card bg-success text-white mb-4">
                    <div class="card-header">
                        <h4 class="papan-kartu">Baik</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="papan-kartu"><?php echo esc($sum['Baik']); ?></h5>
                    </div>

                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-header">
                        <h4 class="papan-kartu"> Rusak Ringan</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="papan-kartu"><?php echo esc($sum['Rusak Ringan']); ?>
                    </div>

                </div>
            </div>

            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-header">
                        <h4 class="papan-kartu"> Rusak Berat</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="papan-kartu"><?php echo esc($sum['Rusak Berat']); ?> </h5>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




<div class="card">
    <div class="card-header">

        <h5> <i class="fa fa-desktop me-1"></i>Daftar Barang IT</h5>
    </div>
    <div class="card-body table-responsive">
        <table id="tabel-barang" class="table table-sm table-striped table-hover" data-search="false" data-striped="true" data-pagination="true" data-filter-control="true" data-side-pagination="client" data-page-size="10" data-page-list="[10, 25, 50, 100, ALL]">
            <thead>
                <tr>

                    <th data-filter-control="input" data-field="Jenis Barang">Jenis Barang</th>
                    <th data-filter-control="input" data-field="Tipe">Tipe</th>
                    <th data-filter-control="input" data-field="Merk">Merk</th>
                    <th data-filter-control="input" data-field="Sistem Operasi (OS)">Sistem Operasi (OS)</th>
                    <th data-filter-control="input" data-field="Lokasi Barang">Lokasi Barang</th>
                    <th data-filter-control="input" data-field="Tahun Peroleh">Tahun Peroleh</th>
                    <th data-filter-control="input" data-field="Kondisi">Kondisi</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($barang_it as $item_barang) : ?>

                    <tr>

                        <td class="jenis"><?= esc($item_barang['jenis']) ?></td>
                        <td><?= esc($item_barang['tipe']) ?></td>
                        <td><?= esc($item_barang['merk']) ?></td>
                        <td><?= esc($item_barang['os']) ?></td>
                        <td><?= esc($item_barang['lokasi']) ?></td>
                        <td><?= esc($item_barang['tahun_peroleh']) ?></td>
                        <td><?= esc($item_barang['kondisi']) ?></td>
                    </tr>


                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#tabel-barang').bootstrapTable();

    });
</script>
<?= $this->endSection(); ?>