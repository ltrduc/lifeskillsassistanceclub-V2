<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * manageShoolYear
 */
class manageShoolYear
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function setShoolYear($schoolyear)
    {
        $schoolyear = $this->fm->validation($schoolyear);
        $schoolyear = mysqli_real_escape_string($this->db->link, $schoolyear);

        if (empty($schoolyear)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $query = "SELECT * FROM `tbl_schoolyear` WHERE schoolyear = '$schoolyear'";
            $result = $this->db->select($query);

            if ($result && $result->num_rows > 0) {
                $alert = '<script> toastr.warning("Năm học đã tồn tại!");</script>';
                return $alert;
            } else {
                $query = "INSERT INTO `tbl_schoolyear`(`schoolyear`) VALUES ('$schoolyear')";
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

    public function deleteShoolYear($schoolyear)
    {
        if (empty($schoolyear)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $query = "SELECT * FROM `tbl_schoolyear` WHERE schoolyear = '$schoolyear'";
            $result = $this->db->select($query);

            if ($result && $result->num_rows > 0) {
                $query = "DELETE FROM `tbl_schoolyear` WHERE schoolyear = '$schoolyear'";
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

    public function getShoolYear()
    {
        $query = "SELECT * FROM `tbl_schoolyear` GROUP BY schoolyear ASC";
        $result = $this->db->select($query);
        return $result;
    }
}
