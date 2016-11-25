<?php include 'include/pdo_local.php' ?>
<?php include 'include/functions.php' ?>

<?php
$error = array();
$success = false;
// verif si submit_form cliqué:

if(!empty($_POST['submit'])) {
 //secure XSS $_POST
 $pseudo = trim(strip_tags($_POST['pseudo']));
 $email = trim(strip_tags($_POST['email']));
 $password = trim(strip_tags($_POST['password']));
 $repeat = trim(strip_tags($_POST['repeat']));

    if(!empty($pseudo)){
      if(strlen($pseudo)<3) {
     $error['pseudo'] = 'est trop court. (min 3 caractères)';
      }
    if(strlen($pseudo)>50) {
     $error['pseudo'] = 'est trop long. (max 50 caractères)';
    } else {
     $get_pseudo = "SELECT pseudo FROM users WHERE pseudo=:pseudo";
     $query = $pdo->prepare($get_pseudo);
     // protection injections sql
     $query -> bindValue(':pseudo' , $pseudo, PDO::PARAM_STR);
     // execute la fonction
     $query -> execute();
     $doublon_pseudo = $query->fetch();

      if(!empty($doublon_pseudo)){
       $error['pseudo'] = 'pseudo non-disponible';
      }
    }
  } else {
   $error['pseudo'] = 'doit être renseigné.';
  }

  if(!empty($email)) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      if(strlen($email)<8) {
       $error['email'] = 'est trop court. (min 8 caractères)';
      }
      if(strlen($email)>50) {
       $error['email'] = 'est trop long. (max 50 caractères)';
      } else {
       $get_email = "SELECT email FROM users WHERE email=:email";
       $query = $pdo->prepare($get_email);
       // protection injections sql
       $query -> bindValue(':email' , $email, PDO::PARAM_STR);
       // execute la fonction
       $query -> execute();
       $doublon_mail = $query->fetch();

        if(!empty($doublon_mail)){
         $error['doublon_mail'] = 'adresse mail non-disponible';
        }
      }
    } else {
     $error['email'] = 'semble erronée.';
    }

  } else {
   $error['email'] = 'doit être renseignée.';
  }

  if(!empty($password)){
    if(strlen($password)<3) {
      $error['password'] = 'est trop court. (min 3 caractères)';
    }
    if(strlen($password)>50) {
     $error['password'] = 'est trop long. (max 50 caractères)';
    }
  } else {
   $error['password'] = 'doit être renseigné.';
  }

  if(!empty($repeat)) {
    if($repeat!==$password) {
     $error['repeat'] = 'Les 2 mots de passe doivent être identiques !.';
    }
  } else {
   $error['repeat'] = 'doit être renseigné.';
  }

  if(count($error) == 0) {
   $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
   $token = generateRandomString(50);

   $inscription = "INSERT INTO users (pseudo, email, password, token, createdat, status) VALUES(:pseudo, :email, :password, :token, NOW(), 'user')";
   //preparation de la requete
   $query = $pdo->prepare($inscription);
   // protection des inj sql
   $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
   $query->bindValue(':email', $email, PDO::PARAM_STR);
   $query->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
   $query->bindValue(':token', $token, PDO::PARAM_STR);
   $query->execute();

   $success = true;
  }
}

?>

<?php include 'include/header.php' ?>

<div class="container">
  <div class="success" id="reponse_forminscription"></div>
  <form id="inscription" class="inscriptionAjax.php" action="" method="POST">
    <h1>Inscription</h1>

    <label for="pseudo">Pseudo :</label><br>
    <input type="text" name="pseudo" value="<?php if (!empty($_POST['pseudo'])) { echo ($_POST['pseudo']); } ?>"><br>
    <span class="error"><?php if (!empty($error['pseudo'])) { echo ($error['pseudo']); } ?></span><br>

    <label for="email">E-mail :</label><br>
    <input type="email" name="email" value="<?php if (!empty($_POST['email'])) { echo ($_POST['email']); } ?>"><br>
    <span class="error"><?php if (!empty($error['email'])) { echo ($error['email']); } ?></span><br>

    <label for="password">Mot de passe :</label><br>
    <input type="password" name="password" value="<?php if (!empty($_POST['password'])) { echo ($_POST['password']); } ?>"><br>
    <span class="error"><?php if (!empty($error['password'])) { echo ($error['password']); } ?></span><br>

    <label for="repeat">Repetez votre mot de passe :</label><br>
    <input type="password" name="repeat" value="<?php if (!empty($_POST['repeat'])) { echo ($_POST['repeat']); } ?>"><br>
    <span class="error"><?php if (!empty($error['repeat'])) { echo ($error['repeat']); } ?></span><br>

    <input type="submit" name="submit" value="Créer !">
  </form>
</div>

<?php include 'include/footer.php'; ?>
