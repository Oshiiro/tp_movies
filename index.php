<?php session_start(); ?>
<?php include ('include/pdo.php'); ?>
<?php include ('include/functions.php'); ?>
<?php

// traitement du random "TEMA CA MON SRAB"
$sql = "SELECT * FROM movies_full
        ORDER BY RAND()
        LIMIT 5";
  $query = $pdo->prepare($sql);
  $query->execute();
  $randomId = $query->fetchAll();

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++
//                   BARRE DE RECHERCHE
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++
$searching = '';
$genres = '';
$anneesSQL = '';
$populariteSQL = '';

if(!empty($_GET['buttonrecherche2'])) {
  $sql = '';
  $sql .= "SELECT * FROM movies_full WHERE 1 = 1";

  // recherche
  if(!empty($_GET['searching'])) {
    $searching = trim(strip_tags($_GET['searching']));
    $sql .= ' AND ( title LIKE :search OR directors LIKE :search OR cast LIKE :search )';
  }

  // genres
  if(!empty($_GET['genres'])) {
    $genres = $_GET['genres'];
    $countGenres = count($genres);
    // foreach ($genres as $key) {
    //   $sql .= " AND genres = '".$key."'";
    // };
    $sql .= " AND genres LIKE '%".$genres[0]."%'";
    for ($i=1; $i < $countGenres ; $i++) {
      $sql .= " OR genres LIKE '%".$genres[$i]."%'";
    }
  }

  // annees
  if(!empty($_GET['annees'])) {
    $annees = trim(strip_tags($_GET['annees']));
    $anneesStr = str_replace("-", "' AND '",$annees);
    $sql .= " AND year BETWEEN '".$anneesStr."'";
  }

  // popularite
  if(!empty($_GET['popularite'])) {
    $popularite = trim(strip_tags($_GET['popularite']));
    $populariteStr = str_replace("-", "' AND '",$popularite);
    $sql .= " AND rating BETWEEN '".$populariteStr."'";
  }

  $sql .= " LIMIT 20";


  $query = $pdo->prepare($sql);
  $query->bindValue(':search','%' . $searching . '%', PDO::PARAM_STR);
  $query->execute();
  $resultSearch = $query->fetchAll();

  debug($resultSearch);


}
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++
//                   FIN DE RECHERCHE
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++


 ?>

<?php include ('include/header.php'); ?>

<div class="container">
  <div class="row">
    <form class="" id="recherche" action="" method="GET">
      <div class="choixchoix hidden">
        <label for="usr">Recherche (titre du film, acteurs, réalisateurs) </label>
        <input type="text" class="form-control" name="searching" id="director">
        <div class ="categories col-lg-4" >
          <div class="form-group">
            <h4>Genres</h4>
            <br>
            <label for="genres" id="genres"></label>
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
            <br>
            <input type="button" id="allGenres" value="Tout cocher"/>
            <input type="button" id="noGenres" value="Tout décocher"/>
          </div>
        </div>

        <div class ="annees col-md-4" >
          <h4> Années </h4>
          <br>
          <select name="annees" class="selectyear">
            <option value="">-</option>
            <option value="2010-2016">2010 - 2016</option>
            <option value="2010-2000">2010 - 2000</option>
            <option value="1990-2000">1990 - 2000</option>
            <option value="1980-1990">1980 - 1990</option>
            <option value="1970-1980">1970 - 1980</option>
            <option value="1960-1970">1960 - 1970</option>
            <option value="1950-1960">1950 - 1960</option>
            <option value="1900-1950">1900 - 1950</option>
          </select>
        </div>

        <div class ="popularite col-md-4" >
          <h4> Popularité </h4>
          <br>
          <select class="selectpopularite" name="popularite">
            <option value="">-</option>
            <option value="0-20">0 - 20</option>
            <option value="20-40">20 - 40</option>
            <option value="40-60">40 - 60</option>
            <option value="60-80">60 - 80</option>
            <option value="80-100">80 - 100</option>
          </select>
        </div>
      </div>
    </div>
    <div class="center">
      <label for="buttonrecherche2"></label>
      <input class="hidden buttonrecherche2 btn btn-success" type="submit" name="buttonrecherche2" value="RECHERCHE">
      <label for="retour"></label>
      <input class="hidden retour btn btn-success" type="submit" name="retour" value="RETOUR">
    </div>
  </form>
  <div class="center">
    <input class="buttonrecherche1 btn btn-success" type="button" name="buttonrecherche1" value="FILTRER">
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-12 films" style="text-align : center">
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
        <form action="" method="post">
          <div class="col-md-12 center">
            <button id="plusDeFilm" type="button" name="plusDeFilm" class="btn btn-success plusdefilm">+ De FILM</button>
          </div>
        </form>
      </div>

    </div> <!-- Div CHOIXCHOIX -->
  </div> <!-- Div row -->
</div> <!-- Div container -->
<!-- Notes -->

<?php include 'include/footer.php'; ?>
