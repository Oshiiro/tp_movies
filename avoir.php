<?php session_start() ?>

<?php include 'include/pdo.php'; ?>
<?php include 'include/functions.php'; ?>

<?php

  $idSession = $_SESSION['user']['id'];


  $sql = "SELECT movies_full.id as idd, movies_full.title
          FROM movies_user_note
          LEFT JOIN movies_full ON movies_user_note.id_movie = movies_full.id
          LEFT JOIN users ON movies_user_note.id = users.id
          WHERE movies_user_note.status = 1 AND movies_user_note.id_user = :id_user";
  $query = $pdo->prepare($sql);
  $query->bindValue(':id_user', $idSession, PDO::PARAM_INT);
  $query->execute();
  $aVoirs = $query->fetchAll();


?>

<?php require('include/header.php') ?>
<div class="container">
  <div class="row">
    <?php
    foreach ($aVoirs as $aVoir) { ?>
      <div class="col-md-12">
        <h4><?php echo $aVoir['title'] ?></h4>
        <?php if (file_exists('posters/' .$aVoir['idd']. '.jpg')) {
          echo '<img src="posters/' .$aVoir['idd']. '.jpg" alt=""/>';
        } else {
          echo '<img src="http://placehold.it/205x300" title="' .$aVoir['title']. '">';
        }
        ?>
        <div class="infofilm col-md-12">

        </div>
      </div>
      <?php } ?>
      <input type="button" name="a_noter" value="Note ce film!">
      <a href="index.php">Retour à l'index</a>
  </div>
</div>

<?php require('include/footer.php') ?>
