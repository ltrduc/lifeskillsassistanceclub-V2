<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_db'])) {
        $checkRecruitment = $manageRegister->deleteRecruitment();
    }
}

if (isset($checkRecruitment)) {
    echo $checkRecruitment;
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
                                            <li class="breadcrumb-item"><a href="#!">Tuyền thành viên</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- HIEN THI DANH SACH THANH VIEN -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header" style="padding-bottom: 0px; padding-top: 10px;">
                                        <div class="float-left p-2">
                                            DANH SÁCH TUYỂN THÀNH VIÊN
                                        </div>
                                        <?php
                                        $query = "SELECT `level` FROM `tbl_checkregister`";
                                        $result = $db->select($query);
                                        $value = $result->fetch_assoc();

                                        if ($value['level'] == "0") {
                                        ?>
                                            <div class="float-right">
                                                <form action="?q=recruitment" method="POST">
                                                    <button onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" name="delete_db" type="submit" class="btn btn-danger"><i class="fa fa-trash "></i>Xóa dữ liệu</button>
                                                </form>
                                            </div>
                                        <?php } ?>

                                        <div class="float-right">
                                            <form action="./exportExcel/exportExcel.php" method="POST">
                                                <button type="submit" name="exportRecruitment" id="downloadfile" class="btn btn-success"><i class="fa fa-download"></i>&nbsp; Xuất dữ liệu</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <div id="simpletable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="simpletable" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="simpletable_info">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="row " style="width: 5%; ">#</th>
                                                                    <th scope="row " style="width: 10%; ">MSSV</th>
                                                                    <th scope="row " style="width: 25%; ">Họ và Tên</th>
                                                                    <th scope="row " style="width: 15%; ">Khoa</th>
                                                                    <th scope="row " style="width: 25%; ">Ban ứng tuyển</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                $getRegister = $manageRegister->getRegister();
                                                                if ($getRegister) {
                                                                    while ($value = $getRegister->fetch_assoc()) {
                                                                ?>
                                                                        <tr>
                                                                            <td style="font-weight: bold; "><?php echo $i++; ?></td>
                                                                            <td><?php echo $value['idstudent']; ?></td>
                                                                            <td><?php echo $value['fullname']; ?></td>
                                                                            <td><?php echo $value['faculty']; ?></td>
                                                                            <td><?php echo $value['team']; ?></td>
                                                                        </tr>
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
                        <!-- KET THUC HIEN THI DANH SACH THANH VIEN -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>