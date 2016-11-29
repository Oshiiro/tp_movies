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
        AND notes.status = 1 OR notes.status =2";

  $query = $pdo->prepare($sql);
  $query->execute();
  $filmvu = $query->fetchAll();
  // debug($filmvu);






$sql = "UPDATE movies_user_note
        SET note = 20, status = 2";










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

            <span class="rating">

              <input type="radio" class="rating-input"
                  id="rating-input-1-5" name="rating-input-1">
              <label for="rating-input-1-5" class="rating-star"></label>
              <input type="radio" class="rating-input"
                  id="rating-input-1-4" name="rating-input-1">
              <label for="rating-input-1-4" class="rating-star"></label>
              <input type="radio" class="rating-input"
                  id="rating-input-1-3" name="rating-input-1">
              <label for="rating-input-1-3" class="rating-star"></label>
              <input type="radio" class="rating-input"
                  id="rating-input-1-2" name="rating-input-1">
              <label for="rating-input-1-2" class="rating-star"></label>
              <input type="radio" class="rating-input"
                  id="rating-input-1-1" name="rating-input-1">
              <label for="rating-input-1-1" class="rating-star"></label>

            </span>


    <?php } else {  ?>
              <p>Votre note : <?php echo $filmv['note']. '/100'?></p>
      <?php }
              } ?>

    </div>
  </div>
</div>

<?php require('include/footer.php') ?>
