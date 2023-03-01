<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>

<h4 class="text-center">Pengajuan Perawatan Barang IT</h4>

<form action="<?= base_url('user') ?>/ajukan" method="post" role="form" class="mx-3">
    <?= csrf_field() ?>
    <div class="row form-group mb-3 d-none">
        <label class="col-form-label" for="id_barang">ID Barang</label>
        <input type="text" id="id1" name="id_barang" class="form-control form-control-sm" value="<?= esc($barang['id']) ?>">
    </div>
    <div class="row form-group mb-3 d-none">
        <label class="col-form-label" for="tipe">Type Barang</label>
        <input type="text" name="tipe" class="form-control form-control-sm" value="<?= esc($barang['tipe']) ?>">
    </div>
    <div class="row form-group mb-3">
        <label class="col-form-label" for="nama_barang">Nama Barang</label>
        <input type="text" id="nama_barang" name="nama_barang" class="form-control form-control-sm" value="<?= esc($barang['nama']) ?>">
    </div>
    <div class="row form-group mb-3">
        <label class="col-form-label" for="keluhan">Keluhan</label>
        <textarea name="keluhan" cols=" 30" rows="10" class="form form-control form-control-sm"></textarea>
    </div>



    <div class="row form-group mb-3">
        <div class="col-auto">
            <a href='<?= base_url('user/pengguna_barangit') ?>' class="btn btn-sm btn-sm btn-default">Kembali</a>
        </div>
        <div class="col-auto">
            <input type="submit" id="submit-edit" name="submit" class="btn btn-sm btn-sm btn-success" value="Ajukan">
        </div>
    </div>

</form>


<?= $this->endSection(); ?>