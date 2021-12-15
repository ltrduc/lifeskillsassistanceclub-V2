<?php
if (!isset($_GET['id']) || $_GET['id'] == NULL) {
    echo "<script>window.location='./?q=loanpayment';</script>";
} else {
    $id = $_GET['id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $devices = $_POST['devices'];
    $quantity = $_POST['quantity'];
    $begin = $_POST['begin'];
    $end = $_POST['end'];
    $reason = $_POST['reason'];

    $checkloanPayment = $loanPayment->updateLoanPayment($id, $name, $phone, $devices, $quantity, $begin, $end, $reason);

    if (isset($checkloanPayment)) {
        echo $checkloanPayment;
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
                                            <li class="breadcrumb-item"><a href="#!">Chỉnh sửa mượn/trả</a></li>
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
                                    <div class="modal-dialog modal-lg mt-0 mb-0" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="typedeviceLabel">CHỈNH SỬA MƯỢN/TRẢ</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="POST">
                                                    <div class="row">
                                                        <?php
                                                        $getLoanPaymentId = $loanPayment->getLoanPaymentId($id);
                                                        if ($getLoanPaymentId != false) {
                                                            $value = $getLoanPaymentId->fetch_assoc();
                                                        }
                                                        ?>
                                                        <!-- [id ẩn] -->
                                                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $value['id'] ?>">
                                                        <!-- [id ẩn] -->

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="name">Người mượn:</label>
                                                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $value['name'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="phone">Số điện thoại:</label>
                                                                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $value['phone'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="devices">Thiết bị:</label>
                                                                <input type="text" class="form-control" name="devices" id="devices" value="<?php echo $value['devices'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="quantity">Số lượng:</label>
                                                                <input type="text" class="form-control" name="quantity" id="quantity" value="<?php echo $value['quantity'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="begin">Ngày mượn:</label>
                                                                <input type="date" class="form-control" name="begin" id="begin" value="<?php echo $value['begin'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="end">Ngày trả:</label>
                                                                <input type="date" class="form-control" name="end" id="end" value="<?php echo $value['end'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="reason">Lý do mượn:</label>
                                                                <input class="form-control" name="reason" id="reason" value="<?php echo $value['reason'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary">Cập nhật mượn/trả</button>
                                                            </div>
                                                        </div>
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