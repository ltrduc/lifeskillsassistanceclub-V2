<?php
include '../lib/database.php';
include '../helpers/format.php';

spl_autoload_register(function ($class) {
    include_once "../classes/" . $class . ".php";
});

$db = new Database();
$fm = new Format();

$manageStructure = new manageStructure();
$managePost = new managePost();
$activityPhoto = new activityPhoto();
$manageRegister = new manageRegister();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Life Skills Assistance</title>

    <!-- favicon -->
    <link href="assets/img/favicon.png" rel=icon>

    <!-- web-fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,500' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- font-awesome -->
    <link href="assets/fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
    <!-- Mobile Menu Style -->
    <link href="assets/css/mobile-menu.css" rel="stylesheet">

    <!-- Owl carousel -->
    <link href="assets/css/owl.carousel.css" rel="stylesheet">
    <link href="assets/css/owl.theme.default.min.css" rel="stylesheet">
    <!-- Theme Style -->
    <link href="assets/css/style.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar">
    <div id="main-wrapper">
        <!-- Page Preloader -->
        <div id="preloader">
            <div id="status">
                <div class="status-mes"></div>
            </div>
        </div>
        <!-- preloader -->

        <div class="uc-mobile-menu-pusher">
            <div class="content-wrapper">
                <!-- [Header] -->
                <section id="header_section_wrapper" class="header_section_wrapper">
                    <div class="container">
                        <div class="header-section">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="left_section">
                                        <span class="date"> Ngày thành lập: </span>
                                        <!-- Date -->
                                        <span class="time"> 07 Tháng 01 . 2020 </span>
                                        <!-- Time -->
                                        <div class="social">
                                            <a class="icons-sm fb-ic" href="https://www.facebook.com/lsa.lifeskillsassistanceclub">facebook: <i class="fa fa-facebook"></i></a>
                                            <!--youtube-->
                                            <a class="icons-sm tw-ic" href="https://www.youtube.com/channel/UCCUwQdxdg11Das0XSkilCWg/videos">youtube: <i class="fa fa-youtube"></i></a>
                                        </div>
                                        <!-- Top Social Section -->
                                    </div>
                                    <!-- Left Header Section -->
                                </div>
                                <div class="col-md-4">
                                    <div class="logo">
                                        <a href="?q=homepage"><img src="assets/img/logo.png"></a>
                                    </div>
                                    <!-- Logo Section -->
                                </div>
                                <div class="col-md-4">
                                    <div class="right_section">
                                        <ul class="nav navbar-nav">
                                            <li><a href="../admin/login.php">Đăng nhập</a></li>
                                            <li><a href="#">---</a></li>
                                            <li class="dropdown lang">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Vi <i class="fa fa-angle-down"></i></button>
                                            </li>
                                        </ul>
                                        <!-- Language Section -->

                                        <ul class="nav-cta hidden-xs">
                                            <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-search"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <div class="head-search">
                                                            <form role="form">
                                                                <!-- Input Group -->
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" placeholder="Type Something"> <span class="input-group-btn">
                                                                        <button type="submit" class="btn btn-primary">Search
                                                                        </button>
                                                                    </span>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <!-- Search Section -->
                                    </div>
                                    <!-- Right Header Section -->
                                </div>
                            </div>
                        </div>
                        <!-- Header Section -->

                        <div class="navigation-section">
                            <nav class="navbar m-menu navbar-default">
                                <div class="container">
                                    <!-- Brand and toggle get grouped for better mobile display -->
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1"><span class="sr-only">Toggle
                                                navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                                        </button>
                                    </div>
                                    <!-- Collect the nav links, forms, and other content for toggling -->
                                    <div class="collapse navbar-collapse" id="#navbar-collapse-1">
                                        <ul class="nav navbar-nav main-nav">
                                            <li class="active"><a href="?q=homepage">Trang chủ</a></li>
                                            <li><a href="?q=introduce">Giới thiệu câu lạc bộ</a></li>
                                            <li><a href="?q=structure">Cơ cấu Tổ chức</a></li>
                                            <li><a href="?q=post">Tin tức</a></li>
                                            <li><a href="?q=contact">Liên hệ</a></li>
                                            <li><a class="link-dangky" style="color: brown;" href="?q=register">Đăng ký thành viên</a></li>
                                        </ul>
                                    </div>
                                    <!-- .navbar-collapse -->
                                </div>
                                <!-- .container -->
                            </nav>
                            <!-- .nav -->
                        </div>
                        <!-- .navigation-section -->
                    </div>
                    <!-- .container -->
                </section>
                <!-- [End Header] -->