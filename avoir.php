<?php session_start() ?>

<?php include 'include/pdo.php'; ?>
<?php include 'include/functions.php'; ?>

<?php
$idSession = $_SESSION['user']['id'];
  // $id_movie = $aVoirs['idd'];
  $sql = "SELECT movies_full.id as idd, movies_full.title
          FROM movies_user_note
          LEFT JOIN movies_full ON movies_user_note.id_movie = movies_full.id
          LEFT JOIN users ON movies_user_note.id = users.id
          WHERE movies_user_note.status = 1 AND movies_user_note.id_user = :id_user";
  $query = $pdo->prepare($sql);
  $query->bindValue(':id_user', $idSession, PDO::PARAM_INT);
  $query->execute();
  $aVoirs = $query->fetchAll();

  // requete étoile
  if(!empty($_POST['submit'])) {

  $id_user = $_SESSION['user']['id'];
  $note =  $_POST['rating-input-1'];
  $movie = $_POST['idmovie'];


    if(!empty($_POST['idmovie'])) {

      echo $note;
      echo 'movie ' .$_POST['idmovie'];

    $sql = "UPDATE movies_user_note
            SET note = $note, status= 3
            WHERE id_movie = $movie
            ";
            $query = $pdo->prepare($sql);
            $query->execute();

      }
  }




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
            } ?>
            <p><u>NOTER CE FILM</u></p>

            <div class="rating">
            <form class="form" method="POST" action="">
              <input type="radio" class="rating-input hidden" value="100"
                  id="rating-input-1-5" name="rating-input-1">
              <label for="rating-input-1-5" class="rating-star"></label>
              <input type="radio" class="rating-input hidden"  value="80"
                  id="rating-input-1-4" name="rating-input-1">
              <label for="rating-input-1-4" class="rating-star"></label>
              <input type="radio" class="rating-input hidden"  value="60"
                  id="rating-input-1-3" name="rating-input-1">
              <label for="rating-input-1-3" class="rating-star"></label>
              <input type="radio" class="rating-input hidden" value="40"
                  id="rating-input-1-2" name="rating-input-1">
              <label for="rating-input-1-2" class="rating-star"></label>
              <input type="radio" class="rating-input hidden" value="20"
                  id="rating-input-1-1" name="rating-input-1">
              <label for="rating-input-1-1" class="rating-star"></label>

              <input type="hidden" name="idmovie" value="<?php echo $aVoir['idd']; ?>" />
              <input type="submit" name="submit" value="Votez">
            </form>
          </div>
    </div>
    <?php } ?>
  </div>
</div>

<?php require('include/footer.php') ?>
