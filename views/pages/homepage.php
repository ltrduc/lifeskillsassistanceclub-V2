<!-- [Slider] -->
<section id="feature_news_section" class="feature_news_section">
    <div class="container">
        <div class="row">
            <div class="col-md-7" style="margin-bottom: 20px;">
                <div class="feature_article_wrapper">
                    <div class="feature_article_img">
                        <img class="img-responsive top_static_article_img display_none" src="../admin/images/slider/img-1.png" style="max-width: 100%; width: 100%; height: 430px;">
                    </div>
                </div>
                <!-- feature_article_wrapper -->
            </div>
            <!-- col-md-7 -->

            <div class="col-md-5">
                <div class="feature_static_wrapper">
                    <div class="feature_article_img">
                        <img class="img-responsive top_static_article_img" src="../admin/images/slider/img-4.png" style="max-width: 100%; width: 100%; height: 200px;">
                    </div>
                </div>
                <!-- feature_static_wrapper -->
            </div>
            <!-- col-md-5 -->

            <div class="col-md-5">
                <div class="feature_static_last_wrapper">
                    <div class="feature_article_img">
                        <img class="img-responsive top_static_article_img" src="../admin/images/slider/img-3.png" style="max-width: 100%; width: 100%; height: 200px;">
                    </div>
                </div>
                <!-- feature_static_wrapper -->
            </div>
            <!-- col-md-5 -->

        </div>

        <!-- container -->
        <!-- entity_wrapper -->
        <?php
        $total = "SELECT * FROM tbl_post WHERE `status` = '1'";
        $totalRecords = $db->select($total);

        if ($totalRecords == false) {
        ?>
            <hr>
            <h1>DANH MỤC TIN TỨC</h1>
            <div class="alert alert-danger" role="alert" style="text-align: center;">
                XIN LỖI! HIỆN TẠI WEBSITE KHÔNG CÓ TIN TỨC NÀO ĐƯỢC CẬP NHẬT!
            </div>
        <?php } ?>

</section>
<!-- [End Slider] -->
<?php
$checkPost = "SELECT * FROM tbl_post WHERE `status` = '1'";
$returnCheck = $db->select($checkPost);
if ($returnCheck && $returnCheck->num_rows > 0) {
?>
    <!-- [Content] -->
    <section id="category_section" class="category_section">
        <div class="container">
            <div class="row">
                <!-- Left Content -->
                <div class="col-md-8">
                    <?php
                    $query = "SELECT * FROM tbl_postgenres";
                    $result = $db->select($query);
                    if ($result) {
                        while ($value = $result->fetch_assoc()) {
                            $postgenre = $value['postgenre'];
                            $q_Post = "SELECT * FROM tbl_post WHERE postgenre = '$postgenre' AND `status` = '1' AND (posttype = 'Nổi bật' OR posttype = 'Không nổi bật') ORDER BY id DESC LIMIT 1";
                            $r_Post = $db->select($q_Post);
                    ?>
                            <div class="category_section">
                                <!----article_title------>
                                <?php if ($r_Post && $r_Post->num_rows > 0) { ?>
                                    <div class="article_title header_purple">
                                        <h2><a href="?q=category&postgenre=<?php echo $value['postgenre'] ?>" target="_self"><?php echo $value['postgenre'] ?></a></h2>
                                    </div>
                                <?php } ?>
                                <!----End article_title------>

                                <!-- Thể loại nổi bật -->
                                <?php
                                $postgenre1 = $value['postgenre'];
                                $q_Post1 = "SELECT * FROM tbl_post WHERE postgenre = '$postgenre1' AND posttype = 'Nổi bật' AND `status` = '1' ORDER BY id DESC LIMIT 1";
                                $r_Post1 = $db->select($q_Post1);
                                if ($r_Post1) {
                                    while ($v_Post1 = $r_Post1->fetch_assoc()) {
                                        if ($postgenre1 == $v_Post1['postgenre']) {
                                ?>
                                            <div class="category_article_wrapper">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <!----top_article_img------>
                                                        <div class="top_article_img">
                                                            <a href="?q=viewpost&id=<?php echo $v_Post1['id'] ?>" target="_self"><img class="img-responsive" src="../admin/<?php echo $v_Post1['images'] ?>" style="width: 100%; height: 220px;"></a>
                                                        </div>
                                                        <!----top_article_img------>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!----category_article_title------>
                                                        <div class="category_article_title">
                                                            <h2>
                                                                <a href="?q=viewpost&id=<?php echo $v_Post1['id'] ?>" target="_self" style="text-transform: uppercase;">
                                                                    <?php echo $fm->textShorten($v_Post1['title'], 80); ?>
                                                                </a>
                                                            </h2>
                                                        </div>
                                                        <!----category_article_title------>

                                                        <!----category_article_date------>
                                                        <div class="category_article">
                                                            <span class="tag purple"><?php echo $v_Post1['postgenre'] ?></span>
                                                            <a><?php echo $v_Post1['time'] ?>, by:</a>
                                                            <a><?php echo $v_Post1['author'] ?></a>
                                                        </div>
                                                        <!----category_article_date------>

                                                        <!----category_article_content------>
                                                        <div class="category_article_content">
                                                            <?php echo $fm->textShorten($v_Post1['contentpost'], 200); ?>
                                                        </div>
                                                        <!----category_article_content------>

                                                        <!----media_social------>
                                                        <div class="media_social">
                                                            <span>
                                                                <a href="?q=viewpost&id=<?php echo $v_Post1['id'] ?>"><i class="fa fa-eye"></i>XEM CHI TIẾT >>></a>
                                                            </span>
                                                        </div>
                                                        <!----media_social------>
                                                    </div>
                                                </div>
                                            </div>
                                <?php }
                                    }
                                } ?>
                                <!-- Thể loại nổi bật -->

                                <!-- Thể loại không nổi bật -->
                                <div class="category_article_wrapper">
                                    <div class="row">
                                        <?php
                                        $postgenre2 = $value['postgenre'];
                                        $q_Post2 = "SELECT * FROM tbl_post WHERE postgenre = '$postgenre2' AND posttype = 'Không nổi bật' AND `status` = '1' ORDER BY id DESC LIMIT 4";
                                        $r_Post2 = $db->select($q_Post2);
                                        if ($r_Post2) {
                                            while ($v_Post2 = $r_Post2->fetch_assoc()) {
                                                if ($postgenre2 == $v_Post2['postgenre']) {
                                        ?>
                                                    <div class="col-md-6" style="margin-bottom: 15px;">
                                                        <div class="media">
                                                            <div class="media-left">
                                                                <a href="?q=viewpost&id=<?php echo $v_Post2['id'] ?>"><img class="media-object" src="../admin/<?php echo $v_Post2['images'] ?>" height="130" width="180"></a>
                                                            </div>
                                                            <div class="media-body">
                                                                <h3 class="media-heading">
                                                                    <a href="?q=viewpost&id=<?php echo $v_Post2['id'] ?>" target="_self" style="text-transform: uppercase;">
                                                                        <?php echo $fm->textShorten($v_Post2['title'], 50); ?>
                                                                    </a>
                                                                </h3>
                                                                <span class="media-date">
                                                                    <span class="tag purple"><?php echo $v_Post2['postgenre'] ?></span>
                                                                    <a style="font-size: 12px;" href="#"><?php echo $v_Post2['time'] ?>, by:</a>
                                                                    <a style="font-size: 12px;" href="#"><?php echo $v_Post2['author'] ?></a>
                                                                </span>

                                                                <div class="media_social">
                                                                    <a style="font-size: 10px;" href="?q=viewpost&id=<?php echo $v_Post2['id'] ?>"><i class="fa fa-eye"></i>XEM CHI TIẾT >>></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                        <?php }
                                            }
                                        } ?>
                                    </div>
                                </div>
                                <!-- Thể loại không nổi bật -->

                                <?php if ($r_Post && $r_Post->num_rows > 0) { ?>
                                    <p class="divider"><a href="?q=category&postgenre=<?php echo $value['postgenre'] ?>">Xem thêm >>></a></p>
                                <?php } ?>
                            </div>
                    <?php }
                    } ?>
                </div>
                <!-- End Left Content -->

                <!-- Right Content -->
                <?php include './inc/content_right.php'; ?>
                <!-- End Right Content -->
            </div>
        </div>
        <!-- Container -->

    </section>
    <!-- [End Content] -->
<?php } ?>