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
        $name = mysqli_real_escape_string($this->db->link, $this->fm->validation($name));
        $phone = mysqli_real_escape_string($this->db->link, $this->fm->validation($phone));
        $devices = mysqli_real_escape_string($this->db->link, $this->fm->validation($devices));
        $quantity = mysqli_real_escape_string($this->db->link, $this->fm->validation($quantity));
        $begin = mysqli_real_escape_string($this->db->link, $this->fm->validation($begin));
        $end = mysqli_real_escape_string($this->db->link, $this->fm->validation($end));
        $reason = mysqli_real_escape_string($this->db->link, $this->fm->validation($reason));

        if (empty($name) || empty($phone) || empty($devices) || empty($quantity) || empty($begin) || empty($end)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ dữ liệu!");</script>';
            return $alert;
        }

        $query = "INSERT INTO `tbl_loanpayment`(`name`, `phone`, `devices`, `quantity`, `begin`, `end` , `reason`, `status`) 
            VALUES ('$name','$phone','$devices','$quantity','$begin','$end', '$reason','Chưa trả')";
        $result = $this->db->insert($query);

        if ($result) {
            $alert = '<script> toastr.success("Đã thêm dữ liệu thành công!");</script>';
            return $alert;
        }

        $alert = '<script> toastr.warning("Đã thêm dữ liệu thất bại!");</script>';
        return $alert;
    }

    public function statusLoanPayment($id, $status)
    {
        $id = mysqli_real_escape_string($this->db->link, $this->fm->validation($id));
        $status = mysqli_real_escape_string($this->db->link, $this->fm->validation($status));

        $query = "UPDATE `tbl_loanpayment` SET `status`= '$status' WHERE id = '$id'";
        $result = $this->db->update($query);

        if ($result) {
            $alert = '<script> toastr.success("Cập nhật dữ liệu thành công!");</script>';
            return $alert;
        }

        $alert = '<script> toastr.warning("Cập nhật dữ liệu thất bại!");</script>';
        return $alert;
    }

    public function updateLoanPayment($id, $name, $phone, $devices, $quantity, $begin, $end, $reason)
    {
        $name = mysqli_real_escape_string($this->db->link, $this->fm->validation($name));
        $phone = mysqli_real_escape_string($this->db->link, $this->fm->validation($phone));
        $devices = mysqli_real_escape_string($this->db->link, $this->fm->validation($devices));
        $quantity = mysqli_real_escape_string($this->db->link, $this->fm->validation($quantity));
        $begin = mysqli_real_escape_string($this->db->link, $this->fm->validation($begin));
        $end = mysqli_real_escape_string($this->db->link, $this->fm->validation($end));
        $reason = mysqli_real_escape_string($this->db->link, $this->fm->validation($reason));

        $query = "UPDATE `tbl_loanpayment` SET `name`='$name', `phone` = '$phone', `devices`='$devices',
        `quantity`='$quantity', `begin`='$begin', `end`='$end', `reason`='$reason' WHERE id = '$id'";
        $result = $this->db->update($query);

        if ($result) {
            $alert = '<script> toastr.success("Cập nhật dữ liệu thành công!");</script>';
            return $alert;
        }

        $alert = '<script> toastr.warning("Cập nhật dữ liệu thất bại!");</script>';
        return $alert;
    }

    public function deleteLoanPayment($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $this->fm->validation($id));

        $query = "SELECT * FROM tbl_loanpayment WHERE id = '$id'";
        $result = $this->db->select($query);

        if ($result) {
            $query = "DELETE FROM tbl_loanpayment WHERE id = '$id'";
            $result = $this->db->delete($query);

            if ($result) {
                $alert = '<script> toastr.success("Đã xóa dữ liệu thành công!");</script>';
                return $alert;
            }
        }

        $alert = '<script> toastr.warning("Đã xóa dữ liệu thất bại!");</script>';
        return $alert;
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
