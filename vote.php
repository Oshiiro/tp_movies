<?php session_start(); ?>
<?php include 'include/pdo.php'; ?>
<?php include 'include/functions.php'; ?>
<?php

$id_user = $_SESSION['user']['id'];
$note =  $_POST['rating-input-1'];


if(!empty($_POST['submit'])) {
  if(!empty($_POST['idmovie'])) {



    echo $note;
    echo 'movie ' .$_POST['idmovie'];



  $sql = "UPDATE movies_user_note
          LEFT JOIN users ON id_user = id
          SET note = $note, status = 3
          WHERE id_user = $id_user

          ";
    }
}



?>
