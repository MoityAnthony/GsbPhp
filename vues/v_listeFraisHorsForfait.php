<div class="fraishorsforfait">
  <div class="col-md-6">
    <div class="formprofil">
      <div class="form-group">
        <form action="index.php?uc=gererFrais&action=validerCreationFrais" method="post">
          <div>
            <fieldset>
              <legend>Nouvel élément hors forfait
              </legend>
              <p>
                <label for="txtDateHF">Date (jj/mm/aaaa) : </label></br>
                <input class="col-md-6" type="date" id="txtDateHF" name="dateFrais" size="10" maxlength="10" value="" />
              </p>
              <p>
                <label for="txtLibelleHF">Libellé :</label></br>
                <input class="col-md-6" type="text" id="txtLibelleHF" name="libelle" size="70" maxlength="256" value="" />
              </p>
              <p>
                <label for="txtMontantHF">Montant : </label></br>
                <input class="col-md-6" type="text" id="txtMontantHF" name="montant" size="10" maxlength="10" value="" />
              </p>
            </fieldset>
          </div>
          <div class="piedForm">
            <p>
              <button class="primary-btn text-uppercase" id="ajouter" type="submit" size="20">Ajouter</button>
              <button class="primary-btn text-uppercase" id="effacer" type="reset" size="20">Effacer</button>
            </p>
          </div>
        </form>
      </div>
    </div>
    <div class="form-group">
      <div class="tableaufiche">
        <div class="mesfiches">
          <table style="text-align:center;">
            <legend>Descriptif des éléments hors forfait</legend>
            <tr>
              <th>Date</th>
              <th>Libellé</th>
              <th>Montant</th>
              <th></th>
            </tr>

            <?php
            foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
              $libelle = $unFraisHorsForfait['libelle'];
              $date = $unFraisHorsForfait['date'];
              $montant = $unFraisHorsForfait['montant'];
              $id = $unFraisHorsForfait['id'];
            ?>
              <tr>
                <td> <?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
                <td>
                  <a style="color:#0ba9ff;" href="index.php?uc=gererFrais&action=supprimerFrais&idFrais=<?php echo $id ?>">
                    <p>Supprimer</p>
                  </a>
                </td>
              </tr>
            <?php

            }
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>