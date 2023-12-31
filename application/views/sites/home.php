<main>

    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="slider-active">
            <div class="single-slider hero-overly  slider-height d-flex align-items-center" data-background="<?= base_url() ?>assets/sites/img/hero/h1_hero.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="hero__caption">
                                <h1 style="font-size:5rem">Selamat Datang Di <span>Desa Kumantan</span> </h style="font-size:18px">
                                    <p>Ada Apa Di Desa Kumantan?</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <div class="home-blog-area section-padding2">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center">
                        <h2>Our Recent news</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($news as $berita) : ?>
                    <div class="col-xl-6 col-lg-6 col-md-6 mb-4">
                        <div class="home-blog-single mb-30 shadow">
                            <div class="blog-img-cap">
                                <div class="blog-img">
                                    <?php if (empty($berita->thumbnail)) : ?>
                                        <img class="card-img rounded-0" src="https://static.everypixel.com/ep-pixabay/0741/1093/6899/08857/7411093689908857422-news.jpg" alt="">
                                    <?php else : ?>
                                        <img class="card-img rounded-0 w-100" src="<?= base_url('assets/uploads/berita/' . $berita->thumbnail) ?>" alt="" style="max-height: 20em !important;min-height: 20em !important;">
                                    <?php endif ?>
                                </div>
                                <div class="blog-cap ">
                                    <p> | <?= $berita->nama_kategori ?></p>
                                    <h3><a href="<?= base_url('berita/read/' . strtolower($berita->slug)) ?>"><?= $berita->title ?></a></h3>
                                    <a href="<?= base_url('berita/read/' . strtolower($berita->slug)) ?>" class="more-btn">Read more »</a>
                                </div>
                            </div>
                            <div class="blog-date text-center">
                                <span><?= date('d', strtotime($berita->created_at)) ?></span>
                                <p><?= date('M', strtotime($berita->created_at)) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <?php $this->load->view('sites/maps'); ?>
</main>