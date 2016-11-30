<?php session_start() ?>

<?php require('include/pdo.php'); ?>
<?php require('include/functions.php'); ?>
<?php

  $sql ='SELECT * FROM movies_full';

  $query = $pdo->prepare($sql);
  $query->execute();
  $movies = $query->fetch();
  $id = $movies['id'];
 ?>
 <?php if (isAdmin()) { ?>
 <?php require('include/header_back.php') ?>

<div class="container modifier">
  <div class="row">
    <div class="col-md-12">
      <div class="thumbnail">
        <div><?php echo '<img src="posters/' .$movies['id']. '.jpg" alt=""/>' ?></div>
        <div class="caption">
          <h3><?php echo $movies['title']; ?></h3>
          <p>
            <tr>
              <td>Year : <?php echo $movies['year']; ?></td><br>
              <td>Genres : <?php echo $movies['genres']; ?></td><br>
              <td>Plot : <?php echo $movies['plot']; ?></td><br>
              <td>Directors : <?php echo $movies['directors']; ?></td><br>
              <td>Cast : <?php echo $movies['cast']; ?></td><br>
              <td>Writers : <?php echo $movies['writers']; ?></td><br>
              <td>Runtime : <?php echo $movies['runtime']; ?></td><br>
              <td>Rating : <?php echo $movies['rating']; ?></td><br>
            </tr>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require('include/footer.php') ?>

<?php } else { echo 'Vous n\'etes pas autorisé à acceder a cette putain de page !'; } ?>
