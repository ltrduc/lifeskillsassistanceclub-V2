<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['member'])) {
    $idstudent = $_POST['idstudent'];
    $fullname = $_POST['fullname'];
    $birthday = $_POST['birthday'];
    $team = $_POST['team'];
    $phone = $_POST['phone'];
    $facebook = $_POST['facebook'];
    $checkMember = $manageMember->setMember($idstudent, $fullname, $birthday, $team, $phone, $facebook);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delMember = $manageMember->deletePersonnel($id);
    if (isset($delMember)) {
        echo $delMember;
        echo '<script>setTimeout(() => { window.location = "?q=member" }, 500); </script> ';
    }
}

if (isset($checkMember)) {
    echo $checkMember;
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
                                            <li class="breadcrumb-item"><a href="#!">Quản Lý Thành Viên</a></li>
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
                                            DANH SÁCH THÀNH VIÊN
                                        </div>
                                        <div class="float-right">
                                            <form action="./exportExcel/exportExcel.php" method="POST">
                                                <button type="submit" name="exportMember" class="btn btn-success"><i class="fa fa-download"></i>&nbsp; Xuất dữ liệu</button>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addmember"><i class="fa fa-edit"></i>&nbsp; Thêm thành viên</button>
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
                                                                    <th scope="row " style="width: 15%; ">Ngày sinh</th>
                                                                    <th scope="row " style="width: 25%; ">Facebook</th>
                                                                    <th scope="row " style="width: 25%; ">Ban hiện tại</th>
                                                                    <th scope="row " style="width: 10%; ">Số ĐT</th>
                                                                    <th class="text-center" scope="row " style="width: 5%; ">Thao tác</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $result = $manageMember->getMember();
                                                                $i = 1;
                                                                if ($result != false) {
                                                                    while ($value = $result->fetch_assoc()) {
                                                                ?>
                                                                        <tr>
                                                                            <td><?php echo $i++ ?></td>
                                                                            <td><?php echo $value['idstudent'] ?></td>
                                                                            <td><?php echo $value['fullname'] ?></td>
                                                                            <td><?php echo $value['birthday'] ?></td>
                                                                            <td><a href="<?php echo $value['facebook'] ?>"><?php echo $value['fullname'] ?></a></td>
                                                                            <td><?php echo $value['team'] ?></td>
                                                                            <td><?php echo $value['phone'] ?></td>
                                                                            <td class="text-center ">
                                                                                <a class="btn btn-primary" style="margin: 0; padding: 2px 8px;" href="?q=updatemember&id=<?php echo $value['id'] ?>"><i class="fa fa-edit" style="margin-right: 0;"></i></a>
                                                                                <a class="btn btn-danger" style="margin: 0; padding: 2px 10px;" onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" href="?q=member&id=<?php echo $value['id'] ?>" type="submit"><i class="fa fa-trash " style="margin-right: 0;"></i></a>
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
                                                                    <th scope="row " style="width: 15%; ">Ngày sinh</th>
                                                                    <th scope="row " style="width: 25%; ">Facebook</th>
                                                                    <th scope="row " style="width: 25%; ">Ban hiện tại</th>
                                                                    <th scope="row " style="width: 10%; ">Số ĐT</th>
                                                                    <th class="text-center" scope="row " style="width: 5%; ">Thao tác</th>
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

                        <!-- [Modal] -->
                        <div class="modal fade" id="addmember" tabindex="-1" role="dialog" aria-labelledby="addmemberLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addmemberLabel">Thêm Thành viên</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="needs-validation" action="./?q=member" method="POST" novalidate>
                                            <div class="row">
                                                <div class="col-lg-6 mt-3">
                                                    <label for="fullname">Họ và Tên:</label>
                                                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Nguyễn Văn A" required>
                                                </div>
                                                <div class="col-lg-6 mt-3">
                                                    <label for="idstudent">Mã số sinh viên:</label>
                                                    <input type="text" class="form-control" name="idstudent" id="idstudent" placeholder="51900001" required>
                                                </div>
                                                <div class="col-lg-6 mt-3">
                                                    <label for="birthday">Ngày sinh:</label>
                                                    <input type="text" class="form-control" name="birthday" id="birthday" placeholder="DD/MM/YYYY" required>
                                                </div>
                                                <div class="col-lg-6 mt-3">
                                                    <label for="team">Ban hiện tại:</label>
                                                    <select name="team" id="team" class="custom-select" required>
                                                        <option selected value="" class="font-weight-bold">Chọn ban</option>
                                                        <option value="Hành Chính">Ban Hành chính</option>
                                                        <option value="Nhân Sự">Ban Nhân sự</option>
                                                        <option value="Truyền Thông">Ban Truyền thông</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 mt-3">
                                                    <label for="phone">Số điện thoại:</label>
                                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="0377642847" required>
                                                </div>
                                                <div class="col-6 mt-3">
                                                    <label for="facebook">Link facebook:</label>
                                                    <input type="text" class="form-control" name="facebook" id="facebook" placeholder="https://www.facebook.com/nguyenvana" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer mt-3">
                                                <button name="member" type="submit " class="btn btn-primary">Thêm thành viên</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Kết thúc Modal -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>