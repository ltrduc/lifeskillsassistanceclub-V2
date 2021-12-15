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
            $alert = '<script> toastr.warning("Ảnh hoạt động tối đa là 6 ảnh!");</script>';
            return $alert;
        } else {
            if ($_FILES['images']['name'] != NULL) {
                if (
                    $_FILES["images"]["type"] == "image/jpeg"
                    || $_FILES["images"]["type"] == "image/png"
                    || $_FILES["images"]["type"] == "image/gif"
                    || $_FILES["images"]["type"] == "image/jpg"
                ) {
                    $path = "./images/action/";
                    $tmp_name = $_FILES['images']['tmp_name'];
                    $name = $_FILES['images']['name'];

                    move_uploaded_file($tmp_name, $path . $name);
                    $image_url = $path . $name;

                    $query = "INSERT INTO `tbl_activityphoto`(`images`) 
                    VALUES ('$image_url')";
                    $result = $this->db->insert($query);

                    if ($result != false) {
                        $alert = '<script> toastr.success("Cập nhật thành công!");</script>';
                        return $alert;
                    } else {
                        $alert = '<script> toastr.warning("Cập nhật thất bại!");</script>';
                        return $alert;
                    }
                } else {
                    $alert = '<script> toastr.warning("File đăng tải không phải là file ảnh!");</script>';
                    return $alert;
                }
            } else {
                $alert = '<script> toastr.warning("Vui lòng chọn ảnh!");</script>';
                return $alert;
            }
        }
    }

    public function deleteActivityPhoto($id)
    {
        $query = "SELECT * FROM tbl_activityphoto WHERE id = '$id'";
        $result = $this->db->select($query);

        if ($result && $result->num_rows > 0) {
            $value = $result->fetch_assoc();
            $img = substr($value['images'], 2, strlen($value['images']));
            unlink("$img");

            $query = "DELETE FROM `tbl_activityphoto` WHERE id = '$id'";
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

    public function getImages()
    {
        $query = "SELECT * FROM tbl_activityphoto";
        $result = $this->db->select($query);

        return $result;
    }
}
