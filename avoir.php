<?php session_start() ?>

<?php include 'include/pdo.php'; ?>
<?php include 'include/functions.php'; ?>

<?php
$idSession = $_SESSION['user']['id'];
  // $id_movie = $aVoirs['idd'];
  $sql = "SELECT movies_full.id as idd, movies_full.title
          FROM movies_user_note
          LEFT JOIN movies_full ON movies_user_note.id_movie = movies_full.id
          LEFT JOIN users ON movies_user_note.id = users.id
          WHERE movies_user_note.status = 0 AND movies_user_note.id_user = :id_user";
  $query = $pdo->prepare($sql);
  $query->bindValue(':id_user', $idSession, PDO::PARAM_INT);
  $query->execute();
  $aVoirs = $query->fetchAll();


// Retirer le film si vu


// Afficher possibilité de NOTATION
?>

<?php require('include/header.php') ?>
<div class="container">
  <div class="row">
    <?php
    foreach ($aVoirs as $aVoir) { ?>
      <div class="col-md-12">
        <h4><?php echo $aVoir['title'] ?></h4>
        <?php if (file_exists('posters/' .$aVoir['idd']. '.jpg')) {
          echo '<img src="posters/' .$aVoir['idd']. '.jpg" alt=""/>';
        } else {
          echo '<img src="http://placehold.it/205x300" title="' .$aVoir['title']. '">';
        }
        ?>
        <div class="infofilm col-md-12">
          <form class ="class" method ="POST" action="delete.php">
            <button class="btn notefilm"><a href="delete.php?id=<?php echo $aVoir['idd'] ?>" class"vu">Vu</a></button>
            <button type="button" name="button" class ="btn notefilm">Note ce film !</button>
            <!-- Systeme de notation -->
          </form>
          <p> Votre note </p>
          <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="70"
            aria-valuemin="0" aria-valuemax="100" style="width:70%">

            </div>
          </div>

          <select class="form-control">
            <?php
            $j = 2;
            echo "<br/>";
            for ($i=0;$i<=100;$i++){

            echo "<option>" . $i . "</option>";
            echo "<br/>";

            }
            ?>
          </select>

          </div>

      </div>
      <button class="btn btn-warning"><a href="index.php">Retour à l'index</a></button>
      <?php } ?>
    </div>
  </div>
</div>

<?php require('include/footer.php') ?>
