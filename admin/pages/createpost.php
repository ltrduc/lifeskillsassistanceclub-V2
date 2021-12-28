<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $author = $_POST['author'];
    $title = $_POST['title'];
    $postgenre = $_POST['postgenre'];
    $posttype = $_POST['posttype'];
    $contentpost = $_POST['contentpost'];

    $checkPost = $managePost->setPost($author, $title, $postgenre, $posttype, $contentpost);
}

if (isset($checkPost)) {
    echo $checkPost;
}
?>

<section class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Quản lý bài đăng</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Tạo bài đăng</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TẠO DANH SACH BAI DANG -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header" style="padding-bottom: 10px;">
                                        TẠO BÀI ĐĂNG
                                    </div>
                                    <div class="card-body">
                                        <form action="?q=createpost" enctype="multipart/form-data" method="POST">
                                            <div class="row">
                                                <!-- [Nguoi dang] -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="author">Người đăng: </label>
                                                        <input type="text" disabled class="form-control" name="author" value="<?php echo Session::get('fullname') ?>">
                                                        <input type="hidden" class="form-control" name="author" value="<?php echo Session::get('fullname') ?>">
                                                    </div>
                                                </div>
                                                <!-- [End Nguoi dang] -->

                                                <!-- Tieu de -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="title">Tên Bài viết: </label>
                                                        <input type="text" class="form-control" name="title" placeholder="Vui lòng nhập tên bài viết">
                                                    </div>
                                                </div>
                                                <!-- Tieu de -->

                                                <!-- [Thể loại] -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="postgenre">Thể loại: </label>
                                                        <select name="postgenre" class="custom-select">
                                                            <option selected="" value="">---Chọn Thể Loại---</option>
                                                            <?php
                                                            $getPostgenres = $managePost->getPostgenres();
                                                            if ($getPostgenres && $getPostgenres->num_rows > 0) {
                                                                while ($value = $getPostgenres->fetch_assoc()) {
                                                            ?>
                                                                    <option value="<?php echo $value['postgenre']; ?>">
                                                                        <?php echo $value['postgenre']; ?>
                                                                    </option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- [Loại Tin Tức] -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="posttype">Loại Tin Tức: </label>
                                                        <select name="posttype" class="custom-select">
                                                            <option selected="" value="">---Chọn Loại Tin Tức---</option>
                                                            <option value="Quan trọng">Quan trọng</option>
                                                            <option value="Nổi bật">Nổi bật</option>
                                                            <option value="Không nổi bật">Không nổi bật</option>
                                                            <option value="Lịch trực">Lịch trực</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="images">Tải ảnh: </label>
                                                        <div class="custom-file">
                                                            <input type="file" name="images" class="custom-file-input" id="images">
                                                            <label class="custom-file-label" for="images">Chọn
                                                                ảnh</label>
                                                        </div>
                                                        <script>
                                                            // Add the following code if you want the name of the file appear on select
                                                            $(".custom-file-input").on("change", function() {
                                                                var fileName = $(this).val().split("\\").pop();
                                                                $(this).siblings(".custom-file-label").addClass(
                                                                    "selected").html(fileName);
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Nội dung bài viết: </label>
                                                        <textarea name="contentpost" id="contentpost"></textarea>
                                                        <script>
                                                            CKEDITOR.replace('contentpost');
                                                        </script>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary">Đăng bài</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- KET THUC TẠO DANH SÁCH BAI DANG -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>