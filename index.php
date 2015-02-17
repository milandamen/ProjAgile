<?php  

$page = "";
if(isset($_GET['p'])){
$page = $_GET['p']; };

$title = $page  . ' - Wijkraad de Bunders';

?>
<?php include_once 'header.php'; ?>



<?php 

switch ($page) {
    case "index":
        include_once 'pages/home.php';
        break;
    case "over":
        include_once 'pages/about.php';
        break;
    case "forum":
        include_once 'pages/forum/index.php';
        break;
    case "discussie":
    	include_once 'pages/forum/discussion.php';
    	break;
    case "topic":
    	include_once 'pages/forum/topic.php';
    	break;
    case "contact":
    	include_once 'pages/contact.php';
    	break;
    case "login":
    	include_once 'pages/login.php';
    	break;
    case "partners":
    	include_once 'pages/partner/partner.php';
    	break;
    case "p-detail":
    	include_once 'pages/partner/partnerdetail.php';
    	break;
    case "add":
        include_once 'pages/cms/add_data.php';
        break;
    default:
    	include_once 'pages/home.php';
    	break;
}

?>

<?php include_once 'footer.php'; ?>