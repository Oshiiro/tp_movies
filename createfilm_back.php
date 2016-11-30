<?php session_start() ?>

<?php require('include/pdo.php'); ?>
<?php require('include/functions.php'); ?>

<?php
  $errors = array();
  $success = false;

  if(!empty($_POST['submit'])) {
    $title = trim(strip_tags($_POST['title']));
    $year = trim(strip_tags($_POST['year']));
    $plot = trim(strip_tags($_POST['plot']));
    $directors = trim(strip_tags($_POST['directors']));
    $cast = trim(strip_tags($_POST['cast']));
    $writers = trim(strip_tags($_POST['writers']));
    $runtime = trim(strip_tags($_POST['runtime']));
    $mpaa = trim(strip_tags($_POST['mpaa']));
    $rating = trim(strip_tags($_POST['rating']));
    $slug =  slugify($title.' '.$year);

    // titre
    if(empty($title)) {
          $errors['title'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';
    }

    // annee
    if(!empty($year)) {
      if (is_numeric($year)) {
        if(strlen($year) > 4) {
        $errors['year'] = '<span class="error">' .'trop long !!'. '</span>';
        }
      }
    } else  {
      $errors['year'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';
    }

    // plot
    if(empty($plot)) {
          $errors['plot'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';

    }

    // directors
    if(empty($directors)) {
      if(strlen($directors) > 255) {
      $errors['directors'] = '<span class="error">' .'trop long !!'. '</span>';
      } else {
        $errors['directors'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';
      }
    }

    // cast
    if(empty($cast)) {
      if(strlen($cast) > 255) {
      $errors['cast'] = '<span class="error">' .'trop long !!'. '</span>';
      } else {
        $errors['cast'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';
      }
    }

    // writers
    if(empty($writers)) {
      if(strlen($writers) > 255) {
      $errors['writers'] = '<span class="error">' .'trop long !!'. '</span>';
      } else {
        $errors['writers'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';
      }
    }

    // runtime
    if(!empty($runtime)) {
      if (is_numeric($runtime)) {
        if(strlen($runtime) > 11) {
        $errors['runtime'] = '<span class="error">' .'trop long !!'. '</span>';
        }
      }
    } else  {
      $errors['runtime'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';
    }

    // mpaa
    if(empty($mpaa)) {
      if(strlen($mpaa) > 11) {
      $errors['mpaa'] = '<span class="error">' .'trop long !!'. '</span>';
      } else {
      $errors['mpaa'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';
      }
    }

    // rating
    if(!empty($rating)) {
      if (is_numeric($rating)) {
        if(strlen($rating) > 3) {
        $errors['rating'] = '<span class="error">' .'trop long !!'. '</span>';
        }
      }
    } else  {
      $errors['rating'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';
    }

    // genres
    if(!empty($_POST['genres'])) {
      $genres = implode(', ', $_POST['genres']);
    } else {
      $errors['genres'] = "Vous n'avez cocher aucun genre.";
    }

    // si pas d'erreur
    if(count($errors) == 0) {

      $sql= "INSERT INTO movies_full (title, year, plot, directors, cast, writers, runtime, mpaa, rating, slug, created, genres, popularity)
             VALUES (:title, :year, :plot, :directors, :cast, :writers, :runtime, :mpaa, :rating, :slug, NOW(), :genres, 0)";

      $movies_form = $pdo->prepare($sql);
      $movies_form->bindValue(':title',$title, PDO::PARAM_STR);
      $movies_form->bindValue(':year',$year, PDO::PARAM_INT);
      $movies_form->bindValue(':plot',$plot, PDO::PARAM_STR);
      $movies_form->bindValue(':directors',$directors, PDO::PARAM_STR);
      $movies_form->bindValue(':cast',$cast, PDO::PARAM_STR);
      $movies_form->bindValue(':writers',$writers, PDO::PARAM_STR);
      $movies_form->bindValue(':runtime',$runtime, PDO::PARAM_INT);
      $movies_form->bindValue(':mpaa',$mpaa, PDO::PARAM_STR);
      $movies_form->bindValue(':rating',$rating, PDO::PARAM_INT);
      $movies_form->bindValue(':slug',$slug, PDO::PARAM_STR);
      $movies_form->bindValue(':genres',$genres, PDO::PARAM_STR);

      $movies_form->execute();
    }
  }

 ?>
 <?php if (isAdmin()) { ?>
<?php require('include/header_back.php') ?>

<div class="container modifier">
  <div class="row">
    <form method="POST" class="col-md-12">
      <div class="form-group">
        <label for="title">Title</label><span><?php if(!empty($errors['title'])) { echo $errors['title']; } ?></span>
        <input type="text" class="form-control" name="title" placeholder="" value="<?php if (!empty($_POST['title'])) { echo ($_POST['title']); } ?>">
      </div>
      <div class="form-group">
        <label for="year">Year</label><span><?php if(!empty($errors['year'])) { echo $errors['year']; } ?></span>
        <input type="" class="form-control" name="year" placeholder="" value="<?php if (!empty($_POST['year'])) { echo ($_POST['year']); } ?>">
      </div>
      <div class="form-group">
        <label for="plot">Plot</label><span><?php if(!empty($errors['plot'])) { echo $errors['plot']; } ?></span>
        <input type="text" class="form-control" name="plot" placeholder="" value="<?php if (!empty($_POST['plot'])) { echo ($_POST['plot']); } ?>">
      </div>
      <div class="form-group">
        <label for="directors">Directors</label><span><?php if(!empty($errors['directors'])) { echo $errors['directors']; } ?></span>
        <input type="text" class="form-control" name="directors" placeholder="" value="<?php if (!empty($_POST['directors'])) { echo ($_POST['directors']); } ?>">
      </div>
      <div class="form-group">
        <label for="cast">Cast</label><span><?php if(!empty($errors['cast'])) { echo $errors['cast']; } ?></span>
        <input type="text" class="form-control" name="cast" placeholder="" value="<?php if (!empty($_POST['cast'])) { echo ($_POST['cast']); } ?>">
      </div>
      <div class="form-group">
        <label for="writers">Writers</label><span><?php if(!empty($errors['writers'])) { echo $errors['writers']; } ?></span>
        <input type="text" class="form-control" name="writers" placeholder="" value="<?php if (!empty($_POST['writers'])) { echo ($_POST['writers']); } ?>">
      </div>
      <div class="form-group">
        <label for="runtime">Runtime</label><span><?php if(!empty($errors['runtime'])) { echo $errors['runtime']; } ?></span>
        <input type="text" class="form-control" name="runtime" placeholder="" value="<?php if (!empty($_POST['runtime'])) { echo ($_POST['runtime']); } ?>">
      </div>
      <div class="form-group">
        <label for="mpaa">Mpaa</label><span><?php if(!empty($errors['mpaa'])) { echo $errors['mpaa']; } ?></span>
        <input type="text" class="form-control" name="mpaa" placeholder="" value="<?php if (!empty($_POST['mpaa'])) { echo ($_POST['mpaa']); } ?>">
      </div>
      <div class="form-group">
        <label for="rating">Rating</label><span><?php if(!empty($errors['rating'])) { echo $errors['rating']; } ?></span>
        <input type="text" class="form-control" name="rating" placeholder="" value="<?php if (!empty($_POST['rating'])) { echo ($_POST['rating']); } ?>">
      </div>
      <div class="form-group">
        <label for="genres" id="genres">Genres</label><span><?php if(!empty($errors['genres'])) { echo $errors['genres']; } ?></span>
        <br>
        <input type="checkbox" name="genres[]" value="Drama" /> Drama
        <input type="checkbox" name="genres[]" value="Action" /> Action
        <input type="checkbox" name="genres[]" value="Adventure" /> Adventure
        <input type="checkbox" name="genres[]" value="Crime" /> Crime
        <input type="checkbox" name="genres[]" value="Romance" /> Romance
        <input type="checkbox" name="genres[]" value="War" />War
        <input type="checkbox" name="genres[]" value="Thriller" />Thriller
        <input type="checkbox" name="genres[]" value="Sci-fy" />Sci-fy
        <input type="checkbox" name="genres[]" value="Mystery" />Mystery
        <input type="checkbox" name="genres[]" value="Music" />Music
        <input type="checkbox" name="genres[]" value="Horror" />Horror
        <input type="checkbox" name="genres[]" value="History" />History
        <input type="checkbox" name="genres[]" value="Fantasy" />Fantasy
        <input type="checkbox" name="genres[]" value="Family" />Family
        <input type="checkbox" name="genres[]" value="Comedy" />Comedy
        <input type="checkbox" name="genres[]" value="Biography" />Biography
        <input type="checkbox" name="genres[]" value="Animation" />Animation
      </div>
      <input type="submit" name="submit" class="btn btn-default" value="submit">
    </form>
  </div>
</div>

<?php require('include/footer.php') ?>

<?php } else { echo 'Vous n\'etes pas autorisé à acceder a cette putain de page !'; } ?>
