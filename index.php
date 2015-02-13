<?php  ?>

<?php include_once 'header.php'; ?>


<?php 

$page = 0;
if(isset($_GET['id'])){
$page = $_GET['id']; };

switch ($page) {
    case 0:
        include_once 'home.php';
        break;
    case 1:
        
        break;
    case 2:
        include_once 'pages/forum/index.php';
        break;
}




?>




<?php include_once 'footer.php'; ?>