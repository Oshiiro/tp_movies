<?php session_start() ?>

<?php require('include/pdo.php'); ?>
<?php require('include/functions.php'); ?>

<?php
$sql ='SELECT * FROM movies_full';

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
          <a href="modifier.php?id=<?php echo $movie['id']; ?>">
            <i class="fa fa-file" aria-hidden="true"></i>
          </a>
        </td>
      </tr>
    <?php } ?>
  </table>
 </div>




 <?php require('include/footer.php') ?>
