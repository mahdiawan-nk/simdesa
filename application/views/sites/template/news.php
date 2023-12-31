<style>
    .card-img {
        width: 100%;
        height: 25rem;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-8 mb-5 mb-lg-0">
            <div class="blog_left_sidebar">
                <?php foreach ($news as $berita) : ?>
                    <article class="blog_item">
                        <div class="blog_item_img">
                            <?php if (empty($berita->thumbnail)) : ?>
                                <img class="card-img rounded-0" src="https://static.everypixel.com/ep-pixabay/0741/1093/6899/08857/7411093689908857422-news.jpg" alt="">
                            <?php else : ?>
                                <img class="card-img rounded-0" src="<?= base_url('assets/uploads/berita/' . $berita->thumbnail) ?>" alt="">
                            <?php endif ?>
                            <a href="#" class="blog_item_date">
                                <h3><?= date('d', strtotime($berita->created_at)) ?></h3>
                                <p><?= date('M', strtotime($berita->created_at)) ?></p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="<?= base_url('berita/read/' . strtolower($berita->slug)) ?>">
                                <h2><?= $berita->title ?></h2>
                            </a>
                            <p>
                                <?php
                                $text = strip_tags($berita->content);
                                $word_limit = 50;
                                $word_array = str_word_count($text, 1);
                                if (count($word_array) > $word_limit) {
                                    $text = implode(' ', array_slice($word_array, 0, $word_limit)) . '...';
                                }
                                echo $text
                                ?>
                            </p>
                            <ul class="blog-info-link">
                                <li><a href="#"><i class="fa fa-user"></i> Travel, Lifestyle</a></li>
                                <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                            </ul>
                        </div>
                    </article>
                <?php endforeach ?>
                <?= $links ?>
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