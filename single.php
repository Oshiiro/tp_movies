<?php include 'include/pdo.php'; ?>
<?php include 'include/functions.php'; ?>
<?php include 'include/header.php'; ?>

<?php

// FICHE TECHNIQUE DU FILM

  if(!empty($_GET['slug'])) {
    $slug = $_GET['slug'];

    $sql = "SELECT * FROM movies_full WHERE slug=:slug";
    $query = $pdo->prepare($sql);
    $query->bindValue(':slug', $slug, PDO::PARAM_INT);
    $query->execute();
    $movies = $query->fetchAll();


    foreach ($movies as $movie) {
      if($_GET['slug'] == $movie['slug']) { ?>

        <div class="col-lg-6 col-lg-offset-3">
          <h4><?php echo $movie['title'] ?></h4>
          <img src="posters/<?php echo $movie['id'] ?>.jpg" alt="" class="imagesingle">
          <div class="infofilm col-lg-9">
            <h5> Infos du film : </h5>
            <hr>
            <p>Résumé : <?php echo $movie['plot']?></p>
            <p>Réalisateur : <?php echo $movie['directors']?></p>
            <p>Acteurs principaux : <?php echo $movie['cast']?></p>
            <p>Durée : <?php echo $movie['runtime']. ' minutes'?></p>
            <p>Année : <?php echo $movie['year']?></p>
            <p>Genre : <?php echo $movie['genres']?></p>
            <p>Note : <?php echo $movie['rating']. '/100'?></p>
          </div>
        </div>

  <?php }
    }
  }

  ?>

<?php include 'include/footer.php'; ?>
