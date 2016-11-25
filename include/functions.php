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

?>
