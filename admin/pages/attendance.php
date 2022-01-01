<?php
if (isset($_POST['setattendance'])) {
    if (empty($_POST['schoolyear']) || empty($_POST['semester']) || empty($_POST['date']) || empty($_POST['shift'])) {
        echo '<script> toastr.warning("Vui lòng nhập đầy đủ dữ liệu!");</script>';
    } else if (empty($_POST['attendance'])) {
        echo '<script> toastr.warning("Chưa có thành viên nào điểm danh!");</script>';
    } else {
        foreach ($_POST['attendance'] as $id => $attendance) {;
            $idstudent = $_POST['idstudent'][$id];
            $fullname = $_POST['fullname'][$id];
            $schoolyear = $_POST['schoolyear'];
            $semester = $_POST['semester'];
            $date = $_POST['date'];
            $shift = $_POST['shift'];

            $checkmanageAttendance = $manageAttendance->setAttendance($idstudent, $fullname, $schoolyear, $semester, $date, $shift, $attendance);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['setShoolYear'])) {
        $schoolyear = $_POST['schoolyear'];
        $checkmanageShoolYear = $manageShoolYear->setShoolYear($schoolyear);
    }

    if (isset($_POST['deleteShoolYear'])) {
        $schoolyear = $_POST['schoolyear'];
        $checkmanageShoolYear = $manageShoolYear->deleteShoolYear($schoolyear);
    }
}

if (isset($checkmanageShoolYear)) {
    echo $checkmanageShoolYear;
}

if (isset($checkmanageAttendance)) {
    echo $checkmanageAttendance;
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
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5>Quản lý buổi học</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#">Quản lý điểm danh</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- DANG KY CA TRUC -->
                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="float-right">
                                                    <ul style="background: none; padding: 0;" class="nav nav-pills" id="pills-tab" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link text-left active" id="attendance-tab" data-toggle="pill" href="#attendance" role="tab" aria-controls="attendance" aria-selected="true">Điểm danh</a>
                                                        </li>
                                                        <?php if (Session::get('level') == "050301" || Session::get('level') == "0") { ?>
                                                            <li class="nav-item">
                                                                <a class="nav-link text-left" id="schoolyear-tab" data-toggle="pill" href="#schoolyear" role="tab" aria-controls="schoolyear" aria-selected="false">Quản lý năm học</a>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- KET THUC DANG KY CA TRUC -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div style="border-radius: 10px;" class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade active show" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
                                        <form action="?q=attendance" method="POST">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <!-- NUT DIEM DANH -->
                                                    <div class="float-left p-2">
                                                        <div class="text-center">
                                                            <h3>ĐIỂM DANH CA TRỰC</h3>
                                                        </div>
                                                    </div>
                                                    <div class="text-right" style="font-weight: bold;">
                                                        <button type="submit" name="setattendance" value="submit" class="btn btn-success">
                                                            <i class="fa fa-edit"></i>&nbsp;Điểm danh
                                                        </button>
                                                    </div>
                                                    <!-- KET THUC NUT DIEM DANH -->

                                                    <!-- [CHON THOI GIAN CA TRUC] -->
                                                    <div class="row mb-3 mt-3">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="schoolyear">Năm học:</label>
                                                                <select name="schoolyear" class="form-control form-control-sm">
                                                                    <option selected value="" class="font-weight-bold">Chọn năm học</option>
                                                                    <?php
                                                                    $getShoolYear = $manageShoolYear->getShoolYear();
                                                                    if ($getShoolYear && $getShoolYear->num_rows > 0) {
                                                                        while ($value = $getShoolYear->fetch_assoc()) {
                                                                    ?>
                                                                            <option value="<?php echo $value['schoolyear']; ?>"><?php echo $value['schoolyear']; ?></option>
                                                                    <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="semester">Học kỳ:</label>
                                                                <select name="semester" class="form-control form-control-sm">
                                                                    <option selected value="" class="font-weight-bold">Chọn học kỳ</option>
                                                                    <option value="Học kỳ 1">Học kỳ 1</option>
                                                                    <option value="Học kỳ 2">Học kỳ 2</option>
                                                                    <option value="Học kỳ hè">Học kỳ hè</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="date">Ngày trực:</label>
                                                                <input style="height: 42.8px;" class="form-control form-control-sm" type="date" id="date" name="date">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label for="shift">Ca trực:</label>
                                                                <select name="shift" class="form-control form-control-sm">
                                                                    <option selected value="" class="font-weight-bold">Chọn ca trực</option>
                                                                    <option value="Ca 1">Ca 1</option>
                                                                    <option value="Ca 2">Ca 2 </option>
                                                                    <option value="Ca 3">Ca 3 </option>
                                                                    <option value="Ca 4">Ca 4 </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- [KET CHON THOI GIAN CA TRUC] -->

                                                    <!-- [BANG DIEM DIEM DANH] -->
                                                    <div class="table-responsive">
                                                        <div class="session-scroll">
                                                            <table id="simpletable" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="simpletable_info">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="row " style="width: 5%; ">#</th>
                                                                        <th scope="row " style="width: 10%; ">MSSV</th>
                                                                        <th scope="row " style="width: 25%; ">Họ và Tên</th>
                                                                        <th scope="row " style="width: 25%; ">Ban hiện tại</th>
                                                                        <th scope="row " class="text-center" style="width: 10%; ">Có mặt</th>
                                                                        <th scope="row " class="text-center" style="width: 8%; ">Trể</th>
                                                                        <th scope="row " class="text-center" style="width: 8%; ">Vắng</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $counter = 0;
                                                                    $serialnumber = 0;
                                                                    $result = $manageMember->getPersonnel();
                                                                    if ($result != false) {
                                                                        while ($value = $result->fetch_assoc()) {
                                                                            $serialnumber++;
                                                                    ?>
                                                                            <tr>
                                                                                <td style="font-weight: bold; "><?php echo $serialnumber; ?></td>
                                                                                <td><?php echo $value['idstudent']; ?><input type="hidden" name="idstudent[<?php echo $counter ?>]" value="<?php echo $value['idstudent']; ?>"></td>
                                                                                <td><?php echo $value['fullname']; ?><input type="hidden" name="fullname[<?php echo $counter ?>]" value="<?php echo $value['fullname']; ?>"></td>
                                                                                <td><?php echo $value['team']; ?></td>
                                                                                <td class="text-center"><input type="radio" name="attendance[<?php echo $counter ?>]" value="Present"></td>
                                                                                <td class="text-center"><input type="radio" name="attendance[<?php echo $counter ?>]" value="Late"></td>
                                                                                <td class="text-center"><input type="radio" name="attendance[<?php echo $counter ?>]" value="Absent"></td>
                                                                            </tr>
                                                                    <?php $counter++;
                                                                        }
                                                                    } ?>
                                                                </tbody>
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="row " style="width: 5%; ">#</th>
                                                                        <th scope="row " style="width: 10%; ">MSSV</th>
                                                                        <th scope="row " style="width: 25%; ">Họ và Tên</th>
                                                                        <th scope="row " style="width: 25%; ">Ban hiện tại</th>
                                                                        <th scope="row " class="text-center" style="width: 10%; ">Có mặt</th>
                                                                        <th scope="row " class="text-center" style="width: 8%; ">Trể</th>
                                                                        <th scope="row " class="text-center" style="width: 8%; ">Vắng</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- [KET THUC BANG DIEM DIEM DANH] -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <?php if (Session::get('level') == "050301" || Session::get('level') == "0") { ?>
                                        <!-- [TAO NIEN HOC] -->
                                        <div class="tab-pane fade" id="schoolyear" role="tabpanel" aria-labelledby="schoolyear-tab">
                                            <div class="row">
                                                <div class="col-lg-6 mt-3">
                                                    <form action="?q=attendance" method="POST">
                                                        <div class="form-group">
                                                            <label for="schoolyear">Tạo năm học:</label>
                                                            <input type="text" class="form-control" name="schoolyear" id="schoolyear" aria-describedby="warning6" placeholder="2021-2022">
                                                        </div>
                                                        <div class="form-group">
                                                            <button name="setShoolYear" type="submit " class="btn btn-primary">Tạo năm học</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-lg-6 mt-3">
                                                    <form action="?q=attendance" method="POST">
                                                        <div class="form-group">
                                                            <label for="schoolyear">Xóa năm học:</label>
                                                            <select name="schoolyear" class="custom-select">
                                                                <option selected value="" class="font-weight-bold">Chọn năm học</option>
                                                                <?php
                                                                $getShoolYear = $manageShoolYear->getShoolYear();
                                                                if ($getShoolYear && $getShoolYear->num_rows > 0) {
                                                                    while ($value = $getShoolYear->fetch_assoc()) {
                                                                ?>
                                                                        <option value="<?php echo $value['schoolyear']; ?>"><?php echo $value['schoolyear']; ?></option>
                                                                <?php }
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <button onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" name="deleteShoolYear" type="submit " class="btn btn-warning">Xóa năm học</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- [KET THUC TAO NIEN HOC] -->
                                    <?php } ?>

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
<!-- [ Main Content ] end -->