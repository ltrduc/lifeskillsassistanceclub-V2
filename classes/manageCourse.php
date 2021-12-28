<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * manageCourse
 */
class manageCourse
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function setCourse($subjects, $group, $period, $local, $dates, $semester, $schoolyear, $teacher)
    {
        $subjects = mysqli_real_escape_string($this->db->link, $subjects);
        $group = mysqli_real_escape_string($this->db->link, $group);
        $period = mysqli_real_escape_string($this->db->link, $period);
        $local = mysqli_real_escape_string($this->db->link, $local);
        $dates = mysqli_real_escape_string($this->db->link, $dates);
        $semester = mysqli_real_escape_string($this->db->link, $semester);
        $schoolyear = mysqli_real_escape_string($this->db->link, $schoolyear);
        $teacher = mysqli_real_escape_string($this->db->link, $teacher);

        if (
            empty($subjects) || empty($group) || empty($period) || empty($local) ||
            empty($dates) || empty($schoolyear) || empty($semester)
        ) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $query = "SELECT * FROM `tbl_course` WHERE `subjects` = '$subjects' AND `group` = '$group' AND `period` = '$period' AND
            `local` = '$local' AND `dates` = '$dates' AND `semesters` = '$semester' AND `schoolyear` = '$schoolyear' AND `teacher` = '$teacher'";
            $result = $this->db->select($query);

            if ($result && $result->num_rows > 0) {
                $alert = '<script> toastr.warning("Lớp học đã tồn tại!");</script>';
                return $alert;
            } else {
                $query = "INSERT INTO `tbl_course`(`subjects`,`group`, `period`, `local`,  `dates`,`semesters`, `schoolyear`, `teacher`)
                VALUES ('$subjects','$group','$period','$local', '$dates','$semester','$schoolyear', '$teacher')";
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

    public function deleteCourse($id)
    {
        $query = "SELECT * FROM `tbl_course` WHERE `id` = '$id'";
        $result = $this->db->select($query);

        if ($result && $result->num_rows > 0) {
            $query = "DELETE FROM `tbl_course` WHERE id = '$id'";
            $this->db->delete($query);

            if ($result != false) {
                $alert = '<script> toastr.success("Đã xóa thành công!");</script>';
                return $alert;
            } else {
                $alert = '<script> toastr.warning("Đã xóa thất bại!");</script>';
                return $alert;
            }
        }
    }

    public function deleteStartDay($schoolyear, $semesters, $dates)
    {
        $query = "SELECT * FROM `tbl_course` WHERE schoolyear = '$schoolyear' AND semesters = '$semesters' AND dates= '$dates'";
        $result = $this->db->select($query);

        if ($result && $result->num_rows > 0) {
            $query = "DELETE FROM `tbl_course` WHERE schoolyear = '$schoolyear' AND semesters = '$semesters' AND dates= '$dates'";
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

    public function getStartDay()
    {
        $query = "SELECT DISTINCT schoolyear, semesters, dates FROM tbl_course 
        ORDER BY schoolyear DESC, semesters DESC, schoolyear DESC, dates DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getCourse($schoolyear, $semesters, $dates)
    {
        $query = "SELECT * FROM tbl_course WHERE schoolyear = '$schoolyear' AND semesters = '$semesters' AND dates = '$dates'";
        $result = $this->db->select($query);
        return $result;
    }
}
