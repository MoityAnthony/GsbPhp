<?php
$id = $_SESSION['idVisiteur'];
$mois = getMois(date("d/m/Y"));
$numAnnee =substr($mois,0,4);
$numMois =substr($mois,4,2);
$action = $_REQUEST['action'];
switch($action){
	case 'saisirFrais':{
		if($pdo->estPremierFraisMois($id,$mois)){
			$pdo->creeNouvellesLignesFrais($id,$mois);
		}
		break;
	}
	case 'validerMajFraisForfait':{
		$lesFrais = $_POST['lesFrais'];
		if(lesQteFraisValides($lesFrais)){
	  	 	$pdo->majFraisForfait($id,$mois,$lesFrais);
		}
		else{
			ajouterErreur("Les valeurs des frais doivent être numériques");
			include("vues/v_erreurs.php");
		}
	  break;
	}
	case 'validerCreationFrais':{
		$date = $_POST['dateFrais'];
		$libelle = $_POST['libelle'];
		$montant = $_POST['montant'];
		$dateFrais = implode('-', explode('-',$date));
		echo $dateFrais;
		valideInfosFrais($dateFrais,$libelle,$montant);
		if (nbErreurs() != 0 ){
			include("vues/v_erreurs.php");
		}
		else{
			try{
				$pdo->creeNouveauFraisHorsForfait($id,$mois,$libelle,$dateFrais,$montant);
			}
			catch(PDOException $e){
				echo "Erreur : " . $e->getMessage();
			}
		}
		break;
	}
	case 'supprimerFrais':{
		$idFrais = $_POST['idFrais'];
	    $pdo->supprimerFraisHorsForfait($idFrais);
		break;
	}
}
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($id,$mois);
$lesFraisForfait= $pdo->getLesFraisForfait($id,$mois);
include("vues/v_listeFraisForfait.php");
include("vues/v_listeFraisHorsForfait.php");
