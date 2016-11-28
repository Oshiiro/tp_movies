<?php session_start() ?>

<?php include 'include/pdo.php'; ?>
<?php include 'include/functions.php'; ?>


<?php if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "SELECT * FROM movies_user_note WHERE id_movie = $id";
  $query = $pdo->prepare($sql);
  $query->bindValue(':id', $id, PDO::PARAM_INT);
  $query->execute();
  $retire = $query->fetch();

print_r($retire);
  if(!empty($retire)) {

  $sql = "UPDATE movies_user_note SET status = 0 WHERE id_movie = $id";
  $query->bindValue(':id', $id, PDO::PARAM_INT);
  $query = $pdo->prepare($sql);
  $query->execute();
  header('Location: avoir.php');
  exit();
  }

}
