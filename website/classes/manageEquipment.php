<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * manageEquipment
 */
class manageEquipment
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    /**
     * Typedevice
     */
    public function setTypedevice($device)
    {
        $device = mysqli_real_escape_string($this->db->link, $this->fm->validation($device));

        if (empty($device)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ dữ liệu!");</script>';
            return $alert;
        }

        $query = "SELECT * FROM tbl_device WHERE device = '$device'";
        $result = $this->db->select($query);

        if ($result) {
            $alert = '<script> toastr.warning("Loại thiết bị đã tồn tại!");</script>';
            return $alert;
        }

        $query = "INSERT INTO `tbl_device`(`device`) VALUES ('$device')";
        $result = $this->db->insert($query);

        if ($result) {
            $alert = '<script> toastr.success("Đã thêm dữ liệu thành công!");</script>';
            return $alert;
        }

        $alert = '<script> toastr.warning("Đã thêm dữ liệu thất bại!");</script>';
        return $alert;
    }

    public function getTypedevice()
    {
        $query = "SELECT * FROM tbl_device";
        $result = $this->db->select($query);
        return $result;
    }

    public function deleteTypedevice($device)
    {
        $device = mysqli_real_escape_string($this->db->link, $this->fm->validation($device));

        if (empty($device)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ dữ liệu!");</script>';
            return $alert;
        }

        $query = "SELECT * FROM tbl_device WHERE device = '$device'";
        $result = $this->db->select($query);

        if ($result) {
            $query = "DELETE FROM tbl_device WHERE device = '$device'";
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

    /**
     * Equipment
     */
    public function setEquipment($typedevice, $originalnumber)
    {
        $typedevice = mysqli_real_escape_string($this->db->link, $this->fm->validation($typedevice));
        $originalnumber = mysqli_real_escape_string($this->db->link, $this->fm->validation($originalnumber));

        if (empty($typedevice) || empty($originalnumber)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ dữ liệu!");</script>';
            return $alert;
        }

        $query = "INSERT INTO `tbl_equipment`(`typedevice`, `originalnumber`)  VALUES ('$typedevice','$originalnumber')";
        $result = $this->db->insert($query);

        if ($result) {
            $alert = '<script> toastr.success("Đã thêm dữ liệu thành công!");</script>';
            return $alert;
        }

        $alert = '<script> toastr.warning("Đã thêm dữ liệu thất bại!");</script>';
        return $alert;
    }

    public function updateEquipment($typedevice, $originalnumber, $donotuse, $normal, $using, $broken, $lost)
    {
        $typedevice = mysqli_real_escape_string($this->db->link, $this->fm->validation($typedevice));
        $originalnumber = mysqli_real_escape_string($this->db->link, $this->fm->validation($originalnumber));
        $donotuse = mysqli_real_escape_string($this->db->link, $this->fm->validation($donotuse));
        $normal = mysqli_real_escape_string($this->db->link, $this->fm->validation($normal));
        $using = mysqli_real_escape_string($this->db->link, $this->fm->validation($using));
        $broken = mysqli_real_escape_string($this->db->link, $this->fm->validation($broken));
        $lost = mysqli_real_escape_string($this->db->link, $this->fm->validation($lost));

        $query = "DELETE FROM `tbl_equipment` WHERE typedevice = '$typedevice'";
        $result = $this->db->delete($query);

        if ($result) {
            $query = "INSERT INTO `tbl_equipment`(`typedevice`, `originalnumber`, `using`, `donotuse`, `normal`, `broken`, `lost`) 
            VALUES ('$typedevice','$originalnumber', '$using', '$donotuse', '$normal', '$broken', '$lost')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = '<script> toastr.success("Cập nhật dữ liệu thành công!");</script>';
                return $alert;
            }
        }

        $alert = '<script> toastr.warning("Cập nhật dữ liệu thất bại!");</script>';
        return $alert;
    }

    public function deleteEquipment($typedevice)
    {
        $typedevice = mysqli_real_escape_string($this->db->link, $this->fm->validation($typedevice));

        $query = "SELECT * FROM tbl_equipment WHERE typedevice = '$typedevice'";
        $result = $this->db->select($query);

        if ($result) {
            $query = "DELETE FROM tbl_equipment WHERE typedevice = '$typedevice'";
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

    public function getEquipment()
    {
        $query = "SELECT `typedevice`, SUM(`originalnumber`) AS `originalnumber`, SUM(`using`) AS `using`,
        SUM(`originalnumber`) - `using` AS `donotuse`,
        SUM(`originalnumber`) - SUM(`broken`) - SUM(`lost`) AS `normal`,
        SUM(`broken`) AS `broken`, SUM(`lost`) AS `lost`
        FROM `tbl_equipment` GROUP BY `typedevice`";

        $result = $this->db->select($query);
        return $result;
    }

    public function getEquipmentId($typedevice)
    {
        $typedevice = mysqli_real_escape_string($this->db->link, $this->fm->validation($typedevice));

        $query = "SELECT `typedevice`, SUM(`originalnumber`) AS `originalnumber`,
        SUM(`using`) AS `using`, SUM(`originalnumber`) - `using` AS `donotuse`,
        SUM(`originalnumber`) - SUM(`broken`) - SUM(`lost`) AS `normal`,
        SUM(`broken`) AS `broken`, SUM(`lost`) AS `lost`
        FROM `tbl_equipment` WHERE `typedevice` = '$typedevice' GROUP BY `typedevice`";

        $result = $this->db->select($query);
        return $result;
    }
}
