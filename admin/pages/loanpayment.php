<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $devices = $_POST['devices'];
    $quantity = $_POST['quantity'];
    $begin = $_POST['begin'];
    $end = $_POST['end'];
    $reason = $_POST['reason'];

    $checkloanPayment = $loanPayment->setLoanPayment($name, $phone, $devices, $quantity, $begin, $end, $reason);
}

if (isset($_GET['warningId'])) {
    $id = $_GET['warningId'];
    $status = "Chưa trả";
    $checkloanPayment = $loanPayment->statusLoanPayment($id, $status);
}

if (isset($_GET['successId'])) {
    $id = $_GET['successId'];
    $status = "Đã trả";
    $checkloanPayment = $loanPayment->statusLoanPayment($id, $status);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $checkloanPayment = $loanPayment->deleteLoanPayment($id);
}

if (isset($checkloanPayment)) {
    echo $checkloanPayment;
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
                                            <li class="breadcrumb-item"><a href="#!">Quản lý mượn/trả</a></li>
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
                                            DANH SÁCH MƯỢN/TRẢ
                                        </div>
                                        <div class="float-right">
                                            <form action="./exportExcel/exportExcel.php" method="POST">
                                                <button type="submit" name="exporLoanPayment" id="downloadfile" class="btn btn-success"><i class="fa fa-download"></i>&nbsp; Xuất dữ liệu</button>
                                            </form>
                                        </div>
                                        <div class="float-right">
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#loanPayment"><i class="fa fa-edit"></i>&nbsp; Tạo mượn/trả</button>
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
                                                                    <th style="width: 5%;" scope="row">#</th>
                                                                    <th style="width: 20%;" scope="row">Người <br> mượn</th>
                                                                    <th style="width: 10%;" scope="row">Số ĐT</th>
                                                                    <th style="width: 15%;" scope="row">Thiết bị</th>
                                                                    <th style="width: 5%;" scope="row" class="text-center">SL</th>
                                                                    <th style="width: 10%;" scope="row" class="text-center">Ngày <br> mượn</th>
                                                                    <th style="width: 10%;" scope="row" class="text-center">Ngày <br> trả</th>
                                                                    <th style="width: 10%;" scope="row" class="text-center">Lý do <br> mượn</th>
                                                                    <th style="width: 6%;" scope="row" class="text-center">Trạng <br> thái</th>
                                                                    <th style="width: 5%;" scope="row" class="text-center"></th>
                                                                    <th style="width: 5%;" scope="row" class="text-center"></th>
                                                                    <th style="width: 5%;" scope="row" class="text-center"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                $getLoanPayment = $loanPayment->getLoanPayment();
                                                                if ($getLoanPayment && $getLoanPayment->num_rows > 0) {
                                                                    while ($value = $getLoanPayment->fetch_assoc()) {
                                                                ?>
                                                                        <tr>
                                                                            <td style="font-weight: bold; "><?php echo $i++; ?></td>
                                                                            <td><?php echo $value['name']; ?></td>
                                                                            <td><?php echo $value['phone']; ?></td>
                                                                            <td><?php echo $value['devices']; ?></td>
                                                                            <td class="text-center"><?php echo $value['quantity']; ?></td>
                                                                            <td><?php echo $value['begin']; ?></td>
                                                                            <td><?php echo $value['end']; ?></td>
                                                                            <td><?php echo $value['reason']; ?></td>
                                                                            <?php
                                                                            if ($value['status'] == 'Chưa trả') {
                                                                                echo '<td class="text-center"><span style="border-radius: 20px; padding: 2px 5px; font-size: 12px;" class="pcoded-badge label label-danger">Chưa trả</span></td>';
                                                                            } else {
                                                                                echo '<td class="text-center"><span style="border-radius: 20px; padding: 2px 5px; font-size: 12px;" class="pcoded-badge label label-success">Đã trả</span></td>';
                                                                            }
                                                                            ?>
                                                                            <?php
                                                                            if ($value['status'] == 'Đã trả') {  ?>
                                                                                <td class="text-center">
                                                                                    <a href="?q=loanpayment&warningId=<?php echo $value['id']; ?>" type="submit"><i class="feather icon-alert-triangle"></i></a>
                                                                                </td>
                                                                            <?php } else { ?>
                                                                                <td class="text-center">
                                                                                    <a href="?q=loanpayment&successId=<?php echo $value['id']; ?>" type="submit"><i class="feather icon-check-circle"></i></a>
                                                                                </td>
                                                                            <?php } ?>
                                                                            <td class="text-center">
                                                                                <a href="?q=updateloanpayment&id=<?php echo $value['id']; ?>"><i class="fa fa-edit"></i></a>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <a onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" href="?q=loanpayment&id=<?php echo $value['id']; ?>" type="submit"><i class="fa fa-trash "></i></a>
                                                                            </td>
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
                        <!-- KET THUC HIEN THI DANH SÁCH THONG KE -->

                        <!-- [Modal] -->
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- [TAO LOẠI THIET BI] -->
                                <div class="modal fade" id="loanPayment" tabindex="-1" role="dialog" aria-labelledby="loanPaymentLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="typedeviceLabel">Tạo mượn/trả</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="?q=loanpayment" method="POST">
                                                    <div class="row">
                                                        <div class="col-3 mt-3">
                                                            <div class="form-group">
                                                                <label for="name">Người mượn:</label>
                                                                <input type="text" class="form-control" name="name" id="name">
                                                            </div>
                                                        </div>
                                                        <div class="col-3 mt-3">
                                                            <div class="form-group">
                                                                <label for="phone">Số điện thoại:</label>
                                                                <input type="text" class="form-control" name="phone" id="phone">
                                                            </div>
                                                        </div>
                                                        <div class="col-3 mt-3">
                                                            <div class="form-group">
                                                                <label for="devices">Thiết bị:</label>
                                                                <input type="text" class="form-control" name="devices" id="devices">
                                                            </div>
                                                        </div>
                                                        <div class="col-3 mt-3">
                                                            <div class="form-group">
                                                                <label for="quantity">Số lượng:</label>
                                                                <input type="text" class="form-control" name="quantity" id="quantity">
                                                            </div>
                                                        </div>
                                                        <div class="col-4 mt-3">
                                                            <div class="form-group">
                                                                <label for="begin">Ngày mượn:</label>
                                                                <input type="date" class="form-control" name="begin" id="begin">
                                                            </div>
                                                        </div>
                                                        <div class="col-4 mt-3">
                                                            <div class="form-group">
                                                                <label for="end">Ngày trả:</label>
                                                                <input type="date" class="form-control" name="end" id="end">
                                                            </div>
                                                        </div>
                                                        <div class="col-4 mt-3">
                                                            <div class="form-group">
                                                                <label for="reason">Lý do mượn:</label>
                                                                <input type="text" class="form-control" name="reason" id="reason">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="form-group">
                                                                <button name="loanPayment" type="submit" class="btn btn-primary">Tạo mượn/trả</button>
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
                        <!-- Kết thúc Modal -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>