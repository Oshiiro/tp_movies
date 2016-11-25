<?php include 'include/pdo.php' ?>
<?php include 'include/functions.php' ?>


<?php
$_SESSION['user']=array();
session_destroy();
// redirection
header('Location: index.php');
exit();
 ?>
