<?php

use Config\App;
?>
<img src="http://localhost:8080/assets/img/logo-ct.png">
<h2>
    <center>SURAT PENGAJUAN USULAN PERBAIKAN BARANG IT
        BADAN PUSAT STATISTIK PROVINSI SULAWESI UTARA</center>
</h2>
Nomor : <span><?= $data['nomor_surat'] ?></span> Tanggal : <span><?= $data['tanggal'] ?></span>
<hr>
<span>Nama Barang</span> : <span><?= $data['nama_barang'] ?></span>
<span> Jenis Barang</span> : <span><?= $data['jenis_barang'] ?></span>
<span> Nomor Seri Barang </span> : <span><?= $data['nomor_seri'] ?></span>
<span> Nomor Induk Barang </span> : <span><?= $data['nib'] ?></span>
<span> Keluhan </span> : <span><?= $data['keluhan'] ?></span>

Yang Menerima,
<br>

<span><?= $data['nama_admin'] ?></span>
<br>
Tanggal : <span><?= $data['tanggal_diproses'] ?></span>
<br>

Yang Menyerahkan,
<br>

<span><?= $data['nama_pemakai'] ?></span>
<br>
Tanggal : <span><?= $data['tanggal_diajukan'] ?></span>