
<?php include ('include/functions.php'); ?>
<?php include ('include/pdo.php'); ?>
<?php include ('include/header.php'); ?>

<?php
$error = array();
$success = false;
$motdepassechanger = false;

// ================= VERIFICATION DANS LIEN URL DES DONNEES =====================

// Vérifier que l'email et le token sont bien dans le lien
if(!empty($_GET['email']) && ($_GET['token'])) {

// On les strip tags
$email = trim(strip_tags($_GET['email']));
$token = trim(strip_tags($_GET['token']));


    // requete sql pour afficher les users
    $sql = "SELECT * FROM users
    WHERE email = :email AND token = :token";

    $sq = $pdo->prepare($sql);
    $sq->bindValue(':email', $email, PDO::PARAM_STR);
    $sq->bindValue(':token', $token, PDO::PARAM_STR);
    $sq->execute();
    $user = $sq->fetch();

      // Si le token et l'email correspondent à un user alors afficher le formulaire pour mdr
        if(!empty($user)) {

          $success = true ;

        } else {
            $error['mail'] = 'Une erreur est survenue!';
          }
} else {
    $error['email'] = 'Une erreur est survenue!';
  }

// =================== VERIFICATION DES MOTS DE PASSE =========================
  if(!empty($_POST['submit'])) {

    $password1 = trim(strip_tags($_POST['password1']));
    $password2 = trim(strip_tags($_POST['password2']));


        if(!empty($password1 && $password2))
        {
          if(strlen($password1) < 5) {
            $error['password1'] = "Mot de passe trop court!";
          }
          else if (strlen($password1) > 25) {
            $error['password1'] = "Mot de passe trop long!";
          }
          else if ($password2 !== $password1) {
            $error["password1"] = "Mots de passe différents!";
          }
        } else {
          $error['password1'] = "Veuillez renseigner un mot de passe et le répeter!";
        }

// =========== SI AUCUNE ERREUR ET QUE L'URL EST BIEN EGAL A LA BDD ============

  if (count($error) == 0) {
    if(!empty($user)) {
      if(!empty($_GET['email']) && !empty($_GET['token'])) {

          // Password crypté
          $password_hashed = password_hash($password1, PASSWORD_BCRYPT);

          // générer token, random (dans functions)
          $token = generateRandomString(20);

            $sql = "UPDATE users SET password = :password,
            token = :token
            WHERE email = :email";

            $sq = $pdo->prepare($sql);
            $sq->bindValue(':email', $email, PDO::PARAM_STR);
            $sq->bindValue(':password', $password_hashed, PDO::PARAM_STR);
            $sq->bindValue(':token', $token, PDO::PARAM_INT);
            $sq->execute();

            $motdepassechanger == true;


      } else { echo 'une erreur est survenue';}
    } else { echo 'une erreur est survenue';}
  }  else { echo 'une erreur est survenue';}

}
?>

<!-- ========================================================================= -->
 <!-- ==================== AFFICHAGE DU FORMULAIRE POUR MDP ================== -->
<?php if($success == true) {
  if($motdepassechanger == false) { ?>
<form class="col-lg-4 col-lg-offset-4" action="" method="post">
  <br><br>
  <h4>ENTRER VOTRE NOUVEAU MOT DE PASSE</h4>
  <div class="form-group">
    <label for="password1">Password*</label>
    <?php if(!empty($error['password1'])) { echo $error['password1'];} ?>
    <input type="password" name ="password1" class="form-control"  value="<?php if(!empty($error['password1'])) { echo $_POST['password1'];} ?>">
  </div>
  <div class="form-group">
    <label for="password2">Repeat password*</label>
    <input type="password" name="password2" class="form-control"  value="">
  </div>

  <input type="submit" name="submit" class="btn btn-default" value="Modifier MDP"></input>
</form>
<?php }
 } else {
 echo '<h4>Mot de passe modifié<br><a href="connexion.php" >Se connecter</a></h4><br>';
}
?>





<?php include ('include/footer.php'); ?>
