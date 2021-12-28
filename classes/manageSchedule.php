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
        $idstudent = $this->fm->validation($idstudent);
        $session = $this->fm->validation($session);
        $shift1 = $this->fm->validation($shift1);
        $shift2 = $this->fm->validation($shift2);
        $shift3 = $this->fm->validation($shift3);
        $shift4 = $this->fm->validation($shift4);

        $idstudent = mysqli_real_escape_string($this->db->link, $idstudent);
        $session = mysqli_real_escape_string($this->db->link, $session);
        $shift1 = mysqli_real_escape_string($this->db->link, $shift1);
        $shift2 = mysqli_real_escape_string($this->db->link, $shift2);
        $shift3 = mysqli_real_escape_string($this->db->link, $shift3);
        $shift4 = mysqli_real_escape_string($this->db->link, $shift4);

        if (empty($idstudent) || empty($session)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $shift = "";
            if (!empty($shift1))
                $shift = $shift . $shift1 . " ";
            if (!empty($shift2))
                $shift = $shift . $shift2 . " ";
            if (!empty($shift3))
                $shift = $shift . $shift3 . " ";
            if (!empty($shift4))
                $shift = $shift . $shift4 . " ";

            if ($shift == "") {
                $alert = '<script> toastr.warning("Vui lòng nhập ca trực!");</script>';
                return $alert;
            } else {
                $query = "SELECT idstudent, session FROM tbl_schedule WHERE idstudent = '$idstudent' AND session = '$session'";
                $result = $this->db->select($query);

                if ($result && $result->num_rows > 0) {
                    $alert = '<script> toastr.warning("Buổi trực ' . $session . ' đã tồn tại!");</script>';
                    return $alert;
                } else {
                    $query_team = "SELECT * FROM `tbl_user` WHERE idstudent = '$idstudent'";
                    $result_team = $this->db->select($query_team);
                    $value_team = $result_team->fetch_assoc();
                    $team = $value_team['team'];

                    $query = "INSERT INTO `tbl_schedule`(`idstudent`, `team`, `session`, `shift`) 
                    VALUES ('$idstudent', '$team', '$session','$shift')";
                    $result = $this->db->insert($query);

                    if ($result != false) {
                        $alert = '<script> toastr.success("Cập nhật lịch trực thành công!");</script>';
                        return $alert;
                    } else {
                        $alert = '<script> toastr.warning("Cập nhật lịch trực thất bại!");</script>';
                        return $alert;
                    }
                }
            }
        }
    }

    public function deleteScheduleId($id)
    {
        $query = "SELECT * FROM `tbl_schedule` WHERE id = '$id'";
        $result = $this->db->select($query);

        if ($result && $result->num_rows > 0) {
            $query = "DELETE FROM `tbl_schedule` WHERE id = '$id'";
            $result = $this->db->delete($query);

            if ($result != false) {
                $alert = '<script> toastr.success("Đã xóa thành công!");</script>';
                return $alert;
            } else {
                $alert = '<script> toastr.warning("Xóa thất bại!");</script>';
                return $alert;
            }
        }
    }

    public function deleteScheduleTeam($team)
    {
        $query = "SELECT * FROM `tbl_schedule` WHERE team = '$team'";
        $result = $this->db->select($query);

        if ($result && $result->num_rows > 0) {
            $query = "DELETE FROM `tbl_schedule` WHERE team = '$team'";
            $result = $this->db->delete($query);
            
            if ($result != false) {
                $alert = '<script> toastr.success("Đã xóa thành công!");</script>';
                return $alert;
            } else {
                $alert = '<script> toastr.warning("Xóa thất bại!");</script>';
                return $alert;
            }
        }
    }

    public function getSchedule($team, $session)
    {
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
