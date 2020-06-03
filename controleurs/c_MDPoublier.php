<?php
$action = $_REQUEST['action'];
switch ($action) {
    case 'id': {
            include("vues/v_id.php");
            break;
        }
    case 'changeMDP': {
            $id = $_POST['id'];
            try{
                $changement = $pdo->RechercheId($id);
                if(!is_array($changement))
                {
                    include ("vues/v_id.php");
                    echo "L'id n'est pas bon";
                }
                else
                {
                    include("vues/v_mdpoublier.php");
                }
            }
            catch (PDOException $e){
                echo "L'id n'est pas valide";
            }
            break;
        }
    case 'Maj': {
            $id = $_POST['id_client'];
            $mdp = $_POST['mdp'];
            $mdp2 = $_POST['mdp2'];
            if ($mdp = $mdp2) {
                $mdp = password_hash($mdp, PASSWORD_BCRYPT, ['cost' => 10]);
                if ($_POST["Valider"]) {
                    try{
                        $pdo->UpdateLePassword($mdp, $id);
                        echo "Changement de mot de passe réaliser !";
                    }
                    catch (PDOException $e){
                        echo "Erreur : " . $e->getMessage();
                        echo "Les mots de passe tapé ne sont pas similaires";
                    }
                }  
            }
            break;
        }
    }
