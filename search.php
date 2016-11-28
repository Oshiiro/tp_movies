<?php include ('include/pdo.php'); ?>
<?php include ('include/functions.php'); ?>
<?php
$recherche = $_GET['searching'];

if(!empty($_GET['buttonrecherche2'])) {
  debug($_GET);
  die();
}

if (!empty($recherche)) {
  $sql = "SELECT * FROM movies_full
          WHERE title LIKE :search
          OR slug LIKE :search
          -- AND genre LIKE :search
          OR year LIKE :search
          OR directors LIKE :search
          OR cast like :search
          OR writers like :search
          OR plot like :search";

  $query = $pdo->prepare($sql);
  $query->bindValue(':search','%' . $recherche . '%', PDO::PARAM_STR);
  $query->execute();
  $resultSearch = $query->fetchAll();

  debug($resultSearch);
}


 ?>
<?php include ('include/header.php'); ?>







<?php include 'include/footer.php'; ?>
