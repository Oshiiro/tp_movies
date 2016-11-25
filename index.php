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
        <h4> Catégories </h4>
            <br>
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
            <div class="checkbox">
              <label><input type="checkbox" value="">2010 - 2016</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="">2000 - 2010 </label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="">1990 - 2000</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="">1980 - 1990</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="">1970 - 1980</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="">1960 - 1970</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="">1950 - 1960</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="">1900 - 1950</label>
            </div>
      </div>

      <div class ="popularite col-lg-4" >
        <h4> Catégories </h4>
            <br>
            <div class="checkbox">
              <label><input type="checkbox" value="">1 etoiles</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="">2 etoiles</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="">3 etoiles </label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="">4 etoiles </label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="">5 etoiles </label>
            </div>
            </div>
      </div>




    </div>



</form>
<div class="choixchoix col-lg-12">



  <div class="col-lg-12 films" style="text-align : center">
    <input type="button" name="buttonrecherche" value="RECHERCHE">
    <h4>Téma ça mon srab</h4>
    <?php if (!empty($_POST['plusDeFilm'])) { ?>
      <?php foreach ($randomId2 as $key): ?>
        <a href="single.php?slug=<?php echo($key['slug']);?>">
          <?php if (file_exists('posters/' .$key['id']. '.jpg')) {
                  echo '<img src="posters/' .$key['id']. '.jpg" alt=""/>';
                } else {
                  echo '<img src="http://placehold.it/205x300" title="' .$key['title']. '">';
                }
          ?>
        </a>
      <?php endforeach; ?>
    <?php } else { ?>
      <?php foreach ($randomId as $key): ?>
        <a href="single.php?slug=<?php echo($key['slug']);?>">
          <?php if (file_exists('posters/' .$key['id']. '.jpg')) {
                  echo '<img src="posters/' .$key['id']. '.jpg" alt=""/>';
                } else {
                  echo '<img src="http://placehold.it/205x300" title="' .$key['title']. '">';
                }
          ?>
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

</div>
</div>

<?php include 'include/footer.php'; ?>
