<?php include 'include/pdo_local.php'; ?>
<?php include 'include/functions.php'; ?>

<?php
$recherche = $_GET['s'];

if (!empty($_GET['s'])) {

 $sql = "SELECT * FROM articles
 WHERE title LIKE :search
 OR content LIKE :search
 OR auteur LIKE :search";

 $query = $pdo->prepare($sql);
 $query->bindValue(':search','%' . $recherche . '%', PDO::PARAM_STR);
 $query->execute();
 $articles = $query->fetchAll();


}
?>

<?php include 'include/header.php'; ?>

<!-- =======================================================================================
                                     ARTICLE
======================================================================================= -->
<?php if (!empty($_GET['s'])) { ?>
<article class="container article">
 <div class="row">
   <h1>Recherche : <?php echo $recherche ?></h1><br>
<?php   foreach ($articles as $article) { ?>
   <div class="col-sm-6 col-md-4">
     <div class="thumbnail">
       <div class="caption">
         <h3><?php echo $article['title']; ?></h3>
         <hr>
         <p><?php echo $article['content']; ?></p>
         <h4>Ecrit par : <?php echo $article['auteur']; ?></h4>
         <p>Publier le : <?php echo $article['created_at']; ?></p>
         <p>Modifier le : <?php echo $article['updated_at']; ?></p>
         <p class="lienSuite2"><a href="single.php?id=<?php echo $article['id']; ?>">Lire la suite ...</a></p>
       </div>
     </div>
   </div>
<?php   } ?>
 </div>
</article>
<div class="spacer"></div>
<?php } else { ?>
 <h1 class="search">Recherche introuvable</h1><br>
 <div class="status">
   <a href="index.php" class="btn btn-default">Retour</a>
 </div>
<?php   } ?>

<?php include ('include/footer.php'); ?>
