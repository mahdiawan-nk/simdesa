<?php $urlassets = $this->config->item('asset-admin') ?>
<?php
$userLevel = $this->session->userdata('level') ?? [];
$allowedLevels = [1, 2, 3];
?>
<?php if (array_intersect($userLevel, $allowedLevels)) : ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h3 class="card-title text-primary">Selamat Datang <?= $this->session->userdata('username') ?> Disistem Desa Kumantan</h3>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="<?= $urlassets ?>img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between mb-0">
                                    <div class="avatar flex-shrink-0">
                                        <i class="fa-solid fa-users fa-beat fa-2xl"></i>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Penduduk</span>
                                <h3 class="card-title mb-2"><?=$data->penduduk?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between mb-0">
                                    <div class="avatar flex-shrink-0">
                                        <i class="fa-solid fa-user-nurse fa-beat fa-2xl"></i>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Perangkat Desa</span>
                                <h3 class="card-title mb-2"><?=$data->perangkat_desa?></h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between mb-0">
                                    <div class="avatar flex-shrink-0">
                                        <i class="fa-solid fa-rectangle-list fa-beat fa-2xl"></i>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Jenis Surat</span>
                                <h3 class="card-title mb-2"><?=$data->jenis_surat?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between mb-0">
                                    <div class="avatar flex-shrink-0">
                                        <i class="fa-solid fa-file-lines fa-beat fa-2xl text-info"></i>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Permohonan Surat</span>
                                <h3 class="card-title mb-2"><?=$data->permohonan_surat?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between mb-0">
                                    <div class="avatar flex-shrink-0">
                                        <i class="fa-solid fa-file-circle-check fa-beat fa-2xl text-success"></i>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Permohonan Selesai</span>
                                <h3 class="card-title mb-2"><?=$data->permohonan_selesai?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between mb-0">
                                    <div class="avatar flex-shrink-0">
                                        <i class="fa-solid fa-file-circle-xmark fa-beat fa-2xl text-danger"></i>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Permohonan Gagal</span>
                                <h3 class="card-title mb-2"><?=$data->permohonan_gagal?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between mb-0">
                                    <div class="avatar flex-shrink-0">
                                        <i class="fa-solid fa-newspaper fa-beat fa-2xl text-primary"></i>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Postingan Berita</span>
                                <h3 class="card-title mb-2"><?=$data->postingan_berita?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between mb-0">
                                    <div class="avatar flex-shrink-0">
                                        <i class="fa-solid fa-file-circle-xmark fa-beat fa-2xl text-info"></i>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Kategori Berita</span>
                                <h3 class="card-title mb-2"><?=$data->kategori_berita?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
<?php if (array_intersect($userLevel, ['warga'])) : ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h3 class="card-title text-primary">Selamat Datang <?= $this->session->userdata('username') ?> Disistem Desa Kumantan</h3>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="<?= $urlassets ?>img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 mb-4">
                        <div class="card">
                            <div class="card-body pb-0">
                                <span class="fw-semibold d-block mb-1">Surat Yang Di Ajukan</span>
                                <h3 class="card-title"><?=$data->pengajuan_saya?></h3>
                            </div>
                            <div class="card-body pt-0 pb-0">
                                <span class="fw-semibold d-block mb-1">Surat Yang Di Setujui</span>
                                <h3 class="card-title"><?=$data->pengajuan_selesai?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>