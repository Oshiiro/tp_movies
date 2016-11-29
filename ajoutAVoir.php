<?php session_start() ?>

<?php include 'include/pdo.php'; ?>
<?php include 'include/functions.php'; ?>



<?php if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "SELECT * FROM movies_full WHERE id = $id";
  $query = $pdo->prepare($sql);
  $query->bindValue(':id', $id, PDO::PARAM_INT);
  $query->execute();
  $ajoutes = $query->fetchAll();


  if(!empty($ajoutes)) {
    $id_movie = $ajoutes['0']['id'];
    $id_user = $_SESSION['user']['id'];

    $ajoutAVoir = "INSERT INTO movies_user_note (id_movie, id_user, note, created_at, status) VALUES (:id_movie, :id_user, 0, now(), 1)";
    //preparation de la requete
    $query = $pdo->prepare($ajoutAVoir);
    // protection des inj sql
    $query->bindValue(':id_movie', $id_movie, PDO::PARAM_STR);
    $query->bindValue(':id_user', $id_user, PDO::PARAM_STR);
    $query->execute();

  header('Location: single.php?slug=' .$ajoutes['0']['slug']);
  exit();
  }

}
