<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * manageSubjects
 */
class manageSubjects
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function setSubjects($subjects)
    {
        $subjects = $this->fm->validation($subjects);
        $subjects = mysqli_real_escape_string($this->db->link, $subjects);

        if (empty($subjects)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $query = "SELECT * FROM `tbl_subjects` WHERE subjects = '$subjects'";
            $result = $this->db->select($query);

            if ($result && $result->num_rows > 0) {
                $alert = '<script> toastr.warning("Môn học đã tồn tại!");</script>';
                return $alert;
            } else {
                $query = "INSERT INTO `tbl_subjects`(`subjects`) VALUES ('$subjects')";
                $result = $this->db->insert($query);

                if ($result != false) {
                    $alert = '<script> toastr.success("Đã thêm thành công!");</script>';
                    return $alert;
                } else {
                    $alert = '<script> toastr.warning("Đã thêm thất bại!");</script>';
                    return $alert;
                }
            }
        }
    }

    public function deleteSubjects($subjects)
    {
        if (empty($subjects)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $query = "SELECT * FROM `tbl_subjects` WHERE subjects = '$subjects'";
            $result = $this->db->select($query);

            if ($result && $result->num_rows > 0) {
                $query = "DELETE FROM `tbl_subjects` WHERE subjects = '$subjects'";
                $result = $this->db->delete($query);

                if ($result != false) {
                    $alert = '<script> toastr.success("Đã xóa thành công!");</script>';
                    return $alert;
                } else {
                    $alert = '<script> toastr.warning("Đã xóa thất bại!");</script>';
                    return $alert;
                }
            }
        }
    }

    public function getSubjects()
    {
        $query = "SELECT * FROM `tbl_subjects`";
        $result = $this->db->select($query);
        return $result;
    }
}
