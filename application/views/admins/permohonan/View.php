<?php $urlassets = $this->config->item('asset-admin') ?>
<style>
    table>tbody>tr>td {
        font-size: 11px;
    }

    .cursor-pointer:hover {
        color: blue !important;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">

        <div class="card-header">
            <h5 class="card-title">Data Permohonan Surat</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table nowrap" id="table-data">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>NIK Nama Pemohon</th>
                            <th>Jenis Surat</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Keterangan</th>
                            <th hidden>Status Permohonan</th>
                            <th hidden>Status Validasi Kades</th>
                            <th>act</th>
                        </tr>
                    </thead>
                    <tbody class="table-border">
                        <?php foreach ($data as $key => $list) : ?>
                            <?php $list = (object)$list ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td>
                                    <span class="d-block"><?= $list->no_ktp_nik ?></span>
                                    <span><?= $list->nama ?></span>
                                </td>
                                <td>
                                    <?= $list->nama_surat ?>
                                </td>
                                <td>
                                    <?= $list->tanggal_pengajuan ?>
                                </td>

                                <td>
                                    <ul class="list-unstyled">

                                        <li>
                                            Status Permohonan :
                                            <span class="badge bg-info" <?= $list->status == 'Prosess' ? '' : 'hidden' ?>>Prosess</span>
                                            <span class="badge bg-warning" <?= $list->status == 'Pending' ? '' : 'hidden' ?>>Pending</span>
                                            <span class="badge bg-danger" <?= $list->status == 'Tolak' ? '' : 'hidden' ?>>Tolak</span>
                                            <span class="badge bg-success" <?= $list->status == 'Selesai' ? '' : 'hidden' ?>>Selesai</span>
                                        </li>

                                        <li>Status Validasi Kades:
                                            <span class="badge bg-info" <?= $list->vkades == 'Prosess' ? '' : 'hidden' ?>>Prosess</span>
                                            <span class="badge bg-warning" <?= $list->vkades == 'Pending' ? '' : 'hidden' ?>>Pending</span>
                                            <span class="badge bg-danger" <?= $list->vkades == 'Tolak' ? '' : 'hidden' ?>>Tolak</span>
                                            <span class="badge bg-success" <?= $list->vkades == 'Terima' ? '' : 'hidden' ?>>Setujui</span>
                                        </li>
                                        <li>Catatan :<br>
                                            <?= $list->keterangan ?>
                                        </li>
                                    </ul>

                                </td>
                                <td hidden>
                                    <?= $list->status ?>

                                </td>
                                <td hidden>
                                    <?= $list->vkades ?>

                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-xs" data-bs-toggle="modal" data-bs-target="#lihatsyarat-<?= $list->id_pengajuan ?>">lihat Persyaratan</button>
                                    <button type="button" class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#viewpermohonan-<?= $list->id_pengajuan ?>">Lihat Permohonan</button>
                                    <?php $userLevel = $this->session->userdata('level') ?? []; ?>
                                    <?php if (array_intersect($userLevel, [1, 2])) : ?>
                                        <button type="button" class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#validasi-tolak-<?= $list->id_pengajuan ?>" <?= array_intersect([$list->status, $list->vkades], ['Prosess', 'Tolak']) && !in_array($list->status, ['Tolak']) ? '' : 'hidden' ?>>Tolak Pengajuan</button>
                                        <button type="button" class="btn btn-success btn-xs" data-bs-toggle="modal" data-bs-target="#validasi-selesai-<?= $list->id_pengajuan ?>" <?= in_array($list->vkades, ['Terima']) ? (in_array($list->status, ['Selesai']) ? 'hidden' : '') : 'hidden' ?>>Validasi Seleai</button>
                                        <button type="button" class="btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target="#sendkades-<?= $list->id_pengajuan ?>" <?= in_array($list->vkades, ['Prosess']) ? '' : 'hidden' ?>>Kirim Ke Kades</button>
                                    <?php else : ?>
                                        <button type="button" class="btn btn-success btn-xs" data-bs-toggle="modal" data-bs-target="#validasi-kades-<?= $list->id_pengajuan ?>" <?= in_array($list->status, ['Pending']) ? '' : 'hidden' ?>>Validasi Seleai Dan Digital Sign</button>
                                    <?php endif ?>


                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php foreach ($data as $key => $list) : ?>
    <?php $list = (object)$list ?>
    <!-- Modal Lihat Persyaratan Pemohon -->
    <div class="modal fade" id="lihatsyarat-<?= $list->id_pengajuan ?>" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">List Persyarat Permohonan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row ">
                                <div class="col-sm-4">NIK Pemohon</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->no_ktp_nik ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Nama Pemohon</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->nama ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Jenis Surat</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->nama_surat ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Tangal Pengajuan</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->tanggal_pengajuan ?></div>
                            </div>
                        </li>
                    </ul>
                    <div class="divider">
                        <div class="divider-text">Text</div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($list->persyaratan as $items) : ?>
                            <li class="list-group-item">
                                <div class="row ">
                                    <div class="col-sm-12"><?= $items->nama_syarat ?> :</div>
                                    <div class="col-sm-12">
                                        <small class="text-muted cursor-pointer" <?= $items->file != '' ? '' : 'hidden' ?> onclick="return window.open('files/view/<?= $items->file ?>','_blank')"><?= $items->file ?></small>
                                        <small class="text-muted" <?= $items->file == '' ? '' : 'hidden' ?>>No Upload File</small>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Kirim Ke kades -->
    <div class="modal fade" id="sendkades-<?= $list->id_pengajuan ?>" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" action="<?= base_url('panel-admin/suratpermohonan/update/' . $list->id_pengajuan) ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Kirim Ke Kades</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-info" role="alert">
                                <strong class="d-block">Informasi :</strong>
                                <small class="text-justify">Dengan Mengklik Kirim Ke Kades akan mengubah status permohonan menjadi Pending dan status validasi kades jadi pending, serta tombol validasi pengajuan di tutup dan dibuka sampai dengan status validasi kades berubah menjadi tolak atau terima</small>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row ">
                                <div class="col-sm-4">NIK Pemohon</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->no_ktp_nik ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Nama Pemohon</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->nama ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Jenis Surat</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->nama_surat ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Tangal Pengajuan</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->tanggal_pengajuan ?></div>
                            </div>
                        </li>
                    </ul>
                    <div class="divider">
                        <div class="divider-text">Detail Validasi</div>
                    </div>
                    <div class="row d-flex justify-content-between">
                        <div class="col text-center">
                            <label for="">Status Permohonan</label>
                            <div class="text-center">
                                <span class="badge bg-warning">Di Pending</span>
                            </div>
                        </div>
                        <div class="col text-center">
                            <label for="">Status Valiasi Kades</label>
                            <div class="text-center">
                                <span class="badge bg-warning">Di Pending</span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="status" value="Pending">
                    <input type="hidden" name="validasi_kades" value="Pending">
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary">Kirim Permohonan</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Validasi Permohan -->
    <div class="modal fade" id="validasi-tolak-<?= $list->id_pengajuan ?>" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" action="<?= base_url('panel-admin/suratpermohonan/update/' . $list->id_pengajuan) ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Validasi Permohonan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-info" role="alert">
                                <strong class="d-block">Informasi :</strong>
                                <small class="text-justify">
                                    Validasi Hanya berlaku untuk status Tolak
                                </small>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row ">
                                <div class="col-sm-4">NIK Pemohon</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->no_ktp_nik ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Nama Pemohon</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->nama ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Jenis Surat</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->nama_surat ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Tangal Pengajuan</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->tanggal_pengajuan ?></div>
                            </div>
                        </li>
                    </ul>
                    <div class="divider">
                        <div class="divider-text">Detail Validasi</div>
                    </div>
                    <div class="row d-flex justify-content-between">
                        <div class="col text-center">
                            <label for="">Status Permohonan</label>
                            <div class="text-center">
                                <span class="badge bg-danger">Di Tolak</span>
                                <input type="hidden" name="status" value="Tolak">
                                <input type="hidden" name="validasi_kades" value="Tolak">
                            </div>
                        </div>
                        <div class="col text-center">
                            <label for="">Status Validasi Kades</label>
                            <div class="text-center">
                                <span class="badge bg-danger">Di Tolak</span>
                                <input type="hidden" name="status" value="Tolak">
                                <input type="hidden" name="validasi_kades" value="Tolak">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col text-center">
                            <label for="" class="">Catatan</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan" required>Permohonan Anda Di tolak Dikaranekan Persyartan Tidak sesuai atau tidak lengkap Mohon Untuk Mengajukan Ulang Kembali
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary">Validasi</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="validasi-selesai-<?= $list->id_pengajuan ?>" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" action="<?= base_url('panel-admin/suratpermohonan/update/' . $list->id_pengajuan) ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Validasi Permohonan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-info" role="alert">
                                <strong class="d-block">Informasi :</strong>
                                <small class="text-justify">
                                    Validasi Hanya berlaku untuk status Tolak
                                </small>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row ">
                                <div class="col-sm-4">NIK Pemohon</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->no_ktp_nik ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Nama Pemohon</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->nama ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Jenis Surat</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->nama_surat ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Tangal Pengajuan</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->tanggal_pengajuan ?></div>
                            </div>
                        </li>
                    </ul>
                    <div class="divider">
                        <div class="divider-text">Detail Validasi</div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <label for="">Status Permohonan</label>
                            <div class="text-center">
                                <span class="badge bg-success">Di Setujui Dan Selesai</span>
                                <input type="hidden" name="status" value="Selesai">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <label for="">Catatan</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan">
                                Permohonan Anda Sudah Di Setujui dan selesai, Silahkan Download File untuk dipergunakan
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary">Validasi</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="validasi-kades-<?= $list->id_pengajuan ?>" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST" action="<?= base_url('panel-admin/suratpermohonan/update/' . $list->id_pengajuan) ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Validasi Permohonan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-info" role="alert">
                                <strong class="d-block">Informasi :</strong>
                                <small class="text-justify">

                                </small>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row ">
                                <div class="col-sm-4">NIK Pemohon</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->no_ktp_nik ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Nama Pemohon</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->nama ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Jenis Surat</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->nama_surat ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Tangal Pengajuan</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->tanggal_pengajuan ?></div>
                            </div>
                        </li>
                    </ul>
                    <div class="divider">
                        <div class="divider-text">Detail Validasi</div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <label for="">Status Validasi Kades</label>
                            <div class="text-center">
                                <span class="badge bg-success">Di Setujui</span>
                                <input type="hidden" name="validasi_kades" value="Terima">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <label for="">Catatan</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan">
                                Permohonan Anda Sudah Di Setujui dan selesai, Silahkan Download File untuk dipergunakan
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary">Validasi</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Lihat Permohonan -->
    <div class="modal fade" id="viewpermohonan-<?= $list->id_pengajuan ?>" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Preview Permohonan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row ">
                                <div class="col-sm-4">NIK Pemohon</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->no_ktp_nik ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Nama Pemohon</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->nama ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Jenis Surat</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->nama_surat ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-4">Tangal Pengajuan</div>
                                <div class="col-sm-1">:</div>
                                <div class="col-sm-7"><?= $list->tanggal_pengajuan ?></div>
                            </div>
                        </li>
                    </ul>
                    <div class="divider">
                        <div class="divider-text">Detail Permohonan</div>
                    </div>
                    <div class="row">
                        <?php $dataSurat = (array)$list->data_surat ?>
                        <?php foreach ($list->fields as $field) : ?>
                            <div class="col-sm-12">
                                <label for="" class="d-block"><?= $field->label ?></label>
                                <label for="" class="text-muted"><?= $dataSurat[$field->name] ?></label>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal view file -->

<?php endforeach ?>

<script>
    var dt = $('#table-data').DataTable({
        responsive: true,
        searchPanes: {
            layout: 'columns-4'
        },
        dom: 'Plfrtip',
        columnDefs: [{
            searchPanes: {
                show: true
            },
            targets: [2, 3, 5, 6]
        }]
    });

    dt.on('select.dt', () => {
        dt.searchPanes.rebuildPane(0, true);
    });

    dt.on('deselect.dt', () => {
        dt.searchPanes.rebuildPane(0, true);
    });



    // Fungsi untuk menyesuaikan tinggi iframe dengan tinggi modal
    function adjustIframeHeight() {
        var modalBody = $('.modal-fullscreen .modal-body');
        var iframe = $('.fileFrame');

        iframe.height(modalBody.height());
    }

    // Panggil fungsi untuk menyesuaikan tinggi iframe ketika modal ditampilkan
    $('.view-files').on('shown.bs.modal', function() {
        adjustIframeHeight();
    });

    // Panggil fungsi untuk menyesuaikan tinggi iframe saat window diubah ukurannya
    $(window).resize(function() {
        adjustIframeHeight();
    });
</script>