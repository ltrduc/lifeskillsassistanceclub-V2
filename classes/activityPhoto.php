<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * activityPhoto
 */
class activityPhoto
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function setActivityPhoto()
    {
        $query = "SELECT * FROM tbl_activityphoto";
        $result = $this->db->select($query);

        if ($result && $result->num_rows >= 9) {
            $alert = '<script> toastr.warning("Ảnh hoạt động tối đa là 9 ảnh!");</script>';
            return $alert;
        }

        if ($_FILES['images']['name'] != NULL) {
            if (
                $_FILES["images"]["type"] == "image/jpeg" || $_FILES["images"]["type"] == "image/png" ||
                $_FILES["images"]["type"] == "image/gif" || $_FILES["images"]["type"] == "image/jpg"
            ) {
                $path = "./images/action/";
                $tmp_name = $_FILES['images']['tmp_name'];
                $name = date('gisitis') . '-' . $_FILES['images']['name'];

                move_uploaded_file($tmp_name, $path . $name);
                $image_url = $path . $name;

                $query = "INSERT INTO `tbl_activityphoto`(`images`) VALUES ('$image_url')";
                $result = $this->db->insert($query);

                if ($result) {
                    $alert = '<script> toastr.success("Cập nhật dữ liệu thành công!");</script>';
                    return $alert;
                }
                $alert = '<script> toastr.warning("Cập nhật dữ liệu thất bại!");</script>';
                return $alert;
            }
            $alert = '<script> toastr.warning("File đăng tải không phải là file ảnh!");</script>';
            return $alert;
        }
        $alert = '<script> toastr.warning("Vui lòng chọn ảnh hoạt động!");</script>';
        return $alert;
    }

    public function deleteActivityPhoto($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $this->fm->validation($id));
        $query = "SELECT * FROM tbl_activityphoto WHERE id = '$id'";
        $result = $this->db->select($query);

        if ($result) {
            $value = $result->fetch_assoc();
            $img = substr($value['images'], 2, strlen($value['images']));
            unlink("$img");

            $query = "DELETE FROM `tbl_activityphoto` WHERE id = '$id'";
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

    public function getImages()
    {
        $query = "SELECT * FROM tbl_activityphoto";
        $result = $this->db->select($query);
        return $result;
    }
}
