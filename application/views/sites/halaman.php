<main>
    <div class="favourite-place place-padding pt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <h2><?= $detail->title_halaman ?></h2>
                </div>
            </div>
        </div>
        <?php $this->load->view($halaman, $detail); ?>
    </div>
    <?php $this->load->view('sites/maps'); ?>
</main>