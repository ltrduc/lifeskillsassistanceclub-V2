<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $oldpwd = $_POST['oldpwd'];
    $newpwd = $_POST['newpwd'];
    $renewpwd = $_POST['renewpwd'];

    $checkPassword = $changePassword->changePassword($user, $oldpwd, $newpwd, $renewpwd);
}

if (isset($checkPassword)) {
    echo $checkPassword;
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
                                            <h5 class="m-b-10">Trang chủ</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Đổi mật khẩu</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- DOI MAT KHAU -->
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>THAY ĐỔI MẬT KHẨU</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="user">Mã số sinh viên</label>
                                                        <input type="text" disabled class="form-control" name="user" placeholder="Nhập mã số sinh viên" value="<?php echo Session::get('idstudent') ?>">
                                                        <input type="hidden" class="form-control" name="user" placeholder="Nhập mã số sinh viên" value="<?php echo Session::get('idstudent') ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="oldpwd">Mật khẩu cũ</label>
                                                        <input type="password" class="form-control" name="oldpwd" placeholder="Nhập mật khẩu cũ">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="newpwd">Mật khẩu mới</label>
                                                        <input type="password" class="form-control" name="newpwd" placeholder="Nhập mật khẩu mới">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="renewpwd">Nhập lại mật khẩu mới</label>
                                                        <input type="password" class="form-control" name="renewpwd" placeholder="Nhập lại mật khẩu mới">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- KET THUC DOI MAT KHAU -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>