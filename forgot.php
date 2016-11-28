<?php session_start(); ?>
<?php require_once __DIR__.'/vendor/autoload.php'; ?>
<?php include 'include/pdo.php'; ?>
<?php include 'include/functions.php'; ?>
<?php include 'include/header.php'; ?>



<?php
$error=array();
$success = false;

if(!empty($_POST['submit'])) {

  $email = trim(strip_tags($_POST['email']));

//  VERIFICATION DU MAIL
//  Si non vide,
    if(!empty($email)) {
      //  Requiete, select de la BDD
      $sql = "SELECT * FROM users
      WHERE email = :email";

      $sq = $pdo->prepare($sql);
      $sq->bindValue(':email', $email, PDO::PARAM_STR);
      $sq->execute();
      $user = $sq->fetch();

      if(!empty($user)) {

          $body = $email . '<p>Afin de récuperer votre mot de passe,</p><a href="http://127.0.0.1/tp_movies/modifmdp.php?email='.$email.'&token='.$user['token'].'"> Cliquer ici</a>';
          $mail = new PHPMailer();
          $mail->isMail();
          $mail->setFrom('from@example.com', 'Mailer');
          $mail->addAddress($email);

          $mail->Subject = 'Recupération de mot de passe';
          $mail->Body = $body;

          if(!$mail->send()) {
            echo ' Message couldnt been send';
          } else {
            $success = true;
          }

      } else {
          $error['email']  ='Adresse mail inconnue';
        }

   } else {
       $error['email'] = 'Veuillez renseigner votre e-mail!';
     }

debug($user);

 } // Submit
?>

<?php if($success == true) { ?>

  <p class="emailenvoyer">
    Votre e-mail a bien été envoyé à l'adresse :<?php echo $email ?>
  </p>

<?php
}
else { ?>
  <br><br>

<div class="container center col-lg-4 col-lg-offset-4">
   <form action="" method="post">
     <h4> MOT DE PASSE OUBLIE </h4>
       <p> Un e-mail va vous être renvoyer afin de réinitialiser votre mot de passe</p>
       <label for="exampleInputEmail1">Votre email*</label>
       <?php if(!empty($error['email'])) { echo $error['email'];} ?>
       <input type="text" class="form-control" name="email" placeholder="Email">
     <input type="submit" name ="submit" class="btn btn-default submitLostMdp"></input>
   </form>

 </div>

<?php } ?>



<?php include 'include/footer.php'; ?>
