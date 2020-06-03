<?php
if (!isset($_REQUEST['action'])) {
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch ($action) {
	case 'demandeConnexion': {
			include("vues/v_connexion.php");
			break;
		}
	case 'valideConnexion': {
			if ($_POST['Valider']) {
				$login = $_POST['login'];
				$mdp = $_POST['mdp'];
				$visiteur = $pdo->getInfosVisiteur($login, $mdp);

				if (!is_array($visiteur)) {
					header("Location:http://localhost/gsbMVC/index.php?uc=connexion&action=pasConnecter");
				} elseif (is_array($visiteur)) {
					$choix = "visiteur"; //pour la couleur de la page d'accueil

					$id = $visiteur['id'];
					$nom =  $visiteur['nom'];
					$prenom = $visiteur['prenom'];
					$pp = $visiteur['pp'];

					connecter($id, $nom, $prenom, $pp);

					header("Location:http://localhost/gsbMVC/index.php?uc=connexion&action=connecter");
				}
				break;
			}
		}
	case 'connecter': {
			include("vues/v_accueil.php");
			include("vues/v_pied.php");
			break;
		}
	case 'pasConnecter': {
			ajouterErreur("Login ou mot de passe incorrect");
			include("vues/v_erreurs.php");
			include("vues/v_connexion.php");
			break;
		}
	case 'insert': {

			$idVisiteur = 'z51';
			$nom = 'Sezille';
			$prenom = 'Lia';
			$login = 'lia';
			$mdp = 'ok';
			$adresse = '8 rue des lila';
			$cp = '21211';
			$ville = 'Londres';
			$dateEmbauche = '2001-07-21';
			$mdp = password_hash($mdp, PASSWORD_BCRYPT, ['cost' => 10]);



			echo $mdp;
			try {

				$donnees = [
					'id' => $idVisiteur,
					'nom' => $nom,
					'prenom' => $prenom,
					'login' => $login,
					'mdp' => $mdp,
					//Retourne la date actuelle pour moi (GMT+2)
					'adresse' => $adresse,
					'cp' => $cp,
					'ville' => $ville,
					'dateEmbauche' => $dateEmbauche,
				];
				//$pdo->Updatepasswordcrypte($idVisiteur,$nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche);
				$monPdo = new PDO($bdd, $user, $pass);
				$monPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$stmt = $monPdo->prepare(
					"INSERT INTO visiteur
					VALUES (
						:id,:nom,:prenom,:login,:mdp,:adresse,:cp,:ville,:dateEmbauche
				)"
				);


				$stmt->execute($donnees);

				echo "données mise à jour";
				echo $mdp;
				echo $idVisiteur;
			} catch (PDOException $e) {
				echo "Erreur : " . $e->getMessage();
			}
			break;
		}
	case 'update': {
			$mdp = $_POST['mdp'];
			$login = $_POST['login'];
			$mdp = password_hash($mdp, PASSWORD_BCRYPT, ['cost' => 10]);
			include("vues/v_sommaire.php");
			include("vues/v_accueil.php");
			include("vues/v_pied.php");

			try {
				echo $mdp;
				echo $login;
				$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass);
				$sql = $monPdo->prepare("UPDATE visiteur SET visiteur.mdp='$mdp' WHERE visiteur.login='$login'");
				$sql->execute();
				var_dump($sql);
				echo 'gg';
			} catch (PdoException $e) {
				echo "Erreur : " . $e->getMessage();
				var_dump($requete);
			}



			break;
		}
	case 'Information': {
			$id = $_SESSION['idVisiteur'];
			include("vues/v_sommaire.php");
			include("vues/v_pied.php");
			$profil = $pdo->getLesInfosProfil($id);

			$adresse = $profil["adresse"];

			include("vues/v_profil.php");
			break;
		}

	default: {
			include("vues/v_connexion.php");
			break;
		}
}
?>