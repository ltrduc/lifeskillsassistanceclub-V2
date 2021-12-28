<?php include './inc/menu.php'; ?>
<?php include './inc/header.php'; ?>

<?php
if (isset($_GET["q"])) {
    switch ($_GET["q"]) {
        case 'homepage':
            include_once 'pages/homepage.php';
            break;
        case 'member':
            if (Session::get('level') == "050301" || Session::get('level') == "0") {
                include_once 'pages/member.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'updatemember':
            if (Session::get('level') == "050301" || Session::get('level') == "0") {
                include_once 'pages/updatemember.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'collaborators':
            if (Session::get('level') == "050301" || Session::get('level') == "0") {
                include_once 'pages/collaborators.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'updateCollaborators':
            if (Session::get('level') == "050301" || Session::get('level') == "0") {
                include_once 'pages/updateCollaborators.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'structure':
            if (Session::get('level') == "050301" || Session::get('level') == "0") {
                include_once 'pages/structure.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'equipment':
            if (Session::get('level') == "050301" || Session::get('level') == "0") {
                include_once 'pages/equipment.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'updateequipment':
            if (Session::get('level') == "050301" || Session::get('level') == "0") {
                include_once 'pages/updateequipment.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'loanpayment':
            if (Session::get('level') == "050301" || Session::get('level') == "0") {
                include_once 'pages/loanpayment.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'schedulehc':
            if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('team') == "Hành Chính") {
                include_once 'pages/schedulehc.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'schedulett':
            if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('team') == "Truyền Thông") {
                include_once 'pages/schedulett.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'updateloanpayment':
            if (Session::get('level') == "050301" || Session::get('level') == "0") {
                include_once 'pages/updateloanpayment.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'administration':
            if (Session::get('level') == "050301") {
                include_once 'pages/administration.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'decentralization':
            if (Session::get('level') == "050301" || Session::get('level') == "0") {
                include_once 'pages/decentralization.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'changepassword':
            include_once 'pages/changepassword.php';
            break;
        case 'listcourse':
            include_once 'pages/listcourse.php';
            break;
        case 'showcourse':
            include_once 'pages/showcourse.php';
            break;
        case 'attendance':
            if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('level') == "1") {
                include_once 'pages/attendance.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'statistical':
            if (Session::get('level') == "050301" || Session::get('level') == "0") {
                include_once 'pages/statistical.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'showstatistical':
            if (Session::get('level') == "050301" || Session::get('level') == "0") {
                include_once 'pages/showstatistical.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'detailedstatistics':
            if (Session::get('level') == "050301" || Session::get('level') == "0") {
                include_once 'pages/detailedstatistics.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'post':
            if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('level') == "2") {
                include_once 'pages/post.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'createpost':
            if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('level') == "2") {
                include_once 'pages/createpost.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'updatepost':
            if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('level') == "2") {
                include_once 'pages/updatepost.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'activityphoto':
            if (Session::get('level') == "050301" || Session::get('level') == "0" || Session::get('level') == "2") {
                include_once 'pages/activityphoto.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
        case 'recruitment':
            if (Session::get('level') == "050301" || Session::get('level') == "0") {
                include_once 'pages/recruitment.php';
            } else {
                echo "<script>alert('Bạn không có quyền truy cập vào trang này!'); window.location='?q=homepage';</script>";
            }
            break;
    }
} else {
    include_once 'pages/homepage.php';
}
?>

<?php include './inc/footer.php'; ?>