<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> Taman Batu | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/logo_kecil.png">

    <!-- Sweet Alert-->
    <link href="<?= base_url() ?>assets/swa/sweetalert2.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="<?= base_url() ?>assets/template_login/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url() ?>assets/template_login/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url() ?>assets/template_login/assets/css/app.css" id="app-style" rel="stylesheet" type="text/css" />

    <style>
        .field-icon {
            float: right;
            margin-left: -25px;
            margin-right: 10px;
            margin-top: -26px;
            position: relative;
            z-index: 2;
        }
    </style>
</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden shadow">
                        <div class="bg-login text-center">
                            <div class="bg-login-overlay"></div>
                            <div class="position-relative">
                                <h2 class="text-white">B A G J A</h2>
                                <p class="text-white-50 mb-0">INDONESIA</p>
                                <a href="index.html" class="logo logo-admin mt-4">
                                    <img src="<?= base_url() ?>assets/img/logo.png" alt="" height="50">
                                </a>
                            </div>
                        </div>
                        <div class="card-body pt-5">
                            <div class="p-2">
                                <form class="form-horizontal" method="POST" id="form-login" autocomplete="off">

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                        <i toggle="#password" class="fa fa-smile-beam fa-lg field-icon toggle-password"></i>
                                    </div><hr>

                                    <div class="mt-3">
                                        <button class="btn btn-warning btn-block waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>Powered By Bagja Indonesia © <?= date('Y') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="<?= base_url() ?>assets/template_login/assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/template_login/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/template_login/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= base_url() ?>assets/template_login/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url() ?>assets/template_login/assets/libs/node-waves/waves.min.js"></script>

    <!-- Sweet Alerts js -->
    <script src="<?= base_url() ?>assets/swa/sweetalert2.all.min.js"></script>

    <script src="<?= base_url() ?>assets/template_login/assets/js/app.js"></script>

    <script>
        
        $(document).ready(function () {
            
            $('#form-login').on('submit', function () {

                var username    = $('#username').val();
                var password    = $('#password').val();

                if ((username == "") && (password == "")) {

                    $('#username').focus();

                    swal({
                        title               : "Peringatan",
                        text                : 'Semua data harus terisi dahulu!',
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 1000
                    }); 

                    return false;

                } else if (username == "") {

                    $('#username').focus();

                    swal({
                        title               : "Peringatan",
                        text                : 'Username harus terisi dahulu!',
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 700
                    }); 

                    return false;

                } else if (password == "") {

                    $('#password').focus();

                    swal({
                        title               : "Peringatan",
                        text                : 'Password harus terisi dahulu!',
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 700
                    }); 

                    return false;

                } else {

                    $.ajax({
                        type        : "post",
                        url         : "Auth/cek",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        data        : {username:username, password:password},
                        dataType    : 'JSON',
                        success     : function (data) {

                            if (data.status == 1) {

                                var url = "<?= base_url('dashboard') ?>";

                                window.location.href = url;

                            } else if (data.status == 0) {

                                $('#username').val('');

                                swal({
                                    title               : "Peringatan",
                                    text                :  (data.pesan).toLowerCase().replace(/(?<= )[^\s]|^./g, a=>a.toUpperCase()),
                                    type                : 'warning',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                $('#username').focus();

                                return false;
                                
                            } else if (data.status == 2) {

                                $('#password').val('');

                                swal({
                                    title               : "Peringatan",
                                    text                : (data.pesan).toLowerCase().replace(/(?<= )[^\s]|^./g, a=>a.toUpperCase()),
                                    type                : 'warning',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                $('#password').focus();

                                return false;
                                
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal({
                                title               : "Peringatan",
                                text                : "Koneksi Tidak Terhubung",
                                type                : 'warning',
                                showConfirmButton   : false,
                                timer               : 1000
                            }); 

                            return false;
                        }							

                        
                    })
                    
                    return false;

                }

            })

            // 18-09-2020
            $(".toggle-password").click(function() {

                $(this).toggleClass("fa-smile-beam fa-meh-rolling-eyes");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                input.attr("type", "text");
                } else {
                input.attr("type", "password");
                }

            });

        })
        
    </script>

</body>

</html>