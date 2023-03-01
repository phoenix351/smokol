<?= $this->extend('Auth/index'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
        <div class="card card-plain mt-8">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-info text-gradient">Selamat Datang</h3>
                <p class="mb-0">Masukkan e-mail dan kata sandi untuk masuk</p>
            </div>
            <div class="card-body">
                <?= view('Myth\Auth\Views\_message_block') ?>

                <form action="<?= base_url('login') ?>" method="post" role="form">
                    <?= csrf_field() ?>

                    <?php if ($config->validFields === ['email']) : ?>
                    <label>E-mail</label>
                    <div class="mb-3">

                        <input type="email"
                            class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                            placeholder="Email" name="login" placeholder="<?= lang('Auth.email') ?>" aria-label="Email"
                            aria-describedby="email-addon">
                        <div class="invalid-feedback">
                            <?= session('errors.login') ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <label>Username</label>
                    <div class="mb-3">

                        <input type="text"
                            class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                            placeholder="Username" name="login" placeholder="<?= lang('Auth.name') ?>" aria-label="Name"
                            aria-describedby="name-addon">
                        <div class="invalid-feedback">
                            <?= session('errors.login') ?>
                        </div>
                    </div>
                    <label>Kata Sandi</label>
                    <div class="mb-3">

                        <input type="password" name="password"
                            class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                            placeholder="<?= lang('Auth.password') ?>" aria-label="Password"
                            aria-describedby="password-addon">
                        <div class="invalid-feedback">
                            <?= session('errors.password') ?>
                        </div>
                    </div>
                    <?php if ($config->allowRemembering) : ?>
                    <div class="form-check form-switch">
                        <input id="rememberMe" type="checkbox" name="remember" class="form-check-input"
                            <?php if (old('remember')) : ?> checked <?php endif ?>>
                        <label class="form-check-label" for="rememberMe">Ingat saya</label>
                    </div>
                    <?php endif; ?>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Masuk</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="col-md-6">
        <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                style="background-image:url('<?= base_url() ?>/assets/img/curved-images/curved6.jpg')"></div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>