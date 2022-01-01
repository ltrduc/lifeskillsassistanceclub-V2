<?php
if (!isset($_GET['id']) || $_GET['id'] == NULL) {
    echo "<script>window.location='./?q=collaborators';</script>";
} else {
    $id = $_GET['id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idstudent = $_POST['idstudent'];
    $fullname = $_POST['fullname'];
    $birthday = $_POST['birthday'];
    $team = $_POST['team'];
    $phone = $_POST['phone'];
    $facebook = $_POST['facebook'];

    $checkupdatePersonnel = $manageMember->updatePersonnel($id, $idstudent, $fullname, $birthday, $team, $phone, $facebook);
    if (isset($checkupdatePersonnel)) {
        echo $checkupdatePersonnel;
    }
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
                                            <h5 class="m-b-10">Quản Lý Nhân Sự</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Chỉnh sửa nhân sự</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- HIEN THI DANH SACH THONG KE -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <?php
                                    $getPersonnelId = $manageMember->getPersonnelId($id);
                                    if ($getPersonnelId != false) {
                                        $value = $getPersonnelId->fetch_assoc();
                                    }
                                    ?>
                                    <div class="card-header" style="padding-bottom: 10px;">
                                        CHỈNH SỬA NHÂN SỰ - <?php echo $value['idstudent'] ?>
                                    </div>
                                    <div class="card-body pt-1 pb-1">
                                        <div class="modal-body pt-0 pb-0">
                                            <form class="needs-validation" action="" method="POST" novalidate>
                                                <div class="row">
                                                    <div class="col-lg-6 mt-3">
                                                        <label for="fullname">Họ và Tên:</label>
                                                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Nguyễn Văn A" value="<?php echo $value['fullname'] ?>">
                                                    </div>
                                                    <div class="col-lg-6 mt-3">
                                                        <label for="idstudent">Mã số sinh viên:</label>
                                                        <input type="text" class="form-control" name="idstudent" id="idstudent" placeholder="51900001" disabled value="<?php echo $value['idstudent'] ?>">
                                                        <input type="hidden" class="form-control" name="idstudent" id="idstudent" placeholder="51900001" value="<?php echo $value['idstudent'] ?>">
                                                    </div>
                                                    <div class="col-lg-6 mt-3">
                                                        <label for="birthday">Ngày sinh:</label>
                                                        <input type="text" class="form-control" name="birthday" id="birthday" placeholder="DD/MM/YYYY" value="<?php echo $value['birthday'] ?>">
                                                    </div>
                                                    <div class="col-lg-6 mt-3">
                                                        <label for="team">Ban hiện tại:</label>
                                                        <input type="text" class="form-control" name="team" id="team" disabled value="Không">
                                                        <input type="hidden" class="form-control" name="team" id="team" value="<?php echo $value['team'] ?>">
                                                    </div>
                                                    <div class="col-lg-6 mt-3">
                                                        <label for="phone">Số điện thoại:</label>
                                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="0377642847" value="<?php echo $value['phone'] ?>">
                                                    </div>
                                                    <div class="col-6 mt-3">
                                                        <label for="facebook">Link facebook:</label>
                                                        <input type="text" class="form-control" name="facebook" id="facebook" placeholder="https://www.facebook.com/nguyenvana" value="<?php echo $value['facebook'] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer mt-3 pt-2 pb-0">
                                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- KET THUC HIEN THI DANH SÁCH THONG KE -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>