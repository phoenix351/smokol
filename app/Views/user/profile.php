<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<?= $this->include('user/modal/edit_profil'); ?>
<?= $this->include('user/modal/edit_foto'); ?>
<?= view('Myth\Auth\Views\_message_block') ?>
<h2 class="text-center mb-5">Profil Saya</h2>
<div class="row">
    <div class="text-center col-lg-6 ">
        <div class="row">
            <img src="<?= base_url('/assets/profil_pics') . '/' . user()->foto ?>" alt="Foto Profil" class="rounded mx-auto d-block" width="300px">
        </div>
        <div class="row w-100">
            <a href="#" class="btn btn-sm btn-secondary mx-auto my-2" data-toggle="modal" onclick=" $('#modal-edit-foto').modal('show');"> <i class="fas fa-edit"></i> Ubah Foto Profil</a>
        </div>
    </div>
    <div class="col-lg-auto">
        <div class="row">
            <div class="col mx-sm-auto my-2">
                <a href="#" class="btn btn-sm text-left btn-secondary" data-toggle="modal" onclick=" $('#modal-edit-profil').modal('show');"> <i class="fas fa-edit"></i> Ubah Data</a>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                Nama Lengkap
            </div>
            <div class="col-6">
                <?= user()->nama_lengkap; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                Email
            </div>
            <div class="col-6"><?= user()->email; ?></div>
        </div>
        <div class="row">
            <div class="col-6">Bidang</div>
            <div class="col-6"><?= user()->bidang; ?></div>
        </div>
        <div class="row">
            <div class="col-6">NIP</div>
            <div class="col-6"><?= user()->nip; ?></div>
        </div>


    </div>
</div>
<script>

</script>

<?= $this->endSection(); ?>