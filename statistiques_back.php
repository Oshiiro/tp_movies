
<?php require('include/pdo.php') ?>
<?php require('include/functions.php'); ?>
<?php require('include/header_back.php') ?>

<?php session_start() ?>
<?php


 ?>
 <div>
 <nav class="container-fluid">
   <div class="row">
     <span class="alert alert-success col-md-3" role="alert">Nombres d'utilisateurs : <?php  ?></span>
     <span class="alert alert-success col-md-3" role="alert">Dernier inscrit : <?php  ?></span>
   </div>
   <div class="row">
     <span class="alert alert-success col-md-3" role="alert">Nombres de films: <?php  ?></span>
   </div>
 </nav>
</div>
<?php require('include/footer.php') ?>
