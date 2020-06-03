<div class="formprofil">
      <div class="col-md-8">
            <div class="photoprofil">
                  </br>
                  <h3>Profil de <?php echo $_SESSION["prenom"] ?><?php echo " "; ?><?php echo $_SESSION["nom"]; ?></h3></br>

                  <div class="col-md-10">
                        <div class="form-group">
                              <form name="PP" action="index.php?uc=profil&action=updatePP" ENCTYPE="multipart/form-data">

                                    <img src="<?php echo $pp; ?>" />
                                    <div class="boutonpp">
                                          <button class="primary-btn text-uppercase" type="file" name="photo" id="photo">Changer de photo</button></br></br>

                                          <button class="primary-btn text-uppercase" type="submit" class="btn" id="envoyer" value="envoyer" name="env">Envoyer</button></br>
                                    </div>
                        </div>
                        </form>
                  </div>
            </div>
            <div class="form-group">
                  <form method="POST" action="index.php?uc=profil&action=updateAdresse">
                        <label for="adresse">Modifier votre adresse :</label></br>

                        <input class="form-control" id="adresse" name="adresse" size="30" maxlength="45" placeholder="Entrer votre adresse : Adresse actuelle : <?php echo $adresse; ?> " /></br>

                        <div class="boutonVal">
                              <button class="primary-btn text-uppercase" type="submit" value="valider" name="ok">Valider</button></br>

                              <button class="primary-btn text-uppercase" type="reset" value="Annuler" name="annuler">Annuler</button>
                        </div>
                  </form>
            </div>
            <div class="form-group">
                  <form method="POST" action="index.php?uc=profil&action=updateMDP">
                        <label for="mdp">Modifier votre mot de passe :</label></br>

                        <input class="form-control" id="mdp" type="password" name="mdp" size="30" maxlength="45" placeholder="Entrer votre mot de passe " /></br>
                        <div class="boutonVal">
                              <button class="primary-btn text-uppercase" type="submit" value="valider" name="valider">Valider</button></br>
                              <button class="primary-btn text-uppercase" type="reset" value="Annuler" name="annuler">Annuler</button>
                        </div>
                  </form>
            </div>
      </div>
</div>