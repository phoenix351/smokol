<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<style>
    #daftar-pegawai {
        font-size: 0.93em;
    }


    .id {
        display: none;
    }

    @media screen and (max-width: 768px) {

        #daftar-barang {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 5px;
            padding-left: 5px !important;
            padding-right: 5px !important;
        }


        .card-footer .btn {
            width: 100% !important;
            padding-top: 10px !important;
            padding-bottom: 10px !important;
            padding-left: 0px !important;
            font-size: medium !important;
        }


        .btn-label {
            position: relative;
            left: -3px;
            display: inline-block;
            padding: 3px 3px;
            /* background: rgba(0, 0, 0, 0.15); */
            border-radius: 3px 0 0 3px;
        }

        .card {
            min-width: 390px !important;
            left: -10px;
        }

        .row {
            margin-right: 0px !important;
            margin-left: 0px !important;
        }

        .btn-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
        }
    }

    @media screen and (min-width: 768px) {
        #daftar-barang {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding-left: 10px !important;
            padding-right: 10px !important;
        }

        .card {
            min-width: 280px
        }

        .card-footer .btn {
            width: 100% !important;
            padding-top: 5px !important;
            padding-bottom: 5px !important;
            padding-left: 0px !important;
            font-size: small !important;
        }

        button {
            width: 100%;
        }

        .btn-label {
            position: relative;
            left: -3px;
            display: inline-block;
            padding: 6px 12px;
            /* background: rgba(0, 0, 0, 0.15); */
            border-radius: 3px 0 0 3px;

        }

        div.btn-container {
            display: grid;
            /* flex-direction: row; */
            align-items: center;
            grid-template-columns: repeat(3, 1fr);
            gap: 5px;
            justify-content: space-around !important;
        }
    }

    @media screen and (min-width: 1800px) {
        #daftar-barang {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            padding-left: 20px !important;
            padding-right: 20px !important;
        }

        .card {
            min-width: 400px;
        }


        .card-footer .btn {
            width: 100% !important;
            padding-top: 0px !important;
            padding-bottom: 0px !important;
            padding-left: 0px !important;
            font-size: smaller !important;
        }

        .btn-label {
            position: relative;
            left: -3px;
            display: inline-block;
            padding: 6px 12px;
            /* background: rgba(0, 0, 0, 0.15); */
            border-radius: 3px 0 0 3px;

        }

        div.btn-container {
            display: grid;
            /* flex-direction: row; */
            align-items: center;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            justify-content: space-around !important;
        }
    }



    .title {
        margin-top: 30px;
        padding-left: 20px;
        padding-right: 20px;
    }
</style>


<!-- modal add form -->
<div class="modal fade" id="modal-add-barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" style="max-width:32vw">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="delete-modal-label">Tambah Data Barang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<!-- end modal add -->



<!-- Modal Kembalikan Barang -->
<div class="modal fade" id="modal-kembalikan-barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="edit-modal-label">Apakah Anda Yakin Akan Mengembalikan Barang
                    Berikut Kepada Admin ? </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td>Jenis Barang</td>
                        <td id="balik_jenis"></td>
                    </tr>
                    <tr>
                        <td>Nama Barang</td>
                        <td id="balik_nama"></td>
                    </tr>
                    <tr>
                        <td>Tahun Peroleh</td>
                        <td id="balik_tahun"></td>
                    </tr>
                    <tr>
                        <td>Sistem Operasi</td>
                        <td id="balik_os"></td>
                    </tr>
                </table>
                <form action=" <?= base_url('user') ?>/pengguna_balik_barang" method="post" role="form">
                    <?= csrf_field() ?>
                    <input type="text" class="" name="barang_id" id="barang_id">

                    <div class="modal-footer">
                        <input type="button" class="btn btn-sm btn-sm btn-default" data-bs-dismiss="modal" value="Batalkan">
                        <input type="submit" name="submit" class="btn btn-sm btn-sm btn-success" value="Konfirmasi">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Modal Tidak Kuasa -->
<div class="modal fade" id="modal-tidak-kuasa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">

                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title text-dark" id="edit-modal-label">Apakah Anda Yakin akan Mengatur Akun ini Sebagai
                    Bukan Penguasa Barang IT ? </h5>
                <form action=" <?= base_url('user') ?>/pengguna_tidak_kuasa" method="post" role="form">
                    <?= csrf_field() ?>
                    <input type="text" class="d-none" name="user_id" id="barang_id">

                    <div class="modal-footer">
                        <input type="button" class="btn btn-sm btn-sm btn-default" data-bs-dismiss="modal" value="Batalkan">
                        <input type="submit" name="submit" class="btn btn-sm btn-sm btn-success" value="Konfirmasi">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<!-- End modal Kembalikan Barang -->

<!-- Modal update info form -->
<!-- <div class="modal fade" id="modal-update-info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="edit-modal-label">Pengajuan Keluhan Barang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


            </div>


            <div class="modal-footer">

            </div>
            </form>

        </div>
    </div>
</div> -->



<!-- Modal -->
<div class="modal modal-fullscreen-md-down fade " id="modal-update-info" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Informasi</h5>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('user') ?>/ajukan" method="post" role="form">
                    <?= csrf_field() ?>
                    <div class=" mb-3">
                        <label class="col-form-label" for="id-barang">ID Barang</label>
                        <input type="text" id="id-barang" name="id-barang" class="form-control form-control-sm">
                    </div>
                    <div class=" mb-3">
                        <label class="form-label" for="kondisi-barang">Kondisi Barang</label>
                        <select name="kondisi-barang" id="kondisi-barang" class="form-control form-control-sm">
                            <option value="Baik">Baik</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                        </select>

                    </div>
                    <div class=" mb-3">
                        <label class="col-form-label" for="sistem-operasi">Sistem Operasi</label>
                        <select name="sistem-operasi" id="sistem-operasi" class="form-control form-control-sm">
                            <?php foreach ($daftar_sistem_operasi as $os) : ?>
                                <option value=<?= $os['id'] ?>><?= $os['nama_sistem_operasi'] . ' ' . $os['arsitektur'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class=" mb-3">
                        <label class="col-form-label" for="nama-ruangan">Lokasi Barang</label>
                        <select name="nama-ruangan" id="nama-ruangan" class="form-control form-control-sm">
                            <?php foreach ($daftar_ruangan as $ruangan) : ?>
                                <option value=<?= $ruangan['id'] ?>><?= $ruangan['nama_ruangan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <input type="button" class="btn btn-sm btn-sm btn-default" data-bs-dismiss="modal" value="Batal">
                <input type="submit" id="submit-edit" name="submit" class="btn btn-sm btn-sm btn-success" value="Simpan">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal pengajuan -->



<?= view('Myth\Auth\Views\_message_block') ?>
<!-- <button href="#" class="btn btn-sm btn-sm btn-success mb-3 mt-2" id="tambah-barang">Tambah Barang</button> -->

<!-- <button href="#" class="btn btn-sm btn-sm btn-secondary mb-3 mt-2" id="tidak-kuasa">Tidak Menguasai</button> -->
<h2 class="title"><?php echo esc("$title"); ?></h2>

<section id="daftar-barang">

    <?php foreach ($barang as $brg) : ?>

        <div class="container py-5">
            <div class="row ">
                <div class="col-6 col-sm-12">
                    <div class="card" style="border-radius: 15px;">
                        <div class="bg-image hover-overlay ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
                            <img src="https://fastly.picsum.photos/id/6/5000/3333.jpg?hmac=pq9FRpg2xkAQ7J9JTrBtyFcp9-qvlu8ycAi7bUHlL7I" style="border-top-left-radius: 15px; border-top-right-radius: 15px;" class="img-fluid" alt="Laptop" />
                            <a href="#!">
                                <div class="mask"></div>
                            </a>
                        </div>
                        <div class="card-body pb-0">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p><a href="#!" class="text-dark"><?= esc($brg['merk_barang'] . ' ' . $brg['tipe_barang']); ?></a>
                                    </p>
                                    <p class="small text-muted"><?= esc($brg['jenis_barang']); ?></p>
                                </div>
                                <div>
                                    <div class="d-flex flex-row justify-content-end mt-1 mb-4 text-primary">
                                        <?= esc($brg['sistem_operasi']); ?>
                                    </div>

                                    <p class="small text-muted"><?= esc($brg['nomor_seri']); ?></p>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body pb-0">
                            <div class="d-flex justify-content-between">
                                <p class="text-dark"><?= esc($brg['nama_ruangan']); ?></p>

                                <p><a href="#!" class="text-dark"></a></p>
                                <p class="text-success"><?= esc($brg['kondisi_barang']); ?></p>
                            </div>
                            <p class="small text-muted"><?= esc($brg['tanggal_peroleh']); ?></p>
                        </div>
                        <hr class="my-0" />
                        <div class="card-footer">
                            <!-- <div class="d-flex justify-content-between align-items-center pb-2 mb-1"> -->
                            <div class="btn-container">
                                <button type="button" class="btn btn-sm btn-primary"><span class="btn-label"><i class="fas fa-tools"></i></span>Pemeliharaan</button>
                                <button type="button" class="btn btn-sm btn-secondary"><span class="btn-label"><i class="fas fa-upload"></i></span>
                                    Upload BAST</button>
                                <button type="button" value=<?= $brg['id'] ?> class="btn btn-sm btn-info
                                update-info-btn"><span class="btn-label"><i id="update-info-icon-<?= $brg['id'] ?>" class="fas fa-edit"></i>
                                        <span id="update-info-loading-<?= $brg['id'] ?>" class="spinner-border spinner-border-sm update-info-loading" role="status" aria-hidden="true"></span>
                                    </span>Update
                                    Info</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>








<script>
    async function getLatestHistoryBarang(id_barang) {
        // show the loading
        $(`#update-info-loading-${id_barang}`).show();
        $(`#update-info-icon-${id_barang}`).hide();


        try {
            const response = await fetch('<?= base_url() ?>/barang/get_last_history?id_barang=' + id_barang);
            const data = await response.json();
            $('#id-barang').val(data['id_barang']);
            $("#kondisi-barang").val(data['kondisi']);
            $("#sistem-operasi").val(data['id_sistem_operasi']);
            $("#nama-ruangan").val(data["id_ruangan"]);
            return data;
        } catch (error) {
            console.error(error);
        } finally {
            // hide the loading

            $(`#update-info-loading-${id_barang}`).hide();
            $(`#update-info-icon-${id_barang}`).show();
        }
    }


    $(document).ready(function() {
        $('.update-info-loading').hide();

        $('#tambah-barang').click(function() {
            $("#modal-add-barang").modal('show');
        });

        $("form[name=form-add]").submit(function() {
            $(this).submit(function() {
                return false;
            });
            return true;
        });

        $('#tidak-kuasa').click(function() {
            let user_id = "<?= user()->id ?>";
            $("#user_id").val(user_id);
            $("#modal-tidak-kuasa").modal('show');
        });

        $('.update-info-btn').click(async (e) => {
            let id_barang = e.currentTarget.value;
            const response = await getLatestHistoryBarang(id_barang);

            $('#modal-update-info').modal('show');

        });




    });



    function Kembalikan(t) {
        let row = $(t).closest("tr");
        // ambil data
        let id = row.find(".id").text();
        let nama = row.find(".nama").text();
        let jenis = row.find(".jenis").text();
        let os = row.find(".os").text();
        let tahun = row.find(".tahun").text();

        // insert data dan buka modal 

        $("#balik_nama").text(nama);
        $("#balik_jenis").text(jenis);
        $("#balik_os").text(os);
        $("#balik_tahun").text(tahun);
        $("#barang_id").val(id);
        $("#modal-kembalikan-barang").modal('show');

    };


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




                    $("#tipe_select").append('<option class="tipe_list">' + item.tipe + '</option>');
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

                    $("#tipe_select").append('<option class="tipe_list">' + item.tipe + '</option>');
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
                ;
                msg.data.forEach(function(item, index) {

                    $("#merk_select").append('<option class="merk_list">' + item.merk + '</option>');
                });


            })
            .fail(function(err) {
                console.log(err);
            });


    }


    // edit employee
</script>


<?= $this->endSection(); ?>