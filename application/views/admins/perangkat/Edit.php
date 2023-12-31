<?php $urlassets = $this->config->item('asset-admin') ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Tambah Berita</h5>
            <small class="text-muted float-end">Form Tambah Berita</small>
        </div>
        <div class="card-body row justify-content-center">
            <div class="col-sm-6 ">
                <form method="post" action="<?= base_url('panel-admin/perangkatdesa/update/'.$data->id_perangkat) ?>" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Foto Pejabat</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="file" accept="image/jpeg, image/jpg, image/png" onchange="previewImage(event)">
                            <?php $foto = base_url('assets/uploads/perangkatdesa/') ?>
                            <img id="preview" src="<?=$data->foto != '' ? $foto.$data->foto:'https://barurejo.desa.id/assets/images/pengguna/kuser.png'?>" alt="" class="img-thumbnail mx-auto d-block w-25 m-3">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-company">NIPD</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="basic-default-company" name="nipd" required value="<?=$data->nipd?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-company">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="basic-default-company" name="nama_lengkap" required value="<?=$data->nama_lengkap?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-company">Jabatan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="basic-default-company" name="jabatan" required value="<?=$data->jabatan?>">
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary">Send</button>
                            <a href="<?= base_url('panel-admin/menu') ?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>