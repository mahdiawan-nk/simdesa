<?php $urlassets = $this->config->item('asset-admin') ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Tambah Berita</h5>
            <small class="text-muted float-end">Form Tambah Berita</small>
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url('panel-admin/berita/save') ?>" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Judul</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">slugs</label>
                    <input type="text" class="form-control" name="slugs" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Thumbnail</label>
                    <input type="file" class="form-control" name="file" accept="image/jpeg, image/jpg, image/png" onchange="previewImage(event)">
                    <div class="divider">
                        <div class="divider-text">Preview Image</div>
                    </div>
                    <img src="https://t4.ftcdn.net/jpg/01/43/42/83/360_F_143428338_gcxw3Jcd0tJpkvvb53pfEztwtU9sxsgT.jpg" alt="" id="preview" class="mx-auto d-block img-thumbnail w-25">
                    <div class="divider">
                        <div class="divider-text">Preview Image</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Status</label>
                    <div class="d-flex justify-content-start">
                        <div class="m-2 form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="active">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Active
                            </label>
                        </div>
                        <div class="m-2 form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="suspend">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Draft/suspend
                            </label>
                        </div>
                    </div>

                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Kategori</label>
                    <select name="kategori_id" id="" class="form-control">
                        <option value="">Pilih Kategori</option>
                        <?php foreach($kategori as $item):?>
                        <option value="<?=$item->id_kategori?>"><?=$item->nama_kategori?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Content</label>
                    <textarea name="content" class="form-control" id="summernote" cols="30" rows="10"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Send</button>
                <a href="<?= base_url('panel-admin/berita') ?>" class="btn btn-default">Batal</a>
            </form>
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
    $(function() {
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

        $('[name="title"]').on('keyup', function() {
            var text = $(this).val();
            text = text.replace(/\s+/g, '-');
            $('[name="slugs"]').val(text);
        });

        $('[name="title"]').on('paste', function() {
            var input = $(this);
            setTimeout(function() {
                var text = input.val();
                text = replaceSpaceWithDash(text);
                $('[name="slugs"]').val(text);
            }, 50);
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