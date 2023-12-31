<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">

        <div class="card-header">
            <h5 class="card-title">Data Pengajuan Surat</h5>
            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalCenter">Ajukan Surat Baru</button>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table nowrap" id="table-data">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Surat</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>act</th>
                        </tr>
                    </thead>
                    <tbody class="table-border">
                        <?php $disabled = ['Prosess', 'Tolak'] ?>
                        <?php foreach ($data as $key => $item) : ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $item->nama_surat ?></td>
                                <td><?= $item->tanggal_pengajuan ?></td>
                                <td>
                                    <span class="badge bg-label-info" <?= $item->status == 'Prosess' ? '' : 'hidden' ?>>Prosess</span>
                                    <span class="badge bg-label-info" <?= $item->status == 'Pending' ? '' : 'hidden' ?>>Pending</span>
                                    <span class="badge bg-label-danger" <?= $item->status == 'Tolak' ? '' : 'hidden' ?>>Tolak</span>
                                    <span class="badge bg-label-success" <?= $item->status == 'Selesai' ? '' : 'hidden' ?>>Selesai</span>
                                </td>
                                <td><?= $item->keterangan ?></td>
                                <td>
                                    <a href="<?=base_url('lihat/surat/'.$item->id_pengajuan)?>" target="_blank" class="btn btn-info btn-sm" <?= array_intersect([$item->status], $disabled) ? 'disabled' : '' ?>>Cetak surat</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="modalCenter" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Jenis Surat</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($surat as $key => $item) : ?>
                                    <tr>
                                        <th scope="row"><?= $key + 1 ?></th>
                                        <td><?= $item->nama_surat ?></td>
                                        <td>
                                            <a href="<?= base_url('panel-user/surat/pengajuan/' . $item->slug) ?>" class="btn btn-sm btn-info">Ajukan</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#table-data').DataTable({
        responsive: true
    });
</script>