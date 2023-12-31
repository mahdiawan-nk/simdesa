<?php $urlassets = $this->config->item('asset-admin') ?>
<style>
    table>tbody>tr>td {
        font-size: 11px;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">

        <div class="card-header">
            <h5 class="card-title">Data Fields Form <?= $detail->nama_surat ?></h5>
            <!-- <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#backDropModal">Tambah Fields Form</button> -->
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table" id="table-data">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Label</th>
                            <th>Type</th>
                            <th>name</th>
                            <th>Required</th>
                            <th>Options</th>
                            <th>Act</th>
                        </tr>
                    </thead>
                    <tbody class="table-border">
                        <?php foreach ($data as $key => $item) : ?>
                            <?php $item = (object)$item ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $item->label ?></td>
                                <td><?= $item->name ?></td>
                                <td><?= $item->type ?></td>
                                <td><?= $item->required ? 'true' : 'false' ?></td>
                                <td><?= $item->options ? json_encode($item->options) : 'false' ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#update-<?= $key ?>">Edit</button>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-<?= $key ?>">Hapus</button>
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
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" method="POST" action="<?= base_url('panel-admin/templatesurat/create/' . $idmeta) ?>">
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Tambah form Fields <?= $detail->nama_surat ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Nama Label</label>
                        <input type="text" id="name-label" name="label" class="form-control" placeholder="Enter Nama Label" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Name Input</label>
                        <input type="text" id="name-input" name="name" class="form-control" placeholder="Enter Name" required readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Type Fields</label>
                        <select name="type" id="" class="form-control">
                            <option value="">pilih Type</option>
                            <option value="text" selected>text</option>
                            <option value="date">date</option>
                            <option value="select">select</option>
                            <option value="radio">radio</option>
                            <option value="textarea">textarea</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Options Select/radio</label>
                        <input type="text" id="nameBackdrop" value="false" name="options" class="form-control" placeholder="ex : Laki-laki,Perempuan" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Required</label>
                        <br>
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" checked name="required" id="inlineRadio1" value="true">
                            <label class="form-check-label" for="inlineRadio1">True</label>
                        </div>
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="required" id="inlineRadio2" value="false">
                            <label class="form-check-label" for="inlineRadio2">False</label>
                        </div>
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

<?php foreach ($data as $index => $fields) : ?>
    <?php $fields = (object)$fields ?>
    <div class="modal fade" id="update-<?= $index ?>" data-bs-backdrop="static" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <form class="modal-content" method="POST" action="<?= base_url('panel-admin/templatesurat/update/' . $idmeta) ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">Ubah Form Fields <?= $detail->nama_surat ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Nama Label</label>
                            <input type="hidden" value="<?= $fields->label ?>" name="oldlabel">
                            <input type="text" id="nameBackdrop" name="label" class="form-control" placeholder="Enter Name" value="<?= $fields->label ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Name Input</label>
                            <input type="text" id="nameBackdrop" name="name" class="form-control" placeholder="Enter Name" required value="<?= $fields->name ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Type Fields</label>
                            <select name="type" id="" class="form-control">
                                <option value="">pilih Type</option>
                                <option value="text" <?= $fields->type == 'text' ? 'selected' : '' ?>>text</option>
                                <option value="date" <?= $fields->type == 'date' ? 'selected' : '' ?>>date</option>
                                <option value="select" <?= $fields->type == 'select' ? 'selected' : '' ?>>select</option>
                                <option value="radio" <?= $fields->type == 'radio' ? 'selected' : '' ?>>radio</option>
                                <option value="textarea" <?= $fields->type == 'textarea' ? 'selected' : '' ?>>textarea</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Options Select/radio</label>
                            <input type="text" id="nameBackdrop" value="<?= $fields->options == false ? 'false' : implode(',', $fields->options) ?>" name="options" class="form-control" placeholder="ex : Laki-laki,Perempuan" <?= $fields->options == false ? 'readonly' : '' ?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Required</label>
                            <br>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" checked name="required" id="inlineRadio1" value="true">
                                <label class="form-check-label" for="inlineRadio1">True</label>
                            </div>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" name="required" id="inlineRadio2" value="false">
                                <label class="form-check-label" for="inlineRadio2">False</label>
                            </div>
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
    <div class="modal fade" id="delete-<?= $index ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <form class="modal-content" method="POST" action="<?= base_url('panel-admin/templatesurat/delete/' . $idmeta) ?>">
                    <input type="hidden" value="<?= $fields->label ?>" name="label">
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
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>

<script>
    $(function() {

        $('[name="type"]').change(function(e) {
            e.preventDefault();
            let val = $(this).val();
            if (val == 'text' || val == 'textarea' || val == 'date') {
                $('[name="options"]').attr('readonly', true).val('false')
            } else {
                $('[name="options"]').attr('readonly', false);
            }
        });

        $('[name="label"').on('keyup', function() {
            // Lakukan sesuatu ketika ada pengetikan di input
            var typedValue = $(this).val();
            var trimmedValue = typedValue.replace(/\s+/g, '');

            $('[name="name"]').val(trimmedValue.toLowerCase());
            // Lakukan tindakan lainnya di sini...
        });
    })
</script>