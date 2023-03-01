<?= $this->extend('Auth/index'); ?>
<?= $this->section('content'); ?>
<div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
                <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                <p class="text-lead text-white">Use these awesome forms to login or create new account in your project for free.</p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-lg-n10 mt-md-n11 mt-n10">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">

                <h2 class="card-header"><?= lang('Auth.register') ?></h2>


                <div class="card-body">
                    <?= view('Myth\Auth\Views\_message_block') ?>

                    <form action="<?= route_to('register') ?>" method="post" role="form text-left">
                        <?= csrf_field() ?>

                        

                        <div class="mb-3">
                            <input type="text" class="form-control <?php if (session('errors.nama_lengkap')) : ?>is-invalid<?php endif ?>" name="nama_lengkap" placeholder="Nama Lengkap" value="<?= old('nama_lengkap') ?>">
                        </div>
                        
                        <div class="mb-3">
                            <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="Username" value="<?= old('username') ?>">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control <?php if (session('errors.nip')) : ?>is-invalid<?php endif ?>" name="nip" placeholder="NIP Pemakai" value="<?= old('nip') ?>">
                        </div> 
                        <div class="mb-3">
                            <select class="form-select <?php if (session('errors.bidang')) : ?>is-invalid<?php endif ?>" name="bidang">
                                <option selected disabled>Pilih Fungsi</option>
                                <option>Kepala</option>
                                <option>Bagian Tata Usaha</option>
                                <option>Bagian Umum</option>
                                <option>Fungsi Statistik Sosial</option>
                                <option>Fungsi Statistik Produksi</option>
                                <option>Fungsi Statistik Distribusi</option>
                                <option>Fungsi Neraca Wilayah dan Analisis</option>
                                <option>Fungsi Integrasi Pengolahan dan Diseminasi Statistik</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input name="email" type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.email') ?>" aria-label="Email" aria-describedby="email-addon" value="<?= old('email') ?>">
                            <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                        </div>
                        <div class="mb-3">

                            <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off" aria-label="Password" aria-describedby="password-addon">
                        </div>
                        <div class="form-check form-check-info text-left">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                            <label class="form-check-label" for="flexCheckDefault">
                                Saya menyetujui <a href="javascript:;" class="text-dark font-weight-bolder">syarat dan ketentuan yang berlaku</a>
                            </label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>