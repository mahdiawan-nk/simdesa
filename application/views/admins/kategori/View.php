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
            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#backDropModal">Tambah Kategori</button>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table" id="table-data">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Status</th>
                            <th>act</th>
                        </tr>
                    </thead>
                    <tbody class="table-border">
                        <?php foreach ($kategori as $no => $list) : ?>
                            <tr>
                                <td><?= $no + 1 ?></td>
                                <td><?= $list->nama_kategori ?></td>
                                <td><span class="badge badge-<?= $list->status == 'Y' ? 'success' : 'danger' ?>"><?= $list->status == 'Y' ? 'Aktif' : 'Deaktif' ?></span></td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#edit-<?= $list->id_kategori ?>">Ubah</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-<?= $list->id_kategori ?>">Hapus</button>
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
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="POST" action="<?= base_url('panel-admin/berita/savekategori') ?>">
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Nama Kategori</label>
                        <input type="text" id="nameBackdrop" name="nama_kategori" class="form-control" placeholder="Enter Name" required>
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

<?php foreach ($kategori as $no => $list) : ?>
    <div class="modal fade" id="edit-<?= $list->id_kategori ?>" data-bs-backdrop="static" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" method="POST" action="<?= base_url('panel-admin/berita/savekategori/'.$list->id_kategori) ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">Edit Kategori</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Nama Kategori</label>
                            <input type="text" id="nameBackdrop" name="nama_kategori" class="form-control" placeholder="Enter Name" value="<?=$list->nama_kategori?>">
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-12">
                            <label for="">Status</label>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="Y" <?=$list->status == 'Y'? 'checked':''?>>
                                <label class="form-check-label" for="inlineRadio1">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="N" <?=$list->status == 'N'? 'checked':''?>>
                                <label class="form-check-label" for="inlineRadio2">Deaktif</label>
                            </div>
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
    <div class="modal fade" id="delete-<?= $list->id_kategori ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a href="<?= base_url('panel-admin/berita/deletekategori/' . $list->id_kategori) ?>" class="btn btn-primary">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<script>
    $('#table-data').DataTable();
</script>