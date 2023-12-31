<?php $urlassets = $this->config->item('asset-admin') ?>
<style>
    table>tbody>tr>td {
        font-size: 11px;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">

        <div class="card-header">
            <h5 class="card-title">Data Data Penduduk</h5>
            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#backDropModal">Tambah Penduduk</button>
            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#importexcel">Import Excel</button>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-sm" id="table-data">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>No NIK_KTP</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Bangsa</th>
                            <th>Agama</th>
                            <th>Pekerjaan</th>
                            <th>Alamat</th>
                            <th>act</th>
                        </tr>
                    </thead>
                    <tbody class="table-border">
                        <?php foreach ($data as $no => $list) : ?>
                            <tr>
                                <td><?= $no + 1 ?></td>
                                <td><?= $list->no_ktp_nik ?></td>
                                <td><?= $list->nama ?></td>
                                <td><?= $list->jenis_kelamin ?></td>
                                <td><?= $list->tempat_lahir ?></td>
                                <td><?= $list->tgl_lahir ?></td>
                                <td><?= $list->bangsa ?></td>
                                <td><?= $list->agama ?></td>
                                <td><?= $list->pekerjaan ?></td>
                                <td><?= $list->alamat ?></td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#edit-<?= $list->id_penduduk ?>">Ubah</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-<?= $list->id_penduduk ?>">Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="backDropModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" method="POST" action="<?= base_url('panel-admin/penduduk/save') ?>">
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Tambah Data Penduduk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">No NIK KTP</label>
                        <input type="text" id="nameBackdrop" name="no_ktp_nik" class="form-control" placeholder="No KTP NIK" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Nama Lengkap</label>
                        <input type="text" id="nameBackdrop" name="nama" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label d-block">Jenis Kelamin</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="L">
                            <label class="form-check-label" for="inlineRadio1">Laki - Laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="P">
                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Tempat Lahir</label>
                        <input type="text" id="nameBackdrop" name="tempat_lahir" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Tanggal Lahir</label>
                        <input type="date" id="nameBackdrop" name="tgl_lahir" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Bangsa</label>
                        <input type="text" id="nameBackdrop" name="bangsa" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Agama</label>
                        <select name="agama" id="" class="form-select">
                            <option value="">Pilih Agama</option>
                            <?php
                            $agama = array(
                                "Islam",
                                "Kristen Protestan",
                                "Kristen Katolik",
                                "Hindu",
                                "Buddha",
                                "Konghucu"
                            ); ?>
                            <?php foreach ($agama as $agamas) : ?>
                                <option value="<?= $agamas ?>" ><?= $agamas ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Pekerjaan</label>
                        <input type="text" id="nameBackdrop" name="pekerjaan" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Alamat</label>
                        <textarea name="alamat" id="" cols="30" rows="5" class="form-control"></textarea>
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
<div class="modal fade" id="importexcel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" method="POST" action="<?= base_url('panel-admin/penduduk/importexcel') ?>" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="importexcel">Import Data Penduduk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Upload File</label>
                        <input type="file" id="nameBackdrop" name="file" class="form-control" placeholder="No KTP NIK" required>
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
    <div class="modal fade" id="edit-<?= $list->id_penduduk ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <form class="modal-content" method="POST" action="<?= base_url('panel-admin/penduduk/update/' . $list->id_penduduk) ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-<?= $list->id_penduduk ?>">Tambah Data Penduduk</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">No NIK KTP</label>
                            <input type="text" id="nameBackdrop" name="no_ktp_nik" class="form-control" placeholder="No KTP NIK" value="<?= $list->no_ktp_nik ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Nama Lengkap</label>
                            <input type="text" id="nameBackdrop" name="nama" class="form-control" required value="<?= $list->nama ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label d-block">Jenis Kelamin</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="L" <?= $list->jenis_kelamin == 'L' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="inlineRadio1">Laki - Laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="P" <?= $list->jenis_kelamin == 'P' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Tempat Lahir</label>
                            <input type="text" id="nameBackdrop" name="tempat_lahir" class="form-control" required value="<?= $list->tempat_lahir ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Tanggal Lahir</label>
                            <input type="date" id="nameBackdrop" name="tgl_lahir" class="form-control" required value="<?= $list->tgl_lahir ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Bangsa</label>
                            <input type="text" id="nameBackdrop" name="bangsa" class="form-control" required value="<?= $list->bangsa ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Agama</label>
                            <select name="agama" id="" class="form-select">
                                <option value="">Pilih Agama</option>
                                <?php
                                $agama = array(
                                    "Islam",
                                    "Kristen Protestan",
                                    "Kristen Katolik",
                                    "Hindu",
                                    "Buddha",
                                    "Konghucu"
                                ); ?>
                                <?php foreach ($agama as $agamas) : ?>
                                    <option value="<?= $agamas ?>" <?= $agamas == $list->agama ? 'selected' : '' ?>><?= $agamas ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Pekerjaan</label>
                            <input type="text" id="nameBackdrop" name="pekerjaan" class="form-control" required value="<?= $list->pekerjaan ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Alamat</label>
                            <textarea name="alamat" id="" cols="30" rows="5" class="form-control"><?= $list->alamat ?></textarea>
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
    <div class="modal fade" id="delete-<?= $list->id_penduduk ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a href="<?= base_url('panel-admin/penduduk/delete/' . $list->id_penduduk) ?>" class="btn btn-primary">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<script>
    $('#table-data').DataTable();
</script>