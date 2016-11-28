<?php session_start() ?>

<?php include 'include/pdo.php'; ?>
<?php include 'include/functions.php'; ?>

<?php

// RECUPERATION DE LA FICHE TECHNIQUE DU FILM POUR AFFICHAGE
  if(!empty($_GET['slug'])) {
    $slug = $_GET['slug'];

    $sql = "SELECT * FROM movies_full WHERE slug=:slug";
    $query = $pdo->prepare($sql);
    $query->bindValue(':slug', $slug, PDO::PARAM_STR);
    $query->execute();
    $movies = $query->fetchAll();
  }

//AJOUT DU FILM DANS LA LISTE "A VOIR"
  if (!empty($_POST['submit'])) {
    foreach ($movies as $movie) {
      $id_movie = $movie['id'];
    }
    $id_user = $_SESSION['user']['id'];

    $sql = "SELECT id FROM movies_user_note WHERE id_user=:id_user AND id_movie=:id_movie";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id_movie', $id_movie, PDO::PARAM_INT);
    $query->bindValue(':id_user', $id_user, PDO::PARAM_INT);
    $query->execute();
    $ajoutExist = $query->fetch();

    if (!empty($ajoutExist)) {
      //Le film est deja dans la BDD
    } else {
      //Si non : On l'ajoute
      $ajoutAVoir = "INSERT INTO movies_user_note (id_movie, id_user, note, created_at, status) VALUES(:id_movie, :id_user, 0, now(), 1)";
      //preparation de la requete
      $query = $pdo->prepare($ajoutAVoir);
      // protection des inj sql
      $query->bindValue(':id_movie', $id_movie, PDO::PARAM_STR);
      $query->bindValue(':id_user', $id_user, PDO::PARAM_STR);
      $query->execute();
    }
  }

 ?>

<?php include 'include/header.php'; ?>

<div class="container">
  <div class="row">
    <?php foreach ($movies as $movie) { ?>
      <?php if($_GET['slug'] == $movie['slug']) { ?>
        <div class="col-md-12">
          <h4 class="center"><?php echo $movie['title'] ?></h4>
          <?php if (file_exists('posters/' .$movie['id']. '.jpg')) {
                  echo '<div class="center"><img src="posters/' .$movie['id']. '.jpg" alt=""/></div>';
                } else {
                  echo '<div class="center"><img src="http://placehold.it/205x300" title="' .$movie['title']. '</div>">';
                } ?>
        </div>
        <div class="infofilm col-md-12">
          <h5> Infos du film : </h5>
          <hr>
          <p>Résumé : <?php echo $movie['plot']?></p>
          <p>Réalisateur : <?php echo $movie['directors']?></p>
          <p>Acteurs principaux : <?php echo $movie['cast']?></p>
          <p>Durée : <?php echo $movie['runtime']. ' minutes'?></p>
          <p>Année : <?php echo $movie['year']?></p>
          <p>Genre : <?php echo $movie['genres']?></p>
          <p>Note : <?php echo $movie['rating']. '/100'?></p>

          <div class="progress">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php $movie['rating']?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $movie['rating'] . '%'?> ">
              <!-- <span class="sr-only">40% Complete (success)</span> -->
            </div>
          </div>
          <form action="" method="POST">
            <input type="submit" class="boutonajoute btn" name="submit" value="A voir">
          </form>
          <!-- <button id="zoneTel" type="button" name="" class="btn">Telecharger ce film</button> -->
          <button type="button" class="hidden boutonretire btn" name="button"></button>
        </div>
      <?php } ?>
    <?php } ?>
  </div>
</div>


<?php include 'include/footer.php'; ?>
