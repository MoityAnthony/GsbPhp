<h3>
  Fiche de frais du mois <?php echo $numMois . "-" . $numAnnee ?> :
</h3>
<div class="mesfiches">
  <p>
    Etat : <?php echo $libEtat ?> depuis le <?php echo $dateModif ?> <br> Montant validé : <?php echo $montantValide ?>


  </p>
  <div style="padding-left:0;" class="col-md-6">
    <table>
      <h4>Eléments forfaitisés </h4>
      <tr>
        <?php
        foreach ($lesFraisForfait as $unFraisForfait) {
          $libelle = $unFraisForfait['libelle'];
        ?>
          <th class="col-md-6"> <?php echo $libelle ?></th>
        <?php
        }
        ?>
      </tr>
      <tr>
        <?php
        foreach ($lesFraisForfait as $unFraisForfait) {
          $quantite = $unFraisForfait['quantite'];
        ?>
          <td class="col-md-6"><?php echo $quantite ?> </td>
        <?php
        }
        ?>
      </tr>
    </table>
    <table>
      <h4>Eléments hors forfait </br><?php echo $nbJustificatifs ?> justificatifs reçus </h4>
      <tr>
        <th class="col-md-6">Date</th>
        <th class="col-md-6">Libellé</th>
        <th class="col-md-6">Montant</th>
      </tr>
      <?php
      foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
        $date = $unFraisHorsForfait['date'];
        $libelle = $unFraisHorsForfait['libelle'];
        $montant = $unFraisHorsForfait['montant'];
      ?>
        <tr>
          <td class="col-md-6"><?php echo $date ?></td>
          <td class="col-md-6"><?php echo $libelle ?></td>
          <td class="col-md-6"><?php echo $montant ?></td>
        </tr>
      <?php
      }
      ?>
    </table>
  </div>
</div>
</div>