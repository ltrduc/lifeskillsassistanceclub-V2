<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * changePassword
 */
class changePassword
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function changePassword($user, $oldpwd, $newpwd, $renewpwd)
    {
        $user = mysqli_real_escape_string($this->db->link, $this->fm->validation($user));
        $oldpwd = md5(mysqli_real_escape_string($this->db->link, $this->fm->validation($oldpwd)));
        $newpwd = md5(mysqli_real_escape_string($this->db->link, $this->fm->validation($newpwd)));
        $renewpwd = md5(mysqli_real_escape_string($this->db->link, $this->fm->validation($renewpwd)));

        if (empty($user) || empty($oldpwd) || empty($newpwd) || empty($renewpwd)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ dữ liệu!");</script>';
            return $alert;
        }

        $query = "SELECT * FROM tbl_user WHERE user = '$user' AND idstudent = '$user' AND password = '$oldpwd'";
        $result = $this->db->select($query);

        if ($result) {
            if ($newpwd != $renewpwd) {
                $alert = '<script> toastr.warning("Mật khẩu mới không trùng khớp!");</script>';
                return $alert;
            }

            $query = "UPDATE `tbl_user` SET `password`='$newpwd' WHERE user = '$user' AND idstudent = '$user' AND password = '$oldpwd'";
            $result = $this->db->update($query);

            if ($result) {
                $alert = '<script> toastr.success("Đã cập nhật dữ liệu thành công!");</script>';
                return $alert;
            }
            $alert = '<script> toastr.warning("Đã cập nhật dữ liệu thất bại!");</script>';
            return $alert;
        }
        $alert = '<script> toastr.warning("Mật khẩu cũ không trùng khớp!");</script>';
        return $alert;
    }
}
