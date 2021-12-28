<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * loanPayment
 */
class loanPayment
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function setLoanPayment($name, $phone, $devices, $quantity, $begin, $end, $reason)
    {
        $name = $this->fm->validation($name);
        $phone = $this->fm->validation($phone);
        $devices = $this->fm->validation($devices);
        $quantity = $this->fm->validation($quantity);
        $begin = $this->fm->validation($begin);
        $end = $this->fm->validation($end);
        $reason = $this->fm->validation($reason);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $devices = mysqli_real_escape_string($this->db->link, $devices);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $begin = mysqli_real_escape_string($this->db->link, $begin);
        $end = mysqli_real_escape_string($this->db->link, $end);
        $reason = mysqli_real_escape_string($this->db->link, $reason);

        if (
            empty($name) || empty($phone) || empty($devices) || empty($quantity) || empty($begin) || empty($end)
        ) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $query = "INSERT INTO `tbl_loanpayment`(`name`, `phone`, `devices`, `quantity`, `begin`, `end` , `reason`, `status`) 
            VALUES ('$name','$phone','$devices','$quantity','$begin','$end', '$reason','Chưa trả')";
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

    public function statusLoanPayment($id, $status)
    {
        $query = "UPDATE `tbl_loanpayment` SET `status`= '$status' WHERE id = '$id'";
        $result = $this->db->update($query);

        if ($result == false) {
            $alert = '<script> toastr.warning("Cập nhật không thành công!");</script>';
            return $alert;
        } else {
            $alert = '<script> toastr.success("Cập nhật thành công!");</script>';
            return $alert;
        }
    }

    public function updateLoanPayment($id, $name, $phone, $devices, $quantity, $begin, $end, $reason)
    {
        $name = $this->fm->validation($name);
        $phone = $this->fm->validation($phone);
        $devices = $this->fm->validation($devices);
        $quantity = $this->fm->validation($quantity);
        $begin = $this->fm->validation($begin);
        $end = $this->fm->validation($end);
        $reason = $this->fm->validation($reason);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $devices = mysqli_real_escape_string($this->db->link, $devices);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $begin = mysqli_real_escape_string($this->db->link, $begin);
        $end = mysqli_real_escape_string($this->db->link, $end);
        $reason = mysqli_real_escape_string($this->db->link, $reason);

        $query = "UPDATE `tbl_loanpayment` SET 
        `name`='$name',
        `phone` = '$phone',
        `devices`='$devices',
        `quantity`='$quantity',
        `begin`='$begin',
        `end`='$end',
        `reason`='$reason'
        WHERE id = '$id'";

        $result = $this->db->update($query);

        if ($result != false) {
            $alert = '<script> toastr.success("Cập nhật thành công!");</script>';
            return $alert;
        } else {
            $alert = '<script> toastr.warning("Cập nhật thất bại!");</script>';
            return $alert;
        }
    }

    public function deleteLoanPayment($id)
    {
        $query = "SELECT * FROM tbl_loanpayment WHERE id = '$id'";
        $result = $this->db->select($query);

        if ($result && $result->num_rows > 0) {
            $query = "DELETE FROM tbl_loanpayment WHERE id = '$id'";
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

    public function getLoanPayment()
    {
        $query = "SELECT * FROM `tbl_loanpayment` ORDER BY `status` ASC";
        $result = $this->db->select($query);

        return $result;
    }

    public function getLoanPaymentId($id)
    {
        $query = "SELECT * FROM `tbl_loanpayment` WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
}
