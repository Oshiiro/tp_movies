<?php session_start() ?>

<?php require('include/pdo.php'); ?>
<?php require('include/functions.php'); ?>

<?php

  $id = $_GET['id'];
  $errors = array();

  $sql ='SELECT * FROM movies_full WHERE id='.$id.'';

  $query = $pdo->prepare($sql);
  $query->execute();
  $movies = $query->fetch();

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
    $genres = trim(strip_tags($_POST['genres']));
    $slug =  slugify($title.' '.$year);

    if(empty($title)) {
          $errors['title'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';
    }

    if(!empty($year)) {
      if (is_numeric($year)) {
        if(strlen($year) > 4) {
        $errors['year'] = '<span class="error">' .'trop long !!'. '</span>';
        }
      }
    } else  {
      $errors['year'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';
    }

    if(empty($plot)) {
          $errors['plot'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';

    }

    if(empty($directors)) {
      if(strlen($directors) > 255) {
      $errors['directors'] = '<span class="error">' .'trop long !!'. '</span>';
      } else {
        $errors['directors'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';
      }
    }

    if(empty($cast)) {
      if(strlen($cast) > 255) {
      $errors['cast'] = '<span class="error">' .'trop long !!'. '</span>';
      } else {
        $errors['cast'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';
      }
    }

    if(empty($writers)) {
      if(strlen($writers) > 255) {
      $errors['writers'] = '<span class="error">' .'trop long !!'. '</span>';
      } else {
        $errors['writers'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';
      }
    }

    if(!empty($runtime)) {
      if (is_numeric($runtime)) {
        if(strlen($runtime) > 11) {
        $errors['runtime'] = '<span class="error">' .'trop long !!'. '</span>';
        }
      }
    } else  {
      $errors['runtime'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';
    }

    if(empty($mpaa)) {
      if(strlen($mpaa) > 11) {
      $errors['mpaa'] = '<span class="error">' .'trop long !!'. '</span>';
      } else {
      $errors['mpaa'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';
      }
    }

    if(!empty($_POST['genres'])) {
      $genres = implode(', ', $_POST['genres']);
    } else {
      $errors['genres'] = "Vous n'avez cocher aucun genre.";
    }

    if(!empty($rating)) {
      if (is_numeric($rating)) {
        if(strlen($rating) > 3) {
        $errors['rating'] = '<span class="error">' .'trop long !!'. '</span>';
        }
      }
    } else  {
      $errors['rating'] ='<span class="error">' .'Veuillez renseigner ce champ.'. '</span>';
    }

    if(count($errors) == 0) {

      $movies_send= "UPDATE movies_full SET slug=:slug,title=:title,year=:year,genres=:genres,plot=:plot,directors=:directors,cast=:cast,writers=:writers,runtime=:runtime,mpaa=:mpaa,rating=:rating,modified=NOW() WHERE id = :id";

      $movies_form = $pdo->prepare($movies_send);
      $movies_form->bindValue(':slug',$slug, PDO::PARAM_STR);
      $movies_form->bindValue(':title',$title, PDO::PARAM_STR);
      $movies_form->bindValue(':year',$year, PDO::PARAM_INT);
      $movies_form->bindValue(':plot',$plot, PDO::PARAM_STR);
      $movies_form->bindValue(':directors',$directors, PDO::PARAM_STR);
      $movies_form->bindValue(':cast',$cast, PDO::PARAM_STR);
      $movies_form->bindValue(':writers',$writers, PDO::PARAM_STR);
      $movies_form->bindValue(':runtime',$runtime, PDO::PARAM_INT);
      $movies_form->bindValue(':mpaa',$mpaa, PDO::PARAM_INT);
      $movies_form->bindValue(':rating',$rating, PDO::PARAM_INT);
      $movies_form->bindValue(':genres',$genres, PDO::PARAM_INT);
      $movies_form->bindValue(':id',$id, PDO::PARAM_INT);

      $movies_form->execute();
      header('location: modif_send_back.php');
    }
  }

 ?>
 <?php if (isAdmin()) { ?>
 <?php require('include/header_back.php') ?>

  <div class="container modifier">
    <div class="row">
    <div class="col-md-4">
      <div class="thumbnail">
        <?php if (file_exists('posters/' .$movies['id']. '.jpg')) {
                echo '<div class="center"><img src="posters/' .$movies['id']. '.jpg" alt=""/></div>';
              } else {
                echo '<div class="center"><img src="http://placehold.it/205x300" title="' .$movies['title']. '"/></div>';
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
              <td>Runtime : <?php echo $movies['mpaa']; ?></td><br>
              <td>Rating : <?php echo $movies['rating']; ?></td><br>
            </tr>
          </p>
        </div>
      </div>
    </div>
    <form method="POST" class="col-md-8">
      <div class="form-group">
        <label for="title">Title</label><span><?php if(!empty($errors['title'])) { echo $errors['title']; } ?></span>
        <input type="text" class="form-control" name="title" placeholder="" value="<?php if (!empty($_POST['title'])) { echo ($_POST['title']); } else { if(!empty($movies['title'])) { echo $movies['title']; }} ?>">
      </div>
      <div class="form-group">
        <label for="year">Year</label><span><?php if(!empty($errors['year'])) { echo $errors['year']; } ?></span>
        <input type="" class="form-control" name="year" placeholder="" value="<?php if (!empty($_POST['year'])) { echo ($_POST['year']); } else { if(!empty($movies['year'])) { echo $movies['year']; }} ?>">
      </div>
      <div class="form-group">
        <label for="plot">Plot</label><span><?php if(!empty($errors['plot'])) { echo $errors['plot']; } ?></span>
        <input type="text" class="form-control" name="plot" placeholder="" value="<?php if (!empty($_POST['plot'])) { echo ($_POST['plot']); } else { if(!empty($movies['plot'])) { echo $movies['plot']; }} ?>">
      </div>
      <div class="form-group">
        <label for="directors">Directors</label><span><?php if(!empty($errors['directors'])) { echo $errors['directors']; } ?></span>
        <input type="text" class="form-control" name="directors" placeholder="" value="<?php if (!empty($_POST['directors'])) { echo ($_POST['directors']); } else { if(!empty($movies['directors'])) { echo $movies['directors']; }} ?>">
      </div>
      <div class="form-group">
        <label for="cast">Cast</label><span><?php if(!empty($errors['cast'])) { echo $errors['cast']; } ?></span>
        <input type="text" class="form-control" name="cast" placeholder="" value="<?php if (!empty($_POST['cast'])) { echo ($_POST['cast']); } else { if(!empty($movies['cast'])) { echo $movies['cast']; }} ?>">
      </div>
      <div class="form-group">
        <label for="writers">Writers</label><span><?php if(!empty($errors['writers'])) { echo $errors['writers']; } ?></span>
        <input type="text" class="form-control" name="writers" placeholder="" value="<?php if (!empty($_POST['writers'])) { echo ($_POST['writers']); } else { if(!empty($movies['writers'])) { echo $movies['writers']; }} ?>">
      </div>
      <div class="form-group">
        <label for="runtime">Runtime</label><span><?php if(!empty($errors['runtime'])) { echo $errors['runtime']; } ?></span>
        <input type="text" class="form-control" name="runtime" placeholder="" value="<?php if (!empty($_POST['runtime'])) { echo ($_POST['runtime']); } else { if(!empty($movies['runtime'])) { echo $movies['runtime']; }} ?>">
      </div>
      <div class="form-group">
        <label for="mpaa">Mpaa</label><span><?php if(!empty($errors['mpaa'])) { echo $errors['mpaa']; } ?></span>
        <input type="text" class="form-control" name="mpaa" placeholder="" value="<?php if (!empty($_POST['mpaa'])) { echo ($_POST['mpaa']); } else {if(!empty($movies['mpaa'])) { echo $movies['mpaa']; }} ?>">
      </div>
      <div class="form-group">
        <label for="rating">Rating</label><span><?php if(!empty($errors['rating'])) { echo $errors['rating']; } ?></span>
        <input type="text" class="form-control" name="rating" placeholder="" value="<?php if (!empty($_POST['rating'])) { echo ($_POST['rating']); } else {if(!empty($movies['rating'])) { echo $movies['rating']; }}?>">
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
