<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * manageAttendance
 */
class manageAttendance
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function setAttendance($idstudent, $fullname, $schoolyear, $semester, $date, $shift, $attendance)
    {
        $idstudent = mysqli_real_escape_string($this->db->link, $this->fm->validation($idstudent));
        $fullname = mysqli_real_escape_string($this->db->link, $this->fm->validation($fullname));
        $schoolyear = mysqli_real_escape_string($this->db->link, $this->fm->validation($schoolyear));
        $semester = mysqli_real_escape_string($this->db->link, $this->fm->validation($semester));
        $date = mysqli_real_escape_string($this->db->link, $this->fm->validation($date));
        $shift = mysqli_real_escape_string($this->db->link, $this->fm->validation($shift));
        $attendance = mysqli_real_escape_string($this->db->link, $this->fm->validation($attendance));

        $query = "SELECT * FROM tbl_attendances WHERE idstudent = '$idstudent' AND schoolyear = '$schoolyear'
        AND semester = '$semester' AND date = '$date' AND shift = '$shift'";
        $result = $this->db->select($query);

        if ($result) {
            echo '<script> toastr.warning(" ' . $fullname . ' đã điểm danh thành công!");</script>';
        } else {
            $query = "INSERT INTO `tbl_attendances`(`idstudent`, `fullname`, `schoolyear`, `semester`, `date`, `shift`, `attendance`) 
            VALUES ('$idstudent','$fullname','$schoolyear','$semester','$date','$shift','$attendance')";
            $result = $this->db->insert($query);

            if ($result) {
                echo '<script> toastr.success(" ' . $fullname . ' đã điểm danh thành công!");</script>';
            } else {
                echo '<script> toastr.warning("Cập nhật điểm danh thất bại!");</script>';
            }
        }
    }

    public function getAttendance()
    {
        $query = "SELECT schoolyear FROM tbl_attendances";
        $result = $this->db->select($query);
        return $result;
    }
}
