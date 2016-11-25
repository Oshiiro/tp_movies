<?php include ('include/pdo.php'); ?>
<?php include ('include/functions.php'); ?>
<?php

$sql = "SELECT id FROM `movies_full`
        ORDER BY RAND()
        LIMIT 5";
  $query = $pdo->prepare($sql);
  $query->execute();
  $randomId = $query->fetchAll();

debug($randomId);
 ?>
<?php include ('include/header.php'); ?>


<div class="choix col-lg-6">
<div class ="categories col-lg-4">
  <h2> Catégories </h2>
  <div class="checkbox">
    <label><input type="checkbox" value="">Option 1</label>
  </div>
  <div class="checkbox">
    <label><input type="checkbox" value="">Option 2</label>
  </div>
  <div class="checkbox">
    <label><input type="checkbox" value="">Option 2</label>
  </div>
  <div class="checkbox">
    <label><input type="checkbox" value="">Option 2</label>
  </div>
  <div class="checkbox">
    <label><input type="checkbox" value="">Option 2</label>
  </div>
  <div class="checkbox">
    <label><input type="checkbox" value="">Option 2</label>
  </div>
  <div class="checkbox disabled">
    <label><input type="checkbox" value="" disabled>Option 3</label>
  </div>
</div>

<div class="annees col-lg-4">
  <h2>Années</h2>
    <li>2016</li>
</div>


<div class="classement col-lg-4">
  <h2>Classement</h2>
  <div class="checkbox">
    <label><input type="checkbox" value="">
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
    </label>
  </div>
  <div class="checkbox">
    <label><input type="checkbox" value="">
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
    </label>
  </div>
  <div class="checkbox">
    <label><input type="checkbox" value="">
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
    </label>
  </div>
  <div class="checkbox">
    <label><input type="checkbox" value="">
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
    </label>
  </div>
  <div class="checkbox">
    <label><input type="checkbox" value="">
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
    </label>
  </div>
</div>
</div> <!-- Div CHOIX -->
<!-- Notes -->


<div class="col-lg-6 col-lg-offset-3">
  <h1>Nous vous proposons ...</h1>
</div>
<div class="col-lg-10 col-lg-offset-1">
  <?php foreach ($randomId as $key): ?>
    <img src="posters/<?php echo $key['id'] ?>.jpg" alt="">
  <?php endforeach; ?>
<button type="button" name="button">+ de films !</button>
</div>





<?php include ('include/footer.php'); ?>
