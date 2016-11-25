<?php include ('include/pdo.php'); ?>
<?php include ('include/functions.php'); ?>
<?php

// traitement du randow
$sql = "SELECT * FROM movies_full
        ORDER BY RAND()
        LIMIT 5";
  $query = $pdo->prepare($sql);
  $query->execute();
  $randomId = $query->fetchAll();


// traitement du bouton + de film
if (!empty($_POST['plusDeFilm'])) {
  $sql = "SELECT * FROM movies_full
          ORDER BY RAND()
          LIMIT 5";
    $query = $pdo->prepare($sql);
    $query->execute();
    $randomId2 = $query->fetchAll();
}






 ?>
<?php include ('include/header.php'); ?>

<div class="container">
  <div class="row">
    <form class="" action="" method="post">
      <div class="choixchoix">
        <label for="usr">Recherche (acteur, directeur..) </label>
        <input type="text" class="form-control" id="director">
        <div class ="categories col-lg-4" >
          <div class="row">
            <h4> Catégories </h4><br>

            <div class= "col-md-6">
              <div class="checkbox">
                <label><input type="checkbox" value="">Action</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">Animation</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">Aventure</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">Biography</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">Comedy</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">Drama</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">Family</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">Fantasy</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="checkbox">
                <label><input type="checkbox" value="">History</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">Horror</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">Music</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">Mystery</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">Romance</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">Sci-fy</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">Thriller</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="">War</label>
              </div>
            </div>
          </div>
        </div>

        <div class ="annees col-lg-4" >
          <h4> Années </h4>
          <br>
          <select class="selectyear">
            <optgroup label="Années">
              <option>2016-2010</option>
              <option>2010-2000</option>
              <option>1990-2000</option>
              <option>1980-1990</option>
              <option>1970-1980</option>
              <option>1960-1970</option>
              <option>1950-1960</option>
              <option>1900-1950</option>
            </optgroup>
          </select>
        </div>

        <div class ="popularite col-lg-4" >
          <h4> Catégories </h4>
          <br>
          <select class="selectpopularite">
            <optgroup label="Popularité">
              <option> 0 - 20 </option>
              <option>20 - 40</option>
              <option>40 - 60</option>
              <option>60 - 80</option>
              <option>80 - 100</option>
            </optgroup>
          </select>
        </div>
      </div>
      <input type="submit" name="buttonrecherche1" value="RECHERCHE">
      <input type="submit" name="buttonrecherche2" value="RECHERCHE">
    </form>
  </div>
  <div class="choixchoix col-lg-12">
    <div class="col-lg-12 films" style="text-align : center">
      <h4>Téma ça mon srab</h4>
      <?php if (!empty($_POST['plusDeFilm'])) { ?>
        <?php foreach ($randomId2 as $key): ?>
          <a href="single.php?slug=<?php echo($key['slug']);?>">
            <img src="posters/<?php echo $key['id'] ?>.jpg" alt="">
          </a>
        <?php endforeach; ?>
      <?php } else { ?>
        <?php foreach ($randomId as $key): ?>
          <a href="single.php?slug=<?php echo($key['slug']);?>">
            <img src="posters/<?php echo $key['id'] ?>.jpg" alt="">
          </a>
        <?php endforeach; ?>
      <?php } ?>
    </div>

    <div class="choix col-lg-12">
      <form action="" method="post">
        <div class="boutonrandom col-lg-12" style="text-align : center">
          <input type="submit" name="plusDeFilm" class="btn btn-success" value="+ De FILM">
        </div>
      </form>
    </div>

  </div> <!-- Div CHOIXCHOIX -->
<!-- Notes -->

</div> <!-- fin container -->

<?php include 'include/footer.php'; ?>
