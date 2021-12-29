<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        $idstudent = $_POST['idstudent'];
        $session = $_POST['session'];

        $shift1 = "";
        $shift2 = "";
        $shift3 = "";
        $shift4 = "";

        if (isset($_POST['shift1'])) $shift1 = $_POST['shift1'];
        if (isset($_POST['shift2']))  $shift2 = $_POST['shift2'];
        if (isset($_POST['shift3'])) $shift3 = $_POST['shift3'];
        if (isset($_POST['shift4'])) $shift4 = $_POST['shift4'];
        $checkSchedule = $manageSchedule->setSchedule($idstudent, $session, $shift1, $shift2, $shift3, $shift4);
    }

    if (isset($_POST['delDatabase'])) {
        $team = "Truyền Thông";
        $checkSchedule = $manageSchedule->deleteScheduleTeam($team);
    }

    if (isset($checkSchedule)) {
        echo $checkSchedule;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delSchedule = $manageSchedule->deleteScheduleId($id);
    if (isset($delSchedule)) {
        echo $delSchedule;
        echo '<script>setTimeout(() => { window.location = "?q=schedulett" }, 500); </script> ';
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
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Quản lý trực Ban</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="">Lịch Trực Ban Truyền Thông</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- DANG KY CA TRUC -->
                                        <div class="row mt-3">
                                            <div class="col">
                                                <?php if (Session::get('level') == "050301" || Session::get('level') == "0") { ?>
                                                    <div class="float-right">
                                                        <form action="?q=schedulett" method="POST">
                                                            <button onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" name="delDatabase" type="submit" class="btn btn-danger"><i class="fa fa-trash "></i>Xóa dữ liệu</button>
                                                        </form>
                                                    </div>
                                                <?php } ?>

                                                <div class="float-right">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaltt"><i class="fa fa-edit"></i>&nbsp; Đăng ký</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- KET THUC DANG KY CA TRUC -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- HIEN THONG BAO CA TRUC -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header pb-1">
                                        <h3>LỊCH TRỰC BAN TRUYỀN THÔNG</h3>
                                        <div style="color: orangered;" role="alert">
                                            Lịch trực sẽ đăng ký theo tuần, sau khi kết thúc lịch
                                            trực tuần người quản lý sẽ xóa lịch trực cũ và bắt đầu
                                            đăng ký lại lịch trực mới.
                                        </div>
                                        <div class="card-header-right">
                                            <div class="btn-group card-option">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="feather icon-more-horizontal"></i>
                                                </button>
                                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-12">
                                                <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    <li class="nav-item">
                                                        <a class="nav-link text-center active" data-toggle="tab" href="#thu2">THỨ 2</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link text-center" data-toggle="tab" href="#thu3">THỨ 3</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link text-center" data-toggle="tab" href="#thu4">THỨ 4</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link text-center" data-toggle="tab" href="#thu5">THỨ 5</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link text-center" data-toggle="tab" href="#thu6">THỨ 6</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link text-center" data-toggle="tab" href="#thu7">THỨ 7</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-10 col-sm-12">
                                                <div class="tab-content" id="v-pills-tabContent">
                                                    <?php
                                                    $administrative = "Truyền Thông";
                                                    $Mon = "Thứ 2";
                                                    $Tues = "Thứ 3";
                                                    $Wednes = "Thứ 4";
                                                    $Thurs = "Thứ 5";
                                                    $Fri = "Thứ 6";
                                                    $Satur = "Thứ 7";
                                                    ?>
                                                    <!-- [Thứ 2] -->
                                                    <div class="tab-pane fade active show" id="thu2" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                        <div class="table-responsive">
                                                            <div class="session-scroll">
                                                                <table class="table table-hover m-b-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="row " style="width: 5%; ">#</th>
                                                                            <th scope="row " style="width: 20%;">Mssv</th>
                                                                            <th scope="row " style="width: 20%;">Họ và Tên</th>
                                                                            <th scope="row " style="width: 20%;">Ca trực</th>
                                                                            <th scope="row " style="width: 5%;">Xóa</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $result = $manageSchedule->getSchedule($administrative, $Mon);
                                                                        $i = 1;
                                                                        if ($result != false) {
                                                                            while ($value = $result->fetch_assoc()) {
                                                                        ?>
                                                                                <tr>
                                                                                    <td style="font-weight: bold; "><?php echo $i++; ?></td>
                                                                                    <td><?php echo $value['idstudent']; ?></td>
                                                                                    <td><?php echo $value['fullname']; ?></td>
                                                                                    <td><?php echo $value['shift']; ?></td>
                                                                                    <?php if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('idstudent') == $value['idstudent']) { ?>
                                                                                        <td><a class="text-center btn btn-danger" style="margin: 0; padding: 2px 10px;" onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" href="?q=schedulett&id=<?php echo $value['id']; ?>" type="submit"><i class="fa fa-trash " style="margin-right: 0;"></i></a></td>
                                                                                    <?php } else { ?>
                                                                                        <td></td>
                                                                                    <?php } ?>
                                                                                </tr>
                                                                        <?php }
                                                                        } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Kết thúc thứ  2-->

                                                    <!-- [Thứ 3] -->
                                                    <div class="tab-pane fade show" id="thu3" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                        <div class="table-responsive">
                                                            <div class="session-scroll">
                                                                <table class="table table-hover m-b-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="row " style="width: 5%; ">#</th>
                                                                            <th scope="row " style="width: 20%;">Mssv</th>
                                                                            <th scope="row " style="width: 20%;">Họ và Tên</th>
                                                                            <th scope="row " style="width: 20%;">Ca trực</th>
                                                                            <th scope="row " style="width: 5%;">Xóa</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $result = $manageSchedule->getSchedule($administrative, $Tues);
                                                                        $i = 1;
                                                                        if ($result != false) {
                                                                            while ($value = $result->fetch_assoc()) {
                                                                        ?>
                                                                                <tr>
                                                                                    <td style="font-weight: bold; "><?php echo $i++; ?></td>
                                                                                    <td><?php echo $value['idstudent']; ?></td>
                                                                                    <td><?php echo $value['fullname']; ?></td>
                                                                                    <td><?php echo $value['shift']; ?></td>
                                                                                    <?php if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('idstudent') == $value['idstudent']) { ?>
                                                                                        <td><a class="text-center btn btn-danger" style="margin: 0; padding: 2px 10px;" onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" href="?q=schedulett&id=<?php echo $value['id']; ?>" type="submit"><i class="fa fa-trash " style="margin-right: 0;"></i></a></td>
                                                                                    <?php } else { ?>
                                                                                        <td></td>
                                                                                    <?php } ?>
                                                                                </tr>
                                                                        <?php }
                                                                        } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Kết thúc thứ 3 -->

                                                    <!-- [Thứ 4] -->
                                                    <div class="tab-pane fade show" id="thu4" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                        <div class="table-responsive">
                                                            <div class="session-scroll">
                                                                <table class="table table-hover m-b-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="row " style="width: 5%; ">#</th>
                                                                            <th scope="row " style="width: 20%;">Mssv</th>
                                                                            <th scope="row " style="width: 20%;">Họ và Tên</th>
                                                                            <th scope="row " style="width: 20%;">Ca trực</th>
                                                                            <th scope="row " style="width: 5%;">Xóa</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $result = $manageSchedule->getSchedule($administrative, $Wednes);
                                                                        $i = 1;
                                                                        if ($result != false) {
                                                                            while ($value = $result->fetch_assoc()) {
                                                                        ?>
                                                                                <tr>
                                                                                    <td style="font-weight: bold; "><?php echo $i++; ?></td>
                                                                                    <td><?php echo $value['idstudent']; ?></td>
                                                                                    <td><?php echo $value['fullname']; ?></td>
                                                                                    <td><?php echo $value['shift']; ?></td>
                                                                                    <?php if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('idstudent') == $value['idstudent']) { ?>
                                                                                        <td><a class="text-center btn btn-danger" style="margin: 0; padding: 2px 10px;" onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" href="?q=schedulett&id=<?php echo $value['id']; ?>" type="submit"><i class="fa fa-trash " style="margin-right: 0;"></i></a></td>
                                                                                    <?php } else { ?>
                                                                                        <td></td>
                                                                                    <?php } ?>
                                                                                </tr>
                                                                        <?php }
                                                                        } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Kết thúc thứ 4 -->

                                                    <!-- [Thứ 5] -->
                                                    <div class="tab-pane fade show" id="thu5" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                        <div class="table-responsive">
                                                            <div class="session-scroll">
                                                                <table class="table table-hover m-b-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="row " style="width: 5%; ">#</th>
                                                                            <th scope="row " style="width: 20%;">Mssv</th>
                                                                            <th scope="row " style="width: 20%;">Họ và Tên</th>
                                                                            <th scope="row " style="width: 20%;">Ca trực</th>
                                                                            <th scope="row " style="width: 5%;">Xóa</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $result = $manageSchedule->getSchedule($administrative, $Thurs);
                                                                        $i = 1;
                                                                        if ($result != false) {
                                                                            while ($value = $result->fetch_assoc()) {
                                                                        ?>
                                                                                <tr>
                                                                                    <td style="font-weight: bold; "><?php echo $i++; ?></td>
                                                                                    <td><?php echo $value['idstudent']; ?></td>
                                                                                    <td><?php echo $value['fullname']; ?></td>
                                                                                    <td><?php echo $value['shift']; ?></td>
                                                                                    <?php if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('idstudent') == $value['idstudent']) { ?>
                                                                                        <td><a class="text-center btn btn-danger" style="margin: 0; padding: 2px 10px;" onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" href="?q=schedulett&id=<?php echo $value['id']; ?>" type="submit"><i class="fa fa-trash " style="margin-right: 0;"></i></a></td>
                                                                                    <?php } else { ?>
                                                                                        <td></td>
                                                                                    <?php } ?>
                                                                                </tr>
                                                                        <?php }
                                                                        } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Kết thúc thứ 5 -->

                                                    <!-- [Thứ 6] -->
                                                    <div class="tab-pane fade show" id="thu6" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                        <div class="table-responsive">
                                                            <div class="session-scroll">
                                                                <table class="table table-hover m-b-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="row " style="width: 5%; ">#</th>
                                                                            <th scope="row " style="width: 20%;">Mssv</th>
                                                                            <th scope="row " style="width: 20%;">Họ và Tên</th>
                                                                            <th scope="row " style="width: 20%;">Ca trực</th>
                                                                            <th scope="row " style="width: 5%;">Xóa</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $result = $manageSchedule->getSchedule($administrative, $Fri);
                                                                        $i = 1;
                                                                        if ($result != false) {
                                                                            while ($value = $result->fetch_assoc()) {
                                                                        ?>
                                                                                <tr>
                                                                                    <td style="font-weight: bold; "><?php echo $i++; ?></td>
                                                                                    <td><?php echo $value['idstudent']; ?></td>
                                                                                    <td><?php echo $value['fullname']; ?></td>
                                                                                    <td><?php echo $value['shift']; ?></td>
                                                                                    <?php if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('idstudent') == $value['idstudent']) { ?>
                                                                                        <td><a class="text-center btn btn-danger" style="margin: 0; padding: 2px 10px;" onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" href="?q=schedulett&id=<?php echo $value['id']; ?>" type="submit"><i class="fa fa-trash " style="margin-right: 0;"></i></a></td>
                                                                                    <?php } else { ?>
                                                                                        <td></td>
                                                                                    <?php } ?>
                                                                                </tr>
                                                                        <?php }
                                                                        } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Kết thúc thứ 6 -->

                                                    <!-- [Thứ 7] -->
                                                    <div class="tab-pane fade show" id="thu7" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                        <div class="table-responsive">
                                                            <div class="session-scroll">
                                                                <table class="table table-hover m-b-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="row " style="width: 5%; ">#</th>
                                                                            <th scope="row " style="width: 20%;">Mssv</th>
                                                                            <th scope="row " style="width: 20%;">Họ và Tên</th>
                                                                            <th scope="row " style="width: 20%;">Ca trực</th>
                                                                            <th scope="row " style="width: 5%;">Xóa</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $result = $manageSchedule->getSchedule($administrative, $Satur);
                                                                        $i = 1;
                                                                        if ($result != false) {
                                                                            while ($value = $result->fetch_assoc()) {
                                                                        ?>
                                                                                <tr>
                                                                                    <td style="font-weight: bold; "><?php echo $i++; ?></td>
                                                                                    <td><?php echo $value['idstudent']; ?></td>
                                                                                    <td><?php echo $value['fullname']; ?></td>
                                                                                    <td><?php echo $value['shift']; ?></td>
                                                                                    <?php if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('idstudent') == $value['idstudent']) { ?>
                                                                                        <td><a class="text-center btn btn-danger" style="margin: 0; padding: 2px 10px;" onclick="return confirm('Hãy cân nhắc kỹ trước khi xóa?');" href="?q=schedulett&id=<?php echo $value['id']; ?>" type="submit"><i class="fa fa-trash " style="margin-right: 0;"></i></a></td>
                                                                                    <?php } else { ?>
                                                                                        <td></td>
                                                                                    <?php } ?>
                                                                                </tr>
                                                                        <?php }
                                                                        } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Kết thúc thứ 7 -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- KET THUC HIEN THONG BAO CA TRUC -->
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- MODAL -->
<div class="modal" id="modaltt">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- DANG KY CA TRUC -->
            <form action="?q=schedulett" method="POST">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card mb-0">
                            <div class="card-header">
                                <h4>ĐĂNG KÝ LỊCH TRỰC</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="idstudent">Thành viên:</label>
                                            <?php if (Session::get('level') == "050301" || Session::get('level') == "0") { ?>
                                                <select name="idstudent" class="form-control form-control-sm">
                                                    <option selected value="">---Chọn Nhân Sự---</option>
                                                    <?php
                                                    $getSchedulett = $manageSchedule->getScheduleTt();
                                                    if ($getSchedulett && $getSchedulett->num_rows > 0) {
                                                        while ($value = $getSchedulett->fetch_assoc()) {
                                                    ?>
                                                            <option value="<?php echo $value['idstudent']; ?>"><?php echo $value['fullname']; ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            <?php } else { ?>
                                                <input type="hidden" class="form-control" name="idstudent" value="<?php echo Session::get('idstudent'); ?>">
                                                <input type="text" class="form-control" name="idstudent" disabled value="<?php echo Session::get('fullname'); ?>">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="session">Buổi trực:</label>
                                            <select name="session" class="form-control form-control-sm">
                                                <option selected value="">---Chọn Ca Trực---</option>
                                                <option value="Thứ 2">Thứ 2</option>
                                                <option value="Thứ 3">Thứ 3</option>
                                                <option value="Thứ 4">Thứ 4</option>
                                                <option value="Thứ 5">Thứ 5</option>
                                                <option value="Thứ 6">Thứ 6</option>
                                                <option value="Thứ 7">Thứ 7</option>
                                            </select>
                                            <small class="invalid-feedback" id="warning6">Vui lòng điền đầy đủ thông tin.</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="shift">Ca trực:</label>
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="shift1" value="Ca 1">
                                                    <label class="form-check-label" for="shift1">Ca 1</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="shift2" value="Ca 2">
                                                    <label class="form-check-label" for="shift2">Ca 2</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="shift3" value="Ca 3">
                                                    <label class="form-check-label" for="shift3">Ca 3</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="shift4" value="Ca 4">
                                                    <label class="form-check-label" for="shift4">Ca 4</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" name="register" class="btn btn-primary">Đăng ký</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- KET THUC DANG KY CA TRUC -->
        </div>
    </div>
</div>
<!-- KET THUC MODAL -->