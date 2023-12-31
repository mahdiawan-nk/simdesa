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
            <a href="<?= base_url('panel-admin/perangkatdesa/create') ?>" class="btn btn-info btn-sm">Tambah Menu</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table-data">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>NIPD</th>
                            <th>Nama Pejabat</th>
                            <th>Jabatan</th>
                            <th>act</th>
                        </tr>
                    </thead>
                    <tbody class="table-border">
                        <?php foreach ($news as $no => $list) : ?>
                            <tr>
                                <td><?= $no + 1 ?></td>
                                <td>
                                    <?php if ($list->foto != null || $list->foto != '') : ?>
                                        <img src="<?= base_url('assets/uploads/perangkatdesa/' . $list->foto) ?>" alt="" class="img-thumbnail" style="width: 15% !important;">
                                    <?php else : ?>
                                        <img src="https://barurejo.desa.id/assets/images/pengguna/kuser.png" alt="" class="img-thumbnail" style="width: 15% !important;">
                                    <?php endif ?>
                                </td>
                                <td><?= $list->nipd ?></td>
                                <td><?= $list->nama_lengkap ?></td>
                                <td><?= $list->jabatan ?></td>
                                <td>
                                    <a href="<?= base_url('panel-admin/perangkatdesa/edit/' . $list->id_perangkat) ?>" type="button" class="btn btn-secondary btn-sm">Ubah</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-<?= $list->id_perangkat ?>">Hapus</button>
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
    <div class="modal fade" id="delete-<?= $list->id_perangkat ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a href="<?= base_url('panel-admin/perangkatdesa/delete/' . $list->id_perangkat) ?>" class="btn btn-primary">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
<script>
    $('#table-data').DataTable();
</script>