<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['setTypedevice'])) {
        $device = $_POST['device'];
        $checkEquipment = $manageEquipment->setTypedevice($device);
    }

    if (isset($_POST['deleteTypedevice'])) {
        $device = $_POST['device'];
        $checkEquipment = $manageEquipment->deleteTypedevice($device);
    }

    if (isset($_POST['setEquipment'])) {
        $typedevice = $_POST['typedevice'];
        $originalnumber = $_POST['originalnumber'];
        $checkEquipment = $manageEquipment->setEquipment($typedevice, $originalnumber);
    }

    if (isset($checkEquipment)) {
        echo $checkEquipment;
    }
}

if (isset($_GET['typedevice'])) {
    $typedevice = $_GET['typedevice'];
    $delEquipment = $manageEquipment->deleteEquipment($typedevice);
    if (isset($delEquipment)) {
        echo $delEquipment;
        echo '<script>setTimeout(() => { window.location = "?q=equipment" }, 500); </script> ';
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
                                            <h5 class="m-b-10">Quản lý thiết bị</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Thống kê thiết bị</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- HIEN THI DANH SACH THONG KE -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header" style="padding-bottom: 0px; padding-top: 10px;">
                                        <div class="float-left p-2">
                                            THỐNG KÊ THIẾT BỊ
                                        </div>
                                        <div class="float-right">
                                            <form action="./exportExcel/exportExcel.php" method="POST">
                                                <button type="submit" name="exportEquipment" id="downloadfile" class="btn btn-success"><i class="fa fa-download"></i>&nbsp; Xuất dữ liệu</button>
                                            </form>
                                        </div>
                                        <div class="float-right">
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#typedevice"><i class="fa fa-edit"></i>&nbsp; Loại thiết bị</button>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#adddevice"><i class="fa fa-edit"></i>&nbsp; Nhập SL thiết bị</button>
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
                                                                    <th colspan="3" scope="row" class="text-center">Thông tin thiết bị</th>
                                                                    <th colspan="2" scope="row" class="text-center">Hiện trạng sử dụng</th>
                                                                    <th colspan="3" scope="row" class="text-center">Tình trạng thiết bị</th>
                                                                    <th colspan="2" scope="row" class="text-center"></th>
                                                                </tr>
                                                                <tr>
                                                                    <th style="width: 5%;" scope="row">#</th>
                                                                    <th style="width: 10%;" scope="row">Loại TB</th>
                                                                    <th style="width: 10%;" scope="row">SL Nhập</th>
                                                                    <th style="width: 10%;" scope="row" class="text-center">Đang sử dụng</th>
                                                                    <th style="width: 10%;" scope="row" class="text-center">Không sử dụng</th>
                                                                    <th style="width: 10%;" scope="row" class="text-center">Bình thường</th>
                                                                    <th style="width: 5%;" scope="row" class="text-center">Hỏng</th>
                                                                    <th style="width: 5%;" scope="row" class="text-center">Mất</th>
                                                                    <th style="width: 5%;" scope="row" class="text-center">Thao tác</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                $getEquipment = $manageEquipment->getEquipment();
                                                                if ($getEquipment && $getEquipment->num_rows > 0) {
                                                                    while ($value = $getEquipment->fetch_assoc()) {
                                                                ?>
                                                                        <tr>
                                                                            <td style="font-weight: bold; "><?php echo $i++; ?></td>
                                                                            <td><?php echo $value['typedevice']; ?></td>
                                                                            <td><?php echo $value['originalnumber']; ?></td>
                                                                            <td><?php echo $value['using']; ?></td>
                                                                            <td><?php echo $value['donotuse']; ?></td>
                                                                            <td><?php echo $value['normal']; ?></td>
                                                                            <td><?php echo $value['broken']; ?></td>
                                                                            <td><?php echo $value['lost']; ?></td>
                                                                            <td class="text-center ">
                                                                                <a class="btn btn-primary" style="margin: 0; padding: 2px 10px;" href="?q=updateequipment&typedevice=<?php echo $value['typedevice']; ?>"><i class="fa fa-edit" style="margin-right: 0;"></i></a>
                                                                                <a class="btn btn-danger" style="margin: 0; padding: 2px 10px;" onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" href="?q=equipment&typedevice=<?php echo $value['typedevice']; ?>" name="delete" type="submit"><i class="fa fa-trash " style="margin-right: 0;"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                <?php }
                                                                } ?>
                                                            </tbody>
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 5%;" scope="row">#</th>
                                                                    <th style="width: 10%;" scope="row">Loại TB</th>
                                                                    <th style="width: 10%;" scope="row">SL Nhập</th>
                                                                    <th style="width: 10%;" scope="row" class="text-center">Đang sử dụng</th>
                                                                    <th style="width: 10%;" scope="row" class="text-center">Không sử dụng</th>
                                                                    <th style="width: 10%;" scope="row" class="text-center">Bình thường</th>
                                                                    <th style="width: 5%;" scope="row" class="text-center">Hỏng</th>
                                                                    <th style="width: 5%;" scope="row" class="text-center">Mất</th>
                                                                    <th style="width: 5%;" scope="row" class="text-center">Thao tác</th>
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
                        <!-- KET THUC HIEN THI DANH SÁCH THONG KE -->

                        <!-- [Modal] -->
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- [TAO LOẠI THIET BI] -->
                                <div class="modal fade" id="typedevice" tabindex="-1" role="dialog" aria-labelledby="typedeviceLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="typedeviceLabel">Quản lý loại thiết bị</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12 mt-3">
                                                        <form action="?q=equipment" method="POST">
                                                            <div class="form-group">
                                                                <label for="device">Tạo loại thiết bị:</label>
                                                                <input type="text" class="form-control" name="device" id="device" aria-describedby="warning6" placeholder="Bút lông">
                                                            </div>
                                                            <div class="form-group">
                                                                <button name="setTypedevice" type="submit " class="btn btn-primary">Tạo loại thiết bị</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <form action="?q=equipment" method="POST">
                                                            <div class="form-group">
                                                                <label for="device">Xóa loại thiết bị:</label>
                                                                <select name="device" class="custom-select">
                                                                    <option selected value="">---Chọn Thiết Bị---</option>
                                                                    <?php
                                                                    $getTypedevice = $manageEquipment->getTypedevice();
                                                                    if ($getTypedevice && $getTypedevice->num_rows > 0) {
                                                                        while ($value = $getTypedevice->fetch_assoc()) {
                                                                    ?>
                                                                            <option value="<?php echo $value['device']; ?>"><?php echo $value['device']; ?></option>
                                                                    <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <button onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" name="deleteTypedevice" type="submit " class="btn btn-warning">Xóa thiết bị</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- KET THUC TAO LOẠI THIET BỊ -->

                                <!-- THEM SO LUONG THIET BI -->
                                <div class="modal fade" id="adddevice" tabindex="-1" role="dialog" aria-labelledby="adddeviceLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="adddeviceLabel">Số lượng thiết bị</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12 mt-3">
                                                        <form action="?q=equipment" method="POST">
                                                            <div class="form-group">
                                                                <label for="typedevice">Loại thiết bị:</label>
                                                                <select name="typedevice" class="custom-select">
                                                                    <option selected value="">---Chọn Thiết Bị---</option>
                                                                    <?php
                                                                    $getTypedevice = $manageEquipment->getTypedevice();
                                                                    if ($getTypedevice && $getTypedevice->num_rows > 0) {
                                                                        while ($value = $getTypedevice->fetch_assoc()) {
                                                                    ?>
                                                                            <option value="<?php echo $value['device']; ?>"><?php echo $value['device']; ?></option>
                                                                    <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="originalnumber">Số lượng:</label>
                                                                <input type="text" class="form-control" name="originalnumber" id="originalnumber" aria-describedby="warning6" placeholder="200">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="form-group">
                                                                    <button name="setEquipment" type="submit" class="btn btn-primary">Tạo số lượng</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- KET THUC THEM SO LUONG THIET BỊ -->
                            </div>
                        </div>
                        <!-- Kết thúc Modal -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>