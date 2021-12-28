<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * manageStructure
 */
class manageStructure
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function setStructure($idstudent, $position)
    {
        $idstudent = mysqli_real_escape_string($this->db->link, $idstudent);
        $position = mysqli_real_escape_string($this->db->link, $position);

        if (empty($idstudent) || empty($position)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_structure WHERE idstudent = '$idstudent' OR position = '$position'";
            $result = $this->db->select($query);

            if ($result && $result->num_rows > 0) {
                $alert = '<script> toastr.warning("Thành viên hoặc chức vụ đã tồn tại!");</script>';
                return $alert;
            } else {
                if ($_FILES['images']['name'] != NULL) {
                    if (
                        $_FILES["images"]["type"] == "image/jpeg"
                        || $_FILES["images"]["type"] == "image/png"
                        || $_FILES["images"]["type"] == "image/gif"
                        || $_FILES["images"]["type"] == "image/jpg"
                    ) {
                        // Xóa ảnh cũ trong file
                        $query = "SELECT images FROM tbl_structure WHERE idstudent = '$idstudent'";
                        $result = $this->db->select($query);

                        if ($result) {
                            $value = $result->fetch_assoc();
                            if ($value['images'] != NULL) {
                                $img = substr($value['images'], 2, strlen($value['images']));
                                unlink("$img");
                            }
                        }

                        $path = "./images/structure/";
                        $tmp_name = $_FILES['images']['tmp_name'];
                        $name = $_FILES['images']['name'];

                        move_uploaded_file($tmp_name, $path . $name);
                        $image_url = $path . $name;

                        $query = "INSERT INTO `tbl_structure`(`idstudent`, `position`, `images`) 
                        VALUES ('$idstudent', '$position', '$image_url')";
                        $result = $this->db->insert($query);
                    } else {
                        $alert = '<script> toastr.warning("File đăng tải không phải là file ảnh!");</script>';
                        return $alert;
                    }
                } else {
                    $image_url = "";
                    $query = "INSERT INTO `tbl_structure`(`idstudent`, `position`, `images`) 
                    VALUES ('$idstudent', '$position', '$image_url')";
                    $result = $this->db->insert($query);
                }

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

    public function deleteStructure($idstudent)
    {
        $query = "SELECT images FROM tbl_structure WHERE idstudent = '$idstudent'";
        $result = $this->db->select($query);

        if ($result && $result->num_rows > 0) {
            if ($result) {
                $value = $result->fetch_assoc();
                if ($value['images'] != NULL) {
                    $img = substr($value['images'], 2, strlen($value['images']));
                    unlink("$img");
                }
            }

            $query = "DELETE FROM `tbl_structure` WHERE idstudent = '$idstudent'";
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

    public function getStructure()
    {
        $query = "SELECT tbl_structure.idstudent, tbl_user.fullname, tbl_user.team, position
        FROM `tbl_structure`, `tbl_user` WHERE tbl_user.idstudent = tbl_structure.idstudent";

        $result = $this->db->select($query);
        return $result;
    }

    // backend
    public function getChuNhiem()
    {
        $query = "SELECT tbl_user.fullname, tbl_user.facebook 
        FROM `tbl_structure`, `tbl_user` 
        WHERE tbl_user.idstudent = tbl_structure.idstudent AND position = 'Chủ nhiệm'";

        $result = $this->db->select($query);
        return $result;
    }

    public function getPhoBanhanhChinh()
    {
        $query = "SELECT tbl_user.fullname, tbl_user.facebook 
        FROM `tbl_structure`, `tbl_user` 
        WHERE tbl_user.idstudent = tbl_structure.idstudent AND position = 'Phó ban Hành chính'";

        $result = $this->db->select($query);
        return $result;
    }

    public function getPhoBanNhanSu()
    {
        $query = "SELECT tbl_user.fullname, tbl_user.facebook 
        FROM `tbl_structure`, `tbl_user` 
        WHERE tbl_user.idstudent = tbl_structure.idstudent AND position = 'Phó ban Nhân sự'";

        $result = $this->db->select($query);
        return $result;
    }

    public function getPhoBanTruyenThong()
    {
        $query = "SELECT tbl_user.fullname, tbl_user.facebook 
        FROM `tbl_structure`, `tbl_user` 
        WHERE tbl_user.idstudent = tbl_structure.idstudent AND position = 'Phó ban Truyền thông'";

        $result = $this->db->select($query);
        return $result;
    }

    public function getTruongBanHanhChinh()
    {
        $query = "SELECT tbl_user.fullname, tbl_user.facebook 
        FROM `tbl_structure`, `tbl_user` 
        WHERE tbl_user.idstudent = tbl_structure.idstudent AND position = 'Trưởng ban Hành chính'";

        $result = $this->db->select($query);
        return $result;
    }

    public function getTruongBanNhanSu()
    {
        $query = "SELECT tbl_user.fullname, tbl_user.facebook 
        FROM `tbl_structure`, `tbl_user` 
        WHERE tbl_user.idstudent = tbl_structure.idstudent AND position = 'Trưởng ban Nhân sự'";

        $result = $this->db->select($query);
        return $result;
    }

    public function getTruongBanTruyenThong()
    {
        $query = "SELECT tbl_user.fullname, tbl_user.facebook 
        FROM `tbl_structure`, `tbl_user` 
        WHERE tbl_user.idstudent = tbl_structure.idstudent AND position = 'Trưởng ban Truyền thông'";

        $result = $this->db->select($query);
        return $result;
    }
}