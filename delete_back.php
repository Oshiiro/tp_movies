<?php
include('include/pdo.php');
include('include/fonction.php');

if(!empty($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "SELECT * FROM movies_full WHERE id = :id";
  $query = $pdo->prepare($sql);
  $query->bindValue(':id', $id, PDO::PARAM_INT);
  $query->execute();

  $movie = $query->fetch();

  if(!empty($movie)) {

    $sql = "DELETE FROM movies_full WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
  }
}

header('Location: affiche_back.php');
