<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * manageSchedule
 */
class manageSchedule
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function setSchedule($idstudent, $session, $shift1, $shift2, $shift3, $shift4)
    {
        $idstudent = mysqli_real_escape_string($this->db->link, $this->fm->validation($idstudent));
        $session = mysqli_real_escape_string($this->db->link, $this->fm->validation($session));
        $shift1 = mysqli_real_escape_string($this->db->link, $this->fm->validation($shift1));
        $shift2 = mysqli_real_escape_string($this->db->link, $this->fm->validation($shift2));
        $shift3 = mysqli_real_escape_string($this->db->link, $this->fm->validation($shift3));
        $shift4 = mysqli_real_escape_string($this->db->link, $this->fm->validation($shift4));

        if (empty($idstudent) || empty($session)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ dữ liệu!");</script>';
            return $alert;
        }

        $shift = "";
        if (!empty($shift1)) $shift = $shift . $shift1 . " ";
        if (!empty($shift2)) $shift = $shift . $shift2 . " ";
        if (!empty($shift3)) $shift = $shift . $shift3 . " ";
        if (!empty($shift4)) $shift = $shift . $shift4 . " ";

        if ($shift == "") {
            $alert = '<script> toastr.warning("Vui lòng nhập ca trực!");</script>';
            return $alert;
        }

        $query = "SELECT idstudent, session FROM tbl_schedule WHERE idstudent = '$idstudent' AND session = '$session'";
        $result = $this->db->select($query);

        if ($result) {
            $alert = '<script> toastr.warning("Buổi trực ' . $session . ' đã tồn tại!");</script>';
            return $alert;
        }

        $query_team = "SELECT * FROM `tbl_user` WHERE idstudent = '$idstudent'";
        $result_team = $this->db->select($query_team);
        $value_team = $result_team->fetch_assoc();
        $team = $value_team['team'];

        $query = "INSERT INTO `tbl_schedule`(`idstudent`, `team`, `session`, `shift`) 
        VALUES ('$idstudent', '$team', '$session','$shift')";
        $result = $this->db->insert($query);

        if ($result) {
            $alert = '<script> toastr.success("Cập nhật lịch trực thành công!");</script>';
            return $alert;
        }

        $alert = '<script> toastr.warning("Cập nhật lịch trực thất bại!");</script>';
        return $alert;
    }

    public function deleteScheduleId($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $this->fm->validation($id));

        $query = "SELECT * FROM `tbl_schedule` WHERE id = '$id'";
        $result = $this->db->select($query);

        if ($result) {
            $query = "DELETE FROM `tbl_schedule` WHERE id = '$id'";
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

    public function deleteScheduleTeam($team)
    {
        $team = mysqli_real_escape_string($this->db->link, $this->fm->validation($team));

        $query = "SELECT * FROM `tbl_schedule` WHERE team = '$team'";
        $result = $this->db->select($query);

        if ($result) {
            $query = "DELETE FROM `tbl_schedule` WHERE team = '$team'";
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

    public function getSchedule($team, $session)
    {
        $team = mysqli_real_escape_string($this->db->link, $this->fm->validation($team));
        $session = mysqli_real_escape_string($this->db->link, $this->fm->validation($session));

        $query = "SELECT tbl_schedule.id, tbl_schedule.idstudent, tbl_user.fullname, session, shift FROM `tbl_schedule`, `tbl_user` 
        WHERE tbl_schedule.idstudent = tbl_user.idstudent AND tbl_schedule.team = '$team' AND session = '$session'";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * Hành chính
     */
    public function getScheduleHc()
    {
        $query = "SELECT * FROM tbl_user WHERE team = 'Hành Chính'";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * Truyền thông
     */
    public function getScheduleTt()
    {
        $query = "SELECT * FROM tbl_user WHERE team = 'Truyền Thông'";
        $result = $this->db->select($query);
        return $result;
    }
}
