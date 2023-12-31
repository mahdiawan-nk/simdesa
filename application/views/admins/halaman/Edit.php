<?php $urlassets = $this->config->item('asset-admin') ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Tambah Halaman</h5>
            <small class="text-muted float-end">Form Tambah Halaman</small>
        </div>
        <div class="card-body row justify-content-center">
            <form action="<?= base_url('panel-admin/halaman/update/' . $halaman->id_halaman) ?>" method="POST">
                <div class="form-group">
                    <label for="">For Menu Halaman</label>
                    <select name="id_menu" class="form-control" id="">
                        <option value="">Pilih Menu</option>
                        <?php foreach ($menu as $menus) : ?>
                            <?php if ($menus->nama_menu != 'Beranda' || $menus->id_menu != 1) : ?>
                                <option value="<?= $menus->id_menu ?>" <?= $halaman->id_menu == $menus->id_menu ? 'selected' : '' ?>><?= $menus->nama_menu ?></option>
                            <?php endif ?>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Judul Halaman</label>
                    <input type="text" class="form-control" name="title_halaman" value="<?= $halaman->title_halaman ?>">
                </div>
                <div class="form-group">
                    <label for="">Slugs Halaman</label>
                    <input type="text" class="form-control" readonly name="slug_name" value="<?= $halaman->slug_name ?>">
                </div>
                <div class="form-group">
                    <label for="">Template Halaman</label>
                    <select name="template" id="" class="form-control">
                        <option value="">Pilih Template</option>
                        <option value="row_text" <?= $halaman->template == 'row_text' ? 'selected' : '' ?>>Row text</option>
                        <option value="card_profile" <?= $halaman->template == 'card_profile' ? 'selected' : '' ?>>Card Profil</option>
                        <option value="news" <?= $halaman->template == 'news' ? 'selected' : '' ?>>News</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-12">Is Statics</label>
                    <div class="col-sm-2">
                        <div class="form-check">
                            <input name="is_statics" class="form-check-input" type="radio" value="Y" id="defaultRadio1" required <?= $halaman->is_statics == 'Y' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="defaultRadio1"> Yes </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-check">
                            <input name="is_statics" class="form-check-input" type="radio" value="N" id="defaultRadio1" required <?= $halaman->is_statics == 'N' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="defaultRadio1"> No </label>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="alert alert-info" role="alert">
                            Note : <br>
                            <li>Pilih Yes Tidak perlu mengisi content text</li>
                            <li>Pilih No perlu mengisi content text</li>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="isi-halaman">
                    <label for="">Content</label>
                    <textarea name="isi_halaman" id="summernote" cols="30" rows="10"><?= $halaman->isi_halaman ?></textarea>
                </div>
                <div class="form-group" >
                    <label for="">Redirect Link</label>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-check">
                                <input name="redirect" class="form-check-input" type="radio" value="Y" id="defaultRadio1" required <?= $halaman->link_redirect != '' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="defaultRadio1"> Yes </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check">
                                <input name="redirect" class="form-check-input" type="radio" value="N" id="defaultRadio1" required <?= $halaman->link_redirect == '' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="defaultRadio1"> No </label>
                            </div>
                        </div>
                    </div>

                    <input type="text" class="form-control" name="link_redirect" readonly value="">
                    <div class="alert alert-info mt-2" role="alert">
                        Note : <br>
                        Jika Ada redirect silahkan di isi jika tidak ada mohon di kosongkan <br>
                        default redirect ini hanya untuk halaman surak keterangan
                    </div>
                </div>
                <div class="form-group">

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('panel-admin/halaman') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function() {
        var hide_content_form = true;
        // $('#isi-halaman').hide(true);
        $('input[name="is_statics"]').change();
        $('input[name="redirect"]').change();
        $('input[name="redirect"]').change(function() {
            var selectedValue = $('input[name="redirect"]:checked').val();
            if (selectedValue == 'Y') {
                $('[name="link_redirect"]').val('<?= base_url() ?>panel-admin/pengajuan-surat');

            } else {
                $('[name="link_redirect"]').val('');
            }
        });
        $('input[name="is_statics"]').change(function() {
            var selectedValue = $('input[name="is_statics"]:checked').val();
            if (selectedValue == 'Y') {
                $('#isi-halaman').hide(true);

            } else {
                $('#isi-halaman').show(true);
            }
        });

        $('#summernote').summernote({
            height: 600, // set editor height
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
                url: "<?php echo base_url('panel-admin/halaman/upload_image') ?>",
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
                url: "<?php echo base_url('panel-admin/halaman/delete_image') ?>",
                cache: false,
                success: function(response) {
                    console.log(response);
                }
            });
        }
        $('[name="title_halaman"]').on('keyup', function() {
            var text = $(this).val();
            text = text.replace(/\s+/g, '-');
            $('[name="slug_name"]').val(text.toLowerCase());
        });

    })

    function replaceSpaceWithDash(text) {
        return text.replace(/\s+/g, '-');
    }
</script>