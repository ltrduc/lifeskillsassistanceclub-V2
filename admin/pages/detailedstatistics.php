<?php
if (
    (!isset($_GET['schoolyear']) || $_GET['schoolyear'] == NULL) ||
    (!isset($_GET['semester']) || $_GET['semester'] == NULL)
) {
    echo "<script>window.location='./?q=statistical';</script>";
} else {
    $schoolyear = $_GET['schoolyear'];
    $semester = $_GET['semester'];
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $checkmanageStatistical = $manageStatistical->deleteDetailedStatistics($id);
    if (isset($checkmanageStatistical)) {
        echo $checkmanageStatistical;
        echo '<script>setTimeout(() => { window.location = "?q=detailedstatistics&schoolyear=' . $schoolyear . '&semester=' . $semester . '" }, 500); </script> ';
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
                                    <div class="col-md-6">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Thống kê chi tiết</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="">Năm học <?php echo $schoolyear; ?> - <?php echo $semester; ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="float-left">
                                            DANH SÁCH CHI TIẾT
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div class="session-scroll">
                                                <table id="simpletable" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="simpletable_info">
                                                    <thead>
                                                        <tr>
                                                            <th scope="row " style="width: 5%; ">#</th>
                                                            <th scope="row " style="width: 10%; ">MSSV</th>
                                                            <th scope="row " style="width: 25%; ">Họ và Tên</th>
                                                            <th scope="row " style="width: 20%; ">Ban hiện tại</th>
                                                            <th scope="row " style="width: 10%; ">Năm học</th>
                                                            <th scope="row " style="width: 10%; ">Học kỳ</th>
                                                            <th scope="row " style="width: 10%; ">Ngày trực</th>
                                                            <th scope="row " style="width: 10%; ">Ca trực</th>
                                                            <th scope="row " style="width: 5%; ">Xóa</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 1;
                                                        $showDetailedstatistics = $manageStatistical->showDetailedstatistics($schoolyear, $semester);
                                                        if ($showDetailedstatistics && $showDetailedstatistics->num_rows > 0) {
                                                            while ($value = $showDetailedstatistics->fetch_assoc()) {
                                                        ?>
                                                                <tr>
                                                                    <td style="font-weight: bold; "><?php echo $i++; ?></td>
                                                                    <td><?php echo $value['idstudent']; ?></td>
                                                                    <td><?php echo $value['fullname']; ?></td>
                                                                    <td><?php echo $value['team']; ?></td>
                                                                    <td><?php echo $value['schoolyear']; ?></td>
                                                                    <td><?php echo $value['semester']; ?></td>
                                                                    <td><?php echo $value['date']; ?></td>
                                                                    <td><?php echo $value['shift']; ?></td>
                                                                    <td>
                                                                        <a class="text-center btn btn-danger" style="margin: 0; padding: 2px 10px;" onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" href="?q=detailedstatistics&id=<?php echo $value['id']; ?>&schoolyear=<?php echo $value['schoolyear']; ?>&semester=<?php echo $value['semester']; ?>" name="delete" type="submit"><i class="fa fa-trash " style="margin-right: 0;"></i></a>
                                                                    </td>
                                                                </tr>
                                                        <?php }
                                                        } ?>
                                                    </tbody>
                                                    <thead>
                                                        <tr>
                                                            <th scope="row " style="width: 5%; ">#</th>
                                                            <th scope="row " style="width: 10%; ">MSSV</th>
                                                            <th scope="row " style="width: 25%; ">Họ và Tên</th>
                                                            <th scope="row " style="width: 20%; ">Ban hiện tại</th>
                                                            <th scope="row " style="width: 10%; ">Năm học</th>
                                                            <th scope="row " style="width: 10%; ">Học kỳ</th>
                                                            <th scope="row " style="width: 10%; ">Ngày trực</th>
                                                            <th scope="row " style="width: 10%; ">Ca trực</th>
                                                            <th scope="row " style="width: 5%; ">Xóa</th>
                                                        </tr>
                                                    </thead>
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