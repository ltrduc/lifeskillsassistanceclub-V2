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
        $query = "SELECT count(*) AS countselectivemember FROM tbl_recruitment";
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
        $idstudent = mysqli_real_escape_string($this->db->link, $this->fm->validation($idstudent));
        $fullname = mysqli_real_escape_string($this->db->link, $this->fm->validation($fullname));
        $birthday = mysqli_real_escape_string($this->db->link, $this->fm->validation($birthday));
        $team = mysqli_real_escape_string($this->db->link, $this->fm->validation($team));
        $phone = mysqli_real_escape_string($this->db->link, $this->fm->validation($phone));
        $facebook = mysqli_real_escape_string($this->db->link, $this->fm->validation($facebook));

        if (empty($idstudent) || empty($fullname) || empty($team)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ dữ liệu!");</script>';
            return $alert;
        }

        $query = "SELECT * FROM tbl_user WHERE idstudent = '$idstudent' LIMIT 1";
        $result = $this->db->select($query);

        if ($result) {
            $alert = '<script> toastr.warning(" ' . $idstudent . ' đã tồn tại!");</script>';
            return $alert;
        }

        $password = md5($idstudent);
        $query = "INSERT INTO `tbl_user`(`user`, `password`, `idstudent`, `fullname`, `birthday`, `facebook`, `team`, `phone`, `level`, `feature`)
        VALUES ('$idstudent', '$password', '$idstudent', '$fullname', ' $birthday', '$facebook', '$team', '$phone', '3', '0')";
        $result = $this->db->insert($query);

        if ($result) {
            $alert = '<script> toastr.success("Đã thêm dữ liệu thành công!");</script>';
            return $alert;
        }

        $alert = '<script> toastr.warning("Đã thêm dữ liệu thất bại!");</script>';
        return $alert;
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
        $idstudent = mysqli_real_escape_string($this->db->link, $this->fm->validation($idstudent));
        $fullname = mysqli_real_escape_string($this->db->link, $this->fm->validation($fullname));
        $birthday = mysqli_real_escape_string($this->db->link, $this->fm->validation($birthday));
        $team = mysqli_real_escape_string($this->db->link, $this->fm->validation($team));
        $phone = mysqli_real_escape_string($this->db->link, $this->fm->validation($phone));
        $facebook = mysqli_real_escape_string($this->db->link, $this->fm->validation($facebook));

        if (empty($idstudent) || empty($fullname)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ dữ liệu!");</script>';
            return $alert;
        }

        $query = "SELECT * FROM tbl_user WHERE idstudent = '$idstudent' LIMIT 1";
        $result = $this->db->select($query);

        if ($result) {
            $alert = '<script> toastr.warning(" ' . $idstudent . ' đã tồn tại!");</script>';
            return $alert;
        }

        $password = md5($idstudent);
        $query = "INSERT INTO `tbl_user`(`user`, `password`, `idstudent`, `fullname`, `birthday`, `facebook`, `team`, `phone`, `level`, `feature`)
        VALUES ('$idstudent', '$password', '$idstudent', '$fullname', ' $birthday', '$facebook', '$team', '$phone', '3', '1')";
        $result = $this->db->insert($query);

        if ($result) {
            $alert = '<script> toastr.success("Đã thêm dữ liệu thành công!");</script>';
            return $alert;
        }

        $alert = '<script> toastr.warning("Đã thêm dữ liệu thất bại!");</script>';
        return $alert;
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
        $id = mysqli_real_escape_string($this->db->link, $this->fm->validation($id));
        $idstudent = mysqli_real_escape_string($this->db->link, $this->fm->validation($idstudent));
        $fullname = mysqli_real_escape_string($this->db->link, $this->fm->validation($fullname));
        $birthday = mysqli_real_escape_string($this->db->link, $this->fm->validation($birthday));
        $team = mysqli_real_escape_string($this->db->link, $this->fm->validation($team));
        $phone = mysqli_real_escape_string($this->db->link, $this->fm->validation($phone));
        $facebook = mysqli_real_escape_string($this->db->link, $this->fm->validation($facebook));

        $query = "UPDATE `tbl_user` SET `fullname`='$fullname', `birthday`='$birthday', `facebook`='$facebook', 
        `team`='$team', `phone`='$phone' WHERE `id` = '$id' AND idstudent = '$idstudent'";
        $result = $this->db->update($query);

        if ($result) {
            $alert = '<script> toastr.success("Cập nhật dữ liệu thành công!");</script>';
            return $alert;
        }

        $alert = '<script> toastr.warning("Cập nhật dữ liệu không thành công!");</script>';
        return $alert;
    }

    public function deletePersonnel($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $this->fm->validation($id));

        $query = "SELECT * FROM tbl_user WHERE id = '$id'";
        $result = $this->db->select($query);

        if ($result && $result->num_rows > 0) {
            $query = "DELETE FROM `tbl_user` WHERE id = '$id'";
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

    public function getPersonnelId($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $this->fm->validation($id));

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
