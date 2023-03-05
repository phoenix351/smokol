<aside class="main-sidebar sidebar-light-primary elevation-4" style="max-height: calc(100vh);overflow-y: auto;">
    <!-- Brand Logo -->

    <i class="nav-icon fas fa-clipboard-list p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url() ?>/assets/img/logo-ct.png" alt="SMOKOL Logo" class="brand-image">
        <span class="brand-text font-weight-dark">SMOKOL</span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">




        <hr class="horizontal dark mt-0">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a class="nav-link <?php if ($uri->getSegment(1) == 'index') {
                                            echo "active ";
                                        }
                                        ?>" href="<?= esc(base_url('index')); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <?php if (logged_in()) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($uri->getSegment(1) == 'rekap') {
                                                echo "active ";
                                            }
                                            ?>" href="<?= esc(base_url()); ?>rekap">

                            <i class="nav-icon fas fa-calendar-check <?php if ($uri->getSegment(1) == 'rekap') {
                                                                            echo "text-white";
                                                                        } else {
                                                                            echo "text-dark";
                                                                        }
                                                                        ?>"></i>

                            <p>Rekapitulasi Barang IT</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($uri->getSegment(1) == 'pengguna_barang') {
                                                echo "active ";
                                            }
                                            ?>" href="<?= esc(base_url()); ?>pengguna_barang">

                            <i class="nav-icon fas fa-desktop <?php if ($uri->getSegment(1) == 'pengguna_barang') {
                                                                    echo "text-white";
                                                                } else {
                                                                    echo "text-dark";
                                                                }
                                                                ?>"></i>

                            <p>Barang IT</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if ($uri->getSegment(1) == 'pengguna_pengajuan') {
                                                echo "active ";
                                            }
                                            ?>" href="<?= esc(base_url()); ?>pengguna_pengajuan">

                            <i class="nav-icon fas fa-sticky-note <?php if ($uri->getSegment(1) == 'pengguna_pengajuan') {
                                                                        echo "text-white";
                                                                    } else {
                                                                        echo "text-dark";
                                                                    }
                                                                    ?>"></i>

                            <p>Daftar Pengajuan Saya</p>
                        </a>
                    </li>

                    <!-- Admin Pages -->

                    <?php if (in_groups('admin')) : ?>
                        <li class="nav-item mt-3">
                            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Admin pages</h6>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php if ($uri->getSegment(1) == 'kelola_barangit') {
                                                    echo "active ";
                                                }
                                                ?>" href="<?= esc(base_url()); ?>kelola_barangit">

                                <i class="nav-icon fas fa-desktop <?php if ($uri->getSegment(1) == 'kelola_barangit') {
                                                                        echo "text-white";
                                                                    } else {
                                                                        echo "text-dark";
                                                                    }
                                                                    ?>"></i>

                                <p>Kelola Barang IT</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php if ($uri->getSegment(1) == 'kelola_pengajuan') {
                                                    echo "active ";
                                                }
                                                ?>" href="<?= esc(base_url()); ?>kelola_pengajuan">

                                <i class="nav-icon fas fa-sticky-note <?php if ($uri->getSegment(1) == 'kelola_pengajuan') {
                                                                            echo "text-white";
                                                                        } else {
                                                                            echo "text-dark";
                                                                        }
                                                                        ?>"></i>

                                <p>Kelola Pengajuan</p>
                            </a>
                        </li>
                        <li class="nav-item d-none">
                            <a class="nav-link <?php if ($uri->getSegment(1) == 'kelola_pengguna') {
                                                    echo "active ";
                                                }
                                                ?>" href="<?= esc(base_url()); ?>kelola_pengguna">

                                <i class="nav-icon fas fa-users <?php if ($uri->getSegment(1) == 'kelola_pengguna') {
                                                                    echo "text-white";
                                                                } else {
                                                                    echo "text-dark";
                                                                }
                                                                ?>"></i>

                                <p>Kelola Pengguna</p>
                            </a>
                        </li>
                    <?php endif; ?>
                    <!-- End Admin Pages -->

                    <!-- Profile Pages -->
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($uri->getSegment(1) == 'profile') {
                                                echo "active ";
                                            }
                                            ?>" href="<?= esc(base_url()); ?>profile">

                            <i class="nav-icon fas fa-user"></i>

                            <p>Profile</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= esc(base_url()); ?>logout">

                            <i class="nav-icon fas fa-sign-out-alt text-dark"></i>

                            <p>Logout</p>
                        </a>
                    </li>
                    <!-- End Profile Pages -->
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= esc(base_url()); ?>login">
                            <i class="nav-icon fas fa-sign-in-alt text-dark"></i>


                            <p>Login</p>

                        </a>
                    </li>
                <?php endif; ?>
            </ul>

        </nav>
    </div>
    </div>

</aside>