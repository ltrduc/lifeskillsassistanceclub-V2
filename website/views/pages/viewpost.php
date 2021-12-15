<?php
if (!isset($_GET['id']) || $_GET['id'] == NULL) {
    echo "<script>window.location='./?q=member';</script>";
} else {
    $id = $_GET['id'];
}

$viewPost = $managePost->viewPost($id);
if ($viewPost) {
    $showPost = $viewPost->fetch_assoc();
    $postgenre = $showPost['postgenre'];
}
?>

<section class="breadcrumb_section">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb" style="margin: 0;">
                <li><a href="?q=homepage">Trang chủ</a></li>
                <li class="active"><a href="#!">Danh mục >> <?php echo $showPost['postgenre'] ?></a></li>
            </ol>
        </div>
    </div>
</section>

<section id="entity_section" class="entity_section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="entity_wrapper">
                    <?php if ($showPost['images'] != "") { ?>
                        <div class="entity_thumb">
                            <img class="img-responsive" src="../admin/<?php echo $showPost['images'] ?>">
                        </div>
                    <?php } ?>
                    <!-- entity_thumb -->

                    <div class="entity_title">
                        <h1 style="font-weight: bold; text-transform: uppercase;"><?php echo $showPost['title'] ?></h1>
                    </div>
                    <!-- entity_title -->

                    <div class="entity_meta"><a target="_self"><?php echo $showPost['time'] ?></a>, by: <a target="_self"><?php echo $showPost['author'] ?></a>
                    </div>
                    <!-- entity_meta -->

                    <div class="entity_content">
                        <?php echo $showPost['contentpost'] ?>
                    </div>
                    <!-- entity_content -->

                    <div class="entity_footer">
                        <div class="entity_tag">
                            <?php
                            $getPostgenres = $managePost->getPostgenres();
                            if ($getPostgenres && $getPostgenres->num_rows > 0) {
                                while ($v_getPostgenres = $getPostgenres->fetch_assoc()) {
                            ?>
                                    <span class="blank"><a href="?q=category&postgenre=<?php echo $v_getPostgenres['postgenre'] ?>"><?php echo $v_getPostgenres['postgenre'] ?></a></span>
                            <?php }
                            } ?>
                        </div>
                        <!-- entity_tag -->
                    </div>
                    <!-- entity_footer -->

                </div>
                <!-- entity_wrapper -->

                <div class="related_news">
                    <div class="entity_inner__title header_purple">
                        <h2><a href="?q=category&postgenre=<?php echo $postgenre ?>"><?php echo $postgenre ?></a></h2>
                    </div>
                    <!-- entity_title -->
                    <div class="row">
                        <?php
                        $query = "SELECT * FROM tbl_post WHERE `status` = '1' AND postgenre = '$postgenre' ORDER BY id DESC LIMIT 4";
                        $result = $db->select($query);
                        if ($result) {
                            while ($value = $result->fetch_assoc()) {
                        ?>
                                <div class="col-md-6">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="?q=viewpost&id=<?php echo $value['id'] ?>"><img class="media-object" src="../admin/<?php echo $value['images'] ?>" height="130" width="180"></a>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="media-heading">
                                                <a href="?q=viewpost&id=<?php echo $value['id'] ?>" target="_self" style="text-transform: uppercase;">
                                                    <?php echo $fm->textShorten($value['title'], 50); ?>
                                                </a>
                                            </h3>
                                            <span class="media-date">
                                                <span class="tag purple"><?php echo $value['postgenre'] ?></span>
                                                <a style="font-size: 12px;"><?php echo $value['time'] ?>, by:</a>
                                                <a style="font-size: 12px;"><?php echo $value['author'] ?></a>
                                            </span>
                                            <div class="media_social">
                                                <a style="font-size: 10px;" href="?q=viewpost&id=<?php echo $value['id'] ?>"><i class="fa fa-eye"></i>XEM CHI TIẾT >>></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>

                </div>
                <!-- Related news -->
            </div>
            <!-- col-md-8 -->

            <!-- Right Content -->
            <?php include './inc/content_right.php'; ?>
            <!-- End Right Content -->

        </div>
        <!-- row -->
    </div>
    <!-- container -->
</section>