<div class="container">
    <!-- Section Tittle -->
    <div class="row">
        <?php foreach($profile as $profile) :?>
        <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="single-place mb-30">
                <div class="place-img">
                    <?php $img = $profile->foto != ''? $profile->foto :'kuser.png' ?>
                    <img src="<?= base_url('assets/uploads/perangkatdesa/'.$img) ?>" alt="">
                </div>
                <div class="place-cap">
                    <div class="place-cap-top text-center">
                        <h3><a href="#"><?=$profile->nama_lengkap?></a></h3>
                        <p class="dolor"><?=$profile->jabatan?></span></p>
                    </div>

                </div>
            </div>
        </div>
        <?php endforeach ?>

    </div>
</div>