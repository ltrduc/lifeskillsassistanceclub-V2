<?php
if (!isset($_GET['typedevice']) || $_GET['typedevice'] == NULL) {
    echo "<script>window.location='./?q=equipment';</script>";
} else {
    $typedevice = $_GET['typedevice'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $typedevice = $_POST['typedevice'];
    $originalnumber = $_POST['originalnumber'];
    $donotuse = $_POST['donotuse'];
    $normal = $_POST['normal'];
    $using = $_POST['using'];
    $broken = $_POST['broken'];
    $lost = $_POST['lost'];

    $checkUpdateEquipment = $manageEquipment->updateEquipment($typedevice, $originalnumber, $donotuse, $normal, $using, $broken, $lost);
    if (isset($checkUpdateEquipment)) {
        echo $checkUpdateEquipment;
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
                                            <li class="breadcrumb-item"><a href="#!">Chỉnh sửa thống kê</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- HIEN THI DANH SACH THONG KE -->
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- [TAO LOẠI THIET BI] -->
                                <div id="loanmanagement">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="typedeviceLabel">CHỈNH SỬA THỐNG KÊ</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form class="needs-validation" action="" method="POST" novalidate>
                                                    <?php
                                                    $getEquipmentId = $manageEquipment->getEquipmentId($typedevice);
                                                    if ($getEquipmentId != false) {
                                                        $value = $getEquipmentId->fetch_assoc();
                                                    }
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-lg-3 mt-3">
                                                            <label for="typedevice">Loại thiết bị:</label>
                                                            <input type="hidden" class="form-control" name="typedevice" value="<?php echo $value['typedevice'] ?>">
                                                            <input type="text" class="form-control" name="typedevice" disabled value="<?php echo $value['typedevice'] ?>">
                                                        </div>
                                                        <div class="col-lg-3 mt-3">
                                                            <label for="originalnumber">Số lượng nhập:</label>
                                                            <input type="hidden" class="form-control" name="originalnumber" value="<?php echo $value['originalnumber'] ?>">
                                                            <input type="text" class="form-control" name="originalnumber" disabled value="<?php echo $value['originalnumber'] ?>">
                                                        </div>
                                                        <div class="col-lg-3 mt-3">
                                                            <label for="donotuse">Không sử dụng:</label>
                                                            <input type="hidden" class="form-control" name="donotuse" value="<?php echo $value['donotuse'] ?>">
                                                            <input type="text" class="form-control" name="donotuse" disabled value="<?php echo $value['donotuse'] ?>">
                                                        </div>
                                                        <div class="col-lg-3 mt-3">
                                                            <label for="normal">Bình thường:</label>
                                                            <input type="hidden" class="form-control" name="normal" value="<?php echo $value['normal'] ?>">
                                                            <input type="text" class="form-control" name="normal" disabled value="<?php echo $value['normal'] ?>">
                                                        </div>
                                                        <div class="col-lg-4 mt-3">
                                                            <label for="using">Đang sử dụng:</label>
                                                            <input style="background: white;" type="text" class="form-control" name="using" value="<?php echo $value['using'] ?>">
                                                        </div>
                                                        <div class="col-lg-4 mt-3">
                                                            <label for="broken">Hỏng:</label>
                                                            <input style="background: white;" type="text" class="form-control" name="broken" value="<?php echo $value['broken'] ?>">
                                                        </div>
                                                        <div class="col-lg-4 mt-3">
                                                            <label for="lost">Mất:</label>
                                                            <input style="background: white;" type="text" class="form-control" name="lost" value="<?php echo $value['lost'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer mt-3">
                                                        <button type="submit " class="btn btn-primary">Cập nhật</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- KET THUC TAO LOẠI THIET BỊ -->
                            </div>
                        </div>
                        <!-- KET THUC HIEN THI DANH SÁCH THONG KE -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>