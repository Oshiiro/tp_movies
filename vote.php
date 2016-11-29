<?php
session_start() ;
$id_user = $_SESSION['user']['id'];


if(!empty($_POST['voter'])) {
  if(!empty($_POST['idmovie'])) {

echo 'movie. ' .$_POST['idmovie'];
echo 'note. ' .$_POST['voter'];
$note =  $_POST['rating-input-1'];



  $sql = "UPDATE movies_user_note
          SET note = 20, status = 2
          WHERE" ;

    }
   }




?>
