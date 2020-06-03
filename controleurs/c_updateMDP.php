<?php
$action = $_REQUEST['action'];
switch ($action) {
    case 'id': {
        include("vues/v_id.php");
            var_dump($action);
            break;
        }
    case 'MDPoublier': {
            $id = $_POST["id"];
            $mdp = $_POST['mdp'];
            $login = $_POST['login'];
            $mdp = password_hash($mdp, PASSWORD_BCRYPT, ['cost' => 10]);
            include("vues/v_mdpoublier.php");
            if ($_POST["Valider"]) {
                $pdo->UpdateLePassword($mdp, $login);
            }
            break;
        }
}
?>
