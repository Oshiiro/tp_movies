<?php session_start() ?>

<?php require('include/pdo.php'); ?>
<?php require('include/functions.php'); ?>

<?php
// =======================================================================================
//                                      PAGINATION
// =======================================================================================
// Nombre d'idée par page
$num = 50;
// Numéro de page
$page = 1;
// Offset par défaut
$offset = 0;

// Requête pour compter le nombre d'idée dans la table
$sql = 'SELECT COUNT(id) FROM movies_full';
$query = $pdo->prepare($sql);
$query->execute();
$count = $query->fetchColumn(); // $count = nombre d'idée dans la table

if (!empty($_GET['page'])) {
  $page = trim(strip_tags($_GET['page']));
  $offset = ($page-1)*$num;}



// LA LIMITE DE 20 EST A VIREE
$sql ="SELECT * FROM movies_full
       ORDER BY created DESC
       LIMIT $offset, $num";

$query = $pdo->prepare($sql);
$query->execute();
$movies = $query->fetchAll();

 ?>
 <?php if (isAdmin()) { ?>

 <?php require('include/header_back.php'); ?>

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

<?php paginationArticle($page, $num, $count); ?>

<?php require('include/footer.php') ?>

<?php } else { echo 'Vous n\'etes pas autorisé à acceder a cette putain de page !'; } ?>
