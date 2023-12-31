<?php $baseurl = base_url('assets/admins'); ?>
<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login User</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= $baseurl ?>/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= $baseurl ?>/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= $baseurl ?>/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= $baseurl ?>/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= $baseurl ?>/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= $baseurl ?>/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?= $baseurl ?>/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="<?= $baseurl ?>/vendor/js/helpers.js"></script>

    <script src="<?= $baseurl ?>/js/config.js"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-text demo text-body fw-bolder">Desa Kumantan</span>
                            </a>
                        </div>
                        <!-- /Logo -->

                        <form id="formAuthentication" class="mb-3" action="<?= base_url('isadmin') ?>" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" autofocus required />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>

                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= $baseurl ?>/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= $baseurl ?>/vendor/libs/popper/popper.js"></script>
    <script src="<?= $baseurl ?>/vendor/js/bootstrap.js"></script>
    <script src="<?= $baseurl ?>/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?= $baseurl ?>/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?= $baseurl ?>/js/main.js"></script>
</body>

</html>