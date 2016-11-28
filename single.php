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

    $sql = "SELECT * FROM movies_user_note WHERE id_user=:id_user AND id_movie=:id_movie";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id_movie', $id_movie, PDO::PARAM_INT);
    $query->bindValue(':id_user', $id_user, PDO::PARAM_INT);
    $query->execute();
    $ajoutExist = $query->fetch();

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
          <?php if (isLogged()) { ?>
            <?php if($ajoutExist['status'] == 1) { ?>
              <a href="delete.php?id=<?php echo $movie['id'] ?>"><button type="button" class="boutonretire btn" name="button">Retirer</button></a>
              <?php } else { ?>
              <a href="ajoutAVoir.php?id=<?php echo $movie['id'] ?>"><button type="button" class="boutonretire btn" name="button">A voir</button></a>
          <?php } ?>
          <!-- <button id="zoneTel" type="button" name="" class="btn">Telecharger ce film</button> -->

        <?php } else { echo '<a href="connexion.php">Se connecter</a>'; } ?>
        </div>
      <?php } ?>
    <?php } ?>
  </div>
</div>


<?php include 'include/footer.php'; ?>
