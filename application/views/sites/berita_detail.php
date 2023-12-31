<main>
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2 class="text-dark"><?= $news->title ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid" src="assets/img/blog/single_blog_1.png" alt="">
                        </div>
                        <div class="blog_details">
                            <h2>
                                <?= $news->title ?>
                            </h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="#"><i class="fa fa-calendar"></i> <?= date('d M Y', strtotime($news->created_at)) ?></a></li>
                                <li><a href="#"><i class="fa fa-user"></i> Admins</a></li>
                            </ul>
                            <?= $news->content ?>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Kategori</h4>
                            <ul class="list cat-list">
                                <?php foreach ($in_kategori as $kategori) : ?>
                                    <li>
                                        <a href="#" class="d-flex">
                                            <p><?= $kategori->nama_kategori ?></p>
                                            <p>(<?= $kategori->jml ?>)</p>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>