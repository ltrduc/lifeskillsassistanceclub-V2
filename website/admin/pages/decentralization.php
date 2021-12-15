<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['changelevel'])) {
        $idstudent = $_POST['idstudent'];
        $level = $_POST['level'];
        $checkDecentralization = $decentralization->updateLevel($idstudent, $level);
    }

    if (isset($_POST['changepersonnel'])) {
        $idstudent = $_POST['idstudent'];
        $feature = $_POST['feature'];
        $checkDecentralization = $decentralization->updatePersonnel($idstudent, $feature);
    }
}

if (isset($checkDecentralization)) {
    echo $checkDecentralization;
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
                                            <li class="breadcrumb-item"><a href="#" style="font-family: 'Times New Roman', Times, serif;">Phân quyền</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->
                        <div class="col-sm-12">
                            <h5 class="mt-4">PHẦN QUYỀN - CHUYỂN NHÂN SỰ</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 col-sm-12 mt-2">
                                    <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <li><a class="nav-link text-left active" id="phanquyen-tab" data-toggle="pill" href="#phanquyen" role="tab" aria-controls="phanquyen" aria-selected="true">Phần quyền</a></li>
                                        <li><a class="nav-link text-left" id="chuyennhansu-tab" data-toggle="pill" href="#chuyennhansu" role="tab" aria-controls="chuyennhansu" aria-selected="false">Chuyển nhân sự</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-9 col-sm-12 mt-2">
                                    <div class="tab-content pb-0" id="v-pills-tabContent">
                                        <!-- [PHAN QUYEN] -->
                                        <div class="tab-pane fade show active" id="phanquyen" role="tabpanel" aria-labelledby="phanquyen-tab">
                                            <div class="text-center" style="font-weight: bold;">
                                                <h3>PHÂN QUYỀN</h3>
                                            </div>
                                            <form class="needs-validation" action="" method="POST" novalidate>
                                                <div class="row">
                                                    <div class="col-lg-6 mt-3">
                                                        <label for="idstudent">Tên nhân sự:</label>
                                                        <select name="idstudent" class="custom-select" required>
                                                            <option selected value="050301">---Chọn Nhân Sự---</option>
                                                            <?php
                                                            $result = $manageMember->getPersonnel();
                                                            $i = 1;
                                                            if ($result != false) {
                                                                while ($value = $result->fetch_assoc()) {
                                                            ?>
                                                                    <option value="<?php echo $value['idstudent']; ?>"><?php echo $value['fullname']; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 mt-3">
                                                        <label for="level">Phân quyền:</label>
                                                        <select name="level" class="custom-select" required>
                                                            <option selected value="050301">---Phân Quyền Chức Năng---</option>
                                                            <option value="0">0. Admin</option>
                                                            <option value="1">1. Điểm danh</option>
                                                            <option value="2">2. Quản lý bài đăng</option>
                                                            <option value="3">3. Hủy tất cả phân quyền</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer mt-3">
                                                    <button type="submit" name="changelevel" class="btn btn-primary">Lưu thay đổi</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- [KET THUC PHAN QUYEN] -->

                                        <!-- [CHUYEN NHAN SU] -->
                                        <div class="tab-pane fade" id="chuyennhansu" role="tabpanel" aria-labelledby="chuyennhansu-tab">
                                            <div class="text-center" style="font-weight: bold;">
                                                <h3>CHUYỂN NHÂN SỰ</h3>
                                            </div>
                                            <form class="needs-validation" action="" method="POST" novalidate>
                                                <div class="row">
                                                    <div class="col-lg-6 mt-3">
                                                        <label for="idstudent">Tên nhân sự:</label>
                                                        <select name="idstudent" class="custom-select" required>
                                                            <option selected value="050301">---Chọn Nhân Sự---</option>
                                                            <?php
                                                            $result = $manageMember->getPersonnel();
                                                            $i = 1;
                                                            if ($result != false) {
                                                                while ($value = $result->fetch_assoc()) {
                                                            ?>
                                                                    <option value="<?php echo $value['idstudent']; ?>"><?php echo $value['fullname']; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 mt-3">
                                                        <label for="feature">Chuyển nhân sự:</label>
                                                        <select name="feature" class="custom-select" required>
                                                            <option selected value="050301">---Chọn Vị Trí---</option>
                                                            <option value="0">0. Thành viên</option>
                                                            <option value="1">1. Cộng tác viên</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer mt-3">
                                                    <button type="submit" name="changepersonnel" class="btn btn-primary">Lưu thay đổi</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- [KET THUC CHUYEN NHAN SU] -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->