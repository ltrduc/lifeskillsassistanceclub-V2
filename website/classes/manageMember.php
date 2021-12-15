<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * manageMember
 */
class manageMember
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function countMenber()
    {
        $query = "SELECT count(*) AS feature FROM tbl_user WHERE feature = 0";
        $result = $this->db->select($query);
        $value = $result->fetch_assoc();
        return $value['feature'];
    }

    public function countCollaborator()
    {
        $query = "SELECT count(*) AS feature FROM tbl_user WHERE feature = 1";
        $result = $this->db->select($query);
        $value = $result->fetch_assoc();
        return $value['feature'];
    }

    public function countSelectiveMember()
    {
        $query = "SELECT count(*) AS countselectivemember FROM tbl_selective";
        $result = $this->db->select($query);
        $value = $result->fetch_assoc();
        return $value['countselectivemember'];
    }

    public function countAdministration()
    {
        $query = "SELECT count(*) AS administration FROM tbl_user WHERE `level` = 0";
        $result = $this->db->select($query);
        $value = $result->fetch_assoc();
        return $value['administration'];
    }

    /**
     * Member
     */
    public function setMember($idstudent, $fullname, $birthday, $team, $phone, $facebook)
    {
        $idstudent = $this->fm->validation($idstudent);
        $fullname = $this->fm->validation($fullname);
        $birthday = $this->fm->validation($birthday);
        $team = $this->fm->validation($team);
        $phone = $this->fm->validation($phone);
        $facebook = $this->fm->validation($facebook);

        $idstudent = mysqli_real_escape_string($this->db->link, $idstudent);
        $fullname = mysqli_real_escape_string($this->db->link, $fullname);
        $birthday = mysqli_real_escape_string($this->db->link, $birthday);
        $team = mysqli_real_escape_string($this->db->link, $team);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $facebook = mysqli_real_escape_string($this->db->link, $facebook);

        if (empty($idstudent) || empty($fullname) || empty($team)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_user WHERE idstudent = '$idstudent' LIMIT 1";
            $result = $this->db->select($query);

            if ($result && $result->num_rows > 0) {
                $alert = '<script> toastr.warning(" ' . $idstudent . ' đã tồn tại!");</script>';
                return $alert;
            } else {
                $query = "INSERT INTO `tbl_user`(`user`, `password`, `idstudent`, `fullname`, `birthday`, `facebook`, `team`, `phone`, `level`, `feature`)
                VALUES ('$idstudent', '$idstudent', '$idstudent', '$fullname', ' $birthday', '$facebook', '$team', '$phone', '3', '0')";
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

    public function getMember()
    {
        $query = "SELECT * FROM tbl_user WHERE feature = '0' ORDER BY team ASC";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * Collaborators
     */
    public function setCollaborators($idstudent, $fullname, $birthday, $team, $phone, $facebook)
    {
        $idstudent = $this->fm->validation($idstudent);
        $fullname = $this->fm->validation($fullname);
        $birthday = $this->fm->validation($birthday);
        $team = $this->fm->validation($team);
        $phone = $this->fm->validation($phone);
        $facebook = $this->fm->validation($facebook);

        $idstudent = mysqli_real_escape_string($this->db->link, $idstudent);
        $fullname = mysqli_real_escape_string($this->db->link, $fullname);
        $birthday = mysqli_real_escape_string($this->db->link, $birthday);
        $team = mysqli_real_escape_string($this->db->link, $team);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $facebook = mysqli_real_escape_string($this->db->link, $facebook);

        if (empty($idstudent) || empty($fullname)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_user WHERE idstudent = '$idstudent' LIMIT 1";
            $result = $this->db->select($query);

            if ($result && $result->num_rows > 0) {
                $alert = '<script> toastr.warning(" ' . $idstudent . ' đã tồn tại!");</script>';
                return $alert;
            } else {
                $query = "INSERT INTO `tbl_user`(`user`, `password`, `idstudent`, `fullname`, `birthday`, `facebook`, `team`, `phone`, `level`, `feature`)
                VALUES ('$idstudent', '$idstudent', '$idstudent', '$fullname', ' $birthday', '$facebook', '$team', '$phone', '3', '1')";
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

    public function getCollaborators()
    {
        $query = "SELECT * FROM tbl_user WHERE feature = '1' ORDER BY team ASC";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * in List tbl_user
     */
    public function updatePersonnel($id, $idstudent, $fullname, $birthday, $team, $phone, $facebook)
    {
        $idstudent = $this->fm->validation($idstudent);
        $fullname = $this->fm->validation($fullname);
        $birthday = $this->fm->validation($birthday);
        $team = $this->fm->validation($team);
        $phone = $this->fm->validation($phone);
        $facebook = $this->fm->validation($facebook);

        $id = mysqli_real_escape_string($this->db->link, $id);
        $idstudent = mysqli_real_escape_string($this->db->link, $idstudent);
        $fullname = mysqli_real_escape_string($this->db->link, $fullname);
        $birthday = mysqli_real_escape_string($this->db->link, $birthday);
        $team = mysqli_real_escape_string($this->db->link, $team);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $facebook = mysqli_real_escape_string($this->db->link, $facebook);

        $query = "UPDATE `tbl_user` SET
        `fullname`='$fullname',
        `birthday`='$birthday',
        `facebook`='$facebook',
        `team`='$team',
        `phone`='$phone' WHERE `id` = '$id' AND idstudent = '$idstudent'";

        $result = $this->db->update($query);

        if ($result == false) {
            $alert = '<script> toastr.warning("Cập nhật không thành công!");</script>';
            return $alert;
        } else {
            $alert = '<script> toastr.success("Cập nhật thành công!");</script>';
            return $alert;
        }
    }

    public function deletePersonnel($id)
    {
        $query = "SELECT * FROM tbl_user WHERE id = '$id'";
        $result = $this->db->select($query);

        if ($result && $result->num_rows > 0) {
            $query = "DELETE FROM `tbl_user` WHERE id = '$id'";
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

    public function getPersonnelId($id)
    {
        $query = "SELECT * FROM tbl_user WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getPersonnel()
    {
        $query = "SELECT * FROM tbl_user";
        $result = $this->db->select($query);
        return $result;
    }
}
