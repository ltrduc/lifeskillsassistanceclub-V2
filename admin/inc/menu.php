<?php
include '../lib/session.php';
Session::checkSession();
?>

<?php
include '../lib/database.php';
include '../helpers/format.php';

spl_autoload_register(function ($class) {
    include_once "../classes/" . $class . ".php";
});

$db = new Database();
$fm = new Format();

$manageMember = new manageMember();
$manageStructure = new manageStructure();
$manageEquipment = new manageEquipment();
$manageSchedule = new manageSchedule();
$loanPayment = new loanPayment();
$adminiStration = new adminiStration();
$decentralization = new decentralization();
$changePassword = new changePassword();
$manageSubjects = new manageSubjects();
$manageCourse = new manageCourse();
$manageShoolYear = new manageShoolYear();
$manageAttendance = new manageAttendance();
$manageStatistical = new manageStatistical();
$managePost = new managePost();
$activityPhoto = new activityPhoto();
$manageRegister = new manageRegister();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Life Skills Assistance</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" type="image/png" href="./assets/images/logo.png">

    <!-- Favicon icon -->
    <link rel="icon" href="./assets/images/favicon.ico" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="./assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="./assets/plugins/animation/css/animate.min.css">

    <!-- Data table -->
    <link rel="stylesheet" href="./assets/plugins/datatable/datatables.min.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="./assets/css/style.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.16.2/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body class="">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar menupos-fixed menu-light brand-blue">
        <div class="navbar-wrapper ">
            <div class="navbar-brand header-logo">
                <a href="?q=homepage" class="b-brand" style="color: white;">
                    <img class="rounded-circle" src="./assets/images/logo_login.png" style="width: 50px; height: auto;" alt="" class="logo images">
                    <img src="./assets/images/logo_login.png" style="width: 30px; height: auto;" alt="" class="logo-thumb images rounded-circle">
                </a>
                <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            </div>
            <div class="navbar-content scroll-div ps ps--active-y">
                <ul class="nav pcoded-inner-navbar" id="myList">
                    <!-- Trang ch??? -->
                    <li class="nav-item pcoded-menu-caption">
                        <label>Thao t??c chung</label>
                    </li>
                    <li class="nav-item">
                        <a href="?q=homepage" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Trang ch???</span></a>
                    </li>

                    <li class="nav-item pcoded-menu-caption">
                        <label>Thao t??c qu???n l??</label>
                    </li>

                    <!-- Qu???n l?? bu???i h???c -->
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-airplay"></i></span><span class="pcoded-mtext">Qu???n l?? bu???i
                                h???c</span></a>
                        <ul class="pcoded-submenu">
                            <?php if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('level') == "1") { ?>
                                <li><a href="?q=attendance">??i???m danh ca tr???c</a></li>
                                <?php if (Session::get('level') == "050301" || Session::get('level') == "0") { ?>
                                    <li><a href="?q=statistical">Th???ng k?? ??i???m danh</a></li>
                                <?php } ?>
                            <?php } ?>
                            <li><a href="?q=listcourse">Qu???n l?? l???ch h???c</a></li>
                        </ul>
                    </li>

                    <?php if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('team') == "H??nh Ch??nh" || Session::get('team') == "Truy???n Th??ng") { ?>
                        <!-- QU???N L?? TR???C BAN -->
                        <li class="nav-item pcoded-hasmenu">
                            <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">Qu???n l?? tr???c
                                    ban</span></a>
                            <ul class="pcoded-submenu">
                                <?php if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('team') == "H??nh Ch??nh") { ?>
                                    <li><a href="?q=schedulehc">Ban h??nh ch??nh</a></li>
                                <?php } ?>

                                <?php if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('team') == "Truy???n Th??ng") { ?>
                                    <li><a href="?q=schedulett">Ban truy???n th??ng</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <!-- KET THUC QUAN LY TRUC BAN -->
                    <?php } ?>

                    <?php if (Session::get('level') == "050301" || Session::get('level') == "0") { ?>
                        <!-- Qu???n l?? thi???t b??? -->
                        <li class="nav-item pcoded-hasmenu">
                            <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-server"></i></span><span class="pcoded-mtext">Qu???n l?? thi???t b???</span></a>
                            <ul class="pcoded-submenu">
                                <li><a href="?q=equipment">Th???ng k?? thi???t b???</a></li>
                                <li><a href="?q=loanpayment">Qu???n l?? m?????n/tr???</a></li>
                            </ul>
                        </li>
                    <?php } ?>

                    <!-- Qu???n l?? Website -->
                    <?php if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('level') == "2") { ?>
                        <li class="nav-item pcoded-hasmenu">
                            <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Qu???n l?? Website</span></a>
                            <ul class="pcoded-submenu">
                                <li><a href="?q=post">Qu???n l?? b??i ????ng</a></li>
                                <li><a href="?q=activityphoto">???nh ho???t ?????ng</a></li>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if (Session::get('level') == "050301" || Session::get('level') == "0") { ?>
                        <li class="nav-item pcoded-hasmenu">
                            <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Qu???n l?? nh??n
                                    s???</span></a>
                            <ul class="pcoded-submenu">
                                <li><a href="?q=structure">C?? c???u t??? ch???c</a></li>
                                <li><a href="?q=member">Qu???n l?? th??nh vi??n</a></li>
                                <li><a href="?q=collaborators">Qu???n l?? c???ng t??c vi??n</a></li>
                                <li><a href="?q=recruitment">Tuy???n th??nh vi??n</a></li>
                            </ul>
                        </li>
                    <?php } ?>

                    <!-- Thao t??c n??ng cao -->
                    <?php if (Session::get('level') == "050301" || Session::get('level') == "0") { ?>
                        <li class="nav-item pcoded-menu-caption">
                            <label>Thao t??c n??ng cao</label>
                        </li>
                        <li class="nav-item">
                            <a href="?q=decentralization" class="nav-link"><span class="pcoded-micon"><i class="feather icon-gitlab"></i></span><span class="pcoded-mtext">Ph??n quy???n</span></a>
                        </li>
                        <?php if (Session::get('level') == "050301") { ?>
                            <li class="nav-item">
                                <a href="?q=administration" class="nav-link"><span class="pcoded-micon"><i class="feather icon-sliders"></i></span><span class="pcoded-mtext">Qu???n tr??? t??i kho???n</span></a>
                            </li>
                        <?php } ?>
                    <?php } ?>

                    <!-- Thao t??c kh??c -->
                    <li class="nav-item pcoded-menu-caption">
                        <label>Thao t??c kh??c</label>
                    </li>
                    <?php if (Session::get('level') != "050301") { ?>
                        <li class="nav-item">
                            <a href="?q=changepassword" class="nav-link"><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">?????i m???t kh???u</span></a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <?php
                        if (isset($_GET['q']) && $_GET['q'] == 'logout') {
                            Session::destroy();
                        }
                        ?>
                        <a href="?q=logout" class="nav-link"><span class="pcoded-micon"><i class="feather icon-log-out"></i></span><span class="pcoded-mtext">????ng xu???t</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="?q=softwareinformation" class="nav-link"><span class="pcoded-micon"><i class="feather icon-alert-circle"></i></span><span class="pcoded-mtext">Th??ng tin ph???n m???m</span></a>
                    </li>
                </ul>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; height: 909px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 850px;"></div>
                </div>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->