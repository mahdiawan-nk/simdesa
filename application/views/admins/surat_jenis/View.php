<?php $urlassets = $this->config->item('asset-admin') ?>
<style>
    table>tbody>tr>td {
        font-size: 11px;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">

        <div class="card-header">
            <h5 class="card-title">Data kategori</h5>
            <!-- <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#backDropModal">Tambah Kategori</button> -->
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table" id="table-data">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>slugs</th>
                            <th>Status</th>
                            <th>act</th>
                        </tr>
                    </thead>
                    <tbody class="table-border">
                        <?php foreach ($data as $no => $list) : ?>
                            <tr>
                                <td><?= $no + 1 ?></td>
                                <td><?= $list->nama_surat ?></td>
                                <td><?= $list->slug ?></td>
                                <td><span class="badge badge-<?= $list->status == 'Y' ? 'success' : 'danger' ?>"><?= $list->status == 'Y' ? 'Aktif' : 'Deaktif' ?></span></td>
                                <td>
                                    <a href="<?= base_url('panel-admin/syaratsurat/' . $list->id_surat_jenis) ?>" class="btn btn-secondary btn-sm">Setting Syarat</a>
                                    <a href="<?= base_url('panel-admin/templatesurat/' . $list->id_surat_jenis) ?>" class="btn btn-secondary btn-sm">Setting Form</a>
                                    <!-- <a href="<?= base_url('panel-admin/templatesurat/format/' . $list->id_surat_jenis) ?>" class="btn btn-secondary btn-sm">Setting Format Surat</a> -->
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#edit-<?= $list->id_surat_jenis ?>">Ubah</button>
                                    <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-<?= $list->id_surat_jenis ?>">Hapus</button> -->
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <form class="modal-content" method="POST" action="<?= base_url('panel-admin/jenissurat/save') ?>">
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Tambah jenis Surat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Nama Surat</label>
                        <input type="text" id="nameBackdrop" name="nama_surat" class="form-control" placeholder="Enter Name" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">slugs</label>
                        <input type="text" id="nameBackdrop" name="slug" class="form-control" placeholder="Enter Name" readonly>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-12">
                        <label for="">Status</label>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="Y" required>
                            <label class="form-check-label" for="inlineRadio1">Aktif</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="N" required>
                            <label class="form-check-label" for="inlineRadio2">Deaktif</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-3">
                        <label class="form-label" for="basic-default-fullname">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="summernote" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<?php foreach ($data as $no => $list) : ?>
    <div class="modal fade" id="edit-<?= $list->id_surat_jenis ?>" data-backdrop="static" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <form class="modal-content" method="POST" action="<?= base_url('panel-admin/jenissurat/update/' . $list->id_surat_jenis) ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-<?= $list->id_surat_jenis ?>">Tambah jenis Surat</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Nama Surat</label>
                            <input type="text" id="nameBackdrop" name="nama_surat" class="form-control" placeholder="Enter Name" required value="<?= $list->nama_surat ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">slugs</label>
                            <input type="text" id="nameBackdrop" name="slug" class="form-control" placeholder="Enter Name" readonly value="<?= $list->slug ?>">
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-12">
                            <label for="">Status</label>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="Y" required <?= $list->status == 'Y' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="inlineRadio1">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="N" required <?= $list->status == 'N' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="inlineRadio2">Deaktif</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label class="form-label" for="basic-default-fullname">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control summernote" id="summernote" cols="30" rows="10"><?= $list->deskripsi ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="delete-<?= $list->id_surat_jenis ?>" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header ">
                </div>
                <div class="modal-body text-center">
                    <h1 class="p-3">
                        <i class="fa-sharp fa-solid fa-circle-question fa-2xl text-danger"></i>
                    </h1>
                    <p>
                        Anda Yakin Menghapus Data Ini?
                    </p>
                </div>
                <div class="modal-footer" style="justify-content: space-between;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('panel-admin/jenissurat/delete/' . $list->id_surat_jenis) ?>" class="btn btn-primary">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<script>
    $('#table-data').DataTable();
    $(function() {
        $('[name="nama_surat"]').on('keyup', function() {
            var text = $(this).val();
            text = text.replace(/\s+/g, '-');
            $('[name="slug"]').val(text);
        });

        $('[name="nama_surat"]').on('paste', function() {
            var input = $(this);
            setTimeout(function() {
                var text = input.val();
                text = replaceSpaceWithDash(text);
                $('[name="slug"]').val(text);
            }, 50);
        });

        $('#summernote').summernote({
            height: 300, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: true, // set focus to editable area after initializing summernote
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                },
                onMediaDelete: function(target) {
                    deleteImage(target[0].src);
                }
            }
        });
        $('.summernote').summernote({
            height: 300, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: true, // set focus to editable area after initializing summernote
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                },
                onMediaDelete: function(target) {
                    deleteImage(target[0].src);
                }
            }
        });

        function uploadImage(image) {
            var data = new FormData();
            data.append("image", image);
            $.ajax({
                url: "<?php echo base_url('panel-admin/berita/upload_image') ?>",
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "POST",
                success: function(url) {
                    console.log(url)
                    $('#summernote').summernote("insertImage", url);
                },
                error: function(request, textStatus, errorThrown) {
                    console.log(request.responseText);
                }

            });
        }

        function deleteImage(src) {
            console.log(src)
            $.ajax({
                data: {
                    src: src
                },
                type: "POST",
                url: "<?php echo base_url('panel-admin/berita/delete_image') ?>",
                cache: false,
                success: function(response) {
                    console.log(response);
                }
            });
        }

        function replaceSpaceWithDash(text) {
            return text.replace(/\s+/g, '-');
        }
    });
</script>