<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        font-family: 'Times New Roman', Times, serif;
        padding: 8px;
        font-size: 13px;
        text-align: left;
    }
</style>

<?php
$filepath = realpath(dirname(__FILE__));
include($filepath . '/../../config/config.php');
?>

<?php
$db_host   = DB_HOST;
$db_user   = DB_USER;
$db_pass   = DB_PASS;
$db_dbname = DB_NAME;
$mysqli = new mysqli("$db_host", "$db_user", "$db_pass", "$db_dbname");

if ($mysqli->connect_error) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$output = '';

if (isset($_POST["exportMember"])) {
    $sql = "SELECT * FROM tbl_user WHERE feature = 0";
    $result = mysqli_query($mysqli, $sql);

    $output .= '<table>
        <tr>
            <th>STT</th>
            <th>Họ và Tên</th>
            <th>MSSV</th>
            <th>Ngày sinh</th>
            <th>Link Facebook</th>
            <th>Ban hiện tại</th>
            <th>Số điện thoại</th>
        </tr>';
    $index = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
            <tr>
                <td>' . $index++ . ' </td>
                <td>' . $row["fullname"] . ' </td>
                <td>' . $row["idstudent"] . ' </td>
                <td>' . $row["birthday"] . ' </td>
                <td>' . $row["facebook"] . ' </td>
                <td>' . $row["team"] . ' </td>
                <td>' . $row["phone"] . ' </td>
            </tr>';
    }
    $output .= '</table>';

    header('Content-Encoding: UTF-8');
    header('Content-type: application/xls; charset=UTF-8');
    header('Content-Disposition: attachment; filename="Danh sách thành viên.xls' . '"');
    echo $output;
}

if (isset($_POST["exportCollaborators"])) {
    $sql = "SELECT * FROM tbl_user WHERE feature = 1";
    $result = mysqli_query($mysqli, $sql);

    $output .= '<table>
        <tr>
            <th>STT</th>
            <th>Họ và Tên</th>
            <th>MSSV</th>
            <th>Ngày sinh</th>
            <th>Link Facebook</th>
            <th>Ban hiện tại</th>
            <th>Số điện thoại</th>
        </tr>';
    $index = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
            <tr>
                <td>' . $index++ . ' </td>
                <td>' . $row["fullname"] . ' </td>
                <td>' . $row["idstudent"] . ' </td>
                <td>' . $row["birthday"] . ' </td>
                <td>' . $row["facebook"] . ' </td>
                <td>' . $row["team"] . ' </td>
                <td>' . $row["phone"] . ' </td>
            </tr>';
    }
    $output .= '</table>';

    header('Content-Encoding: UTF-8');
    header('Content-type: application/xls; charset=UTF-8');
    header('Content-Disposition: attachment; filename="Danh sách cộng tác viên.xls' . '"');
    echo $output;
}

if (isset($_POST["exportRecruitment"])) {
    $sql = "SELECT * FROM tbl_recruitment";
    $result = mysqli_query($mysqli, $sql);

    $output .= '<table>
        <tr>
            <th>STT</th>
            <th>Họ và Tên</th>
            <th>Mssv</th>
            <th>Khoa</th>
            <th>Ngày sinh</th>
            <th>Email cá nhân</th>
            <th>Email sinh viên</th>
            <th>SĐT</th>
            <th>Link facebook</th>
            <th>Bạn sẽ chọn ban nào</th>
            <th>Bạn biết đến LSA là từ đâu</th>
            <th>Tại sao bạn lại chọn ban này</th>
            <th>Bạn đã có kinh nghiệm trong công việc này chưa</th>
            <th>Bạn mong muốn điều gì sau khi tham gia câu lạc bộ</th>
            <th>Bạn có sở trường gì không</th>
            <th>Sở đoản của bạn là gì</th>
            <th>Cam kết</th>
        </tr>';

    $index = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
            <tr>
                <td>' . $index++ . ' </td>
                <td>' . $row["fullname"] . ' </td>
                <td>' . $row["idstudent"] . ' </td>
                <td>' . $row["faculty"] . ' </td>
                <td>' . $row["birthday"] . ' </td>
                <td>' . $row["per_email"] . ' </td>
                <td>' . $row["stu_email"] . ' </td>
                <td>' . $row["phone"] . ' </td>
                <td>' . $row["facebook"] . ' </td>
                <td>' . $row["team"] . ' </td>
                <td>' . $row["content1"] . ' </td>
                <td>' . $row["content2"] . ' </td>
                <td>' . $row["content3"] . ' </td>
                <td>' . $row["content4"] . ' </td>
                <td>' . $row["content5"] . ' </td>
                <td>' . $row["content6"] . ' </td>
                <td>' . $row["resolution"] . ' </td>
            </tr>';
    }
    $output .= '</table>';

    header('Content-Encoding: UTF-8');
    header('Content-type: application/xls; charset=UTF-8');
    header('Content-Disposition: attachment; filename="Danh sách tuyển thành viên.xls' . '"');
    echo $output;
}

if (isset($_POST["exporCountatis"])) {
    $schoolyear = $_GET['schoolyear'];
    $semester = $_GET['semester'];
    $query = "SELECT tbl_attendances.idstudent, tbl_attendances.fullname , team,
    (SELECT COUNT(tbl_attendances.idstudent) FROM tbl_attendances WHERE attendance = 'Present' AND schoolyear = '$schoolyear' AND semester = '$semester' AND tbl_attendances.idstudent = tbl_user.idstudent) AS Present,
    (SELECT COUNT(tbl_attendances.idstudent) FROM tbl_attendances WHERE attendance = 'Late' AND schoolyear = '$schoolyear' AND semester = '$semester' AND tbl_attendances.idstudent = tbl_user.idstudent) AS Late, 
    (SELECT COUNT(tbl_attendances.idstudent) FROM tbl_attendances WHERE attendance = 'Absent' AND schoolyear = '$schoolyear' AND semester = '$semester' AND tbl_attendances.idstudent = tbl_user.idstudent) AS Absent 
    FROM tbl_attendances, tbl_user
    WHERE schoolyear = '$schoolyear' AND semester = '$semester' AND tbl_attendances.idstudent = tbl_user.idstudent
    GROUP BY tbl_attendances.idstudent
    ORDER BY tbl_user.team ASC";
    $result = mysqli_query($mysqli, $query);

    $output .= '<table>
        <tr>
            <th>STT</th>
            <th>MSSV</th>
            <th>Họ và Tên</th>
            <th>Có mặt</th>
            <th>Trể</th>
            <th>Vắng</th>
        </tr>';

    $index = 1;
    while ($value = mysqli_fetch_assoc($result)) {
        $output .= '
            <tr>
                <td>' . $index++ . ' </td>
                <td>' . $value["idstudent"] . ' </td>
                <td>' . $value["fullname"] . ' </td>
                <td>' . $value["Present"] . ' </td>
                <td>' . $value["Late"] . ' </td>
                <td>' . $value["Absent"] . ' </td>
            </tr>';
    }
    $output .= '</table>';

    header('Content-Encoding: UTF-8');
    header('Content-type: application/xls; charset=UTF-8');
    header('Content-Disposition: attachment; filename="Thống kê điểm danh.xls' . '"');
    echo $output;
}

if (isset($_POST["exportEquipment"])) {

    $sql_equi = "SELECT `typedevice`, 
    SUM(`originalnumber`) AS `originalnumber`,
    SUM(`using`) AS `using`,
    SUM(`originalnumber`) - `using` AS `donotuse`,
    SUM(`originalnumber`) - SUM(`broken`) - SUM(`lost`) AS `normal`,
    SUM(`broken`) AS `broken`,
    SUM(`lost`) AS `lost`
    FROM `tbl_equipment`
    GROUP BY `typedevice`";

    $result_equi = mysqli_query($mysqli, $sql_equi);

    $output .= '<table>
        <tr>
                <th colspan="3">Thông tin thiết bị</th>
                <th colspan="2">Hiện trạng sử dụng</th>
                <th colspan="3">Tình trạng thiết bị</th>
            </tr>
        <tr>
            <th>STT</th>
            <th>Loại TB</th>
            <th>SL Nhập</th>
            <th>Đang sử dụng</th>
            <th>Không sử dụng</th>
            <th>Bình thường</th>
            <th>Hỏng</th>
            <th>Mất</th>
        </tr>';
    $index = 1;
    while ($row_equi = mysqli_fetch_assoc($result_equi)) {
        $output .= '
            <tr>
                <td>' . $index++ . ' </td>
                <td>' . $row_equi["typedevice"] . ' </td>
                <td>' . $row_equi["originalnumber"] . ' </td>
                <td>' . $row_equi["using"] . ' </td>
                <td>' . $row_equi["donotuse"] . ' </td>
                <td>' . $row_equi["normal"] . ' </td>
                <td>' . $row_equi["broken"] . ' </td>
                <td>' . $row_equi["lost"] . ' </td>
            </tr>';
    }
    $output .= '</table>';

    header('Content-Encoding: UTF-8');
    header('Content-type: application/xls; charset=UTF-8');
    header('Content-Disposition: attachment; filename="Thống kê thiết bị.xls' . '"');
    echo $output;
}

if (isset($_POST["exporLoanPayment"])) {
    $sql = "SELECT * FROM tbl_loanpayment";
    $result = mysqli_query($mysqli, $sql);

    $output .= '<table>
        <tr>
            <th>STT</th>
            <th>Người mượn</th>
            <th>Thiết bị</th>
            <th>Số lượng</th>
            <th>Ngày mượn</th>
            <th>Ngày trả</th>
            <th>Lý do mượn</th>
            <th>Trạng thái</th>
        </tr>';
    $index = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
            <tr>
                <td>' . $index++ . ' </td>
                <td>' . $row["name"] . ' </td>
                <td>' . $row["devices"] . ' </td>
                <td>' . $row["quantity"] . ' </td>
                <td>' . $row["begin"] . ' </td>
                <td>' . $row["end"] . ' </td>
                <td>' . $row["reason"] . ' </td>
                <td>' . $row["status"] . ' </td>
            </tr>';
    }
    $output .= '</table>';

    header('Content-Encoding: UTF-8');
    header('Content-type: application/xls; charset=UTF-8');
    header('Content-Disposition: attachment; filename="Danh sách mượn trả.xls' . '"');
    echo $output;
}
