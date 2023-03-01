<form action="<?= esc(base_url('user')); ?>/tambahBarangit" method="post" role="form">
    <?= csrf_field() ?>

    <div class="row form-group mb-3">
        <div class="col-3">
            <label class="col-form-label" for="jenis">Jenis</label>
        </div>
        <div class="col-9">
            <select id="jenis_select" class="w-100 selectpicker" name="jenis"    data-live-search="true" data-size="9" data-live-search-placeholder="Pilih Jenis" data-style="" data-style-base="form-control" required>
                <option value='' disabled selected>Pilih Jenis Barang</option>
                <?php foreach ($jenis_list as $jenis) : ?>
                <option value="<?=$jenis['jenis']?>" 
                ><?= esc($jenis['jenis'])?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row form-group mb-3">
        <div class="col-3">
            <label class="col-form-label" for="merk">Merk</label>
        </div>
        <div class="col-9">
            <input type="text" list="list_merk"  id="merk_select" class="w-100 form-control" name="merk"  required>
            <datalist id=list_merk>
                <option class="text-left" value="" selected disabled>Pilih Merk Barang</option>
                <?php foreach ($merk_list as $merk) : ?>
                <option><?= esc($merk['merk']) ?></option>
                <?php endforeach; ?>
            </datalist>
        </div>
    </div>

    <div class="row form-group mb-3">
        <div class="col-3">
            <label class="col-form-label" for="tipe">Tipe </label>
        </div>
        <div class="col-9">
            <input type="text" list="list_tipe" id="tipe_select" class="w-100 form-control form-select" name="tipe" required>
            <datalist id="list_tipe">
                <option class='' value="">Pilih Tipe Barang</option>
                <?php foreach ($tipe_list as $tipe) : ?>
                <option>
                    <?= esc($tipe) ?>
                </option>
                <?php endforeach; ?>
            </datalist>
        </div>
    </div>

    <div class="row form-group mb-3">
        <div class="col-3">
            <label class="col-form-label" for="tahun_peroleh">Tahun Peroleh</label>
        </div>
        <div class="col-9">
            <input type="number" class="w-100 form-control form-select" name="tahun_peroleh" min="2000" max="2021" required>
        </div>
    </div>

    <div class="row form-group mb-3">
        <div class="col-3">
            <label class="col-form-label" for="kondisi">Kondisi Barang</label>
        </div>
        <div class="col-9">
            <select class="w-100 form-control form-select" name="kondisi" required>
                <option class='' value="">Pilih Kondisi Barang</option>
                <option>Baik</option>
                <option>Rusak Ringan</option>
                <option>Rusak Berat</option>
            </select>
        </div>
    </div>
    <div class="row form-group mb-3">
        <div class="col-3">
            <label class="col-form-label" for="status">Status Barang</label>
        </div>
        <div class="col-9">
            <select class="w-100 form-control form-select" name="status" required>
                <option class='' value="">Pilih Status Barang</option>
                <option>Operasional</option>
                <option>Perbaikan</option>
                <option>Tidak digunakan</option>

            </select>
        </div>
    </div>

    <div class="row form-group mb-3">
        <div class="col-3">
            <label class="col-form-label" for="lokasi">Lokasi Barang</label>
        </div>
        <div class="col-9">
            <select class="w-100 selectpicker" name="lokasi"  data-live-search="true" data-size="4" data-live-search-placeholder="Pilih Lokasi Barang" data-style="" data-style-base="form-control" required>
                <option value="" selected disabled>Pilih Lokasi Barang</option>
                <?php foreach ($room_list as $room) : ?>
                <option value="<?=$room?>"><?= $room ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row form-group mb-3">
        <div class="col-3">
            <label class="col-form-label" for="os">Sistem Operasi (OS)</label>
        </div>
        <div class="col-9">
            <input type="text" list="list_os" class="w-100 form-control form-select" name="os"/>
            <datalist id="list_os">
                <option class='' value="">Pilih OS (jika ada) </option>
                <?php foreach ($os_list as $os) : ?>
                <option><?= $os ?></option>
                <?php endforeach; ?>
            </datalist>
        </div>
    </div>

    <div class="row form-group mb-3">
        <div class="col-3">
            <label class="col-form-label" for="nomor_seri">Nomor Seri</label>
        </div>
        <div class="col-9">
            <input type="text" class="form-control" name="nomor_seri" required/>
        </div>
    </div>

    <div class="row form-group mb-3">
        <div class="col-3">
            <label class="col-form-label" for="nib">NIB</label>
        </div>
        <div class="col-9">
            <input type="text" class="form-control" name="nib" required/>
        </div>
    </div>

    <div class="row form-group mb-3 d-none">
        <div class="col-3">
            <label class="col-form-label" for="url">URL</label>
        </div>
        <div class="col-9">
            <input type="text" class="form-control" name="url" value="<?= base_url($uri->getPath()); ?>" required>
        </div>
    </div>

    <div class="row form-group mb-3 d-none">
        <div class="col-3">
            <label class="col-form-label" for="nip_pemakai">NIP Pemakai</label>
        </div>
        <div class="col-9">
            <input type="text" class="form-control" name="nip_pemakai" value="<?= user()->nip; ?>">
        </div>
    </div>

    <div class="modal-footer">
        <input type="button" class="btn btn-sm btn-sm btn-default" data-bs-dismiss="modal" value="Batalkan">
        <input type="submit" id="submit-add" class="btn btn-sm btn-sm btn-success" value="Simpan">
    </div>
</form>