<?php
if (isset($_GET['schoolyear']) && isset($_GET['semester'])) {
    $schoolyear = $_GET['schoolyear'];
    $semester = $_GET['semester'];

    $checkmanageStatistical = $manageStatistical->deleteListStatistical($schoolyear, $semester);
}

if (isset($checkmanageStatistical)) {
    echo $checkmanageStatistical;
}
?>

<div class="pcoded-main-container">
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
                                            <h5 class="m-b-10">Quản lý buổi học</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="">Thống kê điểm danh</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3 class="mt-4 text-center">DANH SÁCH ĐIỂM DANH THEO HỌC KỲ</h3>
                        <hr>
                        <div class="row">
                            <?php
                            $getAttendance = $manageAttendance->getAttendance();
                            if ($getAttendance && $getAttendance->num_rows > 0) {
                                $getListStatistical = $manageStatistical->getListStatistical();
                                if ($getListStatistical && $getListStatistical->num_rows > 0) {
                                    while ($value = $getListStatistical->fetch_assoc()) {
                            ?>
                                        <div class="col-lg-3 col-md-4 col-ms-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title" style="text-transform: uppercase;">Năm học <?php echo $value['schoolyear']; ?></h5>
                                                    <p class="card-text"><?php echo $value['semester']; ?></p>
                                                    <a href="?q=showstatistical&schoolyear=<?php echo $value['schoolyear']; ?>&semester=<?php echo $value['semester']; ?>" type="submit" class="btn btn-primary">Xem thông tin</a>
                                                    <a onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" href="?q=statistical&schoolyear=<?php echo $value['schoolyear']; ?>&semester=<?php echo $value['semester']; ?>" type="submit" class="btn btn-danger">Xóa</a>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                }
                            } else { ?>
                                <div class="col-12">
                                    <h6 class="text-center">No data available in database</h6>
                                    <hr>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>