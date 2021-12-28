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
        $postgenre = $this->fm->validation($postgenre);
        $postgenre = mysqli_real_escape_string($this->db->link, $postgenre);

        if (empty($postgenre)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $query = "SELECT * FROM `tbl_postgenres` WHERE postgenre = '$postgenre'";
            $result = $this->db->select($query);

            if ($result && $result->num_rows > 0) {
                $alert = '<script> toastr.warning("Thể loại đã tồn tại!");</script>';
                return $alert;
            } else {
                $query = "INSERT INTO `tbl_postgenres`(`postgenre`) VALUES ('$postgenre')";
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

    public function deletePostgenres($postgenre)
    {
        if (empty($postgenre)) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            $query = "SELECT * FROM `tbl_postgenres` WHERE postgenre = '$postgenre'";
            $result = $this->db->select($query);

            if ($result && $result->num_rows > 0) {
                $query = "DELETE FROM `tbl_postgenres` WHERE postgenre = '$postgenre'";
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
        $author = mysqli_real_escape_string($this->db->link, $author);
        $title = mysqli_real_escape_string($this->db->link, $title);
        $postgenre = mysqli_real_escape_string($this->db->link, $postgenre);
        $posttype = mysqli_real_escape_string($this->db->link, $posttype);
        $contentpost = mysqli_real_escape_string($this->db->link, $contentpost);

        if (
            empty($_POST['author']) || empty($_POST['title']) ||
            empty($_POST['postgenre']) || empty($_POST['posttype']) || empty($_POST['contentpost'])
        ) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
            return $alert;
        } else {
            if ($_FILES['images']['name'] != NULL) {
                if (
                    $_FILES["images"]["type"] == "image/jpeg"
                    || $_FILES["images"]["type"] == "image/png"
                    || $_FILES["images"]["type"] == "image/gif"
                    || $_FILES["images"]["type"] == "image/jpg"
                ) {
                    // Kiểm tra file up lên có phải là ảnh không            
                    // Nếu là ảnh tiến hành code upload
                    $path = "./images/post/"; // Ảnh sẽ lưu vào thư mục images
                    $tmp_name = $_FILES['images']['tmp_name'];
                    $name = $_FILES['images']['name'];
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

            if ($result != false) {
                $alert = '<script> toastr.success("Cập nhật thành công!");</script>';
                return $alert;
            } else {
                $alert = '<script> toastr.warning("Cập nhật thất bại!");</script>';
                return $alert;
            }
        }
    }


    public function getPost()
    {
        $query = "SELECT * FROM `tbl_post` ORDER BY `status` ASC, `id` DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getPostId($id)
    {
        $query = "SELECT * FROM `tbl_post` WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updatePost($id, $author, $title, $postgenre, $posttype, $contentpost)
    {
        $author = mysqli_real_escape_string($this->db->link, $author);
        $title = mysqli_real_escape_string($this->db->link, $title);
        $postgenre = mysqli_real_escape_string($this->db->link, $postgenre);
        $posttype = mysqli_real_escape_string($this->db->link, $posttype);
        $contentpost = mysqli_real_escape_string($this->db->link, $contentpost);

        if (
            empty($_POST['author']) || empty($_POST['title']) ||
            empty($_POST['postgenre']) || empty($_POST['posttype']) || empty($_POST['contentpost'])
        ) {
            $alert = '<script> toastr.warning("Vui lòng nhập đầy đủ thông tin!");</script>';
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
                    $name = $_FILES['images']['name'];
                    // Upload ảnh vào thư mục images
                    move_uploaded_file($tmp_name, $path . $name);
                    $image_url = $path . $name; // Đường dẫn ảnh lưu vào cơ sở dữ liệu
                    // Insert ảnh vào cơ sở dữ liệu

                    $query = "UPDATE `tbl_post` SET 
                    `author`=' $author',
                    `title`='$title',
                    `postgenre`='$postgenre',
                    `posttype`='$posttype',
                    `time`='" . date('Y-m-d H:i:s') . "',
                    `contentpost`='$contentpost',
                    `images`='$image_url' WHERE id = '$id'";
                    $result = $this->db->update($query);
                } else {
                    $alert = '<script> toastr.warning("File đăng tải không phải là file ảnh!");</script>';
                    return $alert;
                }
            } else {
                $image_url = "";
                $query = "UPDATE `tbl_post` SET 
                `author`=' $author',
                `title`='$title',
                `postgenre`='$postgenre',
                `posttype`='$posttype',
                `time`='" . date('Y-m-d H:i:s') . "',
                `contentpost`='$contentpost',
                `images`='$image_url' WHERE id = '$id'";
                $result = $this->db->update($query);
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

    public function deletePost($idPost)
    {
        $query = "SELECT images FROM tbl_post WHERE id = '$idPost'";
        $result = $this->db->select($query);

        if ($result && $result->num_rows > 0) {
            if ($result) {
                $value = $result->fetch_assoc();
                if ($value['images'] != NULL) {
                    $img = substr($value['images'], 2, strlen($value['images']));
                    unlink("$img");
                }
            }

            $query = "DELETE FROM `tbl_post` WHERE id = '$idPost'";
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

    public function statusPost($id, $status)
    {
        $query = "UPDATE `tbl_post` SET `status`= '$status' WHERE id = '$id'";
        $result = $this->db->update($query);

        if ($result == false) {
            $alert = '<script> toastr.warning("Cập nhật không thành công!");</script>';
            return $alert;
        } else {
            $alert = '<script> toastr.success("Cập nhật thành công!");</script>';
            return $alert;
        }
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
        $query = "SELECT * FROM tbl_post WHERE `status` = '1' ORDER BY id DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
        $result = $this->db->select($query);
        return $result;
    }

    public function viewPost($id)
    {
        $query = "SELECT * FROM `tbl_post` WHERE `status` = '1' AND `id` = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function viewCategory($category, $item_per_page, $offset)
    {
        $query = "SELECT * FROM tbl_post WHERE `status` = '1' AND `postgenre` = '$category' ORDER BY id DESC LIMIT " . $item_per_page . " OFFSET " . $offset;
        $result = $this->db->select($query);
        return $result;
    }
}
