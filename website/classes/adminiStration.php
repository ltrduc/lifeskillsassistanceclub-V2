<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * adminiStration
 */
class adminiStration
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function getAdminiStration()
    {
        $query = "SELECT * FROM tbl_user ORDER BY level ASC";
        $result = $this->db->select($query);
        return $result;
    }
}
