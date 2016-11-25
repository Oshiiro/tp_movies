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
      <label for="slug">Slug</label>
      <input type="" class="form-control" id="slug" placeholder="">
    </div>
    <div class="form-group">
      <label for="title">Title</label>
      <input type="" class="form-control" id="title" placeholder="">
    </div>
    <div class="form-group">
      <label for="year">Year</label>
      <input type="" class="form-control" id="year" placeholder="">
    </div>
    <div class="form-group">
      <label for="genres">Genres</label>
      <input type="checkbox" name="genres[]" id="genres" value="Drama" /> Drama
      <input type="checkbox" name="genres[]" id="genres" value="Action" /> Action
      <input type="checkbox" name="genres[]" id="genres" value="Adventure" /> Adventure
      <input type="checkbox" name="genres[]" id="genres" value="Crime" /> Crime
      <input type="checkbox" name="genres[]" id="genres" value="Romance" /> Romance
    </div>
    <input type="submit" name="submitedfilter" class="btn btn-default">Submit</button>
  </form>
</div>



 <?php require('include/footer.php') ?>
