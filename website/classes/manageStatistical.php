<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * manageStatistical
 */
class manageStatistical
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function getListStatistical()
    {
        $query = "SELECT DISTINCT schoolyear, semester FROM tbl_attendances ORDER BY schoolyear DESC, semester DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function deleteListStatistical($schoolyear, $semester)
    {
        $schoolyear = mysqli_real_escape_string($this->db->link, $this->fm->validation($schoolyear));
        $semester = mysqli_real_escape_string($this->db->link, $this->fm->validation($semester));

        $query = "SELECT * FROM `tbl_attendances` WHERE schoolyear = '$schoolyear' AND semester = '$semester'";
        $result = $this->db->select($query);

        if ($result) {
            $query = "DELETE FROM `tbl_attendances` WHERE schoolyear = '$schoolyear' AND semester = '$semester'";
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

    public function showStatistical($schoolyear, $semester)
    {
        $schoolyear = mysqli_real_escape_string($this->db->link, $this->fm->validation($schoolyear));
        $semester = mysqli_real_escape_string($this->db->link, $this->fm->validation($semester));

        $query = "SELECT tbl_attendances.idstudent, tbl_attendances.fullname , team,
        (SELECT COUNT(tbl_attendances.idstudent) FROM tbl_attendances WHERE attendance = 'Present' AND schoolyear = '$schoolyear' AND semester = '$semester' AND tbl_attendances.idstudent = tbl_user.idstudent) AS Present,
        (SELECT COUNT(tbl_attendances.idstudent) FROM tbl_attendances WHERE attendance = 'Late' AND schoolyear = '$schoolyear' AND semester = '$semester' AND tbl_attendances.idstudent = tbl_user.idstudent) AS Late, 
        (SELECT COUNT(tbl_attendances.idstudent) FROM tbl_attendances WHERE attendance = 'Absent' AND schoolyear = '$schoolyear' AND semester = '$semester' AND tbl_attendances.idstudent = tbl_user.idstudent) AS Absent 
        FROM tbl_attendances, tbl_user
        WHERE schoolyear = '$schoolyear' AND semester = '$semester' AND tbl_attendances.idstudent = tbl_user.idstudent
        GROUP BY tbl_attendances.idstudent ORDER BY tbl_user.team ASC";

        $result = $this->db->select($query);
        return $result;
    }

    public function showDetailedstatistics($schoolyear, $semester)
    {
        $schoolyear = mysqli_real_escape_string($this->db->link, $this->fm->validation($schoolyear));
        $semester = mysqli_real_escape_string($this->db->link, $this->fm->validation($semester));

        $query = "SELECT tbl_attendances.id, tbl_user.idstudent, tbl_user.fullname , team, schoolyear, semester, shift, date                                
        FROM tbl_attendances, tbl_user
        WHERE schoolyear = '$schoolyear' AND semester = '$semester' AND tbl_attendances.idstudent = tbl_user.idstudent ORDER BY date DESC";

        $result = $this->db->select($query);
        return $result;
    }

    public function deleteDetailedStatistics($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $this->fm->validation($id));

        $query = "SELECT * FROM `tbl_attendances` WHERE id = '$id'";
        $result = $this->db->select($query);

        if ($result) {
            $query = "DELETE FROM `tbl_attendances` WHERE id = '$id'";
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
}
