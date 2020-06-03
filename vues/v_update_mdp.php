<?php
require_once("include/fct.inc.php");
require_once("include/class.pdogsb.inc.php");
?>

<div id="contenu">
      <h2>Veuillez rentrer un nouveau mot de passe</h2>


      <form method="POST" action="">
            <label for="nom">Nouveau mot de passe</label></br>
            <input id="mdp" type="password" name="mdp" size="30" maxlength="45" /></br></br>
            <label for="nom">Confirmer le nouveau mot de passe</label></br>
            <input id="mdp" type="password" name="mdp" size="30" maxlength="45" /></br></br>
            <input type="submit" value="Valider" name="valider" />
            </br>
            </br>
            <input type="reset" value="Annuler" name="annuler" />

      </form>

</div>