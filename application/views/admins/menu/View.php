<?php $urlassets = $this->config->item('asset-admin') ?>
<style>
    table>tbody>tr>td {
        font-size: 11px;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">

        <div class="card-header">
            <h5 class="card-title">Data Menu Site</h5>
            <a href="<?= base_url('panel-admin/menu/create') ?>" class="btn btn-info btn-sm">Tambah Menu</a>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table" id="table-data">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Is Dinamic</th>
                            <th>Link</th>
                            <th>urutan</th>
                            <th>act</th>
                        </tr>
                    </thead>
                    <tbody class="table-border">
                        <?php foreach ($news as $no => $list) : ?>
                            <tr>
                                <td><?= $no + 1 ?></td>
                                <td><?= $list->nama_menu ?></td>
                                <td><?= $list->dinamic_pages ?></td>
                                <td><?= $list->link_menu ?></td>
                                <td><?= $list->urut ?></td>
                                <td>
                                    <a href="<?= base_url('panel-admin/menu/edit/' . $list->id_menu) ?>" type="button" class="btn btn-secondary btn-sm">Ubah</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-<?= $list->id_menu ?>">Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php foreach ($news as $no => $list) : ?>
    <div class="modal fade" id="delete-<?= $list->id_menu ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a href="<?=base_url('panel-admin/menu/delete/'.$list->id_menu)?>" class="btn btn-primary">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<script>
    $('#table-data').DataTable();
</script>