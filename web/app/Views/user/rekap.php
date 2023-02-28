<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<style>
    th {
        text-align: center;
        vertical-align: center;
    }
</style>

<h3 class="text-center">Rekap Banyaknya Barang IT Berdasarkan Jenis dan Kondisi</h3>

<div class="container my-4 table-responsive">
    <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Jenis</th>
                <th colspan="3">Kondisi Barang</th>
                <th rowspan="2">Total</th>
            </tr>
            <tr>
                <th>Baik</th>
                <th>Rusak Ringan</th>
                <th>Rusak Berat</th>

            </tr>
        </thead>

        <tbody>
            <?php $i = 1 ?>
            <?php foreach ($rekap_it as $row) : ?>
                <tr>
                    <td class="text-center"><?= esc($i) ?></td>
                    <td class="text-start"><?= esc($row['jenis']) ?></td>
                    <td class="text-center"><?= esc($row['Baik']) ?></td>
                    <td class="text-center"><?= esc($row['Rusak Ringan']) ?></td>
                    <td class="text-center"><?= esc($row['Rusak Berat']) ?></td>
                    <td class="text-center"><?= esc($row['Total']) ?></td>
                </tr>

            <?php $i++;
            endforeach; ?>
        </tbody>
    </table>
    <a href="<?= base_url('user/unduh_rekap_kondisi') ?>" class="btn btn-sm btn-sm btn-success mb-3 mt-2">Download as CSV</a>
</div>
<div class="d-none">
    <h3>Rekap Biaya Pemeliharaan Perangkat Keras TIK</h3>

    <div class="container my-4 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <th class="text-end">No</th>
                <th class="text-start">Jenis</th>
                <th class="text-start">Nama Barang</th>
                <th class="text-start">Nama Pemakai</th>
                <th class="text-end">Tahun</th>
                <th class="text-end">Total Biaya</th>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach ($rekap_biaya as $rek) : ?>
                    <tr>
                        <td class="text-end"><?= esc($i) ?></td>
                        <td class="text-start"><?= esc($rek['jenis']) ?></td>
                        <td class="text-start"><?= esc($rek['merk'] . ' ' . $rek['tipe']) ?></td>
                        <td class="text-start"><?= esc($rek['nama_pemakai']) ?></td>
                        <td class="text-end"><?= esc($rek['tahun']) ?></td>
                        <td class="text-end"><?= esc($rek['total_biaya']) ?></td>
                    </tr>
                <?php $i++;
                endforeach; ?>

            </tbody>
        </table>
        <a href="<?= base_url('user/unduh_rekap_ruangan') ?>" class="btn btn-sm btn-sm btn-success mb-3 mt-2">Download as CSV</a>
    </div>
</div>


<h3 class="text-center">Rekap BMN TIK berdasarkan Ruangan dan Jenis</h3>
<div class="container my-4 table-responsive">
    <table class="table table-striped table-hover" id="rekap-ruangan" data-search="false" data-striped="true" data-pagination="true" data-filter-control="true" data-side-pagination="client" data-page-size="10" data-page-list="[10, 25, 50, 100, ALL]">
        <thead>
            <tr>
                <th class="text-end" rowspan="2">No</th>
                <th data-filter-control="input" data-field="Nama Ruangan" class="text-start" rowspan="2">Nama Ruangan</th>
                <th class="text-center" colspan="6">Jenis Barang</th>
                <th class="text-center" rowspan="2" data-filter-control="input" data-field="Jumlah">Jumlah</th>
            </tr>
            <tr>
                <th data-filter-control="input" data-field="PC" class="text-start">PC</th>
                <th data-filter-control="input" data-field="Laptop" class="text-start">Laptop</th>
                <th data-filter-control="input" data-field="Printer" class="text-start">Printer</th>
                <th data-filter-control="input" data-field="Scanner" class="text-start">Scanner</th>
                <th data-filter-control="input" data-field="UPS" class="text-start">UPS</th>
                <th data-filter-control="input" data-field="Lainnya" class="text-start">Lainnya</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php foreach ($rekap_ruangan as $rek) : ?>
                <tr>
                    <td class="text-end"><?= esc($i) ?></td>
                    <td class="text-start"><?= esc($rek['lokasi']) ?></td>
                    <td class="text-center"><?= esc($rek['PC']) ?></td>
                    <td class="text-center"><?= esc($rek['Laptop']) ?></td>
                    <td class="text-center"><?= esc($rek['Printer']) ?></td>
                    <td class="text-center"><?= esc($rek['Scanner']) ?></td>
                    <td class="text-center"><?= esc($rek['UPS']) ?></td>
                    <td class="text-center"><?= esc($rek['Lainnya']) ?></td>
                    <td class="text-center"><?= esc($rek['Jumlah']) ?></td>
                </tr>
            <?php $i++;
            endforeach; ?>

        </tbody>
    </table>
    <a href="<?= base_url('user/unduh_rekap_ruangan') ?>" class="btn btn-sm btn-sm btn-success mb-3 mt-2">Download as CSV</a>

</div>


<h3 class="text-center">Rekap Banyaknya Barang IT berdasarkan Pemegang dan Jenis </h3>

<div class="container my-4 table-responsive" style="padding-bottom:80px">
    <table class="table table-striped table-hover" id="rekap-pegawai" data-search="false" data-striped="true" data-pagination="true" data-filter-control="true" data-side-pagination="client" data-page-size="10" data-page-list="[10, 25, 50, 100, ALL]">
        <thead>
            <tr>
                <th class="text-end" rowspan="2">No</th>
                <th data-filter-control="input" data-field="Nama Pemegang" class="text-start" rowspan="2">Nama Pemegang</th>
                <th class="text-center" colspan="6">Jenis Barang</th>
                <th class="text-center" rowspan="2" data-filter-control="input" data-field="Jumlah">Jumlah</th>
            </tr>
            <tr>
                <th data-filter-control="input" data-field="PC" class="text-start">PC</th>
                <th data-filter-control="input" data-field="Laptop" class="text-start">Laptop</th>
                <th data-filter-control="input" data-field="Printer" class="text-start">Printer</th>
                <th data-filter-control="input" data-field="Scanner" class="text-start">Scanner</th>
                <th data-filter-control="input" data-field="UPS" class="text-start">UPS</th>
                <th data-filter-control="input" data-field="Lainnya" class="text-start">Lainnya</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php foreach ($rekap_pengguna as $rek) : ?>
                <tr>
                    <td class="text-end"><?= esc($i) ?></td>
                    <td class="text-start"><?= esc($rek['nama_lengkap']) ?></td>
                    <td class="text-center"><?= esc($rek['PC']) ?></td>
                    <td class="text-center"><?= esc($rek['Laptop']) ?></td>
                    <td class="text-center"><?= esc($rek['Printer']) ?></td>
                    <td class="text-center"><?= esc($rek['Scanner']) ?></td>
                    <td class="text-center"><?= esc($rek['UPS']) ?></td>
                    <td class="text-center"><?= esc($rek['Lainnya']) ?></td>
                    <td class="text-center"><?= esc($rek['Jumlah']) ?></td>
                </tr>
            <?php $i++;
            endforeach; ?>

        </tbody>
    </table>
    <a href="<?= base_url('user/unduh_rekap_pemegang') ?>" class="btn btn-sm btn-sm btn-success mb-3 mt-2">Download as CSV</a>

</div>


<h3 class="text-center">Rekap Banyaknya Barang IT berdasarkan Bidang dan Jenis </h3>

<div class="container my-4 table-responsive" style="padding-bottom:80px">
    <table class="table table-striped table-hover" id="rekap-bidang" data-search="false" data-striped="true" data-pagination="true" data-filter-control="true" data-side-pagination="client" data-page-size="10" data-page-list="[10, 25, 50, 100, ALL]">
        <thead>
            <tr>
                <th class="text-end" rowspan="2">No</th>
                <th data-filter-control="input" data-field="Bidang" class="text-start" rowspan="2">Bidang</th>
                <th class="text-center" colspan="6">Jenis Barang</th>
                <th class="text-center" rowspan="2" data-filter-control="input" data-field="Jumlah">Jumlah</th>
            </tr>
            <tr>
                <th data-filter-control="input" data-field="PC" class="text-start">PC</th>
                <th data-filter-control="input" data-field="Laptop" class="text-start">Laptop</th>
                <th data-filter-control="input" data-field="Printer" class="text-start">Printer</th>
                <th data-filter-control="input" data-field="Scanner" class="text-start">Scanner</th>
                <th data-filter-control="input" data-field="UPS" class="text-start">UPS</th>
                <th data-filter-control="input" data-field="Lainnya" class="text-start">Lainnya</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php foreach ($rekap_bidang as $rek) : ?>
                <tr>
                    <td class="text-end"><?= esc($i) ?></td>
                    <td class="text-start"><?= esc($rek['bidang']) ?></td>
                    <td class="text-center"><?= esc($rek['PC']) ?></td>
                    <td class="text-center"><?= esc($rek['Laptop']) ?></td>
                    <td class="text-center"><?= esc($rek['Printer']) ?></td>
                    <td class="text-center"><?= esc($rek['Scanner']) ?></td>
                    <td class="text-center"><?= esc($rek['UPS']) ?></td>
                    <td class="text-center"><?= esc($rek['Lainnya']) ?></td>
                    <td class="text-center"><?= esc($rek['Jumlah']) ?></td>
                </tr>
            <?php $i++;
            endforeach; ?>

        </tbody>
    </table>
    <a href="<?= base_url('user/unduh_rekap_bidang') ?>" class="btn btn-sm btn-sm btn-success mb-3 mt-2">Download as CSV</a>

</div>

<h3 class="text-center">Rekap Pemeliharaan Barang IT berdasarkan Jenis </h3>

<div class="container my-4 table-responsive" style="padding-bottom:80px">
    <table class="table table-striped table-hover table-bordered" id="rekap-bidang" data-search="false" data-striped="true" data-pagination="true" data-filter-control="true" data-side-pagination="client" data-page-size="10" data-page-list="[10, 25, 50, 100, ALL]">
        <thead>
            <tr>
                <th style='text-align:end'>No</th>
                <th style='text-align:start' data-filter-control="input" data-field="Jenis">Jenis Barang</th>
                <th  style='text-align:end' data-filter-control="input" data-field="Jumlah">Jumlah Item</th>
                <th  style='text-align:end' data-filter-control="input" data-field="Biaya">Biaya (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;$sum=['jenis'=>'Jumlah Total','jumlah_biaya'=>0,'jumlah_item'=>0] ?>
            <?php foreach ($rekap_pemeliharaan as $rek) : ?>
                <tr>
                    <td  style='text-align:end'><?= $i ?></td>
                    <td style='text-align:start'><?= esc($rek['jenis']) ?></td>
                                        <td style='text-align:end'><?= esc($rek['jumlah_item']) ?></td>
                    <td style='text-align:end'><?= esc($rek['jumlah_biaya']) ?></td>
                </tr>
                
            <?php $i++; $sum['jumlah_biaya']+=$rek['jumlah_biaya']; $sum['jumlah_item']+=$rek['jumlah_item']; ?>
            <?php endforeach; ?>
            <tr>
                    <td style='text-align:center' colspan="2"><b><?= esc($sum['jenis']) ?></b></td>
                    <td style='text-align:end'><b><?= esc($sum['jumlah_item']) ?></b></td>
                    <td style='text-align:end'><b><?= esc($sum['jumlah_biaya']) ?></b></td>
                </tr>

        </tbody>
    </table>
    <a href="<?= base_url('user/unduh_rekap_pemeliharaan') ?>" class="btn btn-sm btn-sm btn-success mb-3 mt-2">Download as CSV</a>

</div>
<script>
    $(document).ready(function() {
        $("#rekap-pegawai").bootstrapTable();
        $("#rekap-ruangan").bootstrapTable();
    });
</script>


<?= $this->endSection(); ?>