<nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>



    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">

                <?php if (logged_in()) : ?>
                    <img src="<?= base_url('assets/profil_pics') . '/' . user()->foto ?>" class="rounded-circle" width="30px" alt="Foto Profil">
                    <span class="d-sm-inline d-none"><?= user()->nama_lengkap; ?></span>
                <?php else : ?>
                    <img src="<?= base_url('assets/profil_pics') . '/' . 'default.jpg' ?>" class="rounded-circle" width="30px" alt="Foto Profil">
                    <span class="d-sm-inline d-none">Tamu</span>
                <?php endif; ?>
            </a>
        </li>


    </ul>


</nav>