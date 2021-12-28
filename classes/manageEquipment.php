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
        $device = $this->fm->validation($device);
        $device = mysqli_real_escape_string($this->db->link, $device);

        if (empty($device)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_device WHERE device = '$device'";
            $result = $this->db->select($query);

            if ($result && $result->num_rows > 0) {
                $alert = '<script> toastr.warning("Lại thiết bị đã tồn tại!");</script>';
                return $alert;
            } else {
                $query = "INSERT INTO `tbl_device`(`device`) VALUES ('$device')";
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

    public function getTypedevice()
    {
        $query = "SELECT * FROM tbl_device";
        $result = $this->db->select($query);
        return $result;
    }

    public function deleteTypedevice($device)
    {
        if (empty($device)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_device WHERE device = '$device'";
            $result = $this->db->select($query);

            if ($result && $result->num_rows > 0) {
                $query = "DELETE FROM tbl_device WHERE device = '$device'";
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

    /**
     * Equipment
     */
    public function setEquipment($typedevice, $originalnumber)
    {
        $typedevice = $this->fm->validation($typedevice);
        $originalnumber = $this->fm->validation($originalnumber);

        $typedevice = mysqli_real_escape_string($this->db->link, $typedevice);
        $originalnumber = mysqli_real_escape_string($this->db->link, $originalnumber);

        if (empty($typedevice) || empty($originalnumber)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $query = "INSERT INTO `tbl_equipment`(`typedevice`, `originalnumber`) 
            VALUES ('$typedevice','$originalnumber')";

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

    public function updateEquipment($typedevice, $originalnumber, $donotuse, $normal, $using, $broken, $lost)
    {
        $typedevice = $this->fm->validation($typedevice);
        $originalnumber = $this->fm->validation($originalnumber);
        $donotuse = $this->fm->validation($donotuse);
        $normal = $this->fm->validation($normal);
        $using = $this->fm->validation($using);
        $broken = $this->fm->validation($broken);
        $lost = $this->fm->validation($lost);

        $typedevice = mysqli_real_escape_string($this->db->link, $typedevice);
        $originalnumber = mysqli_real_escape_string($this->db->link, $originalnumber);
        $donotuse = mysqli_real_escape_string($this->db->link, $donotuse);
        $normal = mysqli_real_escape_string($this->db->link, $normal);
        $using = mysqli_real_escape_string($this->db->link, $using);
        $broken = mysqli_real_escape_string($this->db->link, $broken);
        $lost = mysqli_real_escape_string($this->db->link, $lost);

        $query = "DELETE FROM `tbl_equipment` WHERE typedevice = '$typedevice'";
        $result = $this->db->delete($query);

        $query = "INSERT INTO `tbl_equipment`(`typedevice`, `originalnumber`, `using`, `donotuse`, `normal`, `broken`, `lost`) 
            VALUES ('$typedevice','$originalnumber', '$using', '$donotuse', '$normal', '$broken', '$lost')";
        $result = $this->db->insert($query);

        if ($result != false) {
            $alert = '<script> toastr.success("Cập nhật thành công!");</script>';
            return $alert;
        } else {
            $alert = '<script> toastr.warning("Cập nhật thất bại!");</script>';
            return $alert;
        }
    }

    public function deleteEquipment($typedevice)
    {
        $query = "SELECT * FROM tbl_equipment WHERE typedevice = '$typedevice'";
        $result = $this->db->select($query);

        if ($result && $result->num_rows > 0) {
            $query = "DELETE FROM tbl_equipment WHERE typedevice = '$typedevice'";
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

    public function getEquipment()
    {
        $query = "SELECT `typedevice`, 
        SUM(`originalnumber`) AS `originalnumber`,
        SUM(`using`) AS `using`,
        SUM(`originalnumber`) - `using` AS `donotuse`,
        SUM(`originalnumber`) - SUM(`broken`) - SUM(`lost`) AS `normal`,
        SUM(`broken`) AS `broken`,
        SUM(`lost`) AS `lost`
        FROM `tbl_equipment`
        GROUP BY `typedevice`";

        $result = $this->db->select($query);
        return $result;
    }

    public function getEquipmentId($typedevice)
    {
        $query = "SELECT `typedevice`, 
        SUM(`originalnumber`) AS `originalnumber`,
        SUM(`using`) AS `using`,
        SUM(`originalnumber`) - `using` AS `donotuse`,
        SUM(`originalnumber`) - SUM(`broken`) - SUM(`lost`) AS `normal`,
        SUM(`broken`) AS `broken`,
        SUM(`lost`) AS `lost`
        FROM `tbl_equipment` 
        WHERE `typedevice` = '$typedevice'
        GROUP BY `typedevice`";

        $result = $this->db->select($query);
        return $result;
    }
}
