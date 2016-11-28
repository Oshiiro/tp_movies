<?php session_start() ?>

<?php include 'include/pdo.php'; ?>
<?php include 'include/functions.php'; ?>

<?php
$idSession = $_SESSION['user']['id'];

// traitement du randow
$sql = "SELECT * FROM movies_user_note WHERE status = 1 AND id_user = :id_user";
  $query = $pdo->prepare($sql);
  $query->bindValue(':id_user', $idSession, PDO::PARAM_INT);
  $query->execute();
  $aVoirs = $query->fetchAll();

?>

<?php require('include/header.php') ?>

<?php
foreach ($aVoirs as $aVoir) {
    echo $aVoir['created_at']. '<br/>';
}

?>

<input type="button" name="a_noter" value="Note ce film!">


<a href="index.php">Retour à l'index</a>

<?php require('include/footer.php') ?>
