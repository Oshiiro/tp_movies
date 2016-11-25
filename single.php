<?php include 'include/pdo.php'; ?>
<?php include 'include/functions.php'; ?>
<?php include 'include/header.php'; ?>

<?php

// FICHE TECHNIQUE DU FILM

  if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM movies_full WHERE id=:id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $movies = $query->fetchAll();


    foreach ($movies as $movie) {
      if($_GET['id'] == $movie['id']) { ?>

        <div class="col-lg-6 col-lg-offset-3">
          <h4>Nom du film</h4>
          <img src="posters/<?php echo $movie['id'] ?>.jpg" alt="" class="imagesingle">
          <div class="infofilm col-lg-9">
            <h5> Infos du film : </h5>
            <hr>
            <p>Année : <?php echo $movie['year']?></p>
            <p>Résumé : <?php echo $movie['plot']?></p>
            <p>Note : <?php echo $movie['rating']. '/100'?></p>
          </div>
        </div>

  <?php }
    }
  }

  ?>

<?php include 'include/footer.php'; ?>