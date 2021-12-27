<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idstudent = $_POST['idstudent'];
    $position = $_POST['position'];
    $checkStructure = $manageStructure->setStructure($idstudent, $position);
}

if (isset($_GET['idstudent'])) {
    $idstudent = $_GET['idstudent'];
    $delStructure = $manageStructure->deleteStructure($idstudent);
}

if (isset($delStructure)) {
    echo $delStructure;
    echo "<script> setTimeout(() => { window.location = '?q=structure'; }, 1000); </script>";
}

if (isset($checkStructure)) {
    echo $checkStructure;
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
                                            <h5 class="m-b-10">Quản lý nhân sự</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Cơ cấu tổ chức</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CƠ CẤU -->
                        <form action="?q=structure" enctype="multipart/form-data" method="POST">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header pb-2">
                                            <div class="row">
                                                <div class="col-lg-6 p-2">
                                                    CẬP NHẬT CƠ CẤU
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div id="simpletable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                <div class="row">
                                                    <div class="col-lg-4 mt-3">
                                                        <label for="idstudent">Tên nhân sự:</label>
                                                        <select style="height: 40px;" name="idstudent" class="custom-select">
                                                            <option selected value="">---Chọn Nhân Sự---</option>
                                                            <?php
                                                            $getstructure = $manageMember->getMember();
                                                            if ($getstructure && $getstructure->num_rows > 0) {
                                                                while ($value = $getstructure->fetch_assoc()) {
                                                            ?>
                                                                    <option value="<?php echo $value['idstudent'] ?>"><?php echo $value['fullname'] ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4 mt-3">
                                                        <label for="position">Vị trí:</label>
                                                        <select style="height: 40px;" name="position" class="custom-select">
                                                            <option selected value="">---Chọn Vị Trí---</option>
                                                            <option value="Chủ nhiệm">0. Chủ nhiệm</option>
                                                            <option value="Trưởng ban Hành chính">1. Trưởng ban Hành chính</option>
                                                            <option value="Phó ban Hành chính">2. Phó ban Hành chính</option>
                                                            <option value="Trưởng ban Truyền thông">3. Trưởng ban Truyền thông</option>
                                                            <option value="Phó ban Truyền thông">4. Phó ban Truyền thông</option>
                                                            <option value="Trưởng ban Nhân sự">5. Trưởng ban Nhân sự</option>
                                                            <option value="Phó ban Nhân sự">6. Phó ban Nhân sự</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4 mt-3">
                                                        <label for="images">Tải ảnh: </label>
                                                        <div class="custom-file p-2">
                                                            <input type="file" name="images" class="custom-file-input" id="images">
                                                            <label style="height: 40px;" class="custom-file-label p-2" for="images">Chọn ảnh</label>
                                                        </div>
                                                        <script>
                                                            // Add the following code if you want the name of the file appear on select
                                                            $(".custom-file-input").on("change", function() {
                                                                var fileName = $(this).val().split("\\").pop();
                                                                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- KET THUC CƠ CẤU -->

                        <!-- HIEN THI DANH SACH THANH VIEN -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header" style="padding-bottom: 10px;">
                                        DANH SÁCH CƠ CẤU TỔ CHỨC
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
                                                                    <th scope="row " style="width: 15%; ">Ban hiện tại</th>
                                                                    <th scope="row " style="width: 20%; ">Vị trí</th>
                                                                    <th scope="row " style="width: 8%; ">Thao tác</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                $showStructure = $manageStructure->getStructure();
                                                                if ($showStructure && $showStructure->num_rows > 0) {
                                                                    while ($value = $showStructure->fetch_assoc()) {
                                                                ?>
                                                                        <tr>
                                                                            <td style="font-weight: bold; "><?php echo $i++; ?></td>
                                                                            <td><?php echo $value['idstudent']; ?></td>
                                                                            <td><?php echo $value['fullname']; ?></td>
                                                                            <td><?php echo $value['team']; ?></td>
                                                                            <td><?php echo $value['position']; ?></td>
                                                                            <td class="text-center"><a class="text-center btn btn-danger" style="margin: 0; padding: 2px 10px;" onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" href="?q=structure&idstudent=<?php echo $value['idstudent']; ?>" type="submit"><i class="fa fa-trash " style="margin-right: 0;"></i></a></td>
                                                                        </tr>
                                                                <?php }
                                                                } ?>
                                                            </tbody>
                                                            <thead>
                                                                <tr>
                                                                    <th scope="row " style="width: 5%; ">#</th>
                                                                    <th scope="row " style="width: 10%; ">MSSV</th>
                                                                    <th scope="row " style="width: 25%; ">Họ và Tên</th>
                                                                    <th scope="row " style="width: 15%; ">Ban hiện tại</th>
                                                                    <th scope="row " style="width: 20%; ">Vị trí</th>
                                                                    <th scope="row " style="width: 8%; ">Thao tác</th>
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
                        <!-- KET THUC HIEN THI DANH SACH THANH VIEN -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>