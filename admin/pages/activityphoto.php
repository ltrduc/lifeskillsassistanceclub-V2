<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $checkAtyPhoto = $activityPhoto->setActivityPhoto();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $checkAtyPhoto = $activityPhoto->deleteActivityPhoto($id);
}

if (isset($checkAtyPhoto)) {
    echo $checkAtyPhoto;
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
                                            <h5 class="m-b-10">Ảnh hoạt động</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Danh sách ảnh</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- HOẠT ĐỘNG -->
                        <form action="?q=activityphoto" enctype="multipart/form-data" method="POST">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header pb-2">
                                            <div class="row">
                                                <div class="col-lg-6 p-2">
                                                    CẬP NHẬT HOẠT ĐỘNG
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div id="simpletable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                <div class="row">
                                                    <div class="col-lg-12 mt-3">
                                                        <label for="images">Tải ảnh: </label>
                                                        <div class="custom-file p-2">
                                                            <input type="file" name="images" class="custom-file-input" id="images">
                                                            <label style="height: 40px;" class="custom-file-label p-2" for="images">Chọn ảnh</label>
                                                        </div>
                                                        <script>
                                                            // Add the following code if you want the name of the file appear on select
                                                            $(".custom-file-input").on("change", function() {
                                                                var fileName = $(this).val().split("\\").pop();
                                                                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- KET THUC HOẠT ĐỘNG -->

                        <!-- HIEN THI ANH HOAT DONG -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header" style="padding-bottom: 10px;">
                                        ẢNH HOẠT ĐỘNG
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php
                                            $getImages = $activityPhoto->getImages();
                                            if ($getImages) {
                                                while ($value = $getImages->fetch_assoc()) {
                                            ?>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="card">
                                                            <img class="card-img-top img-fluid" src="<?php echo $value['images'] ?>">
                                                            <div class="card-body pl-0">
                                                                <a href="?q=activityphoto&id=<?php echo $value['id'] ?>" class="btn btn-primary">Xóa ảnh hoạt động</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- KET THUC HIEN THI ANH HOAT DONG -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>