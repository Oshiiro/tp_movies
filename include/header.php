<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.css" media="screen" title="no title">
    <link rel="stylesheet" href="css/font-awesome.css" media="screen" title="no title">
    <link rel="stylesheet" href="css/style.css" media="screen" title="no title">
    <title>BEST MOVIES EVER</title>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-default">
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

            <!-- <form class="navbar-form navbar-left" method="GET" action="search.php">
              <div class="form-group">
                <input type="text" class="form-control" name="searching" placeholder="Trouver un film">
              </div>
              <button type="submit" class="btn btn-default">Recherche</button>

            </form> -->
            <ul class="nav navbar-nav navbar-right">
              <?php if (isLogged()) { ?>
              <li><a class="noPointer">Bienvenue <?php echo $_SESSION['user']['pseudo']; ?></a></li>
              <?php } ?>
              <?php if (isLogged()) {
                echo '<li><a href="avoir.php">FILMS A VOIR !</a></li>';
                echo '<li><a href="filmsvu.php">FILMS VUS !</a></li>';
              } ?>
              <li> <a href="affiche.php">BACK OFFICE</a></li>
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
