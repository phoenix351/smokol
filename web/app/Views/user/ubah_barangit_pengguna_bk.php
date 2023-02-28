<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>

<form action="<?= esc(base_url('user/ubah_barangitByUser')); ?>" method="post" role="form">
    <h4 class="text-center mt-5">Perubahan Data Barang IT</h4>
    <?= csrf_field() ?>
    <div class="row form-group mb-3 d-none">
        <div class="col-5"><label class="col-form-label" for="id1">ID </label></div>
        <div class="col-7"><input type="text" class="form-control form-control-sm" name="id" value="<?= $barang['id'] ?>">
        </div>
    </div>
    <div class="row form-group mb-3">
        <div class="col-5">
            <label class="col-form-label" for="jenis">Jenis</label>
        </div>
        <div class="col-7">

            <input type="text" list="list_jenis" id="jenis_select" class="w-100 form-control form-select" name="jenis" onchange="showfield('jenis','jenis_lainnya',this.options[this.selectedIndex].value); getMerkByJenis(this.options[this.selectedIndex].value); getTipeByJenis(this.options[this.selectedIndex].value);" value="<?= $barang['jenis'] ?>" required>
            <datalist id="list_jenis">
                <option class="text-center" value="">Pilih Jenis Barang</option>
                <?php foreach ($jenis_list as $jenis) : ?>
                    <option><?= esc($jenis) ?></option>
                <?php endforeach; ?>

            </datalist>

        </div>

    </div>


    <div class="row form-group mb-3">
        <div class="col-5">
            <label class="col-form-label" for="merk">Merk Barang</label>
        </div>
        <div class="col-7">

            <input type="text" list="list_merk" id="merk_select" class="w-100 form-control form-select" name="merk" onchange="showfield('merk','merk_lainnya',this.options[this.selectedIndex].value); getTipeByMerk(this.options[this.selectedIndex].value,$('#jenis_select').val())" value="<?= $barang['merk'] ?>" required>
            <datalist id="list_merk">
                <option class="text-center" value="">Pilih Merk Barang</option>
                <?php foreach ($merk_list as $merk) : ?>
                    <option class="merk_list" <?= $barang['merk'] == $merk ? ' selected="selected"' : ''; ?>><?= esc($merk) ?></option>
                <?php endforeach; ?>
            </datalist>


        </div>
    </div>

    <div class="row form-group mb-3">
        <div class="col-5">
            <label class="col-form-label" for="tipe">Tipe </label>
        </div>
        <div class="col-7">

            <input type="text" list="list_tipe" id="tipe_select" class="w-100 form-control form-select" onchange="showfield('tipe','tipe_lainnya',this.options[this.selectedIndex].value)" name="tipe" value="<?= $barang['tipe'] ?>" required/>
            <datalist id="list_tipe">
                <option class="text-center" value="">Pilih Tipe Barang</option>
                <?php foreach ($tipe_list as $tipe) : ?>
                <option class="tipe_list" <?= $barang['tipe'] == $tipe ? 'selected="selected"' : ''; ?>><?= esc($tipe) ?></option>
                <?php endforeach; ?>
            </datalist>


        </div>
    </div>

    <div class="row form-group mb-3">
        <div class="col-5">
            <label class="col-form-label" for="tahun_peroleh">Tahun Peroleh</label>
        </div>
        <div class="col-7">

            <input type="number" class="w-100 form-control form-select" name="tahun_peroleh" min="2000" max="2021" value="<?= $barang['tahun_peroleh'] ?>" required>


        </div>
    </div>


    <div class="row form-group mb-3">
        <div class="col-5">
            <label class="col-form-label" for="kondisi">Kondisi Barang</label>
        </div>
        <div class=" col-7">

            <select class="w-100 form-control form-select" name="kondisi" required>
                <option class="text-center" value="">Pilih Kondisi Barang</option>

                <option <?= $barang['kondisi'] == 'Baik' ? ' selected="selected"' : ''; ?>>Baik</option>
                <option <?= $barang['kondisi'] == 'Rusak Ringan' ? ' selected="selected"' : ''; ?>>Rusak Ringan</option>
                <option <?= $barang['kondisi'] == 'Rusak Berat' ? ' selected="selected"' : ''; ?>>Rusak Berat</option>

            </select>


        </div>
    </div>
    <div class="row form-group mb-3">
        <div class="col-5">
            <label class="col-form-label" for="status">Status Barang</label>
        </div>
        <div class="col-7">

            <select class="w-100 form-control form-select" name="status" required>
                <option class="text-center" value="">Pilih Status Barang</option>
                <option <?= $barang['status'] == 'Operasional' ? ' selected="selected"' : ''; ?>>Operasional</option>
                <option <?= $barang['status'] == 'Perbaikan' ? ' selected="selected"' : ''; ?>>Perbaikan</option>
                <option <?= $barang['status'] == 'Tidak digunakan' ? ' selected="selected"' : ''; ?>>Tidak digunakan</option>

            </select>

        </div>
    </div>
    <div class="row form-group mb-3">
        <div class="col-5">
            <label class="col-form-label" for="lokasi">Lokasi Barang</label>
        </div>
        <div class="col-7">

            <input type="text" list="list_room" class="w-100 form-control form-select" name="lokasi" value="<?= $barang['lokasi'] ?>" required>
            <datalist id="list_room">
                <option class="text-center" value="">Pilih Lokasi Barang</option>
                <?php foreach ($room_list as $room) : ?>
                    <option><?= $room ?></option>
                <?php endforeach; ?>
            </datalist>


        </div>
    </div>


    <div class="row form-group mb-3">
        <div class="col-5">
            <label class="col-form-label" for="os">Sistem Operasi (OS)</label>
        </div>
        <div class="col-7">

            <input type="text" list="list_os" class="w-100 form-control form-select" name="os" value="<?= $barang['os'] ?>">
            <datalist id="list_os">
                <option class="text-center" value="">Pilih OS (jika ada) </option>
                <?php foreach ($os_list as $os) : ?>
                    <option><?= $os ?></option>
                <?php endforeach; ?>
            </datalist>

        </div>
    </div>

    <div class="row form-group mb-3">
        <div class="col-5">
            <label class="col-form-label" for="nomor_seri">Nomor Seri</label>
        </div>
        <div class="col-7">
            <input type="text" class="form-control" value="<?= $barang['nomor_seri'] ?>" name="nomor_seri" required></input>
        </div>
    </div>
    <div class="row form-group mb-3">
        <div class="col-5">
            <label class="col-form-label" for="nib">NIB</label>
        </div>
        <div class="col-7">
            <input type="text" class="form-control" name="nib" value="<?= $barang['nib'] ?>" required></input>
        </div>
    </div>


    <input name="url" type="text" class="d-none" value="<?= base_url('user/pengguna_barangit'); ?>">
    <div class="row form-group mb-3 offset-5">
        <div class="col-auto">
            <a href='<?= base_url('user/pengguna_barangit') ?>' class="btn btn-sm btn-sm btn-secondary">Kembali</a>
        </div>
        <div class="col-auto">
            <div class="col-7"><input type="submit" id="submit-edit" name="submit" class="btn btn-sm btn-sm btn-success" value="Simpan">
            </div>
        </div>
</form>
<script>
    $(document).ready(function() {

        getTipeByMerk($('#merk_select').val(), $('#jenis_select').val());

    });


    function getTipeByMerk(merk, jenis) {
        //delete all child

        $("option[class='tipe_list']").remove();
        console.log(merk, jenis);
        //panggil api
        $.ajax({
                method: "GET",
                url: "<?= esc(base_url()); ?>/user/getTipeListByMerk/",
                data: {
                    'merk': merk,
                    'jenis': jenis
                }
            })
            .done(function(msg) {
                console.log(msg)

                msg.data.forEach(function(item, index) {
                    let btipe = "<?= $barang['tipe'] ?>";

                    let select_ = btipe == item.tipe ? 'selected' : '';

                    $("#list_tipe").append('<option ' + select_ + ' class="tipe_list">' + item.tipe + '</option>');
                });


            })
            .fail(function(err) {
                console.log(err);
            });

    }


    function getMerkByJenis(jenis) {
        //delete all child
        $("option[class='merk_list']").remove();
        //panggil api
        $.ajax({
                method: "GET",
                url: "<?= esc(base_url()); ?>/user/getMerkByJenis/" + jenis,
            })
            .done(function(msg) {

                msg.data.forEach(function(item, index) {

                    $("#merk_select").append('<option class="merk_list">' + item.merk + '</option>');
                });



            })
            .fail(function(err) {
                console.log(err);
            });


    }

    function getTipeByJenis(jenis) {
        //delete all child
        $("option[class='tipe_list']").remove();
        //panggil api
        $.ajax({
                method: "GET",
                url: "<?= esc(base_url()); ?>/user/getTipeListByJenis/" + jenis,

            })
            .done(function(msg) {
                ;

                msg.data.forEach(function(item, index) {

                    $("#list_tipe").append('<option class="tipe_list">' + item.tipe + '</option>');
                });
                if (msg.data[0].tipe == "Lainnya") {
                    $("#tipe_lainnya").html('<input class="form-control" type="text" name="tipe" required />')
                }


            })
            .fail(function(err) {
                console.log(err);
            });

    }
</script>
<?= $this->endSection(); ?>