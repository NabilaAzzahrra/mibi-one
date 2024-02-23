<!doctype html>
<html lang="en">

<!-- Code From : https://colorlib.com/wp/template/login-form-08/ -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/template/logs/') ?>fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?= base_url('assets/template/logs/') ?>css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/template/logs/') ?>css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="<?= base_url('assets/template/logs/') ?>css/style.css">

    <link rel="stylesheet" href="<?= base_url('assets/template/assets/') ?>toastr/toastr.min.css">

    <link rel="shortcut icon" href="<?= base_url('assets/template/logs/images/') ?>logo-ex.png" type="image/x-icon">

    <title>MiBi-One - Login</title>
</head>

<body>



    <div class="content align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-2">
                    <img src="<?= base_url('assets/template/logs/') ?>images/people-s-emotions-cinema.jpg" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Sistem Informasi Penjualan Tiket <strong>MiBi-One</strong></h3>
                                <p class="mb-4">Silahkan log in terlebih dahulu...</p>
                            </div>
                            <form action="<?= base_url('Auth/login'); ?>" method="post">
                                <div class="form-group first">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username">

                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">

                                </div>

                                <input type="submit" value="Log In" class="btn text-white btn-block btn-primary">

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <script src="<?= base_url('assets/template/logs/') ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url('assets/template/logs/') ?>js/popper.min.js"></script>
    <script src="<?= base_url('assets/template/logs/') ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/template/logs/') ?>js/main.js"></script>
</body>

</html>
<!-- Toastr -->
<script src="<?= base_url('assets/template/assets/') ?>toastr/toastr.min.js"></script>
<script>
    $(function() {
        $('[name="username"]').focus();
        <?php if ($this->session->flashdata('usernotfound')) { ?>
            toastr.error('Username atau Password tersebut tidak ada.');
        <?php } else if ($this->session->flashdata('logout')) { ?>
            toastr.success('Berhasil keluar dari sesi anda.');
        <?php } else { ?>
            toastr.info('Masukkan data anda untuk masuk.');
        <?php } ?>
    });
</script>