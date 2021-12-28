<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * decentralization
 */
class decentralization
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function updateLevel($idstudent, $level)
    {
        $idstudent = $this->fm->validation($idstudent);
        $level = $this->fm->validation($level);

        $idstudent = mysqli_real_escape_string($this->db->link, $idstudent);
        $level = mysqli_real_escape_string($this->db->link, $level);

        if ($idstudent == "050301" || $level == "050301") {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $query = "UPDATE `tbl_user` SET `level`= '$level' WHERE idstudent = '$idstudent'";
            $result = $this->db->update($query);

            if ($result != false) {
                $alert = '<script> toastr.success("Cập nhật thành công!");</script>';
                return $alert;
            } else {
                $alert = '<script> toastr.warning("Cập nhật thất bại!");</script>';
                return $alert;
            }
        }
    }

    public function updatePersonnel($idstudent, $feature)
    {
        $idstudent = $this->fm->validation($idstudent);
        $feature = $this->fm->validation($feature);

        $idstudent = mysqli_real_escape_string($this->db->link, $idstudent);
        $feature = mysqli_real_escape_string($this->db->link, $feature);

        if ($idstudent == "050301" || $feature == "050301") {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $query = "UPDATE `tbl_user` SET `feature`= '$feature' WHERE idstudent = '$idstudent'";
            $result = $this->db->update($query);

            if ($result != false) {
                $alert = '<script> toastr.success("Cập nhật thành công!");</script>';
                return $alert;
            } else {
                $alert = '<script> toastr.warning("Cập nhật thất bại!");</script>';
                return $alert;
            }
        }
    }
}
