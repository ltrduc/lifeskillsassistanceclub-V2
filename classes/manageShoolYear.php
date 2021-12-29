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
        $schoolyear = mysqli_real_escape_string($this->db->link, $this->fm->validation($schoolyear));

        if (empty($schoolyear)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ dữ liệu!");</script>';
            return $alert;
        }

        $query = "SELECT * FROM `tbl_schoolyear` WHERE schoolyear = '$schoolyear'";
        $result = $this->db->select($query);

        if ($result) {
            $alert = '<script> toastr.warning("Năm học đã tồn tại!");</script>';
            return $alert;
        }

        $query = "INSERT INTO `tbl_schoolyear`(`schoolyear`) VALUES ('$schoolyear')";
        $result = $this->db->insert($query);

        if ($result) {
            $alert = '<script> toastr.success("Đã thêm dữ liệu thành công!");</script>';
            return $alert;
        }
        $alert = '<script> toastr.warning("Đã thêm dữ liệu thất bại!");</script>';
        return $alert;
    }

    public function deleteShoolYear($schoolyear)
    {
        $schoolyear = mysqli_real_escape_string($this->db->link, $this->fm->validation($schoolyear));

        if (empty($schoolyear)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ dữ liệu!");</script>';
            return $alert;
        }

        $query = "SELECT * FROM `tbl_schoolyear` WHERE schoolyear = '$schoolyear'";
        $result = $this->db->select($query);

        if ($result) {
            $query = "DELETE FROM `tbl_schoolyear` WHERE schoolyear = '$schoolyear'";
            $result = $this->db->delete($query);

            if ($result) {
                $alert = '<script> toastr.success("Đã xóa dữ liệu thành công!");</script>';
                return $alert;
            }
            $alert = '<script> toastr.warning("Đã xóa dữ liệu thất bại!");</script>';
            return $alert;
        }
        return;
    }

    public function getShoolYear()
    {
        $query = "SELECT * FROM `tbl_schoolyear` GROUP BY schoolyear DESC";
        $result = $this->db->select($query);
        return $result;
    }
}
