<?php session_start() ?>

<?php require('include/pdo.php'); ?>
<?php require('include/functions.php'); ?>

<?php

if(!empty($_GET['submitedfilter'])) {
  debug($_GET);
  die();
}
 ?>







<?php require('include/header_back.php') ?>
<div class="container modifier">
  <form action="" method="GET">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" placeholder="">
    </div>
    <div class="form-group">
      <label for="year">Year</label>
      <input type="" class="form-control" id="year" placeholder="">
    </div>
    <div class="form-group">
      <label for="plot">Plot</label>
      <input type="text" class="form-control" id="plot" placeholder="">
    </div>
    <div class="form-group">
      <label for="genres">Genres</label>
      <input type="checkbox" name="genres[]" id="genres" value="Drama" /> Drama
      <input type="checkbox" name="genres[]" id="genres" value="Action" /> Action
      <input type="checkbox" name="genres[]" id="genres" value="Adventure" /> Adventure
      <input type="checkbox" name="genres[]" id="genres" value="Crime" /> Crime
      <input type="checkbox" name="genres[]" id="genres" value="Romance" /> Romance
      <input type="checkbox" name="genres[]" id="genres" value="War" />War
      <input type="checkbox" name="genres[]" id="genres" value="Thriller" />Thriller
      <input type="checkbox" name="genres[]" id="genres" value="Sci-fy" />Sci-fy
      <input type="checkbox" name="genres[]" id="genres" value="Mystery" />Mystery
      <input type="checkbox" name="genres[]" id="genres" value="Music" />Music
      <input type="checkbox" name="genres[]" id="genres" value="Horror" />Horror
      <input type="checkbox" name="genres[]" id="genres" value="History" />History
      <input type="checkbox" name="genres[]" id="genres" value="Fantasy" />Fantasy
      <input type="checkbox" name="genres[]" id="genres" value="Family" />Family
      <input type="checkbox" name="genres[]" id="genres" value="Comedy" />Comedy
      <input type="checkbox" name="genres[]" id="genres" value="Biography" />Biography
      <input type="checkbox" name="genres[]" id="genres" value="Animation" />Animation
    </div>
    <input type="submit" name="submitedfilter" class="btn btn-default">Submit</button>
  </form>
</div>



 <?php require('include/footer.php') ?>
