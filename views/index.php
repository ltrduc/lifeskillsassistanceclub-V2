<?php include './inc/header.php'; ?>

<?php
if (isset($_GET["q"])) {
    switch ($_GET["q"]) {
        case 'homepage':
            include_once 'pages/homepage.php';
            break;
        case 'register':
            include_once 'pages/register.php';
            break;
        case 'contact':
            include_once 'pages/contact.php';
            break;
        case 'structure':
            include_once 'pages/structure.php';
            break;
        case 'introduce':
            include_once 'pages/introduce.php';
            break;
        case 'post':
            include_once 'pages/post.php';
            break;
        case 'viewpost':
            include_once 'pages/viewpost.php';
            break;
        case 'category':
            include_once 'pages/category.php';
            break;
    }
} else {
    include_once 'pages/homepage.php';
}
?>

<?php include './inc/footer.php'; ?>