<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css" media="screen" title="no title">
    <link rel="stylesheet" href="css/font-awesome.css" media="screen" title="no title">
    <link rel="stylesheet" href="css/style_back.css" media="screen" title="no title">
    <title>Movies</title>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">

          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">BEST MOVIES EVER</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <?php if (isLogged()) { ?>
              <li><a class="noPointer">Bienvenue <?php echo $_SESSION['user']['pseudo']; ?></a></li>
              <?php } ?>
              <li> <a href="createfilm_back.php">AJOUTER UN FILM +</a></li>
              <li> <a href="affiche_back.php">LISTE FILM</a></li>
              <li> <a href="statistiques_back.php">STATISTIQUE</a></li>
              <li> <a href="index.php">FRONT OFFICE</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-cogs" aria-hidden="true"></i>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <?php if (isLogged()) { ?>
                  <li><a href="deconnexion.php">Deconnexion</a></li>
                  <?php } else { ?>
                  <li><a href="connexion.php">Connexion</a></li>
                  <li><a href="inscription.php">Inscription</a></li>
                  <?php } ?>
                </ul>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>
