<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * managePost
 */
class managePost
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    // tbl_postgenres
    public function setPostgenres($postgenre)
    {
        $postgenre = mysqli_real_escape_string($this->db->link, $this->fm->validation($postgenre));

        if (empty($postgenre)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ dữ liệu!");</script>';
            return $alert;
        }

        $query = "SELECT * FROM `tbl_postgenres` WHERE postgenre = '$postgenre'";
        $result = $this->db->select($query);

        if ($result) {
            $alert = '<script> toastr.warning("Thể loại đã tồn tại!");</script>';
            return $alert;
        }

        $query = "INSERT INTO `tbl_postgenres`(`postgenre`) VALUES ('$postgenre')";
        $result = $this->db->insert($query);

        if ($result) {
            $alert = '<script> toastr.success("Đã thêm dữ liệu thành công!");</script>';
            return $alert;
        }

        $alert = '<script> toastr.warning("Đã thêm dữ liệu thất bại!");</script>';
        return $alert;
    }

    public function deletePostgenres($postgenre)
    {
        $postgenre = mysqli_real_escape_string($this->db->link, $this->fm->validation($postgenre));

        if (empty($postgenre)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ dữ liệu!");</script>';
            return $alert;
        }

        $query = "SELECT * FROM `tbl_postgenres` WHERE postgenre = '$postgenre'";
        $result = $this->db->select($query);

        if ($result) {
            $query = "DELETE FROM `tbl_postgenres` WHERE postgenre = '$postgenre'";
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

    public function getPostgenres()
    {
        $query = "SELECT * FROM `tbl_postgenres`";
        $result = $this->db->select($query);
        return $result;
    }

    public function countPostgenres()
    {
        $query = "SELECT tbl_post.postgenre, COUNT(tbl_postgenres.postgenre) AS countpostgenre 
        FROM tbl_postgenres, tbl_post
        WHERE tbl_postgenres.postgenre = tbl_post.postgenre
        GROUP BY tbl_post.postgenre";
        $result = $this->db->select($query);
        return $result;
    }

    // tbl_post
    public function setPost($author, $title, $postgenre, $posttype, $contentpost)
    {
        $author = mysqli_real_escape_string($this->db->link, $this->fm->validation($author));
        $title = mysqli_real_escape_string($this->db->link, $this->fm->validation($title));
        $postgenre = mysqli_real_escape_string($this->db->link, $this->fm->validation($postgenre));
        $posttype = mysqli_real_escape_string($this->db->link, $this->fm->validation($posttype));
        $contentpost = mysqli_real_escape_string($this->db->link, $this->fm->validation($contentpost));

        if (
            empty($_POST['author']) || empty($_POST['title']) || empty($_POST['postgenre']) ||
            empty($_POST['posttype']) || empty($_POST['contentpost'])
        ) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ dữ liệu!");</script>';
            return $alert;
        }

        if ($_FILES['images']['name'] != NULL) {
            if (
                $_FILES["images"]["type"] == "image/jpeg" || $_FILES["images"]["type"] == "image/png" ||
                $_FILES["images"]["type"] == "image/gif" || $_FILES["images"]["type"] == "image/jpg"
            ) {
                // Kiểm tra file up lên có phải là ảnh không            
                // Nếu là ảnh tiến hành code upload
                $path = "./images/post/"; // Ảnh sẽ lưu vào thư mục images
                $tmp_name = $_FILES['images']['tmp_name'];
                $data =  date('H-i-s');
                $name = $data . '-' . $_FILES['images']['name'];

                // Upload ảnh vào thư mục images
                move_uploaded_file($tmp_name, $path . $name);
                $image_url = $path . $name; // Đường dẫn ảnh lưu vào cơ sở dữ liệu
                // Insert ảnh vào cơ sở dữ liệu

                $query = "INSERT INTO `tbl_post`(`author`, `title`, `postgenre`, `posttype`, `time`, `contentpost`, `images`) 
                VALUES ('$author','$title','$postgenre','$posttype','" . date('Y-m-d H:i:s') . "','$contentpost','$image_url')";
                $result = $this->db->insert($query);
            } else {
                $alert = '<script> toastr.warning("File đăng tải không phải là file ảnh!");</script>';
                return $alert;
            }
        } else {
            $image_url = "";
            $query = "INSERT INTO `tbl_post`(`author`, `title`, `postgenre`, `posttype`, `time`, `contentpost`, `images`) 
            VALUES ('$author','$title','$postgenre','$posttype','" . date('Y-m-d H:i:s') . "','$contentpost','$image_url')";
            $result = $this->db->insert($query);
        }

        if ($result) {
            $alert = '<script> toastr.success("Cập nhật dữ liệu thành công!");</script>';
            return $alert;
        }

        $alert = '<script> toastr.warning("Cập nhật dữ liệu thất bại!");</script>';
        return $alert;
    }


    public function getPost()
    {
        $query = "SELECT * FROM `tbl_post` ORDER BY `status` ASC, `id` DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getPostId($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $this->fm->validation($id));

        $query = "SELECT * FROM `tbl_post` WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updatePost($id, $author, $title, $postgenre, $posttype, $contentpost)
    {
        $id = mysqli_real_escape_string($this->db->link, $this->fm->validation($id));
        $author = mysqli_real_escape_string($this->db->link, $this->fm->validation($author));
        $title = mysqli_real_escape_string($this->db->link, $this->fm->validation($title));
        $postgenre = mysqli_real_escape_string($this->db->link, $this->fm->validation($postgenre));
        $posttype = mysqli_real_escape_string($this->db->link, $this->fm->validation($posttype));
        $contentpost = mysqli_real_escape_string($this->db->link, $this->fm->validation($contentpost));

        if (
            empty($_POST['author']) || empty($_POST['title']) || empty($_POST['postgenre']) ||
            empty($_POST['posttype']) || empty($_POST['contentpost'])
        ) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ dữ liệu!");</script>';
            return $alert;
        }

        if ($_FILES['images']['name'] != NULL) {
            if (
                $_FILES["images"]["type"] == "image/jpeg"
                || $_FILES["images"]["type"] == "image/png"
                || $_FILES["images"]["type"] == "image/gif"
                || $_FILES["images"]["type"] == "image/jpg"
            ) {
                // Xóa ảnh cũ trong file
                $query = "SELECT images FROM tbl_post WHERE id = '$id'";
                $result = $this->db->select($query);

                if ($result) {
                    $value = $result->fetch_assoc();
                    if ($value['images'] != NULL) {
                        $img = substr($value['images'], 2, strlen($value['images']));
                        unlink("$img");
                    }
                }
                // Kiểm tra file up lên có phải là ảnh không            
                // Nếu là ảnh tiến hành code upload
                $path = "./images/post/"; // Ảnh sẽ lưu vào thư mục images
                $tmp_name = $_FILES['images']['tmp_name'];
                $data =  date('H-i-s');
                $name = $data . '-' . $_FILES['images']['name'];
                // Upload ảnh vào thư mục images
                move_uploaded_file($tmp_name, $path . $name);
                $image_url = $path . $name; // Đường dẫn ảnh lưu vào cơ sở dữ liệu
                // Insert ảnh vào cơ sở dữ liệu

                $query = "UPDATE `tbl_post` SET `author`=' $author', `title`='$title', `postgenre`='$postgenre',
                `posttype`='$posttype', `time`='" . date('Y-m-d H:i:s') . "', `contentpost`='$contentpost',
                `images`='$image_url' WHERE id = '$id'";
                $result = $this->db->update($query);
            } else {
                $alert = '<script> toastr.warning("File đăng tải không phải là file ảnh!");</script>';
                return $alert;
            }
        } else {
            $query = "UPDATE `tbl_post` SET `author`=' $author', `title`='$title', `postgenre`='$postgenre',
            `posttype`='$posttype', `time`='" . date('Y-m-d H:i:s') . "', `contentpost`='$contentpost' WHERE id = '$id'";
            $result = $this->db->update($query);
        }

        if ($result) {
            $alert = '<script> toastr.success("Cập nhật dữ liệu thành công!");</script>';
            return $alert;
        }

        $alert = '<script> toastr.warning("Cập nhật dữ liệu thất bại!");</script>';
        return $alert;
    }

    public function deletePost($idPost)
    {
        $idPost = mysqli_real_escape_string($this->db->link, $this->fm->validation($idPost));

        $query = "SELECT images FROM tbl_post WHERE id = '$idPost'";
        $result = $this->db->select($query);

        if ($result) {
            $value = $result->fetch_assoc();
            if ($value['images'] != NULL) {
                $img = substr($value['images'], 2, strlen($value['images']));
                unlink("$img");
            }

            $query = "DELETE FROM `tbl_post` WHERE id = '$idPost'";
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

    public function statusPost($id, $status)
    {
        $id = mysqli_real_escape_string($this->db->link, $this->fm->validation($id));
        $status = mysqli_real_escape_string($this->db->link, $this->fm->validation($status));

        $query = "UPDATE `tbl_post` SET `status`= '$status' WHERE id = '$id'";
        $result = $this->db->update($query);

        if ($result) {
            $alert = '<script> toastr.success("Cập nhật dữ liệu thành công!");</script>';
            return $alert;
        }

        $alert = '<script> toastr.warning("Cập nhật dữ liệu không thành công!");</script>';
        return $alert;
    }

    // Backend
    public function getQuanTrong()
    {
        $query = "SELECT * FROM `tbl_post` WHERE `status` = '1' AND posttype = 'Quan trọng' ORDER BY id DESC LIMIT 15";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLichTruc()
    {
        $query = "SELECT * FROM `tbl_post` WHERE `status` = '1' AND posttype = 'Lịch trực' ORDER BY id DESC LIMIT 15";
        $result = $this->db->select($query);
        return $result;
    }

    public function getPostDesc($item_per_page, $offset)
    {
        $item_per_page = mysqli_real_escape_string($this->db->link, $this->fm->validation($item_per_page));
        $offset = mysqli_real_escape_string($this->db->link, $this->fm->validation($offset));

        $query = "SELECT * FROM tbl_post WHERE `status` = '1' ORDER BY id DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
        $result = $this->db->select($query);
        return $result;
    }

    public function viewPost($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $this->fm->validation($id));

        $query = "SELECT * FROM `tbl_post` WHERE `status` = '1' AND `id` = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function viewCategory($category, $item_per_page, $offset)
    {
        $category = mysqli_real_escape_string($this->db->link, $this->fm->validation($category));
        $item_per_page = mysqli_real_escape_string($this->db->link, $this->fm->validation($item_per_page));
        $offset = mysqli_real_escape_string($this->db->link, $this->fm->validation($offset));

        $query = "SELECT * FROM tbl_post WHERE `status` = '1' AND `postgenre` = '$category' ORDER BY id DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
        $result = $this->db->select($query);
        return $result;
    }
}
