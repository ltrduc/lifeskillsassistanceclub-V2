<div class="col-md-4">
    <div class="widget">
        <?php
        $getQuanTrong = $managePost->getQuanTrong();
        if ($getQuanTrong && $getQuanTrong->num_rows > 0) {
        ?>
            <div class="widget_title widget_black">
                <h2><a href="?q=category&posttype=Quan trọng">Tin quan trọng</a></h2>
            </div>
        <?php } ?>
        <?php
        if ($getQuanTrong) {
            while ($showQuanTrong = $getQuanTrong->fetch_assoc()) {
        ?>
                <div class="media">
                    <div class="media-left">
                        <a href="?q=viewpost&id=<?php echo $showQuanTrong['id'] ?>"><img class="media-object" src="../admin/<?php echo $showQuanTrong['images'] ?>" height="107" width="160"></a>
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">
                            <a href="?q=viewpost&id=<?php echo $showQuanTrong['id'] ?>" target="_self" style="text-transform: uppercase;"><?php echo $fm->textShorten($showQuanTrong['title'], 60); ?></a>
                        </h3>
                        <span class="media-date"><a style="font-size: 12px;"><?php echo $showQuanTrong['time'] ?>,
                                by:</a>
                            <a style="font-size: 12px;"><?php echo $showQuanTrong['author'] ?></a></span>
                        <div class="widget_article_social">
                            <a style="font-size: 10px;" href="?q=viewpost&id=<?php echo $showQuanTrong['id'] ?>"><i class="fa fa-eye"></i>XEM CHI TIẾT >>></a>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
        <?php if ($getQuanTrong) { ?>
            <p class="widget_divider"><a href="?q=category&posttype=Quan trọng" target="_self">XEM THÊM&nbsp;&raquo;</a></p>
        <?php } ?>
    </div>

    <div class="widget">
        <?php
        $getLichTruc = $managePost->getLichTruc();
        if ($getLichTruc && $getLichTruc->num_rows > 0) {
        ?>
            <div class="widget_title widget_black">
                <h2><a href="?q=category&posttype=Lịch trực">Lịch trực</a></h2>
            </div>
        <?php } ?>
        <?php
        if ($getLichTruc) {
            while ($showLichTruc = $getLichTruc->fetch_assoc()) {
        ?>
                <div class="media">
                    <div class="media-left">
                        <a href="?q=viewpost&id=<?php echo $showLichTruc['id'] ?>"><img class="media-object" src="../admin/<?php echo $showLichTruc['images'] ?>" height="107" width="160"></a>
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">
                            <a href="?q=viewpost&id=<?php echo $showLichTruc['id'] ?>" target="_self" style="text-transform: uppercase;"><?php echo $fm->textShorten($showLichTruc['title'], 60); ?></a>
                        </h3>
                        <span class="media-date"><a style="font-size: 12px;"><?php echo $showLichTruc['time'] ?>,
                                by:</a>
                            <a style="font-size: 12px;"><?php echo $showLichTruc['author'] ?></a></span>

                        <div class="widget_article_social">
                            <a style="font-size: 10px;" href="?q=viewpost&id=<?php echo $showLichTruc['id'] ?>"><i class="fa fa-eye"></i>XEM CHI TIẾT >>></a>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
        <?php if ($getLichTruc) { ?>
            <p class="widget_divider"><a href="?q=category&posttype=Lịch trực" target="_self">XEM THÊM&nbsp;&raquo;</a></p>
        <?php } ?>
    </div>

    <?php
    $checkPost = "SELECT * FROM tbl_post WHERE `status` = '1'";
    $returnCheck = $db->select($checkPost);
    if ($returnCheck && $returnCheck->num_rows > 0) {
    ?>
        <aside class="single_sidebar_widget post_category_widget">
            <h2 class="w_title">Thể loại bài đăng</h2>
            <ul class="list cat-list">
                <?php
                $countPostgenres = $managePost->countPostgenres();
                if ($countPostgenres && $countPostgenres->num_rows > 0) {
                    while ($v_countPostgenres = $countPostgenres->fetch_assoc()) {
                ?>
                        <li>
                            <a href="?q=category&postgenre=<?php echo $v_countPostgenres['postgenre'] ?>" class="d-flex justify-content-between">
                                <p><?php echo $v_countPostgenres['postgenre'] ?></p>
                                <p>(<?php echo $v_countPostgenres['countpostgenre'] ?>)</p>
                            </a>
                        </li>
                <?php }
                } ?>
            </ul>
            <div class="br"></div>
        </aside>
    <?php } ?>
</div>