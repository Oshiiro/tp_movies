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

function isAdmin(){
  global $pdo;

 if((!empty($_SESSION['user'])) && (!empty($_SESSION['user']['id'])) && (!empty($_SESSION['user']['pseudo'])) && (!empty($_SESSION['user']['status'])) && (!empty($_SESSION['user']['ip']))) {
   $id_User = $_SESSION['user']['id'];
   $ip = $_SERVER['REMOTE_ADDR'];
   if($ip == $_SESSION['user']['ip']){

    $sql = "SELECT status FROM users WHERE id = $id_User";
    $query = $pdo->prepare($sql);
    $query->execute();
    $isAdmin = $query->fetch();

    if ($isAdmin['status'] === 'superadminmaster' ) {
      return true;
    } else {
      return false;
    }
   }
 }
}

function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}


function toSee($id_movie, $id_user){
 global $pdo;

 $sql="SELECT status FROM movies_user_note WHERE id_movie = :id_movie AND id_user = :id_user";
 $query = $pdo->prepare($sql);
 $query->bindValue(':id_movie', $id_movie, PDO::PARAM_INT);
 $query->bindValue(':id_user', $id_user, PDO::PARAM_INT);
 $query->execute();
 $result = $query->fetchAll();

 if (!empty($result[0]) && $result[0]['status'] == 1) {
   return true;
 } else {
   return false;
 }
}
function isSeen($id_movie, $id_user){
 global $pdo;

 $sql="SELECT status FROM movies_user_note WHERE id_movie = :id_movie AND id_user = :id_user";
 $query = $pdo->prepare($sql);
 $query->bindValue(':id_movie', $id_movie, PDO::PARAM_INT);
 $query->bindValue(':id_user', $id_user, PDO::PARAM_INT);
 $query->execute();
 $result = $query->fetchAll();

 if (!empty($result[0]) && $result[0]['status'] == 2) {
   return true;
 } else {
   return false;
 }
}

function isVoted($id_movie, $id_user){
 global $pdo;

 $sql="SELECT status FROM movies_user_note WHERE id_movie = :id_movie AND id_user = :id_user";
 $query = $pdo->prepare($sql);
 $query->bindValue(':id_movie', $id_movie, PDO::PARAM_INT);
 $query->bindValue(':id_user', $id_user, PDO::PARAM_INT);
 $query->execute();
 $result = $query->fetchAll();

 if (!empty($result[0]) && $result[0]['status'] == 3) {
   return true;
 } else {
   return false;
 }
}
?>

<?php function paginationArticle($page, $num, $count) { ?>
  <div class=" center status">
    <?php if ($page > 1) { ?>
      <a class="btn btn-default" href="affiche_back.php?page=<?php echo $page-1 ?>">Précédent</a>
    <?php } ?>
    <?php if ($page*$num < $count) { ?>
      <a class="btn btn-default" href="affiche_back.php?page=<?php echo $page+1 ?>">Suivant</a>
    <?php } ?>
  </div>
<?php } ?>

<?php function paginationArticleFilmVu($page, $num, $count) { ?>
  <div class=" center status">
    <?php if ($page > 1) { ?>
      <a class="btn btn-default" href="filmsvu.php?page=<?php echo $page-1 ?>">Précédent</a>
    <?php } ?>
    <?php if ($page*$num < $count) { ?>
      <a class="btn btn-default" href="filmsvu.php?page=<?php echo $page+1 ?>">Suivant</a>
    <?php } ?>
  </div>
<?php } ?>
