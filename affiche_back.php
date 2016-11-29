<?php session_start() ?>

<?php require('include/pdo.php'); ?>
<?php require('include/functions.php'); ?>

<?php
// LA LIMITE DE 20 EST A VIREE
$sql ='SELECT * FROM movies_full LIMIT 20';

$query = $pdo->prepare($sql);
$query->execute();
$movies = $query->fetchAll();

 ?>
 <?php require('include/header_back.php'); ?>
 <div class="">
  <table class="container">
     <tr>
       <th>Id</th>
       <th>title</th>
       <th>Year</th>
       <th>Rating</th>
       <th>Action</th>
     </tr>
  <?php foreach ($movies as $movie){ ?>
       <tr>
         <td><?php echo $movie['id']; ?></td>
         <td><?php echo $movie['title']; ?></td>
         <td><?php echo $movie['year']; ?></td>
         <td><?php echo $movie['rating']; ?></td>
         <td>
          <a href="single.php?slug=<?php echo $movie['slug']; ?>" title="Voir">
           <i class="fa fa-file" aria-hidden="true"></i>
         </a>
          <a href="modifier_back.php?id=<?php echo $movie['id']; ?>" title="Editer">
            <i class="fa fa-pencil" aria-hidden="true"></i>
          </a>
          <a class="suppr" onclick="return confirm('Supprimer ?');" href="delete_back.php?id=<?php echo $movie['id']; ?>" title="Supprimer">
            <i class="fa fa-close" aria-hidden="true"></i>
          </a>
        </td>
      </tr>
    <?php } ?>
  </table>
 </div>




 <?php require('include/footer.php') ?>
