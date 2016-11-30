
<?php require('include/pdo.php') ?>
<?php require('include/functions.php'); ?>

<?php session_start() ?>
<?php
  $sql ='SELECT id FROM users WHERE 1=1';

  $query = $pdo->prepare($sql);
  $query->execute();
  $users = $query->fetchAll();

  $sql ='SELECT id FROM movies_full WHERE 1=1';

  $query = $pdo->prepare($sql);
  $query->execute();
  $movies = $query->fetchAll();

  $sql ='SELECT pseudo FROM users ORDER BY createdat DESC';

  $query = $pdo->prepare($sql);
  $query->execute();
  $user = $query->fetch();

 ?>
  <?php if (isAdmin()) { ?>
  <?php require('include/header_back.php') ?>
  <div>
    <nav class="container-fluid">
    <div class="row">

     <span class="alert alert-success col-md-3" role="alert">Nombres d'utilisateurs : <?php echo count($users); ?></span>

     <span class="alert alert-success col-md-3" role="alert">Dernier inscrit : <?php echo $user['pseudo']; ?></span>
   </div>
   <div class="row">
     <span class="alert alert-success col-md-3" role="alert">Nombres de films: <?php echo count($movies); ?></span>
   </div>
 </nav>
</div>
<?php require('include/footer.php') ?>

<?php } else { echo 'Vous n\'etes pas autorisé à acceder a cette putain de page !'; } ?>
