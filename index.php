<?php
session_start();
require_once("include/fct.inc.php");
require_once ("include/class.pdogsb.inc.php");
$pdo = PdoGsb::getPdoGsb();
include("vues/v_entete.php");
$estConnecte = estConnecte();
if(!isset($_REQUEST['uc']) || !$estConnecte){
     $_REQUEST['uc'] = 'connexion';
}
$uc = $_REQUEST['uc'];
switch($uc){
	case 'connexion':{
		include("controleurs/c_connexion.php");break;
	}
	case 'gererFrais':{
		include("controleurs/c_gererFrais.php");break;
	}
	case 'etatFrais':{
		include("controleurs/c_etatFrais.php");break; 
	}
	case 'changement':{
		include("controleurs/c_changement.php");break;
	}
	case 'MDPoublier':{
		include("controleurs/c_MDPoublier.php");break;
	}
	case 'profil':{
		include("controleurs/c_profil.php");break;
	}
}
include("vues/v_pied.php") ;
?>

