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
        $user = $this->fm->validation($user);
        $oldpwd = $this->fm->validation($oldpwd);
        $newpwd = $this->fm->validation($newpwd);
        $renewpwd = $this->fm->validation($renewpwd);

        $user = mysqli_real_escape_string($this->db->link, $user);
        $oldpwd = mysqli_real_escape_string($this->db->link, $oldpwd);
        $newpwd = mysqli_real_escape_string($this->db->link, $newpwd);
        $renewpwd = mysqli_real_escape_string($this->db->link, $renewpwd);

        if (empty($user) || empty($oldpwd) || empty($newpwd) || empty($renewpwd)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {

            $query = "SELECT * FROM tbl_user WHERE user = '$user' AND idstudent = '$user' AND password = '$oldpwd'";
            $result = $this->db->select($query);

            if ($result != false) {
                if ($newpwd != $renewpwd) {
                    $alert = '<script> toastr.warning("Mật khẩu mới không trùng khớp!");</script>';
                    return $alert;
                } else {
                    $query = "UPDATE `tbl_user` SET `password`='$newpwd' WHERE user = '$user' AND idstudent = '$user' AND password = '$oldpwd'";
                    $result = $this->db->update($query);

                    if ($result != false) {
                        $alert = '<script> toastr.success("Cập nhật thành công!");</script>';
                        return $alert;
                    } else {
                        $alert = '<script> toastr.warning("Cập nhật thất bại!");</script>';
                        return $alert;
                    }
                }
            } else {
                $alert = '<script> toastr.warning("Mật khẩu cũ không trùng khớp!");</script>';
                return $alert;
            }
        }
    }
}
