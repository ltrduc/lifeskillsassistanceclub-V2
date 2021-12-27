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
        $idstudent = mysqli_real_escape_string($this->db->link, $this->fm->validation($idstudent));
        $level = mysqli_real_escape_string($this->db->link, $this->fm->validation($level));

        if ($idstudent == "050301" || $level == "050301") {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ dữ liệu!");</script>';
            return $alert;
        }

        $query = "UPDATE `tbl_user` SET `level`= '$level' WHERE idstudent = '$idstudent'";
        $result = $this->db->update($query);

        if ($result) {
            $alert = '<script> toastr.success("Cập nhật dữ liệu thành công!");</script>';
            return $alert;
        }

        $alert = '<script> toastr.warning("Cập nhật dữ liệu thất bại!");</script>';
        return $alert;
    }

    public function updatePersonnel($idstudent, $feature)
    {
        $idstudent = mysqli_real_escape_string($this->db->link, $this->fm->validation($idstudent));
        $feature = mysqli_real_escape_string($this->db->link, $this->fm->validation($feature));

        if ($idstudent == "050301" || $feature == "050301") {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ dữ liệu!");</script>';
            return $alert;
        }

        $query = "UPDATE `tbl_user` SET `feature`= '$feature' WHERE idstudent = '$idstudent'";
        $result = $this->db->update($query);

        if ($result) {
            $alert = '<script> toastr.success("Cập nhật dữ liệu thành công!");</script>';
            return $alert;
        }

        $alert = '<script> toastr.warning("Cập nhật dữ liệu thất bại!");</script>';
        return $alert;
    }
}
