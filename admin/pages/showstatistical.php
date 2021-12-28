<?php
if (
    (!isset($_GET['schoolyear']) || $_GET['schoolyear'] == NULL) &&
    (!isset($_GET['semester']) || $_GET['semester'] == NULL)
) {
    echo "<script>window.location='./?q=statistical';</script>";
} else {
    $schoolyear = $_GET['schoolyear'];
    $semester = $_GET['semester'];
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
                                            <h5 class="m-b-10">Quản lý buổi học</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="">Năm học <?php echo $schoolyear; ?> - <?php echo $semester; ?></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="float-right">
                                            <div class="float-right">
                                                <form action="./?q=detailedstatistics&schoolyear=<?php echo $schoolyear; ?>&semester=<?php echo $semester; ?>" method="POST">
                                                    <button type="submit" name="exporcountatis" id="downloadfile" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp; Thống kê chi tiết</button>
                                                </form>
                                            </div>
                                            <div class="float-right">
                                                <form action="./exportExcel/exportExcel.php?schoolyear=<?php echo $schoolyear; ?>&semester=<?php echo $semester; ?>" method="POST">
                                                    <button type="submit" name="exporCountatis" id="downloadfile" class="btn btn-success"><i class="fa fa-download"></i>&nbsp; Xuất dữ liệu</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header" style="padding-bottom: 10px;">
                                        <div class="float-left">
                                            THỐNG KÊ CA TRỰC
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
                                                            <th scope="row " style="width: 10%; ">Có mặt</th>
                                                            <th scope="row " style="width: 10%; ">Trể</th>
                                                            <th scope="row " style="width: 10%; ">Vắng</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 1;
                                                        $showStatistical = $manageStatistical->showStatistical($schoolyear, $semester);
                                                        if ($showStatistical && $showStatistical->num_rows > 0) {
                                                            while ($value = $showStatistical->fetch_assoc()) {
                                                        ?>
                                                                <tr>
                                                                    <td style="font-weight: bold; "><?php echo $i++; ?></td>
                                                                    <td><?php echo $value['idstudent']; ?></td>
                                                                    <td><?php echo $value['fullname']; ?></td>
                                                                    <td><?php echo $value['team']; ?></td>
                                                                    <td><?php echo $value['Present']; ?></td>
                                                                    <td><?php echo $value['Late']; ?></td>
                                                                    <td><?php echo $value['Absent']; ?></td>
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
                                                            <th scope="row " style="width: 10%; ">Có mặt</th>
                                                            <th scope="row " style="width: 10%; ">Trể</th>
                                                            <th scope="row " style="width: 10%; ">Vắng</th>
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