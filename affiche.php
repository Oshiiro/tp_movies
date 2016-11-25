<?php require('include/pdo.php') ?>
<?php require('include/header_back.php') ?>
<?php
$sql ='SELECT * FROM movies_full';

$query = $pdo->prepare($sql);
$query->execute();
$movies = $query->fetchAll();

 ?>

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
       </tr>
       <?php } ?>
   </table>




 <?php require('include/footer.php') ?>
