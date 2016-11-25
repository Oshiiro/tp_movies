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



<div class="choixchoix col-lg-6 col-lg-offset-3">

<div class ="categories col-lg-4" >
      <h4> Catégories </h4>
      <br>
      <p> Action </p>
      <p> Action </p>
      <p> Action </p>
      <p> Action </p>
      <p> Action </p>
      <p> Action </p>
</div>

<div class ="annees col-lg-4" >
      <h4> Années </h4>
      <br>
      <p> 2016 </p>
      <p> 2010 </p>
      <p> 2000 </p>
      <p> 1990 </p>
      <p> 1980 </p>
      <p> 1970 </p>
</div>


    <div class="classement col-lg-4">
      <h4>Classement</h4>
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



</div> <!-- Div CHOIXCHOIX -->

<!-- Notes -->

<div class="col-lg-8 col-lg-offset-2 films" style="text-align : center">
  <h4>Téma ça mon srab</h4>
  <?php foreach ($randomId as $key): ?>
    <a href='single.php'><img src="posters/<?php echo $key['id'] ?>.jpg" alt=""></a>
  <?php endforeach; ?>
</div>

<div class="choix col-lg-12">
<div class="boutonrandom col-lg-12" style="text-align : center">
  <button type="button" class="btn btn-success">
    + De FILM
  </button>
</div>
</div>





<?php include ('include/footer.php'); ?>
