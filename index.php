<?php session_start() ?>

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

 ?>

<?php include ('include/header.php'); ?>

<div class="container">
  <div class="row">
    <form class="" action="search.php" method="GET">
      <div class="choixchoix hidden">
        <label for="usr">Recherche (acteur, directeur..) </label>
        <input type="text" class="form-control" name="searching" id="director">
        <div class ="categories col-lg-4" >
          <div class="row">
            <div class="form-group">
              <h4>Genres</h4>
              <br>
              <label for="genres"></label>
              <input type="checkbox" name="genres[]" id="genres" value="Drama" /> Drama
              <input type="checkbox" name="genres[]" id="genres" value="Action" /> Action
              <input type="checkbox" name="genres[]" id="genres" value="Adventure" /> Adventure
              <input type="checkbox" name="genres[]" id="genres" value="Crime" /> Crime
              <input type="checkbox" name="genres[]" id="genres" value="Romance" /> Romance
              <input type="checkbox" name="genres[]" id="genres" value="War" />War
              <input type="checkbox" name="genres[]" id="genres" value="Thriller" />Thriller
              <input type="checkbox" name="genres[]" id="genres" value="Sci-fy" />Sci-fy
              <input type="checkbox" name="genres[]" id="genres" value="Mystery" />Mystery
              <input type="checkbox" name="genres[]" id="genres" value="Music" />Music
              <input type="checkbox" name="genres[]" id="genres" value="Horror" />Horror
              <input type="checkbox" name="genres[]" id="genres" value="History" />History
              <input type="checkbox" name="genres[]" id="genres" value="Fantasy" />Fantasy
              <input type="checkbox" name="genres[]" id="genres" value="Family" />Family
              <input type="checkbox" name="genres[]" id="genres" value="Comedy" />Comedy
              <input type="checkbox" name="genres[]" id="genres" value="Biography" />Biography
              <input type="checkbox" name="genres[]" id="genres" value="Animation" />Animation
            </div>
          </div>
        </div>

        <div class ="annees col-lg-4" >
          <h4> Années </h4>
          <br>
          <select class="selectyear">
            <optgroup label="Années" name="annees">
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
            <optgroup label="Popularité" name="popularité">
              <option>0 - 20</option>
              <option>20 - 40</option>
              <option>40 - 60</option>
              <option>60 - 80</option>
              <option>80 - 100</option>
            </optgroup>
          </select>
        </div>
      </div>
    </div>
    <div class="center">
      <input class="hidden buttonrecherche2 btn btn-success" type="submit" name="buttonrecherche2" value="RECHERCHE" placeholder="Trouver un film">
    </div>
  </form>
  <div class="center">
    <input class="buttonrecherche1 btn btn-success" type="button" name="buttonrecherche1" value="RECHERCHE">
  </div>
</div>
<div class="choixchoix col-lg-12">
  <div class="col-lg-12 films" style="text-align : center">
    <h4>Téma ça mon srab</h4>

      <?php foreach ($randomId as $key) { ?>
        <a href="single.php?slug=<?php echo($key['slug']);?>">
          <?php if (file_exists('posters/' .$key['id']. '.jpg')) {
                  echo '<img src="posters/' .$key['id']. '.jpg" alt=""/>';
                } else {
                  echo '<img src="http://placehold.it/205x300" title="' .$key['title']. '">';
                } ?>
        </a>
    <?php } ?>
  </div>
  <div class="choix col-lg-12">
    <form action="" method="post">
      <div class="col-lg-12 center">
        <button id="plusDeFilm" type="button" name="plusDeFilm" class="btn btn-success">+ De FILM</button>
      </div>
    </form>
  </div>
</div> <!-- Div CHOIXCHOIX -->
<!-- Notes -->

</div> <!-- fin container -->

<?php include 'include/footer.php'; ?>
