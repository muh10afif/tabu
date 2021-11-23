<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= $title ?> | Taman Batu</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="<?= base_url() ?>assets/template/assets/images/favicon.ico">

    <?php $this->load->view('template/css'); ?>
    <script src="<?= base_url() ?>assets/template/assets/js/jquery.min.js"></script>

</head>

<body>

    <div class="header-bg">
        <!-- Navigation Bar-->
        <?php $this->load->view('template/header');?>
        <!-- End Navigation Bar-->

    </div>
    <!-- header-bg -->

    <div class="wrapper">
        <div class="container-fluid">
            
            <?= $konten ?>

        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end wrapper -->

    <!-- Footer -->
    <footer class="footer">
        © <?= date('Y', now('Asia/Jakarta')) ?> Taman Batu <span class="d-none d-sm-inline-block"> - Powered By Bagja Indonesia</span>.
    </footer>

    <!-- End Footer -->

    <?php $this->load->view('template/js'); ?>

</body>

</html>