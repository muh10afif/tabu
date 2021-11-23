<header id="topnav">
    <div class="topbar-main">
        <div class="container-fluid">

            <!-- Logo-->
            <div>
                <a href="index.html" class="logo">
                    <span class="logo-light">
                        <!-- <i class="mdi mdi-camera-control"></i> -->
                        Wisata Taman Batu
                    </span>
                </a>
            </div>
            <!-- End Logo-->

            <div class="menu-extras topbar-custom navbar p-0">

                <ul class="navbar-right ml-auto list-inline float-right mb-0">
                    <!-- notification -->
                    <li class="dropdown notification-list list-inline-item">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="date-part"></span>&nbsp;~&nbsp;<span class="time-part"></span>
                        </a>
                    </li>

                    <li class="dropdown notification-list list-inline-item">
                        <div class="dropdown notification-list nav-pro-img">
                            <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?= base_url() ?>assets/template/assets/images/users/user-4.jpg" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <!-- <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Profile</a>
                                <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item text-danger" href="<?= base_url('Auth/out') ?>"><i class="mdi mdi-power text-danger"></i> Logout</a>
                            </div>
                        </div>
                    </li>

                    <li class="menu-item dropdown notification-list list-inline-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle nav-link">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>

                </ul>

            </div>
            <!-- end menu-extras -->

            <div class="clearfix"></div>

        </div>
        <!-- end container -->
    </div>
    <!-- end topbar-main -->

    <!-- MENU Start -->
    <div class="navbar-custom">
        <div class="container-fluid">

            <div id="navigation">

                <!-- Navigation Menu-->
                <ul class="navigation-menu text-center">

                    <li class="has-submenu">
                        <a href="<?= base_url('dashboard') ?>"><i class="icon-accelerator"></i> Dashboard</a>
                    </li>

                    <li class="has-submenu">
                        <a href="#"><i class="icon-squares"></i>Master<i class="mdi mdi-chevron-down mdi-drop"></i></a>
                        <ul class="submenu megamenu">
                            <li>
                                <ul>
                                    <li><a href="<?= base_url('master/setting') ?>">Setting Data</a></li>
                                    <!-- <li><a href="<?= base_url('master/kategori') ?>">Kategori</a></li>
                                    <li><a href="<?= base_url('master/grup_pengunjung') ?>">Grup Pengunjung</a></li> -->
                                    <li><a href="<?= base_url('master/hari_besar') ?>">Judul Hari Besar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- <li class="has-submenu">
                        <a href="#"><i class="icon-pricetag"></i>Potongan<i class="mdi mdi-chevron-down mdi-drop"></i></a>
                        <ul class="submenu megamenu">
                            <li>
                                <ul>
                                    <li><a href="<?= base_url('potongan/kupon') ?>">Kupon</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->

                    <li class="has-submenu">
                        <a href="<?= base_url('transaksi') ?>"><i class="icon-ticket"></i>Transaksi</a>
                    </li>

                    <li class="has-submenu">
                        <a href="<?= base_url('laporan') ?>"><i class="icon-spread"></i>Laporan</a>
                    </li>

                </ul>
                <!-- End navigation menu -->
            </div>
            <!-- end #navigation -->
        </div>
        <!-- end container -->
    </div>
    <!-- end navbar-custom -->
</header>