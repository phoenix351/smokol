<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<style>
    .bg-primary {
        background-color: rgb(75, 0, 130) !important;
    }
</style>

<?= view('Myth\Auth\Views\_message_block') ?>

<?= $this->include('templates/kelola_pengguna/modal_add_user'); ?>
<?= $this->include('templates/kelola_pengguna/modal_edit_user'); ?>
<?= $this->include('templates/kelola_pengguna/modal_delete_user'); ?>


<h2><?php echo esc($page_name); ?></h2>

<button href="#" class="btn btn-sm btn-sm btn-success mb-3 mt-2" id="tambah-pegawai">Tambah Pengguna</button>
<div class="table-responsive">
    <table class="table table-bordered table-hover" id="daftar-pengguna" data-search="false" data-striped="true" data-pagination="true" data-filter-control="true" data-side-pagination="client" data-page-size="10" data-page-list="[10, 25, 50, 100, ALL]">
        <thead>
            <tr>
                <th data-filter-control="select" data-field="Role">Role</th>
                <th data-filter-control="input" data-field="Nama Lengkap">Nama Lengkap</th>
                <th class="id d-none">ID Users</th>
                <th data-filter-control="input" data-field="Bidang">Bidang</th>
                <th data-filter-control="input" data-field="E-mail">E-mail</th>
                <th data-filter-control="input" data-field="NIP">NIP</th>
                <th data-filter-control="select" data-field="Status">Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $status_ = ['0' => "Non Aktif", "1" => "Aktif"]; ?>
            <?php foreach ($users as $user) : ?>
                <tr>

                    <td class="role"><?= esc($user['role']); ?></td>
                    <td class="nama_lengkap"><?= esc($user['nama_lengkap']); ?></td>
                    <td class="id d-none"><?= esc($user['id']); ?></td>
                    <td class="bidang"><?= esc($user['bidang']); ?></td>
                    <td class="email"><?= esc($user['email']); ?></td>
                    <td class="nip"><?= esc($user['nip']); ?></td>
                    <td class="active"><?= esc($status_[$user['active']]); ?></td>
                    <td class="text-center">
                        <button class="edit btn btn-warning"><i class="fas fa-edit "></i></button>
                        <button class="delete btn btn-danger"><i class="fas fa-trash "></i></button>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>
<script>
    $("#tambah-pegawai").click(function() {
        $('#modal-add-user').modal('show');
    });

    $(".edit").click(function() {
        // cari baris
        let row = $(this).closest("tr");
        // ambil data
        let id = row.find(".id").text();
        let nip = row.find(".nip").text();
        let role = row.find(".role").text();
        let email = row.find(".email").text();
        let bidang = row.find(".bidang").text();
        let nama_lengkap = row.find(".nama_lengkap").text();

        // taruh di modal

        $("#id-edit").val(id);
        $("#role-edit").val(role);
        $("#nip-edit").val(nip);
        $("#email-edit").val(email);
        $("#bidang-edit").val(bidang);
        $("#nama_lengkap-edit").val(nama_lengkap);
        // show modal

        $("#modal-edit-user").modal('show');
    });
    $(".edit").click(function() {
        // cari baris
        let row = $(this).closest("tr");
        // ambil data
        let id = row.find(".id").text();
        let nip = row.find(".nip").text();
        let role = row.find(".role").text();
        let email = row.find(".email").text();
        let bidang = row.find(".bidang").text();
        let nama_lengkap = row.find(".nama_lengkap").text();

        // taruh di modal

        $("#id-edit").val(id);
        $("#role-edit").val(role);
        $("#nip-edit").val(nip);
        $("#email-edit").val(email);
        $("#bidang-edit").val(bidang);
        $("#nama_lengkap-edit").val(nama_lengkap);
        // show modal

        $("#modal-edit-user").modal('show');
    });
    $(".delete").click(function() {
        // cari baris
        let row = $(this).closest("tr");
        // ambil data
        let id = row.find(".id").text();
        let nip = row.find(".nip").text();
        let role = row.find(".role").text();
        let email = row.find(".email").text();
        let bidang = row.find(".bidang").text();
        let nama_lengkap = row.find(".nama_lengkap").text();

        // taruh di modal

        $("#id-delete").text(id);
        $("#id-delete2").val(id);
        $("#role-delete").text(role);
        $("#nip-delte").text(nip);
        $("#email-delete").text(email);
        $("#bidang-delete").text(bidang);
        $("#nama_lengkap-delete").text(nama_lengkap);
        // show modal

        $("#modal-delete-user").modal('show');
    });
    $("#submit-delete").click(function() {


        let data = {
            id: $("#id-delete").text()
        };

        $.ajax({
                method: "POST",
                url: "<?= esc(base_url()); ?>/user/hapus_pengguna",
                data: data
            })
            .done(function(msg) {
                console.log(msg);
                location.reload();

            })
            .fail(function(err) {
                alert(err);
            })
    });
    $(document).ready(function() {
        $('#daftar-pengguna').bootstrapTable();

    });
</script>
<?= $this->endSection() ?>