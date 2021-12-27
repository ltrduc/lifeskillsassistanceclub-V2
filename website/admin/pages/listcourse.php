<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['setsubjects'])) {
        $subjects = $_POST['subjects'];
        $checkmanageSubjects = $manageSubjects->setSubjects($subjects);
    }

    if (isset($_POST['deletesubjects'])) {
        $subjects = $_POST['subjects'];
        $checkmanageSubjects = $manageSubjects->deleteSubjects($subjects);
    }

    if (isset($_POST['addcourse'])) {
        $subjects = $_POST['subjects'];
        $group = $_POST['group'];
        $period = $_POST['period'];
        $local = $_POST['local'];
        $dates = $_POST['dates'];
        $semester = $_POST['semester'];
        $schoolyear = $_POST['schoolyear'];
        $teacher = $_POST['teacher'];

        $checkmanageCourse = $manageCourse->setCourse($subjects, $group, $period, $local, $dates, $semester, $schoolyear, $teacher);
    }
}

if (isset($_GET["schoolyear"]) && isset($_GET["semesters"]) && isset($_GET["dates"])) {
    $schoolyear = $_GET['schoolyear'];
    $semesters = $_GET['semesters'];
    $dates = $_GET['dates'];
    $delmanageCourse = $manageCourse->deleteStartDay($schoolyear, $semesters, $dates);
}

if (isset($checkmanageCourse)) {
    echo $checkmanageCourse;
}

if (isset($checkmanageSubjects)) {
    echo $checkmanageSubjects;
}

if (isset($delmanageCourse)) {
    echo $delmanageCourse;
    echo "<script> setTimeout(() => { window.location = '?q=listcourse'; }, 1000); </script>";
}
?>

<section class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <?php if (Session::get('level') == "050301" || Session::get('level') == "0") { ?>
                        <!-- [TAO LOP HỌC] -->
                        <div class="modal fade" id="calendar" tabindex="-1" role="dialog" aria-labelledby="calendarLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="calendarLabel">Tạo lịch học</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="?q=listcourse" method="POST">
                                            <div class="row">
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        <label for="subjects">Môn học: </label>
                                                        <select name="subjects" class="form-control">
                                                            <option selected value="">---Chọn Môn Học---</option>
                                                            <?php
                                                            $getSubjects = $manageSubjects->getSubjects();
                                                            if ($getSubjects && $getSubjects->num_rows > 0) {
                                                                while ($value = $getSubjects->fetch_assoc()) {
                                                            ?>
                                                                    <option value="<?php echo $value['subjects']; ?>"><?php echo $value['subjects']; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        <label for="group">Nhóm: </label>
                                                        <input type="text" class="form-control" name="group" id="group" aria-describedby="warning6" placeholder="01">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        <label for="teacher">Tên Giảng viên: </label>
                                                        <input type="text" class="form-control" name="teacher" id="teacher" aria-describedby="warning6" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                    <label for="period">Buổi học: </label>
                                                    <select name="period" class="form-control mb-3">
                                                        <option selected value="">---Chọn Số Buổi Học---</option>
                                                        <option value="Sáng - Buổi 1">Sáng - Buổi 1</option>
                                                        <option value="Sáng - Buổi 2">Sáng - Buổi 2</option>
                                                        <option value="Chiều - Buổi 1">Chiều - Buổi 1</option>
                                                        <option value="Chiều - Buổi 2">Chiều - Buổi 2</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm">
                                                    <label for="local">Địa điểm</label>
                                                    <select name="local" class="form-control mb-3">
                                                        <option selected value="">---Chọn Địa Điểm---</option>
                                                        <option value="10A">Hội trường 10A</option>
                                                        <option value="6B">Hội trường 6B</option>
                                                        <option value="Khác">Khác</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm">
                                                    <label for="dates">Ngày bắt đầu:</label>
                                                    <input class="form-control" type="date" id="dates" name="dates">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm">
                                                    <label for="semester">Học kỳ</label>
                                                    <select name="semester" class="form-control mb-3">
                                                        <option selected value="">---Chọn Học Kỳ---</option>
                                                        <option value="Học kỳ 1">Học kỳ 1</option>
                                                        <option value="Học kỳ 2">Học kỳ 2</option>
                                                        <option value="Học kỳ hè">Học kỳ hè</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm">
                                                    <label for="schoolyear">Niên học:</label>
                                                    <select name="schoolyear" class="form-control">
                                                        <option selected value="">---Chọn Niên Học---</option>
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

                                            <div class="modal-footer">
                                                <div class="form-group">
                                                    <button name="addcourse" type="submit" class="btn btn-primary">Tạo mới
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- KET THUC TAO LOP HỌC -->

                        <!-- TAO MON HỌC -->
                        <div class="modal fade" id="subjects" tabindex="-1" role="dialog" aria-labelledby="subjectsLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="subjectsLabel">Quản lý môn học</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-6 mt-3">
                                                <form action="?q=listcourse" method="POST">
                                                    <div class="form-group">
                                                        <label for="subjects">Tạo môn học:</label>
                                                        <input type="text" class="form-control" name="subjects" id="subjects" aria-describedby="warning6" placeholder="Thái độ sống 1">
                                                    </div>
                                                    <div class="form-group">
                                                        <button name="setsubjects" type="submit " class="btn btn-primary">Tạo môn học</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <form action="?q=listcourse" method="POST">
                                                    <div class="form-group">
                                                        <label for="subjects">Xóa môn học:</label>
                                                        <select name="subjects" class="custom-select">
                                                            <option selected value="">---Chọn Môn Học---</option>
                                                            <?php
                                                            $getSubjects = $manageSubjects->getSubjects();
                                                            if ($getSubjects && $getSubjects->num_rows > 0) {
                                                                while ($value = $getSubjects->fetch_assoc()) {
                                                            ?>
                                                                    <option value="<?php echo $value['subjects']; ?>"><?php echo $value['subjects']; ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <button onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" name="deletesubjects" type="submit " class="btn btn-warning">Xóa môn học</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- KET THUC TAO MON HỌC -->
                    <?php } ?>

                    <div class="page-wrapper">
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Quản lý lịch học</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="">Lịch học</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <?php if (Session::get('level') == "050301" || Session::get('level') == "0") { ?>
                                            <!-- DANG KY LOP HOC -->
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <div class="float-right">
                                                        <button class="btn btn-warning" data-toggle="modal" data-target="#subjects"><i class="fa fa-edit"></i>Quản lý môn học</button>
                                                        <button class="btn btn-danger" data-toggle="modal" data-target="#calendar"><i class="fa fa-edit"></i>Tạo lịch học</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- KET THUC DANG KY LOP HOC -->
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header" style="padding-bottom: 10px;">
                                        <div class="float-left">
                                            DANH SÁCH LỊCH HỌC
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div class="calendar-scroll">
                                                <table id="simpletable" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="simpletable_info">
                                                    <thead>
                                                        <tr>
                                                            <th scope="row " style="width: 5%; ">#</th>
                                                            <th scope="row " style="width: 10%; ">Ngày học</th>
                                                            <th scope="row " style="width: 10%; ">Học kỳ</th>
                                                            <th scope="row " style="width: 10%; ">năm học</th>
                                                            <th scope="row " class="text-center" style="width: 3%; ">Thao tác</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="myTable">
                                                        <?php
                                                        $i = 1;
                                                        $getStartDay = $manageCourse->getStartDay();
                                                        if ($getStartDay && $getStartDay->num_rows > 0) {
                                                            while ($value = $getStartDay->fetch_assoc()) {
                                                        ?>
                                                                <tr>
                                                                    <td style="font-weight: bold; "><?php echo $i++; ?></td>
                                                                    <td><?php echo $fm->formatDate($value['dates']) ?></td>
                                                                    <td><?php echo $value['semesters']; ?></td>
                                                                    <td><?php echo $value['schoolyear']; ?></td>
                                                                    <td class="text-center">
                                                                        <a class="btn btn-primary" style="margin: 0; padding: 2px 15px;" href="?q=showcourse&schoolyear=<?php echo $value['schoolyear']; ?>&semesters=<?php echo $value['semesters']; ?>&dates=<?php echo $value['dates']; ?>" type="submit"><i class="fa fa-info" style="margin-right: 0;"></i></a>
                                                                        <?php if (Session::get('level') == "050301" || Session::get('level') == "0") { ?>
                                                                            <a class="btn btn-danger" style="margin: 0; padding: 2px 10px;" onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" href="?q=listcourse&schoolyear=<?php echo $value['schoolyear']; ?>&semesters=<?php echo $value['semesters']; ?>&dates=<?php echo $value['dates']; ?>" type="submit"><i class="fa fa-trash" style="margin-right: 0;"></i></a>
                                                                        <?php } ?>
                                                                    </td>
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
            </div>
        </div>
    </div>
</section>