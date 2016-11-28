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
          <?php if (file_exists('posters/' .$movie['id']. '.jpg')) {
                  echo '<img src="posters/' .$movie['id']. '.jpg" alt=""/>';
                } else {
                  echo '<img src="http://placehold.it/205x300" title="' .$movie['title']. '">';
                }
          ?>
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

            <div class="progress">
              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php $movie['rating']?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $movie['rating'] . '%'?> ">
                <!-- <span class="sr-only">40% Complete (success)</span> -->
              </div>
            </div>
            <button type="button" class="boutonajoute btn" name="button">à voir!</button>
            <button id="zoneTel" type="button" name="" class="btn">Telecharger ce film</button>
            <button type="button" class="hidden boutonretire btn" name="button"></button>
          </div>
        </div>

  <?php }
    }
  }

  ?>

<?php include 'include/footer.php'; ?>
