<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['on'])) {
        $query = "UPDATE `tbl_checkregister` SET `level`='0'";
        $result = $db->update($query);

        if ($result != false) {
            echo '<script> toastr.warning("Đã đóng đăng ký tuyển thành viên!");</script>';
        }
    }

    if (isset($_POST['off'])) {
        $query = "UPDATE `tbl_checkregister` SET `level`='1'";
        $result = $db->update($query);

        if ($result != false) {
            echo '<script> toastr.success("Đã mở đăng ký tuyển thành viên!");</script>';
        }
    }
}
?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- [ breadcrumb ] start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="page-header-title" style="font-family: 'Times New Roman', Times, serif;">
                                            <h5>Trang chủ</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="homepage.php"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#" style="font-family: 'Times New Roman', Times, serif;">Trang chủ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <!-- product profit start -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card prod-p-card bg-c-red">
                                    <div class="card-body">
                                        <div class="row align-items-center m-b-25">
                                            <div class="col">
                                                <h6 class="m-b-5 text-white">Thành viên</h6>
                                                <h3 class="m-b-0 text-white">
                                                    <?php echo $manageMember->countMenber() ?>
                                                </h3>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users text-c-red f-18"></i>
                                            </div>
                                        </div>
                                        <p class="m-b-0 text-white">Thành viên hiện có <span class="label label-danger m-r-10"> <?php echo $manageMember->countMenber() ?></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card prod-p-card bg-c-blue">
                                    <div class="card-body">
                                        <div class="row align-items-center m-b-25">
                                            <div class="col">
                                                <h6 class="m-b-5 text-white">Cộng tác viên</h6>
                                                <h3 class="m-b-0 text-white">
                                                    <?php echo $manageMember->countCollaborator() ?>
                                                </h3>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users text-c-blue f-18"></i>
                                            </div>
                                        </div>
                                        <p class="m-b-0 text-white">Cộng tác viên hiện có <span class="label label-primary m-r-10"><?php echo $manageMember->countCollaborator() ?></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card prod-p-card bg-c-green">
                                    <div class="card-body">
                                        <div class="row align-items-center m-b-25">
                                            <div class="col">
                                                <h6 class="m-b-5 text-white">Tuyển TV</h6>
                                                <h3 class="m-b-0 text-white">
                                                    <?php echo $manageMember->countSelectiveMember() ?>
                                                </h3>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-database text-c-green f-18"></i>
                                            </div>
                                        </div>
                                        <p class="m-b-0 text-white">Tuyển thành viên có <span class="label label-success m-r-10"><?php echo $manageMember->countSelectiveMember() ?></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card prod-p-card bg-c-yellow">
                                    <div class="card-body">
                                        <div class="row align-items-center m-b-25">
                                            <div class="col">
                                                <h6 class="m-b-5 text-white">Quản trị viên</h6>
                                                <h3 class="m-b-0 text-white">
                                                    <?php echo $manageMember->countAdministration() ?>
                                                </h3>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-server text-c-yellow f-18"></i>
                                            </div>
                                        </div>
                                        <p class="m-b-0 text-white">Quản trị viên có <span class="label label-warning m-r-10"><?php echo $manageMember->countAdministration() ?></span></p>
                                    </div>
                                </div>
                            </div>

                            <?php if (Session::get('level') == "050301" || Session::get('level') == "0") { ?>
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Chức năng năng cao</h5>
                                            <div class="card-header-right">
                                                <div class="btn-group card-option">
                                                    <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="feather icon-more-horizontal"></i>
                                                    </button>
                                                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                                        <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a>
                                                        </li>
                                                        <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                                        <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="card-body card-block">
                                                        <button type="submit" class="btn btn-warning btn-sm">
                                                            <i class="feather icon-lock"></i> Đang tắt
                                                        </button> Hiển thị trang 404 <br>
                                                        <span style="font-size: 12px; color: green;">Lưu ý: Nếu bặt tính năng 404 website sẽ không hoạt động</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="card-body card-block">
                                                        <form action="?q=homepage" method="post">
                                                            <?php
                                                            $query = "SELECT `level` FROM `tbl_checkregister`";
                                                            $result = $db->select($query);
                                                            $value = $result->fetch_assoc();

                                                            if ($value['level'] == "1") {
                                                            ?>
                                                                <button type="submit" name="on" class="btn btn-success btn-sm">
                                                                    <i class="feather icon-lock"></i></i> Đang bật
                                                                </button> Hiển thị trang form đăng ký thành viên <br>
                                                            <?php } else { ?>
                                                                <button type="submit" name="off" class="btn btn-warning btn-sm">
                                                                    <i class="feather icon-lock"></i></i> Đang tắt
                                                                </button> Hiển thị trang form đăng ký thành viên <br>
                                                            <?php } ?>
                                                        </form>
                                                        <span style="font-size: 12px; color: green;">Lưu ý: Nếu bặt tính năng đóng form thì form đăng ký tại trang chủ sẽ không hoạt động</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- [ Main Content ] end -->