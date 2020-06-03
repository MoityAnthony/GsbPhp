    <!-- Division pour le sommaire -->
    <div class="sommaire">
    	<div class="main_menu">
    		<nav class="navbar navbar-expand-lg navbar-light">
    			<div class="container">
    				<!-- Brand and toggle get grouped for better mobile display -->

    				<!-- Collect the nav links, forms, and other content for toggling -->
    				<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
    					<ul class="nav navbar-nav menu_nav">
    						<li class="nav-item"><a class="nav-link" href="index.php?uc=profil&action=Information"><img src="<?php echo $_SESSION['pp']; ?>" /></a></li>
    						<li class="nav-item"><a id="accueil" class="nav-link" href="index.php?uc=connexion&action=connecter" title="Accueil">Accueil</a></li>
    						<li class="nav-item"><a class="nav-link" href="index.php?uc=gererFrais&action=saisirFrais" title="Saisie fiche de frais">Saisie fiche de frais</a></li>
    						<li class="nav-item"><a class="nav-link" href="index.php?uc=etatFrais&action=selectionnerMois" title="Consultation de mes fiches de frais">Mes fiches de frais</a></li>
    						<li class="nav-item"><a class="nav-link" href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a></li>
    					</ul>
    				</div>
    			</div>
    		</nav>
    	</div>
    </div>
    </section>