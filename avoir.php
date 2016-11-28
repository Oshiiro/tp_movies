<?php session_start() ?>

<?php include 'include/pdo.php'; ?>
<?php include 'include/functions.php'; ?>

<?php
$idSession = $_SESSION['user']['id'];

  $sql = "SELECT *
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

<?php
foreach ($aVoirs as $aVoir) { ?>
  <div class="col-lg-6 col-lg-offset-3">
    <h4><?php echo $aVoir['title'] ?></h4>
    <?php if (file_exists('posters/' .$aVoir['id']. '.jpg')) {
            echo '<img src="posters/' .$aVoir['id']. '.jpg" alt=""/>';
          } else {
            echo '<img src="http://placehold.it/205x300" title="' .$aVoir['title']. '">';
          }
    ?>
    <div class="infofilm col-lg-9">

    </div>
  </div>

<?php } ?>

<?php require('include/footer.php') ?>
