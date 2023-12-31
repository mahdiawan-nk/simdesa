<header>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header ">
            <div class="header-bottom  header-sticky">
                <div class="container-fluid pl-5 pr-5">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-3 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="<?= base_url() ?>">
                                    <?php $settingSite = $this->db->get('setting_sites')->row(); ?>
                                    <?php if ($settingSite->is_logo == 'yes') : ?>
                                        <img src="<?= base_url() ?>assets/sites/img/logo/logo.png" alt="">
                                    <?php endif ?>
                                    <?php if ($settingSite->is_text_logo == 'yes') : ?>
                                        <label for="" class="text-dark font-weight-bold text-uppercase" style="font-size: 1.5rem;"><?= $settingSite->nama_situs ?></label>
                                    <?php endif ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-10 col-md-10">
                            <!-- Main-menu -->
                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <?php
                                        $this->db->order_by('urut', 'asc');

                                        $menuSite = $this->db->get('menu_sites')->result(); ?>
                                        <?php foreach ($menuSite as $menu) : ?>
                                            <?php if ($menu->dinamic_pages == 'N') : ?>
                                                <li><a href="<?= base_url($menu->link_menu) ?>"><?= $menu->nama_menu ?></a></li>
                                            <?php else : ?>
                                                <li><a href="#"><?= $menu->nama_menu ?></a>
                                                    <ul class="submenu">
                                                        <?php
                                                        $this->db->where('id_menu', $menu->id_menu);
                                                        $dinamicPages = $this->db->get('halaman')->result();
                                                        ?>
                                                        <?php foreach ($dinamicPages as $key => $value) { ?>
                                                            <?php if ($value->is_statics == 'Y') : ?>
                                                                <?php if ($value->slug_name == "" || $value->slug_name == "-") : ?>
                                                                    <li><a href="<?= base_url($value->slug_name) ?>"><?= $value->title_halaman ?></a></li>
                                                                <?php else : ?>
                                                                    <li><a href="<?= base_url($value->slug_name) ?>"><?= $value->title_halaman ?></a></li>

                                                                <?php endif ?>
                                                            <?php else : ?>
                                                                <li><a href="<?= base_url($value->slug_name) ?>"><?= $value->title_halaman ?></a></li>
                                                            <?php endif ?>
                                                        <?php } ?>
                                                    </ul>
                                                </li>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                        <li><a href="#">Pengajuan Surat</a>
                                            <ul class="submenu">
                                                <?php $suratList=$this->db->get_where('surat_jenis',['status'=>'Y'])->result();?>
                                                <?php foreach($suratList as $itemlist): ?>
                                                <li><a href="<?= base_url('surat/'.$itemlist->slug) ?>"><?=$itemlist->nama_surat?></a></li>
                                                <?php endforeach?>
                                            </ul>
                                        </li>
                                        <!-- <li><a href="#">Pemerintahan</a>
                                            <ul class="submenu">
                                                <li><a href="<?= base_url('halaman') ?>">Perangkat Desa</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="blog.html">layanan Publik</a>
                                            <ul class="submenu">
                                                <li><a href="<?= base_url('berita') ?>">Berita Desa</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="blog.html">Pengajuan Surat</a>
                                            <ul class="submenu">
                                                <li><a href="<?= base_url('halaman') ?>">Berita Desa</a></li>
                                            </ul>
                                        </li> -->

                                        <a href="<?= base_url('login') ?>" class="genric-btn primary">Login</a>
                                    </ul>

                                </nav>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>