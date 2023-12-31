<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">

        <div class="card-header">
            <h5 class="card-title">Data Syarat <?=$surat->nama_surat?></h5>
            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#add">Tambah syarat</button>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table" id="table-data">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Syarat</th>
                            <th>act</th>
                        </tr>
                    </thead>
                    <tbody class="table-border">
                        <?php foreach ($data as $key => $item) : ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $item->nama_syarat ?></td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#edit-<?= $item->id_syarat_surat ?>">Ubah</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-<?= $item->id_syarat_surat ?>">Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="add" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" action="<?= base_url('panel-admin/syaratsurat/save') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTitle">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Nama Syarat</label>
                            <input type="text" id="nameWithTitle" class="form-control" placeholder="Enter Nama Syarat" name="nama_syarat" />
                            <input type="hidden" name="id_surat" value="<?= $surat->id_surat_jenis ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php foreach ($data as $key => $item) : ?>
    <div class="modal fade" id="edit-<?=$item->id_syarat_surat?>" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" action="<?= base_url('panel-admin/syaratsurat/update/'.$item->id_syarat_surat) ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTitle">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Nama Syarat</label>
                                <input type="text" id="nameWithTitle" class="form-control" placeholder="Enter Nama Syarat" name="nama_syarat" value="<?=$item->nama_syarat?>"/>
                                <input type="hidden" name="id_surat" value="<?= $surat->id_surat_jenis ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="delete-<?= $item->id_syarat_surat ?>" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a href="<?= base_url('panel-admin/syaratsurat/delete/' . $item->id_syarat_surat) ?>" class="btn btn-primary">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>