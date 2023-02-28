<script>
    function importData() {
        let input = document.createElement('input');
        input.type = 'file';
        input.onchange = _ => {
            // you can use this method to get file and perform respective operations
            let files = Array.from(input.files);
            console.log(files);
        };
        input.click();

    }

    function showPreview(event) {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("foto-preview");
            preview.src = src;
            preview.style.display = "block";
        }
    }
</script>
<!-- modal lihat rincian -->
<div class="modal fade" id="modal-edit-foto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="rincian-modal-label">Edit Foto Profil</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= esc(base_url('user/ubah_foto')); ?>" method="post" role="form" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="row">
                        <img id="foto-preview" src="<?= base_url('assets/profil_pics') . '/' . user()->foto ?>" class="img-fluid" alt="...">
                    </div>
                    <div class="row">
                        <input type="file" name="foto-baru" class="btn btn-sm btn-secondary my-2 mx-auto" onchange="showPreview(event);" value="" />
                    </div>



            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-sm" data-bs-dismiss="modal" value="Batal">
                <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
                <input type="hidden" name="id" class="form-control" value="<?= user()->id ?>">
                </form>

            </div>
        </div>
    </div>
</div>
<!-- end modal lihat rincian -->