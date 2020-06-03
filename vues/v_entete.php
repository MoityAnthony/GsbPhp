<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
  <title>Intranet du Laboratoire Galaxy-Swiss Bourdin</title>
  <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./styles/css/bootstrap.css">
  <link rel="stylesheet" href="./styles/vendors/linericon/style.css">
  <link rel="stylesheet" href="./styles/css/font-awesome.min.css">
  <link rel="stylesheet" href="./styles/vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="./styles/vendors/lightbox/simpleLightbox.css">
  <link rel="stylesheet" href="./styles/vendors/nice-select/css/nice-select.css">
  <link rel="stylesheet" href="./styles/vendors/animate-css/animate.css">
  <!-- main css -->
  <link rel="stylesheet" href="./styles/css/style.css">
</head>

<body class="home_banner_area">
  <header>
    <div class="col-md-12">
      <div class="entete">
        <?php
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        if ($url != 'http://localhost/gsbMVC/index.php' && $url != 'http://localhost/gsbMVC/index.php?uc=connexion&action=deconnexion' && $url != "http://localhost/gsbMVC/index.php?uc=connexion&action=pasConnecter" && $url != 'http://localhost/gsbMVC/index.php?uc=MDPoublier&action=id' && $url != 'http://localhost/gsbMVC/index.php?uc=MDPoublier&action=changeMDP' && $url != 'http://localhost/gsbMVC/index.php?uc=MDPoublier&action=Maj') {
          $h1 = "Suivi du remboursement des frais";
        } elseif ($url = 'http://localhost/gsbMVC/index.php' && $url = 'http://localhost/gsbMVC/index.php?uc=connexion&action=deconnexion' && $url = "http://localhost/gsbMVC/index.php?uc=connexion&action=pasConnecter" && $url != 'http://localhost/gsbMVC/index.php?uc=MDPoublier&action=id' && $url != 'http://localhost/gsbMVC/index.php?uc=MDPoublier&action=changeMDP' && $url != 'http://localhost/gsbMVC/index.php?uc=MDPoublier&action=Maj') {
          $h1 = "Connexion";
        } elseif ($url = "http://localhost/gsbMVC/index.php?uc=MDPoublier&action=id" && $url = "http://localhost/gsbMVC/index.php?uc=MDPoublier&action=changeMDP" && $url = "http://localhost/gsbMVC/index.php?uc=MDPoublier&action=Maj") {
          $h1 = "Mot de passe oublier";
        }

        ?>
        <div class="col-md-10">
          <h1><?php echo $h1; ?></h1>
        </div>
        <div class="col-md-2">
          <img src="./images/logo.png" id="logoGSB" alt="Laboratoire Galaxy-Swiss Bourdin" title="Laboratoire Galaxy-Swiss Bourdin" />
        </div>
      </div>
    </div>
    <?php
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if ($url != 'http://localhost/gsbMVC/index.php' && $url != 'http://localhost/gsbMVC/index.php?' && $url != 'http://localhost/gsbMVC/index.php?uc=connexion&action=deconnexion' && $url != 'http://localhost/gsbMVC/index.php?uc=connexion&action=pasConnecter' && $url != 'http://localhost/gsbMVC/index.php?uc=connexion&action=valideConnexion' && $url != 'http://localhost/gsbMVC/index.php?uc=MDPoublier&action=id' && $url != 'http://localhost/gsbMVC/index.php?uc=MDPoublier&action=changeMDP'  && $url != 'http://localhost/gsbMVC/index.php?uc=MDPoublier&action=Maj') {
      include("v_sommaire.php");
    }
    ?>
  </header>
  <section>