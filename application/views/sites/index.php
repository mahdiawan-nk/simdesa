<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Travel HTML-5 Template </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

		<!-- CSS here -->
        <?php require_once(APPPATH.'views/_partials/sites/styles.php') ?>
        <!-- end CSS -->
   </head>

   <body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="<?=base_url()?>assets/sites/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <?php include_once(APPPATH.'views/_partials/sites/header.php') ?>

    <?php 
    $this->load->view($pages);
     ?>
    
    <?php include_once APPPATH.'views/_partials/sites/footer.php' ?>
	<!-- JS here -->
	
    <?php include_once APPPATH.'views/_partials/sites/javascript.php' ?>
    </body>
</html>