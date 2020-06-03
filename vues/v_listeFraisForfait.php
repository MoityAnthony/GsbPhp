<div class="col-md-6">
  <div class="fraisforfait">
    <div class="formprofil">
      <div class="form-group">
        <h3>Renseigner ma fiche de frais du mois <?php echo $numMois . "-" . $numAnnee ?></h3></br>
        <form method="POST" action="index.php?uc=gererFrais&action=validerMajFraisForfait">


          <fieldset>
            <legend>Eléments forfaitisés
            </legend>
            <?php
            foreach ($lesFraisForfait as $unFrais) {
              $idFrais = $unFrais['idfrais'];
              $libelle = $unFrais['libelle'];
              $quantite = $unFrais['quantite'];
            ?>
              <p>
                <label for="idFrais"><?php echo $libelle ?></label></br>
                <input class="col-md-6" type="text" id="idFrais" name="lesFrais[<?php echo $idFrais ?>]" size="10" maxlength="5" value="<?php echo $quantite ?>">
              </p>

            <?php
            }
            ?>





          </fieldset>

          <div class="piedForm">
            <p>
              <button class="primary-btn text-uppercase" id="ok" type="submit" size="20">Valider</button>
              <button class="primary-btn text-uppercase" id="annuler" type="reset" size="20">Effacer</button>
            </p>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>