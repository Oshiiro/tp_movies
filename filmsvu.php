<?php session_start() ?>
<?php include 'include/pdo.php'; ?>
<?php include 'include/functions.php'; ?>
<?php require('include/header.php') ?>

<?php

$id_user = $_SESSION['user']['id'];

$sql = "SELECT notes.note, movies.title, movies.plot, movies.rating, notes.status, movies.id
        FROM movies_user_note AS notes

        LEFT JOIN movies_full AS movies
        ON notes.id_movie = movies.id

        WHERE notes.id_user = $id_user
        AND notes.status = 2 OR notes.status = 3

        ORDER BY created_at DESC";

  $query = $pdo->prepare($sql);
  $query->execute();
  $filmvu = $query->fetchAll();
  // debug($filmvu);


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

// header('Location: filmsvu.php');



?>
<div class="container">
  <div class="row">
    <div class="col-md-6">

      <h4>FILMS VUS</h4>

        <?php  foreach($filmvu as $filmv) { ?>
        <h4>Titre : <?php echo $filmv['title'];?></h4>
        <?php if (file_exists('posters/' .$filmv['id']. '.jpg')) {
               echo '<div class="center"><img src="posters/' .$filmv['id']. '.jpg" alt=""/></div>';
             } else {
               echo '<div class="center"><img src="http://placehold.it/205x300" title="' .$filmv['title']. '</div>">';
             } ?>
          <p>Résumé : <?php echo $filmv['plot'];?></p>
          <p>Note générale : <?php echo $filmv['rating']. '/100'?></p>
          <?php if($filmv['note'] == 0) { ?>
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

              <input type="hidden" name="idmovie" value="<?php echo $filmv['id']; ?>" />
              <input type="submit" name="submit" value="Votez">
            </form>
          </div>



    <?php } else {  ?>
              <p>Votre note : <?php echo $filmv['note']. '/100'?></p>
      <?php }
              } ?>

    </div>
  </div>
</div>

<?php require('include/footer.php') ?>
