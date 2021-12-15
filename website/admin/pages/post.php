<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['setPostgenres'])) {
        $postgenre = $_POST['postgenre'];
        $checkPostgenre = $managePost->setPostgenres($postgenre);
    }

    if (isset($_POST['deletePostgenres'])) {
        $postgenre = $_POST['postgenre'];
        $checkPostgenre = $managePost->deletePostgenres($postgenre);
    }
}

if (isset($_GET['warningId'])) {
    $id = $_GET['warningId'];
    $checkPostgenre = $managePost->statusPost($id, 1);
}

if (isset($_GET['successId'])) {
    $id = $_GET['successId'];
    $checkPostgenre = $managePost->statusPost($id, 0);
}

if (isset($_GET['idPost'])) {
    $idPost = $_GET['idPost'];
    $checkPostgenre = $managePost->deletePost($idPost);
}

if (isset($checkPostgenre)) {
    echo $checkPostgenre;
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
                                    <div class="col-md-6">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Quản lý bài đăng</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Danh sách bài đăng</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="float-right">
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#postgenre"><i class="fa fa-edit"></i>&nbsp; Thể loại</button>
                                            <a class="btn btn-primary" style="color: white;" href="?q=createpost"><i class="fa fa-edit"></i>&nbsp; Tạo bài đăng</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- HIEN THI DANH SACH BAI DANG -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header" style="padding-bottom: 10px;">
                                        DANH SÁCH BÀI ĐĂNG
                                    </div>
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <div id="simpletable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="simpletable" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="simpletable_info">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 5%;" scope="row">#</th>
                                                                    <th style="width: 10%;" scope="row">Người đăng </th>
                                                                    <th style="width: 10%;" scope="row">Tên bài viết</th>
                                                                    <th style="width: 10%;" scope="row">Thể loại</th>
                                                                    <th style="width: 10%;" scope="row">Loại Tin tức</th>
                                                                    <th style="width: 10%;" scope="row">Ngày đăng </th>
                                                                    <th style="width: 5%;" class="text-center" scope="row">Status</th>
                                                                    <th style="width: 5%;" class="text-center" scope="row">Thao tác</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                $result = $managePost->getPost();
                                                                if ($result != false) {
                                                                    while ($value = $result->fetch_assoc()) {
                                                                ?>
                                                                        <tr>
                                                                            <td style="font-weight: bold; "> <?php echo $i++; ?>
                                                                            </td>
                                                                            <td><?php echo $value['author']; ?> </td>
                                                                            <td><?php echo $fm->textShorten($value['title'], 35); ?></td>
                                                                            <td><?php echo $value['postgenre']; ?> </td>
                                                                            <td><?php echo $value['posttype']; ?> </td>
                                                                            <td><?php echo $fm->textShorten($value['time'], 15); ?></td>
                                                                            <?php if ($value['status'] == 0) { ?>
                                                                                <td class="text-center"><span class="pcoded-badge label label-danger">0</span></td>
                                                                            <?php } else { ?>
                                                                                <td class="text-center"><span class="pcoded-badge label label-success">1</span></td>
                                                                            <?php } ?>
                                                                            <td class="text-center">
                                                                                <?php if ($value['status'] == 0) { ?>
                                                                                    <a class="btn btn-success" href="?q=post&warningId=<?php echo $value['id']; ?>" style="margin: 0; padding: 2px 10px;" type="submit"><i class="fa fa-check" style="margin-right: 0;"></i></a>
                                                                                <?php } else { ?>
                                                                                    <a class="btn btn-warning" href="?q=post&successId=<?php echo $value['id']; ?>" style="margin: 0; padding: 2px 12px;" type="submit"><i class="fa fa-info" style="margin-right: 0;"></i></a>
                                                                                <?php } ?>
                                                                                <a class="btn btn-primary" style="margin: 0; padding: 2px 10px;" href="?q=updatepost&id=<?php echo $value['id']; ?>" type="submit"><i class="fa fa-edit" style="margin-right: 0;"></i></a>
                                                                                <a class="btn btn-danger" style="margin: 0; padding: 2px 10px;" onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" href="?q=post&idPost=<?php echo $value['id']; ?>" type="submit"><i class="fa fa-trash" style="margin-right: 0;"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                <?php }
                                                                } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- KET THUC HIEN THI DANH SÁCH BAI DANG -->

                        <!-- THE LOAI-->
                        <div class="row">
                            <div class="col-sm-12">
                                <!--  THE LOAI BAI VIET] -->
                                <div class="modal fade" id="postgenre" tabindex="-1" role="dialog" aria-labelledby="postgenreLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="postgenreLabel">Quản lý thể loại
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12 mt-3">
                                                        <form action="?q=post" method="POST">
                                                            <div class="form-group">
                                                                <label for="postgenre">Tạo thể loại:</label>
                                                                <input type="text" class="form-control" name="postgenre" id="postgenre" aria-describedby="warning6" placeholder="Sự kiện">
                                                            </div>
                                                            <div class="form-group">
                                                                <button name="setPostgenres" type="submit " class="btn btn-primary">Tạo thể loại</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <form action="?q=post" method="POST">
                                                            <div class="form-group">
                                                                <label for="postgenre">Xóa thể loại:</label>
                                                                <select name="postgenre" class="custom-select">
                                                                    <option selected="" value="">---Chọn Thể Loại---
                                                                    </option>
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
                                                            <div class="form-group">
                                                                <button onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" name="deletePostgenres" type="submit " class="btn btn-warning">Xóa thể loại</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- KET THUC THE LOAI BAI VIET -->
                            </div>
                        </div>
                        <!-- KET THUC THE LOAI-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>