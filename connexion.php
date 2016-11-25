<?php include 'include/pdo.php' ?>
<?php include 'include/functions.php' ?>

<?php
$error = array();
$success = false;
// verif si submit_form cliqué:

if(!empty($_POST['submit'])) {
  // Faille XSS
  $login = trim(strip_tags($_POST['login']));
  $mdp = trim(strip_tags($_POST['mdp']));

  // VERIFICATION
  // LOGIN
  if(!empty($login)) {
    //pseudo
    $sql = "SELECT id FROM users WHERE pseudo = :pseudo";
    $query = $pdo->prepare($sql);
    // bind VALUES (protec injection SQL)
    $query->bindValue(':pseudo', $login, PDO::PARAM_STR);
    $query->execute();
    $verif1 = $query->fetch();

    //mail
    $sql = "SELECT id FROM users WHERE email = :email";
    $query = $pdo->prepare($sql);
    // bind VALUES (protec injection SQL)
    $query->bindValue(':email', $login, PDO::PARAM_STR);
    $query->execute();
    $verif2 = $query->fetch();

    if (!empty($verif1) || !empty($verif2)) {

    } else {
      $error['login'] = 'Aucun utilisateur correspondant a ce pseudo ou ce mail';
    }
  } else {
    $error['login'] = 'Ce champs doit etre rempli';
  }
  //MDP
  if(!empty($mdp)) {
    $sql = "SELECT * FROM users WHERE pseudo = :pseudo OR email = :pseudo";
    $query = $pdo->prepare($sql);
    // bind VALUES (protec injection SQL)
    $query->bindValue(':pseudo', $login, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    if (password_verify($mdp, $user['password'])) {
      $success = true;

      // creation de la session
      $_SESSION['user']=array(
        'pseudo' => $user['pseudo'],
        'id' => $user['id'],
        'status' => $user['status'],
        'ip' => $_SERVER['REMOTE_ADDR']
      );

      header('Location: index.php');
      exit();

    } else {
    $error['mdp'] = 'Mot de passe incorrect';
    }


  } else {
    $error['mdp'] = 'Ce champs doit etre rempli';
  }
}

 ?>

<?php include 'include/header.php' ?>

<div class="container">
  <div class="success" id="reponse_formconnexion"></div>
  <form id="connexion" class="connexion" action="" method="POST">
    <h1>Connexion</h1>

    <label for="login">Pseudo ou E-mail:</label><br>
    <input type="text" name="login" value="<?php if (!empty($_POST['login'])) { echo ($_POST['login']); } ?>"><br>
    <span class="error"><?php if (!empty($error['login'])) { echo ($error['login']); } ?></span><br>

    <label for="mdp">Mot de passe :</label><br>
    <input type="password" name="mdp" value="<?php if (!empty($_POST['mdp'])) { echo ($_POST['mdp']); } ?>"><br>
    <span class="error"><?php if (!empty($error['mdp'])) { echo ($error['mdp']); } ?></span><br>

    <input type="submit" name="submit" value="Se connecter !"><br>
    <a href="forgot.php">Mot de passe oublié ? (comme un con !)</a>

  </form>

</div>


<?php include 'include/footer.php'; ?>
