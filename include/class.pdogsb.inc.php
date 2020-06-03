<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb{   		
      	public static $bdd='mysql:dbname=gsbMVC;host=localhost';
      	public static $user='root';
      	public static $pass='' ;
		public static $monPdo;
		public static $monPdoGsb=null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	public function __construct(){
		try{
			$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$monPdo->query("SET CHARACTER SET utf8");
		}
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
		}
    	
	}
	public function _destruct(){
		$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
 * @return l'unique objet de la classe PdoGsb
 */
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;  
	}
/**
 * Retourne les informations d'un visiteur
 
 * @param $login 
 * @param $mdp
 * @return l'id, le nom et le prénom sous la forme d'un tableau associatif 
*/
	public function getInfosVisiteur($login, $mdp){

		$String='';
		$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		$hash = $monPdo->query("SELECT mdp FROM visiteur where visiteur.login='$login'")->fetch();
		$String .= $hash[0];
		if(password_verify($mdp,$String)){
			try{
			$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$req = $monPdo->query("SELECT visiteur.id as id, visiteur.nom as nom, visiteur.prenom as prenom, visiteur.login, visiteur.mdp, visiteur.pp as pp 
			from visiteur 
			where visiteur.login='$login' and visiteur.mdp='$String'")->fetch();
			return $req;
		}
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
		}
		} 
		else {
			echo 'ERREUR';	

		}
		
		
	}

/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
 * concernées par les deux arguments
 
 * La boucle foreach ne peut être utilisée ici car on procède
 * à une modification de la structure itérée - transformation du champ date-
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif 
*/
	public function getLesFraisHorsForfait($idVisiteur,$mois){
		try{
			$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	    	$req = $monPdo->query("SELECT * from lignefraishorsforfait where lignefraishorsforfait.idvisiteur ='$idVisiteur' 
			and lignefraishorsforfait.mois = '$mois' ")->fetchAll();
			$nbLignes = count($req);
			for ($i=0; $i<$nbLignes; $i++){
				$date = $req[$i]['date'];
				$req[$i]['date'] =  dateAnglaisVersFrancais($date);
			}
			return $req; 
		}
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
		}
		
	}
/**
 * Retourne le nombre de justificatif d'un visiteur pour un mois donné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return le nombre entier de justificatifs 
*/
	public function getNbjustificatifs($idVisiteur, $mois){
		try{
			$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$req = "select fichefrais.nbjustificatifs as nb from  fichefrais where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
			$res = $monPdo->query($req);
			$laLigne = $res->fetch();
			return $laLigne['nb'];
		}
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
		}		
	}
/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
 * concernées par les deux arguments
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif 
*/
	public function getLesFraisForfait($idVisiteur, $mois){
		try{
			$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$req = "SELECT fraisforfait.id as idfrais, fraisforfait.libelle as libelle, 
			lignefraisforfait.quantite as quantite from lignefraisforfait inner join fraisforfait 
			on fraisforfait.id = lignefraisforfait.idfraisforfait
			where lignefraisforfait.idvisiteur ='$idVisiteur' and lignefraisforfait.mois='$mois' 
			order by lignefraisforfait.idfraisforfait";	
			$res = $monPdo->query($req);
			$lesLignes = $res->fetchAll();
			return $lesLignes; 
		}
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
		}
		
	}
/**
 * Retourne tous les id de la table FraisForfait
 
 * @return un tableau associatif 
*/
	public function getLesIdFrais(){
		try{
			$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$req = "SELECT fraisforfait.id as idfrais from fraisforfait order by fraisforfait.id";
			$res = $monPdo->query($req);
			$lesLignes = $res->fetchAll();
			return $lesLignes;
		}
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
		}
	}
/**
 * Met à jour la table ligneFraisForfait
 
 * Met à jour la table ligneFraisForfait pour un visiteur et
 * un mois donné en enregistrant les nouveaux montants
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
 * @return un tableau associatif 
*/
	public function majFraisForfait($idVisiteur, $mois, $lesFrais){
		try{
		$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		$lesCles = array_keys($lesFrais);
		
		foreach($lesCles as $unIdFrais){
			$qte = $lesFrais[$unIdFrais];
			$req = "UPDATE lignefraisforfait set lignefraisforfait.quantite = $qte
			where lignefraisforfait.idvisiteur = '$idVisiteur' and lignefraisforfait.mois = '$mois'
			and lignefraisforfait.idfraisforfait = '$unIdFrais'";
			$monPdo->exec($req);
			}
		}
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
		}
	}
/**
 * met à jour le nombre de justificatifs de la table ficheFrais
 * pour le mois et le visiteur concerné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
*/
	public function majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs){
		try{
			$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$req = "UPDATE fichefrais set nbjustificatifs = $nbJustificatifs 
			where fichefrais.idvisiteur = '$idVisiteur' and fichefrais.mois = '$mois'";
			$monPdo->exec($req);	
		}
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
		}
	}
/**
 * Teste si un visiteur possède une fiche de frais pour le mois passé en argument
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return vrai ou faux 
*/	
	public function estPremierFraisMois($idVisiteur,$mois)
	{
		try{
			$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$ok = false;
			$req = "SELECT count(*) as nblignesfrais from fichefrais 
			where fichefrais.mois = '$mois' and fichefrais.idvisiteur = '$idVisiteur'";
			$res = $monPdo->query($req);
			$laLigne = $res->fetch();
			if($laLigne['nblignesfrais'] == 0){
				$ok = true;
			}
			return $ok;
		}
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
		}
	}
/**
 * Retourne le dernier mois en cours d'un visiteur
 
 * @param $idVisiteur 
 * @return le mois sous la forme aaaamm
*/	
	public function dernierMoisSaisi($idVisiteur){
	try{
		$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		$req = "SELECT max(mois) as dernierMois from fichefrais where fichefrais.idvisiteur = '$idVisiteur'";
		$res = $monPdo->query($req);
		$laLigne = $res->fetch();
		$dernierMois = $laLigne['dernierMois'];
		return $dernierMois;
	}
	catch(PDOException $e){
		echo "Erreur : " . $e->getMessage();
	}
}
	
/**
 * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un visiteur et un mois donnés
 
 * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
 * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
*/
	public function creeNouvellesLignesFrais($idVisiteur,$mois){
	try{
		$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		$dernierMois = $this->dernierMoisSaisi($idVisiteur);
		$laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur,$dernierMois);
			if($laDerniereFiche['idEtat']=='CR'){
				$this->majEtatFicheFrais($idVisiteur, $dernierMois,'CL');
			}
		$req = "INSERT into fichefrais(idvisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat) 
		values('$idVisiteur','$mois',0,0,now(),'CR')";
		$monPdo->exec($req);
		$lesIdFrais = $this->getLesIdFrais();
		foreach($lesIdFrais as $uneLigneIdFrais){
			$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$unIdFrais = $uneLigneIdFrais['idfrais'];
			$req = "INSERT into lignefraisforfait(idvisiteur,mois,idFraisForfait,quantite) 
			values('$idVisiteur','$mois','$unIdFrais',0)";
			$monPdo->exec($req);
		 }
		}
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
		}
	}
/**
 * Crée un nouveau frais hors forfait pour un visiteur un mois donné
 * à partir des informations fournies en paramètre
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @param $libelle : le libelle du frais
 * @param $date : la date du frais au format français jj//mm/aaaa
 * @param $montant : le montant
*/
	public function creeNouveauFraisHorsForfait($id,$mois,$libelle,$dateFrais,$montant){
	try{
		$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		$req = $monPdo->prepare("INSERT INTO lignefraishorsforfait(idVisiteur,mois,libelle,date,montant)
		VALUES(?,?,?,?,?)");
		$req->bindParam(1, $id);
		$req->bindParam(2, $mois);
		$req->bindParam(3, $libelle);
		$req->bindParam(4, $dateFrais);
		$req->bindParam(5, $montant);
		$req->execute();
		var_dump($req->errorInfo());
	}
	catch(PDOException $e){
		echo "Erreur : " . $e->getMessage();
	}
}
/**
 * Supprime le frais hors forfait dont l'id est passé en argument
 
 * @param $idFrais 
*/
	public function supprimerFraisHorsForfait($idFrais){
	try{
		$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		$req = "DELETE from lignefraishorsforfait where lignefraishorsforfait.id =$idFrais ";
		$monPdo->exec($req);
	}
	catch(PDOException $e){
		echo "Erreur : " . $e->getMessage();
	}
}
/**
 * Retourne les mois pour lesquel un visiteur a une fiche de frais
 
 * @param $idVisiteur 
 * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant 
*/
public function getLesMoisDisponibles($idVisiteur){
	
	try{
		$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		$req =("SELECT fichefrais.mois as mois from fichefrais where fichefrais.idvisiteur ='$idVisiteur' 
		order by fichefrais.mois desc ");
		$res=$monPdo->query($req);
		$laLigne = $res->fetch(PDO::FETCH_COLUMN);
			while($laLigne!=null)
			{
				$mois=$laLigne;
				$numAnnee =substr($mois,0,4);
				$numMois =substr($mois,4,6);
			
				$lesMois['mois']=array(
					"mois" => "$mois",
					"numAnnee"  => "$numAnnee",
					"numMois"  => "$numMois"
				);
			
				$laLigne=$res->fetch(PDO::FETCH_COLUMN);
				
				return $lesMois;
				
				if($laLigne!=null)
				{
					echo "yes";
				}
			}
		}
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			
		}
	
}
/**
 * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état 
*/	
	public function getLesInfosFicheFrais($idVisiteur,$mois){
	try{
		$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		$req = "SELECT ficheFrais.idEtat as idEtat, ficheFrais.dateModif as dateModif, ficheFrais.nbJustificatifs as nbJustificatifs, 
			ficheFrais.montantValide as montantValide, etat.libelle as libEtat from  fichefrais inner join Etat on ficheFrais.idEtat = Etat.id 
			where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
		$res = $monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne;
	}
	catch(PDOException $e){
		echo "Erreur : " . $e->getMessage();
	}
}
/**
 * Modifie l'état et la date de modification d'une fiche de frais
 
 * Modifie le champ idEtat et met la date de modif à aujourd'hui
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 */
 
	public function majEtatFicheFrais($idVisiteur,$mois,$etat){
	try{
		$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		$req = "UPDATE ficheFrais set idEtat = '$etat', dateModif = now() 
		where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
		$monPdo->exec($req);
	}
	catch(PDOException $e){
		echo "Erreur : " . $e->getMessage();
	}
}
	public function UpdateLePassword($mdp,$id){
		try{
			$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$sql="UPDATE visiteur SET mdp=? WHERE id=?";
			$stmt=$monPdo->prepare($sql);
			$stmt->execute([$mdp,$id]);	
		}
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
		}
	}
	public function UpdateAdresse($adresse,$id){
		try{
			$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$sql="UPDATE visiteur SET adresse=? WHERE id=?";
			$stmt=$monPdo->prepare($sql);
			$stmt->execute([$adresse,$id]);
		}
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
		}
	}

	public function getLesInfosProfil($id){
		try{
			$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$req = "SELECT visiteur.id as id, visiteur.nom as nom, visiteur.prenom as prenom, visiteur.adresse as adresse , visiteur.pp as pp
			from visiteur 
			where visiteur.id='$id'";
			$res=$monPdo->query($req);
			$Info=$res->fetch();

			return $Info;
		}
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
		}
	}

	public function UpdateLaPP($pp,$id){
		try{
			$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			
			$sql="UPDATE visiteur SET pp=? WHERE id=?";
			$stmt=$monPdo->prepare($sql);
			$stmt->execute([$pp,$id]);
		}
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
		}
	}
	public function RechercheId($id){
		try{
			$monPdo = new PDO(PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			
			$sql=$monPdo->query("SELECT visiteur.id as id FROM visiteur WHERE visiteur.id='$id'")->fetch();;
			return $sql;
		}
		catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
		}
	}
}
