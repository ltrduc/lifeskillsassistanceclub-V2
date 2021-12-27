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

        $fullname = mysqli_real_escape_string($this->db->link, $this->fm->validation($fullname));
        $idstudent = mysqli_real_escape_string($this->db->link, $this->fm->validation($idstudent));
        $faculty = mysqli_real_escape_string($this->db->link, $this->fm->validation($faculty));
        $birthday = mysqli_real_escape_string($this->db->link, $this->fm->validation($birthday));
        $per_email = mysqli_real_escape_string($this->db->link, $this->fm->validation($per_email));
        $phone = mysqli_real_escape_string($this->db->link, $this->fm->validation($phone));
        $facebook = mysqli_real_escape_string($this->db->link, $this->fm->validation($facebook));
        $team = mysqli_real_escape_string($this->db->link, $this->fm->validation($team));
        $resolution = mysqli_real_escape_string($this->db->link, $this->fm->validation($resolution));
        $content1 = mysqli_real_escape_string($this->db->link, $this->fm->validation($content1));
        $content2 = mysqli_real_escape_string($this->db->link, $this->fm->validation($content2));
        $content3 = mysqli_real_escape_string($this->db->link, $this->fm->validation($content3));
        $content4 = mysqli_real_escape_string($this->db->link, $this->fm->validation($content4));
        $content5 = mysqli_real_escape_string($this->db->link, $this->fm->validation($content5));
        $content6 = mysqli_real_escape_string($this->db->link, $this->fm->validation($content6));

        if (
            empty($fullname) || empty($idstudent) || empty($faculty) || empty($birthday) ||
            empty($per_email) || empty($phone) || empty($facebook) || empty($team) || $resolution == ""
            || empty($content1) || empty($content2) || empty($content3) || empty($content4)
        ) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        }
        $query = "INSERT INTO  `tbl_recruitment`(`fullname`, `idstudent`, `faculty`, `birthday`, `per_email`, `stu_email`, `phone`, `facebook`, `team`, `resolution`, `content1`, `content2`, `content3`, `content4`, `content5`, `content6`) 
        VALUES ('$fullname','$idstudent','$faculty','$birthday','$per_email','$idstudent@student.tdtu.edu.vn','$phone','$facebook','$team','$resolution','$content1','$content2','$content3','$content4','$content5','$content6')";
        $result = $this->db->insert($query);

        if ($result) {
            $alert = '<script> toastr.success("Đã đăng ký thành công!");</script>';
            return $alert;
        }

        $alert = '<script> toastr.warning("Đăng ký thất bại!");</script>';
        return $alert;
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

        if ($result) {
            $alert = '<script> toastr.success("Đã xóa dữ liệu thành công!");</script>';
            return $alert;
        }


        $alert = '<script> toastr.warning("Đã xóa dữ liệu thất bại!");</script>';
        return $alert;
    }
}
