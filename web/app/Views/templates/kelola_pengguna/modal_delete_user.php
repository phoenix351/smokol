<div class="modal fade" id="modal-delete-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="delete-modal-label">Hapus Data Pengguna</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Apakah yakin akan menghapus Pengguna dengan rincian sebagai berikut :</h6>
                <table>
                    <tbody>
                        <tr>
                            <td class="px-4"> User ID </td>
                            <td id="id-delete"></span></td>
                        </tr>
                        <tr>
                            <td class="px-4"> User Role </td>
                            <td id="role-delete"></span></td>
                        </tr>
                        <tr>
                            <td class="px-4">Nama Lengkap</td>
                            <td id="nama_lengkap-delete"></td>
                        </tr>
                        <tr>
                            <td class="px-4">
                                E-mail </td>
                            <td id="email-delete"></td>
                        </tr>
                        <tr>
                            <td class="px-4">
                                Bidang </td>
                            <td id="bidang-delete"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">

                <input type="button" class="btn btn-sm btn-sm btn-default" data-bs-dismiss="modal" value="Batalkan">


                <input type="submit" id="submit-delete" class="btn btn-sm btn-sm btn-danger" value="Hapus"></input>


            </div>
        </div>
    </div>
</div>
<!-- end modal delete -->