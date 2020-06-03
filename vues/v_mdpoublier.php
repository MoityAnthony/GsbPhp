<?php
require_once("include/fct.inc.php");
require_once("include/class.pdogsb.inc.php");
?>

<div id="contenu" class="col-md-6 id_mdp">
      <h2>Veuillez saisir un nouveau mot de passe</h2></br>


      <form method="POST" action="index.php?uc=MDPoublier&action=Maj">
            <input id="mdp" class="form-control" type="password" name="mdp" size="30" maxlength="45" placeholder="Nouveau mot de passe" /></br></br>
            <input id="mdp2" class="form-control" type="password" name="mdp2" size="30" maxlength="45" placeholder="Confirmer le nouveau mot de passe" /></br></br>
            <button class="primary-btn text-uppercase" type="submit" value="Valider" name="Valider">Valider</button>
            <button class="primary-btn text-uppercase" type="reset" value="Annuler" name="annuler">Annuler</button>
            <textarea style="display:none;" type="hidden" id="id_client" name="id_client"><?php echo $_POST['id']; ?></textarea>
      </form>

</div>