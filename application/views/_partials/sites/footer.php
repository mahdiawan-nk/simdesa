<footer>
    <?php $settingSite = $this->db->get('setting_sites')->row(); ?>
    <?php $kontak = $this->db->get('kontak_sites')->result(); ?>
    <!-- Footer Start-->
    <div class="footer-area footer-padding footer-bg pt-2 pb-2" data-background="<?= base_url() ?>assets/sites/img/service/footer_bg.jpg">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                    <div class="single-footer-caption mb-50">
                        <div class="single-footer-caption mb-30">
                            <!-- logo -->
                            <div class="footer-tittle">
                                <h4>Profile</h4>
                            </div>
                            <div class="footer-tittle">
                                <div class="footer-pera">
                                    <p><?= $settingSite->deskripsi ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Kontak Kami</h4>
                            <ul>
                                <?php foreach ($kontak as $knt) : ?>
                                    <?php switch ($knt->jenis_media) {
                                        case 'alamat':
                                            echo '<li><i class="fa-solid fa-map-location-dot"></i> ' . $knt->keterangan . ' </li>';
                                            break;
                                        case 'telepon':
                                            echo '<li><i class="fas fa-phone-alt"></i> ' . $knt->keterangan . ' </li>';
                                            break;
                                        case 'instagram':
                                            echo '<li><a href="' . $knt->link . '"><i class="fab fa-instagram"></i> ' . $knt->nama_kontak . '</a></li>';
                                            break;
                                        case 'facebook':
                                            echo '<li><a href="' . $knt->link . '"><i class="fab fa-facebook-square"></i>' . $knt->nama_kontak . '</a></li>';
                                            break;
                                        case 'youtube':
                                            echo '<li><a href="' . $knt->link . '"><i class="fab fa-youtube"></i>' . $knt->nama_kontak . '</a></li>';
                                            break;
                                        default:

                                            break;
                                    } ?>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer bottom -->
            <div class="row pt-padding">
                <div class="col-xl-7 col-lg-7 col-md-7">
                    <div class="footer-copy-right">
                        <p>Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with Testing <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End-->
</footer>