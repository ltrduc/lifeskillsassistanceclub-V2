<?php
$item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 4; // Số sản phẩm hiện trong 1 trang
$current_page = !empty($_GET['page']) ? $_GET['page'] : 1; // Số trang bắt đầu sẽ là 0 - 1 - 2 - 3
$offset = ($current_page - 1) * $item_per_page;

$sqltotalRecords = "SELECT * FROM tbl_post WHERE `status` = '1'";
$totalRecords = $db->select($sqltotalRecords);

if ($totalRecords) {
    $totalRecords = $totalRecords->num_rows; // Tổng số sản phẩm
}

$totalPages = ceil($totalRecords / $item_per_page); // tổng số trang
?>

<section class="breadcrumb_section">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb" style="margin: 0;">
                <li><a href="?q=homepage">Trang chủ</a></li>
                <li class="active"><a href="#!">Danh mục >> Tất cả tin tức</a></li>
            </ol>
        </div>
    </div>
</section>

<section id="entity_section" class="entity_section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php
                $getAllPost = $managePost->getPostDesc($item_per_page, $offset);
                if ($getAllPost) {
                    while ($showAllPost = $getAllPost->fetch_assoc()) {
                ?>
                        <div class="blog_left_sidebar" style="display: block;">
                            <div class="entity_wrapper">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="blog_info text-left" style="margin-bottom: 20px;">
                                            <ul class="blog_meta list">
                                                <li style="margin-bottom: 10px;"><a style="font-size: 15px;"><i class="fa fa-user"></i> <?php echo $showAllPost['author'] ?></a></li>
                                                <li style="margin-bottom: 10px;"><a style="font-size: 15px;"><i class="fa fa-calendar"> <?php echo $showAllPost['time'] ?></i></a></li>
                                                <li style="margin-bottom: 10px;"><a style="font-size: 15px;" href="?q=category&postgenre=<?php echo $showAllPost['postgenre'] ?>"><i class="fa fa-edit"> <?php echo $showAllPost['postgenre'] ?></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <?php if ($showAllPost['images'] != "") { ?>
                                            <div class="entity_thumb">
                                                <a href="?q=viewpost&id=<?php echo $showAllPost['id'] ?>">
                                                    <img class="img-responsive" src="../admin/<?php echo $showAllPost['images'] ?>" style="max-width: 100%; width: 100%; height: 280px;">
                                                </a>
                                            </div>
                                        <?php } ?>
                                        <div class="entity_title">
                                            <h1 style="margin-top: 20px;"><a href="?q=viewpost&id=<?php echo $showAllPost['id'] ?>" target="_self" style="text-transform: uppercase;"><?php echo $showAllPost['title'] ?></a>
                                            </h1>
                                            <div class="entity_content" style="margin-top: 10px; margin-bottom: 20px;">
                                                <?php echo $fm->textShorten($showAllPost['contentpost'], 400); ?>
                                            </div>
                                            <div class="widget_divider" style="margin-bottom: 50px;">
                                                <a style="font-size: 13px;" href="?q=viewpost&id=<?php echo $showAllPost['id'] ?>"></i>XEM CHI TIẾT >>></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }
                }
                ?>

                <?php if ($totalRecords > 0) { ?>
                    <!-- entity_wrapper -->
                    <nav aria-label="Page navigation" class="pagination_section text-center">
                        <ul class="pagination">
                            <?php
                            for ($i = 1; $i <= $totalPages; $i++) {
                            ?>
                                <li><a href="?q=post&per_page=<?= $item_per_page ?>&page=<?= $i ?>"><?= $i ?></a></li>
                            <?php } ?>
                        </ul>
                    </nav>
                <?php } else { ?>
                    <div class="alert alert-danger" role="alert" style="text-align: center;">
                        XIN LỖI! HIỆN TẠI WEBSITE KHÔNG CÓ TIN TỨC NÀO ĐƯỢC CẬP NHẬT!
                    </div>
                <?php } ?>
                <!-- navigation -->
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