<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<?= $this->include('templates/modal_rincian_pengajuan'); ?>


<!-- modal kelola pending -->
<div class="modal fade" id="modal-kelola-pending" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="kelola-modal-pending">Kelola Pengajuan Barang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form action="<?= esc(base_url('user/update_pending')) ?>" method="post" role="form text-left">
                    <?= csrf_field() ?>
                    <div class="row form-group mb-3 d-none">
                        <div class="col-3">
                            <label for="id-pending">Nomor Tiket</label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="id" class="form-control form-control-sm" id="id-pending">
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-3">
                            <label for="status-pending">Status</label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="status" class="form-control form-control-sm" id="status-pending" disabled>

                        </div>
                    </div>


                    <div class="row form-group mb-3">
                        <div class="col-3">
                            <label for="start-date-pending">Tanggal Diproses</label>
                        </div>
                        <div class="col-9">
                            <input type="date" name="start_date" id="start-date-pending" class="form-control" name="start-date-pending" min="2010-01-01">
                        </div>
                    </div>
                    <input name="url" type="text" class="d-none" value="<?= base_url($uri->getPath()); ?>">

            </div>


            <div class="modal-footer">
                <input type="button" class="btn btn-sm btn-default" data-bs-dismiss="modal" value="Batalkan">
                <input type="button" class="btn btn-sm btn-danger" value="Tolak" onClick='hapusPengajuan()'>
                <input type="submit" class="btn btn-sm btn-success">
            </div>
            </form>


        </div>

    </div>
</div>

<!-- end modal edit pengajuan -->

<!-- modal kelola processed -->
<div class="modal fade" id="modal-kelola-processed" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="processed-modal-label">Kelola Pengajuan Barang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form action="<?= esc(base_url('user/update_processed')) ?>" method="post" role="form text-left" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="row form-group mb-3 d-none">
                        <div class="col-3">
                            <label for="id-processed">Nomor Tiket</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-sm" id="id-processed" name="id">
                        </div>
                    </div>
                    <div class="row form-group mb-3 d-none">
                        <div class="col-3">
                            <label for="id_barang">ID Barang</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-sm" id="id_barang" name="id_barang">
                        </div>
                    </div>
                    <div class="row form-group mb-3 d-none">
                        <div class="col-3">
                            <label for="status-processed">Status</label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="status" class="form-control" id="status-processed">
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-3">
                            <label for="kondisi-processed">Kondisi Akhir</label>
                        </div>
                        <div class="col-9">
                            <select class="form-control form-select" id="kondisi-processed" name="kondisi_final" required>
                                <option>Baik</option>
                                <option>Rusak Ringan</option>
                                <option>Rusak Berat</option>
                            </select>
                        </div>
                    </div>
                   
                    <div class="row form-group mb-3" id="bukti-rusak-berat-wrapper" style="display:none">
                        <div class="col-3">
                            <label for="bukti-rusak-berat">Bukti Rusak Berat</label>
                        </div>
                        <div class="col-9" id="bukti-input-wrapper" >
                                </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-3">
                            <label for="biaya-processed">Biaya Perawatan</label>
                        </div>
                        <div class="col-9">
                            <input type="number" class="form-control form-control-sm" id="biaya-processed" name="biaya" required>
                        </div>
                    </div>

                    <div class="row form-group mb-3">
                        <div class="col-3">
                            <label for="end-date-processed">Tanggal Selesai</label>
                        </div>
                        <div class="col-9">
                            <input class="form-control" type="date" id="end-date-processed" name="end_date" min="2010-01-01" required>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-3">
                            <label for="description-processed">Deskripsi Hasil Perawatan</label>
                        </div>
                        <div class="col-9">
                            <input type="text" id="description-processed" class="form-control" name="catatan_admin">
                        </div>
                    </div>

                    <input name="url" type="text" class="d-none" value="<?= base_url($uri->getPath()); ?>">


            </div>


            <div class="modal-footer">
                <input type="button" class="btn btn-sm btn-default" data-bs-dismiss="modal" value="Batalkan">
                <input type="submit" class="btn btn-sm btn-success" id="submit-processed" value="Kirim">
                </form>
            </div>


        </div>

    </div>
</div>

<!-- end modal edit processed -->






<h3 class="mb-3">Daftar Pengajuan Barang</h3>
<?= view('Myth\Auth\Views\_message_block') ?>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="#" class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Pending</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="#" class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Diproses</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="#" class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Selesai</a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <!-- Pengajuan Pending -->
        <table class="table table-bordered  table-hover table-sm" id="pengajuan-pending" data-search="false" data-striped="true" data-pagination="true" data-filter-control="true" data-side-pagination="client" data-page-size="10" data-page-list="[10, 25, 50, 100, ALL]">
            <thead>
                <tr>
                    <th data-filter-control="input" data-field="ID Barang">ID Barang</th>
                    <th data-filter-control="input" data-field="Nomor Tiket">Nomor Tiket </th>

                    <th data-filter-control="input" data-field="Nama Barang">Nama Barang</th>
                    <th data-filter-control="input" data-field="Nama Pengguna">Nama Pengguna</th>
                    <th data-filter-control="input" data-field="Keluhan">Keluhan</th>
                    <th data-filter-control="input" data-field="Status Pengajuan">Status Pengajuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $tipe_ = ['0' => "Kendaraan Dinas", '1' => "Barang IT"]; ?>
                <?php foreach ($pending as $pengajuan) : ?>
                    <tr>
                        <td class="id-barang"><?= esc($pengajuan['id_barang']); ?></td>
                        <td class="nomor-tiket"><?= esc($pengajuan['id']); ?></td>

                        <td class="nama"><?= esc($pengajuan['merk'] . ' ' . $pengajuan['tipe_barang']); ?></td>
                        <td class="nama-pengguna"><?= esc($pengajuan['nama_pengguna']); ?></td>
                        <td class="keluhan"><?= esc($pengajuan['keluhan']); ?></td>
                        <td class="status"><?= esc($pengajuan['status']); ?></td>
                        <td>
                            <div class="row my-1">
                                <a href="<?= base_url('user/cetak/' . $pengajuan['id'] . '?'); ?>" class="btn btn-sm btn-secondary cetak w-100">Cetak Memo</a>
                            </div>
                            <div class="row my-1">
                                <a href="#" class="btn btn-sm btn-info submit w-100" data-toggle="modal" onclick="lihatRincian(this)">Rincian</a>
                            </div>
                            <div class="row my-1">
                                <a href="#" class="btn btn-sm btn-primary kelola-pending w-100" data-toggle="modal" onclick="kelolaPending(this)">Kelola</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <!-- Pengajuan Prccessed -->
        <table class="table table-bordered  table-hover table-sm" id="pengajuan-processed" data-search="false" data-striped="true" data-pagination="true" data-filter-control="true" data-side-pagination="client" data-page-size="10" data-page-list="[10, 25, 50, 100, ALL]">
            <thead>
                <tr>
                    <th data-filter-control="input" data-field="ID Barang">ID Barang</th>
                    <th data-filter-control="input" data-field="Nomor Tiket">Nomor Tiket </th>
                    <th data-filter-control="input" data-field="Nama Barang">Nama Barang</th>
                    <th data-filter-control="input" data-field="Nama Pengguna">Nama Pengguna</th>
                    <th data-filter-control="input" data-field="Keluhan">Keluhan</th>
                    <th data-filter-control="input" data-field="Status Pengajuan">Status Pengajuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($processed as $pengajuan) : ?>
                    <tr>
                        <td class="id-barang"><?= esc($pengajuan['id_barang']); ?></td>
                        <td class="nomor-tiket"><?= esc($pengajuan['id']); ?></td>
                        <td class="nama"><?= esc($pengajuan['merk'] . ' ' . $pengajuan['tipe_barang']); ?></td>
                        <td class="nama-pengguna"><?= esc($pengajuan['nama_pengguna']); ?></td>
                        <td class="keluhan"><?= esc($pengajuan['keluhan']); ?></td>
                        <td class="status"><?= esc($pengajuan['status']); ?></td>
                        <td>
                            <div class="row my-1">
                                <a href="#" class="btn btn-sm btn-info submit w-100" data-toggle="modal" onclick="lihatRincian(this)">Rincian</a>
                            </div>
                            <div class="row my-1">
                                <a href="#" class="btn btn-sm btn-primary kelola-process w-100" onclick="kelolaProses(this)">Kelola</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        <!-- Pengajuan Done -->
        <table class="table table-bordered  table-hover table-sm" id="pengajuan-done" data-search="false" data-striped="true" data-pagination="true" data-filter-control="true" data-side-pagination="client" data-page-size="10" data-page-list="[10, 25, 50, 100, ALL]">
            <thead>
                <tr>
                    <th data-filter-control="input" data-field="ID Barang">ID Barang</th>
                    <th data-filter-control="input" data-field="Nomor Tiket">Nomor Tiket </th>
                    <th data-filter-control="input" data-field="Nama Barang">Nama Barang</th>
                    <th data-filter-control="input" data-field="Nama Pengguna">Nama Pengguna</th>
                    <th data-filter-control="input" data-field="Keluhan">Keluhan</th>
                    <th data-filter-control="input" data-field="Status Pengajuan">Status Pengajuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($done as $pengajuan) : ?>
                    <tr>
                        <td class="nomor-tiket"><?= esc($pengajuan['id']); ?></td>
                        <td class="id-barang"><?= esc($pengajuan['id_barang']); ?></td>
                        <td class="nama"><?= esc($pengajuan['merk'] . ' ' . $pengajuan['tipe_barang']); ?></td>
                        <td class="nama-pengguna"><?= esc($pengajuan['nama_pengguna']); ?></td>
                        <td class="keluhan"><?= esc($pengajuan['keluhan']); ?></td>
                        <td class="status"><?= esc($pengajuan['status']); ?></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info submit" data-toggle="modal" onclick="lihatRincian(this)">Rincian</a>

                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>




<script>
    function hapusPengajuan() {
    $.ajax({
      method: "POST",
      url: "<?=base_url('user/delete_pengajuan')?>",
      data: {'id': $("#id-pending").val()}
        }).done(function( msg ) {
            alert( "Data Saved: " + msg['pesan'] );
        }
    );
        
    }
    
    function kelolaProses(t) {
        let row = $(t).closest('tr');
        let no_tiket = row.find(".nomor-tiket").text();
        let id_barang = row.find(".id-barang").text();
        let status = row.find(".status").text();

        $("#id-processed").val(no_tiket);
        $("#status-processed").val(status);
        $("#id_barang").val(id_barang);


        $("#modal-kelola-processed").modal('show');
    };
    function kelolaPending(elem) {
            console.log('fungsi terpanggil wkwk');
            let row = $(elem).closest('tr');
            let no_tiket = row.find(".nomor-tiket").text();
            let status = row.find(".status").text();

            $("#id-pending").val(no_tiket);
            $("#status-pending").val(status);


            $("#modal-kelola-pending").modal('show');
        }

        function lihatRincian(elem) {
            //ambil  nilai id tiket dan id_barang
            let row = $(elem).closest('tr');
            let no_tiket = row.find(".nomor-tiket").text();
            //let id_barang = row.find(".id-barang").text();
            // manggil api ke lihat rincian 
            $.ajax({
                    method: "POST",
                    url: "<?= esc(base_url()); ?>/user/pengajuan_detail/" + no_tiket,
                })
                .done(function(response) {


                    let id = response.data[0].id;
                    let status = response.data[0].status;
                    let complain = response.data[0].keluhan;
                    let created_at = response.data[0].created_at;
                    let start_date = (response.data[0].start_date ? response.data[0].start_date : "Belum Tersedia");
                    let end_date = (response.data[0].end_date ? response.data[0].end_date : "Belum Tersedia");
                    $("#nomor-tiket").text(id);
                    $("#status").text(status);
                    $("#tanggal-pengajuan").text(created_at);
                    $("#tanggal-proses").text(start_date);
                    $("#tanggal-selesai").text(end_date);
                    $("#keluhan").text(complain);
                    $("#biaya").text(response.data[0].biaya);
                    console.log(Boolean(response.data[0].bukti_rusak_berat));
                    $("#bukti-rusak-berat").attr("href","<?= base_url().'/user/download_by_path?path='?>"+response.data[0].bukti_rusak_berat);
                    //$("#").text(response.data[0].bukti_rusak_berat);
                    // munculkan modal
                    $("#modal-lihat-rincian").modal('show');


                })
                .fail(function(err) {
                    console.log(JSON.stringify(err));
                })

            // masukan hasilnya ke span - span

        }

    $(document).ready(function() {
        $("#pengajuan-pending").bootstrapTable();
        $("#pengajuan-processed").bootstrapTable();
        $("#pengajuan-done").bootstrapTable();
        // $(".kelola-pending").click(function() {
        //     console.log('fungsi terpanggil wkwk');
        //     let row = $(this).closest('tr');
        //     let no_tiket = row.find(".nomor-tiket").text();
        //     let status = row.find(".status").text();

        //     $("#id-pending").val(no_tiket);
        //     $("#status-pending").val(status);


        //     $("#modal-kelola-pending").modal('show');
        // });


       

        
    
      const kondisi = document.getElementById('kondisi-processed');
                    const buktiWrapper = document.getElementById('bukti-rusak-berat-wrapper');
                    const buktiInputWrapper = document.getElementById('bukti-input-wrapper');
                    kondisi.addEventListener('change', function handleChange(event) {
                      
                      if(event.target.selectedIndex==2) {
                          buktiWrapper.style.display="flex";
                          buktiInputWrapper.innerHTML='<input type="file" class="form-control" id="bukti-rusak-berat" name="bukti-rusak-berat">';
                      } else {
                          buktiInputWrapper.innerHTML="";
                          buktiWrapper.style.display="none";
                      }
                    });
                });
                
</script>
<?= $this->endSection(); ?>