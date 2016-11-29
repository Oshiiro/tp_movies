<?php
function debug($array) {
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function isLogged(){
 if((!empty($_SESSION['user'])) && (!empty($_SESSION['user']['id'])) && (!empty($_SESSION['user']['pseudo'])) && (!empty($_SESSION['user']['status'])) && (!empty($_SESSION['user']['ip']))) {

   $ip = $_SERVER['REMOTE_ADDR'];
   if($ip == $_SESSION['user']['ip']){
     return true;
   }
   return false;
 }
}

function isVoted($movie_id, $user_id){
 global $pdo;
 $sql="SELECT status FROM movies_user_note WHERE id_movie = :id_movie AND id_user = :id_user";
 $query = $pdo->prepare($sql);
 $query->bindValue('id_movie', $movie_id, PDO::PARAM_INT);
 $query->bindValue('id_user', $user_id, PDO::PARAM_INT);
 $query->execute();
 $query->fetch();
 if ($query === 2) {
   return true;
 } else {
   return false;
 }
}

function toSee($id_movie, $id_user){
 global $pdo;

 $sql="SELECT status FROM movies_user_note WHERE id_movie = :id_movie AND id_user = :id_user";
 $query = $pdo->prepare($sql);
 $query->bindValue(':id_movie', $id_movie, PDO::PARAM_INT);
 $query->bindValue(':id_user', $id_user, PDO::PARAM_INT);
 $query->execute();
 $result = $query->fetchAll();

 if (!empty($result[0]) && $result[0]['status'] == 0) {
   return true;
 } else {
   return false;
 }
}

?>
