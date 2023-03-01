<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<?php helper('auth');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/assets/img/logo-ct.png">
    <title>
        <?= esc($app_name); ?> - <?= esc($page_name); ?>
    </title>
    <!--     Fonts and icons     -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="<?= base_url() ?>/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->

    <script src="<?= esc(base_url()); ?>/assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?= esc(base_url()); ?>/assets/js/jquery.dataTables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <link href="<?= esc(base_url()); ?>/assets/css/bootstrapTable.css" rel="stylesheet">



</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= esc(base_url()); ?>/assets/img/logo-ct.png" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Sidebar -->
        <?= $this->include('templates/sidebar'); ?>
        <!--  End Sidebar -->


        <!-- Navbar -->

        <?= $this->include('templates/topbar'); ?>
        <!-- End Navbar -->

        <!-- Page Content -->
        <div class="content-wrapper">
            <section class="content">
                <div class=" container-fluid" style="
    position: relative;
    top: 8vh;
">

                    <?= $this->renderSection('content'); ?>

                </div>
            </section>
        </div>
        <!-- <footer class="text-center text-white" style="background-color: #0a4275;">
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2020 Copyright:IPDS
            </div>

        </footer> -->

    </div>
    <style>
    th,
    td,
    button,
    input {
        font-size: 0.875rem;
    }
    </style>

    <script src="<?= esc(base_url()); ?>/assets/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?= esc(base_url()); ?>/assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?= esc(base_url()); ?>/assets/js/bootstrapTable.js"></script>
    <script src="<?= esc(base_url()); ?>/assets/js/bootstrap.bundle.min.js"></script>
    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>/assets/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->




    <!-- Latest compiled and minified JavaScript -->



    <script src="<?= base_url() ?>/assets/js/core/popper.min.js"></script>



    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    </script>

</body>

</html>