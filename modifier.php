<?php session_start() ?>

<?php require('include/pdo.php'); ?>
<?php require('include/functions.php'); ?>

<?php
  $errors = array();

  $sql ='SELECT * FROM movies_full';

  $query = $pdo->prepare($sql);
  $query->execute();
  $movies = $query->fetch();
// if(!empty($_GET['submitedfilter'])) {
//   debug($_GET);
//   die();
// }
  if(!empty($_POST['submit'])) {
    $title = trim(strip_tags($_POST['title']));
    $year = trim(strip_tags($_POST['year']));
    $genres = trim(strip_tags($_POST['genres']));
    $plot = trim(strip_tags($_POST['plot']));
    $directors = trim(strip_tags($_POST['directors']));
    $cast = trim(strip_tags($_POST['cast']));
    $writers = trim(strip_tags($_POST['writers']));
    $runtime = trim(strip_tags($_POST['runtime']));
    $rating = trim(strip_tags($_POST['rating']));
 }
 ?>







<?php require('include/header_back.php') ?>
  <div class="row">
  <div class="container modifier">
    <div class="col-md-4">
      <div class="thumbnail">
        <?php if (file_exists('posters/' .$movie['id']. '.jpg')) {
                echo '<div class="center"><img src="posters/' .$movie['id']. '.jpg" alt=""/></div>';
              } else {
                echo '<div class="center"><img src="http://placehold.it/205x300" title="' .$movie['title']. '</div>">';
              } ?>
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
    <form action="" method="POST" class="col-md-8">
      <div class="form-group">
        <label for="title">Title</label><span></span>
        <input type="text" class="form-control" id="title" placeholder="" value="<?php if(!empty($movies['title'])) { echo $movies['title']; } ?>">
      </div>
      <div class="form-group">
        <label for="year">Year</label><span></span>
        <input type="" class="form-control" id="year" placeholder="" value="<?php if(!empty($movies['year'])) { echo $movies['year']; } ?>">
      </div>
      <div class="form-group">
        <label for="plot">Plot</label><span></span>
        <input type="text" class="form-control" id="plot" placeholder="" value="<?php if(!empty($movies['plot'])) { echo $movies['plot']; } ?>">
      </div>
      <div class="form-group">
        <label for="directors">Directors</label><span></span>
        <input type="text" class="form-control" id="directors" placeholder="" value="<?php if(!empty($movies['directors'])) { echo $movies['directors']; } ?>">
      </div>
      <div class="form-group">
        <label for="cast">Cast</label><span></span>
        <input type="text" class="form-control" id="cast" placeholder="" value="<?php if(!empty($movies['cast'])) { echo $movies['cast']; } ?>">
      </div>
      <div class="form-group">
        <label for="writers">Writers</label><span></span>
        <input type="text" class="form-control" id="writers" placeholder="" value="<?php if(!empty($movies['writers'])) { echo $movies['writers']; } ?>">
      </div>
      <div class="form-group">
        <label for="runtime">Runtime</label><span></span>
        <input type="text" class="form-control" id="runtime" placeholder="" value="<?php if(!empty($movies['runtime'])) { echo $movies['runtime']; } ?>">
      </div>
      <div class="form-group">
        <label for="rating">Rating</label><span></span>
        <input type="text" class="form-control" id="rating" placeholder="" value="<?php if(!empty($movies['rating'])) { echo $movies['rating']; } ?>"><br>
      </div>
      <input type="submit" name="submitedfilter" class="btn btn-default">
    </form>
  </div>
</div>


 <?php require('include/footer.php') ?>
