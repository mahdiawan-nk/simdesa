<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?= base_url() ?>" class="app-brand-link">
            <!-- <span class="app-brand-logo demo">
                
            </span> -->
            <span class="app-brand-text demo menu-text fw-bolder" style="text-transform: none;">Panel Admin</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <?php
    $userLevel = $this->session->userdata('level') ?? [];
    $allowedLevels = [1, 2, 3];
    ?>
    <?php if (array_intersect($userLevel, $allowedLevels)) : ?>
        <ul class="menu-inner py-1">
            <li class="menu-item ">
                <a href="<?= base_url('panel-admin/dashboard') ?>" class="menu-link ">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>
            <?php if (!array_intersect($userLevel, [3])) : ?>
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Manajemen Desa</span>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Account Settings">Data Master</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="<?= base_url('panel-admin/penduduk') ?>" class="menu-link">
                            <div data-i18n="Account">Data Penduduk</div>

                        </a>
                    </li>
                    <li class="menu-item acitve">
                        <a href="<?= base_url('panel-admin/jenissurat') ?>" class="menu-link">
                            <div data-i18n="Account">Data jenis Surat</div>

                        </a>
                    </li>

                </ul>
            </li>
            <li class="menu-item ">
                <a href="<?= base_url('panel-admin/perangkatdesa') ?>" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-user-rectangle"></i>
                    <div data-i18n="Analytics">Perangkat Desa</div>
                </a>
            </li>
            <?php endif ?>
            <?php if (array_intersect($userLevel, [1,2,3])) : ?>
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Manajemen Surat</span></li>
            <li class="menu-item ">
                <a href="<?= base_url('panel-admin/suratpermohonan') ?>" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-file"></i>
                    <div data-i18n="Analytics">Permohonan Surat</div>
                </a>
            </li>
            <?php endif ?>
            <?php if (array_intersect($userLevel, [1])) : ?>
                <li class="menu-header small text-uppercase"><span class="menu-header-text">Manajemen Situs</span></li>
                <li class="menu-item">
                    <a href="<?= base_url('panel-admin/berita') ?>" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-collection"></i>
                        <div data-i18n="Basic">Berita</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('panel-admin/berita/kategori') ?>" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-collection"></i>
                        <div data-i18n="Basic">Kategori Berita</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-box"></i>
                        <div data-i18n="User interface">Menu Pages</div>
                    </a>
                    <ul class="menu-sub">
                        <!-- <li class="menu-item">
                            <a href="<?= base_url('panel-admin/menu') ?>" class="menu-link">
                                <div data-i18n="Accordion">Menu Site</div>
                            </a>
                        </li> -->
                        <li class="menu-item">
                            <a href="<?= base_url('panel-admin/halaman') ?>" class="menu-link">
                                <div data-i18n="Alerts">Halaman</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-header small text-uppercase"><span class="menu-header-text">Manajemen User</span></li>
                <li class="menu-item ">
                    <a href="<?= base_url('panel-admin/pengguna') ?>" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-user-rectangle"></i>
                        <div data-i18n="Analytics">Data Pengguna</div>
                    </a>
                </li>
            <?php endif ?>


        </ul>
    <?php elseif (array_intersect($userLevel, ['warga'])) : ?>
        <ul class="menu-inner py-1">
            <li class="menu-item ">
                <a href="<?= base_url('panel-user/dashboard') ?>" class="menu-link ">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Pengajuan Surat</span>
            </li>
            <li class="menu-item ">
                <a href="<?= base_url('panel-user/surat') ?>" class="menu-link ">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n="Analytics">Surat Saya</div>
                </a>
            </li>
        </ul>
    <?php endif ?>

</aside>