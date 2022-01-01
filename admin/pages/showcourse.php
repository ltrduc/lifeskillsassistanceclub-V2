<?php
if (
    (!isset($_GET['schoolyear']) || $_GET['schoolyear'] == NULL) ||
    (!isset($_GET['semesters']) || $_GET['semesters'] == NULL) ||
    (!isset($_GET['dates']) || $_GET['dates'] == NULL)
) {
    echo "<script>window.location='./?q=listcourse';</script>";
} else {
    $schoolyear = $_GET['schoolyear'];
    $semesters = $_GET['semesters'];
    $dates = $_GET['dates'];
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $checkmanageCourse = $manageCourse->deleteCourse($id);
    if (isset($checkmanageCourse)) {
        echo $checkmanageCourse;
        echo '<script>setTimeout(() => { window.location = "?q=showcourse&schoolyear=' . $schoolyear . '&semesters=' . $semesters . '&dates=' . $dates . '" }, 500); </script> ';
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
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Quản lý buổi học</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="">Lịch học ngày <?php echo $fm->formatDate($dates); ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header" style="padding-bottom: 10px;">
                                        <div class="float-left">
                                            LỊCH HỌC NGÀY <?php echo $fm->formatDate($dates); ?>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div class="calendar-scroll">
                                                <table id="simpletable" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="simpletable_info">
                                                    <thead>
                                                        <tr>
                                                            <th scope="row " style="width: 5%; ">#</th>
                                                            <th scope="row " style="width: 10%; ">Môn học</th>
                                                            <th scope="row " style="width: 10%; ">Nhóm</th>
                                                            <th scope="row " style="width: 10%; ">Buổi học</th>
                                                            <th scope="row " style="width: 10%; ">Ngày học</th>
                                                            <th scope="row " style="width: 10%; ">Địa điểm</th>
                                                            <th scope="row " style="width: 15%; ">Giảng viên</th>
                                                            <?php if (Session::get('level') == "050301" || Session::get('level') == "0") { ?>
                                                                <th scope="row " class="text-center" style="width: 3%; ">Xóa</th>
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="myTable">
                                                        <?php
                                                        $i = 1;
                                                        $getCourse = $manageCourse->getCourse($schoolyear, $semesters, $dates);
                                                        if ($getCourse && $getCourse->num_rows > 0) {
                                                            while ($value = $getCourse->fetch_assoc()) {
                                                        ?>
                                                                <tr>
                                                                    <td style="font-weight: bold; "><?php echo $i++; ?></td>
                                                                    <td><?php echo $value['subjects']; ?></td>
                                                                    <td><?php echo $value['group']; ?></td>
                                                                    <td><?php echo $value['period']; ?></td>
                                                                    <td><?php echo $fm->formatDate($value['dates']); ?></td>
                                                                    <td><?php echo $value['local']; ?></td>
                                                                    <td><?php echo $value['teacher']; ?></td>
                                                                    <?php if (Session::get('level') == "050301" || Session::get('level') == "0") { ?>
                                                                        <td class="text-center">
                                                                            <a class="btn btn-danger" style="margin: 0; padding: 2px 10px;" onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" href="?q=showcourse&id=<?php echo $value['id']; ?>&schoolyear=<?php echo $value['schoolyear']; ?>&semesters=<?php echo $value['semesters']; ?>&dates=<?php echo $value['dates']; ?>" type="submit"><i class="fa fa-trash" style="margin-right: 0;"></i></a>
                                                                        </td>
                                                                    <?php } ?>
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

</section>