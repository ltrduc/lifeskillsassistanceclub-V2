<?php
if (!isset($_GET['postgenre']) || $_GET['postgenre'] == NULL) {
    echo "<script>window.location='./?q=post';</script>";
} else {
    $postgenre = $_GET['postgenre'];
}
?>

<?php
$item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 10; // Số sản phẩm hiện trong 1 trang
$current_page = !empty($_GET['page']) ? $_GET['page'] : 1; // Số trang bắt đầu sẽ là 0 - 1 - 2 - 3
$offset = ($current_page - 1) * $item_per_page;

$sqltotalRecords = "SELECT * FROM tbl_post WHERE `status` = '1' AND `postgenre` = '$postgenre'";
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
                <li class="active"><a href="#!">Thể loại >> <?php echo $postgenre ?></a></li>
            </ol>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="entity_wrapper">
                <div class="entity_title header_purple">
                    <h1 style="text-transform: uppercase;">Thể Loại: <?php echo $postgenre ?></h1>
                </div>
            </div>
            <!-- entity_wrapper -->

            <div class="row">
                <?php
                $viewCategory = $managePost->viewCategory($postgenre, $item_per_page, $offset);
                if ($viewCategory) {
                    while ($showCategory = $viewCategory->fetch_assoc()) {
                ?>
                        <div class="col-md-6" style="margin-top: 20px;">
                            <div class="category_article_body">
                                <div class="top_article_img">
                                    <img class="img-fluid" src="../admin/<?php echo $showCategory['images'] ?>" style="max-width: 100%; width: 100%; height: 200px;">
                                </div>
                                <!-- top_article_img -->

                                <div class="category_article_title" style="height: 100px;">
                                    <h5><a style="text-transform: uppercase;" href="?q=viewpost&id=<?php echo $showCategory['id'] ?>" target="_blank"><?php echo $fm->textShorten($showCategory['title'], 200); ?></a></h5>
                                </div>
                                <!-- category_article_title -->

                                <div class="article_date">
                                    <a><?php echo $showCategory['time'] ?></a>, by: <a><?php echo $showCategory['author'] ?></a>
                                </div>
                                <!-- article_date -->

                                <div class="category_article_content">
                                    <?php echo $fm->textShorten($showCategory['contentpost'], 400); ?>
                                </div>
                                <!-- category_article_content -->
                            </div>
                            <!-- category_article_body -->
                        </div>
                <?php
                    }
                } ?>
            </div>
            <!-- row -->

            <nav aria-label="Page navigation" class="pagination_section">
                <ul class="pagination">
                    <?php
                    for ($i = 1; $i <= $totalPages; $i++) {
                    ?>
                        <li><a href="?q=post&per_page=<?= $item_per_page ?>&page=<?= $i ?>"><?= $i ?></a></li>
                    <?php } ?>
                </ul>
            </nav>
            <!-- navigation -->

        </div>
        <!-- col-md-8 -->

        <!-- Right Content -->
        <?php include './inc/content_right.php'; ?>
        <!-- End Right Content -->
    </div>
    <!-- row -->

</div>