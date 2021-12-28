<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * manageRegister
 */
class manageRegister
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function setRegister(
        $fullname,
        $idstudent,
        $faculty,
        $birthday,
        $per_email,
        $phone,
        $facebook,
        $team,
        $resolution,
        $content1,
        $content2,
        $content3,
        $content4,
        $content5,
        $content6
    ) {
        $fullname = mysqli_real_escape_string($this->db->link, $fullname);
        $idstudent = mysqli_real_escape_string($this->db->link, $idstudent);
        $faculty = mysqli_real_escape_string($this->db->link, $faculty);
        $birthday = mysqli_real_escape_string($this->db->link, $birthday);
        $per_email = mysqli_real_escape_string($this->db->link, $per_email);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $facebook = mysqli_real_escape_string($this->db->link, $facebook);
        $team = mysqli_real_escape_string($this->db->link, $team);
        $resolution = mysqli_real_escape_string($this->db->link, $resolution);
        $content1 = mysqli_real_escape_string($this->db->link, $content1);
        $content2 = mysqli_real_escape_string($this->db->link, $content2);
        $content3 = mysqli_real_escape_string($this->db->link, $content3);
        $content4 = mysqli_real_escape_string($this->db->link, $content4);
        $content5 = mysqli_real_escape_string($this->db->link, $content5);
        $content6 = mysqli_real_escape_string($this->db->link, $content6);

        if (
            empty($fullname) || empty($idstudent) || empty($faculty) || empty($birthday) ||
            empty($per_email) || empty($phone) || empty($facebook) || empty($team) || $resolution == ""
            || empty($content1) || empty($content2) || empty($content3) || empty($content4)
        ) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $query = "INSERT INTO 
            `tbl_recruitment`(`fullname`, `idstudent`, `faculty`, `birthday`, `per_email`, `stu_email`, `phone`, `facebook`, `team`, `resolution`, `content1`, `content2`, `content3`, `content4`, `content5`, `content6`) 
            VALUES ('$fullname','$idstudent','$faculty','$birthday','$per_email','$idstudent@student.tdtu.edu.vn','$phone','$facebook','$team','$resolution','$content1','$content2','$content3','$content4','$content5','$content6')";
            $result = $this->db->insert($query);

            if ($result != false) {
                $alert = '<script> toastr.success("Đã đăng ký thành công!");</script>';
                return $alert;
            } else {
                $alert = '<script> toastr.warning("Đăng ký thất bại!");</script>';
                return $alert;
            }
        }
    }

    public function getRegister()
    {
        $query = "SELECT * FROM `tbl_recruitment`";
        $result = $this->db->select($query);

        return $result;
    }

    public function deleteRecruitment()
    {
        $query = "DELETE FROM `tbl_recruitment`";
        $result = $this->db->delete($query);

        if ($result != false) {
            $alert = '<script> toastr.success("Đã xóa thành công!");</script>';
            return $alert;
        } else {
            $alert = '<script> toastr.warning("Xóa thất bại!");</script>';
            return $alert;
        }
    }
}
