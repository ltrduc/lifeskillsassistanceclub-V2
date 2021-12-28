<!-- [Footer] -->
<section id="footer_section" class="footer_section">
    <div class="container">
        <hr class="footer-top">
        <div class="row">
            <div class="col-md-4">
                <div class="footer_widget_title">
                    <h3><a target="_self">Giới thiệu</a></h3>
                </div>
                <div class="logo footer-logo">
                    <a title="fontanero" href="?q=homepage">
                        <img src="assets/img/logo.png">
                    </a>
                    <p>
                        1. Sống sâu sắc và có ý nghĩa. <br>
                        2. Lan tỏa sức sống lành mạnh, trung thực, đơn giản. <br>
                        3. Nâng tầm bản thân từ bên trong.
                    </p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="footer_widget_title">
                    <h3><a target="_self">Bộ phận chức năng</a></h3>
                </div>
                <div class="row">
                    <?php
                    $cn = $manageStructure->getChuNhiem();
                    $phc = $manageStructure->getPhoBanhanhChinh();
                    $pns = $manageStructure->getPhoBanNhanSu();
                    $ptt = $manageStructure->getPhoBanTruyenThong();
                    $thc = $manageStructure->getTruongBanHanhChinh();
                    $tns = $manageStructure->getTruongBanNhanSu();
                    $ttt = $manageStructure->getTruongBanTruyenThong();

                    if ($cn && $cn->num_rows > 0) {
                        $value_cn = $cn->fetch_assoc();
                        $facebook_cn  = $value_cn['facebook'];
                        $fullname_cn  = $value_cn['fullname'];
                    } else {
                        $facebook_cn  = "?q=homepage";
                        $fullname_cn  = "---------------";
                    }
                    if ($phc && $phc->num_rows > 0) {
                        $value_phc = $phc->fetch_assoc();
                        $facebook_phc = $value_phc['facebook'];
                        $fullname_phc = $value_phc['fullname'];
                    } else {
                        $facebook_phc = "?q=homepage";
                        $fullname_phc = "---------------";
                    }
                    if ($pns && $pns->num_rows > 0) {
                        $value_pns = $pns->fetch_assoc();
                        $facebook_pns = $value_pns['facebook'];
                        $fullname_pns = $value_pns['fullname'];
                    } else {
                        $facebook_pns = "?q=homepage";
                        $fullname_pns = "---------------";
                    }
                    if ($ptt && $ptt->num_rows > 0) {
                        $value_ptt = $ptt->fetch_assoc();
                        $facebook_ptt = $value_ptt['facebook'];
                        $fullname_ptt = $value_ptt['fullname'];
                    } else {
                        $facebook_ptt = "?q=homepage";
                        $fullname_ptt = "---------------";
                    }
                    if ($thc && $thc->num_rows > 0) {
                        $value_thc = $thc->fetch_assoc();
                        $facebook_thc = $value_thc['facebook'];
                        $fullname_thc = $value_thc['fullname'];
                    } else {
                        $facebook_thc = "?q=homepage";
                        $fullname_thc = "---------------";
                    }
                    if ($tns && $tns->num_rows > 0) {
                        $value_tns = $tns->fetch_assoc();
                        $facebook_tns = $value_tns['facebook'];
                        $fullname_tns = $value_tns['fullname'];
                    } else {
                        $facebook_tns = "?q=homepage";
                        $fullname_tns = "---------------";
                    }
                    if ($ttt && $ttt->num_rows > 0) {
                        $value_ttt = $ttt->fetch_assoc();
                        $facebook_ttt = $value_ttt['facebook'];
                        $fullname_ttt = $value_ttt['fullname'];
                    } else {
                        $facebook_ttt = "?q=homepage";
                        $fullname_ttt = "---------------";
                    }
                    ?>
                    <div class="col-xs-6">
                        <ul class="list-unstyled left">
                            <li><a href="<?php echo $facebook_cn ?>">Chủ nhiệm</a></li>
                            <li><a href="<?php echo $facebook_thc ?>">T.Ban Hành chính</a></li>
                            <li><a href="<?php echo $facebook_phc ?>">P.Ban Hành chính</a></li>
                            <li><a href="<?php echo $facebook_tns ?>">T.Ban Nhân sự</a></li>
                            <li><a href="<?php echo $facebook_pns ?>">P.Ban Nhân sự</a></li>
                            <li><a href="<?php echo $facebook_ttt ?>">T.Ban Truyền thông</a></li>
                            <li><a href="<?php echo $facebook_ptt ?>">P.Ban Truyền thông</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-6">
                        <ul class="list-unstyled">
                            <li><a href="<?php echo $facebook_cn  ?>"><?php echo $fullname_cn ?></a></li>
                            <li><a href="<?php echo $facebook_thc ?>"><?php echo $fullname_thc ?></a></li>
                            <li><a href="<?php echo $facebook_phc ?>"><?php echo $fullname_phc ?></a></li>
                            <li><a href="<?php echo $facebook_tns ?>"><?php echo $fullname_tns ?></a></li>
                            <li><a href="<?php echo $facebook_pns ?>"><?php echo $fullname_pns ?></a></li>
                            <li><a href="<?php echo $facebook_ttt ?>"><?php echo $fullname_ttt ?></a></li>
                            <li><a href="<?php echo $facebook_ptt ?>"><?php echo $fullname_ptt ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="footer_widget_title">
                    <h3><a target="_self">Hoạt động</a></h3>
                </div>
                <div class="widget_photos">
                    <?php
                    $getImages = $activityPhoto->getImages();
                    if ($getImages) {
                        while ($value = $getImages->fetch_assoc()) {
                    ?>
                            <a href="../admin/<?php echo $value['images'] ?>"><img class="img-thumbnail" src="../admin/<?php echo $value['images'] ?>"></a>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="footer_bottom_Section">
        <div class="container">
            <div class="row">
                <div class="footer">
                    <div class="col-sm-3">
                        <div class="social">
                            <a href="https://www.facebook.com/lsa.lifeskillsassistanceclub" class="icons-sm fb-ic">facebook: <i class="fa fa-facebook"></i></a>
                            <!--youtube-->
                            <a href="https://www.youtube.com/channel/UCCUwQdxdg11Das0XSkilCWg/videos" class="icons-sm tw-ic">youtube: <i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <p style="text-align: center;">&copy; Copyright 2021 - Life Skills Assistance</p>
                    </div>
                    <div class="col-sm-3">
                        <p style="text-align: center;">Câu lạc bộ Kỹ năng sống - LSA</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- [End Footer] -->
</div>
<!-- #content-wrapper -->

</div>
<!-- .offcanvas-pusher -->

<!-- [Menu] -->
<a href="#" class="crunchify-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
<div class="uc-mobile-menu uc-mobile-menu-effect">
    <button type="button" class="close" aria-hidden="true" data-toggle="offcanvas" id="uc-mobile-menu-close-btn">&times;</button>
    <div>
        <div>
            <ul id="menu">
                <li class="active"><a href="?q=homepage">Trang chủ</a></li>
                <li><a href="?q=introduce">Giới thiệu câu lạc bộ</a></li>
                <li><a href="?q=structure">Cơ cấu Tổ chức</a></li>
                <li><a href="?q=post">Tin tức</a></li>
                <li><a href="?q=contact">Liên hệ</a></li>
                <li><a class="link-dangky" href="?q=register">Đăng ký thành viên</a></li>

            </ul>
        </div>
    </div>
</div>
<!-- [End Menu] -->

</div>
<!-- #main-wrapper -->

<!-- jquery Core-->
<script src="assets/js/jquery-2.1.4.min.js"></script>

<!-- Bootstrap -->
<script src="assets/js/bootstrap.min.js"></script>

<!-- Theme Menu -->
<script src="assets/js/mobile-menu.js"></script>

<!-- Owl carousel -->
<script src="assets/js/owl.carousel.min.js"></script>

<!-- Theme Script -->
<script src="assets/js/script.js"></script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>

</html>