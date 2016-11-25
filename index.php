<?php include ('include/pdo.php'); ?>
<?php include ('include/functions.php'); ?>
<?php

$sql = "SELECT id FROM `movies_full`
        ORDER BY RAND()
        LIMIT 5";
  $query = $pdo->prepare($sql);
  $query->execute();
  $randomId = $query->fetchAll();

 ?>
<?php include ('include/header.php'); ?>


<div class="choix col-lg-12">
<div class="choixchoix col-lg-6 col-lg-offset-3">

<div class ="categories col-lg-4">
  <div class="btn-group">
  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Catégories <span class="caret"></span>
  </button>
    <ul class="dropdown-menu">
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
    </ul>
  </div>
</div>

<div class="annees col-lg-4">
  <div class="btn-group">
    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Années <span class="caret"></span>
    </button>
      <ul class="dropdown-menu">
        <li><a href="#">2016</a></li>
        <li><a href="#">2015</a></li>
        <li><a href="#">2014</a></li>
      </ul>
  </div>
</div>

<div class="classement col-lg-4">

    <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Catégories <span class="caret"></span>
    </button>
      <ul class="dropdown-menu">
    <label><input type="checkbox" value="">
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
    </label>


    <label><input type="checkbox" value="">
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
    </label>


    <label><input type="checkbox" value="">
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
    </label>


    <label><input type="checkbox" value="">
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star-o" aria-hidden="true"></i>
    </label>


    <label><input type="checkbox" value="">
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
      <i class="fa fa-star" aria-hidden="true"></i>
    </label>
  </div>

</div>

</div> <!-- Div CHOIXCHOIX -->
</div> <!-- Div CHOIX -->
<!-- Notes -->

<div class="col-lg-8 col-lg-offset-2 films" style="text-align : center">
  <?php foreach ($randomId as $key): ?>
    <img src="posters/<?php echo $key['id'] ?>.jpg" alt="">
  <?php endforeach; ?>
</div>


<div class="boutonrandom col-lg-12" style="text-align : center">
  <button type="button" class="btn btn-success">
    + De FILM <span class="caret"></span>
  </button>
</div>





<?php include ('include/footer.php'); ?>
