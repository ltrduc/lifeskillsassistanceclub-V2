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
                                            <h5 class="m-b-10">Trang chủ</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Quản trị tài khoản</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- HIEN THI DANH SACH THANH VIEN -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header" style="padding-bottom: 10px;">
                                        DANH SÁCH TÀI KHOẢN
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
                                                                    <th scope="row " style="width: 10%; ">Tài khoản</th>
                                                                    <th scope="row " style="width: 10%; ">Mật khẩu</th>
                                                                    <th scope="row " style="width: 15%; ">Ban hiện tại</th>
                                                                    <th scope="row " style="width: 5%; ">Chức năng</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                $getAdminiStration = $adminiStration->getAdminiStration();
                                                                if ($getAdminiStration && $getAdminiStration->num_rows > 0) {
                                                                    while ($value = $getAdminiStration->fetch_assoc()) {
                                                                ?>
                                                                        <tr>
                                                                            <td style="font-weight: bold; "><?php echo $i++; ?></td>
                                                                            <td style="padding-bottom: 0;"><?php echo $value['idstudent']; ?></td>
                                                                            <td style="padding-bottom: 0;"><?php echo $value['fullname']; ?></td>
                                                                            <td style="padding-bottom: 0;"><?php echo $value['user']; ?></td>
                                                                            <td style="padding-bottom: 0;">
                                                                                <p data-toggle="popover" data-placement="top" title="" data-content="<?php echo $value['password']; ?>" aria-describedby="popover663869">************</p>
                                                                            </td>
                                                                            <td style="padding-bottom: 0;"><?php echo $value['team']; ?></td>
                                                                            <?php
                                                                            if ($value['level'] == 0) {
                                                                                echo '<td class="text-center"><span style="border-radius: 20px; font-size: 11px;" class="pcoded-badge label label-danger">Admin</span></td>';
                                                                            } else if ($value['level'] == 1) {
                                                                                echo '<td class="text-center"><span style="border-radius: 20px; font-size: 11px;" class="pcoded-badge label label-success">Điểm danh</span></td>';
                                                                            } else if ($value['level'] == 2) {
                                                                                echo '<td class="text-center"><span style="border-radius: 20px; font-size: 11px;" class="pcoded-badge label label-warning">Bài đăng</span></td>';
                                                                            } else {
                                                                                echo '<td></td>';
                                                                            }
                                                                            ?>
                                                                        </tr>
                                                                <?php }
                                                                } ?>
                                                            </tbody>
                                                            <thead>
                                                                <tr>
                                                                    <th scope="row " style="width: 5%; ">#</th>
                                                                    <th scope="row " style="width: 10%; ">MSSV</th>
                                                                    <th scope="row " style="width: 25%; ">Họ và Tên</th>
                                                                    <th scope="row " style="width: 10%; ">Tài khoản</th>
                                                                    <th scope="row " style="width: 10%; ">Mật khẩu</th>
                                                                    <th scope="row " style="width: 15%; ">Ban hiện tại</th>
                                                                    <th scope="row " style="width: 5%; ">Chức năng</th>
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