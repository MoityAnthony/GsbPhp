<div class="col-md-8">
<h3>Ajouter un nouveau frais hors forfait</h3>
	<form class="form-group" method='POST' action='index.php?uc=gererFrais&action=validerCreationFrais'>
		<table class='tabNonQuadrille'>
			<tr>
				<td>Date du frais (jj/mois/aaaa)</td>
				<td>
					<input class="form-control" type='text' name=dateFrais  size='30' maxlength='45'>
				</td>
			</tr>
			<tr>
				<td>Description du frais</td>
				<td>
					<input class="form-control" type='text' name=description  size='50' maxlength='100'>
				</td>
			</tr>
			<tr>
				<td>Montant engage</td>
				<td>
					<input class="form-control" type='text' name=montant  size='30' maxlength='45'>
				</td>
			</tr>
			<tr>
			<td>Justificatif</td>
			<td><input class="form-control" type='radio' name='justificatif' value='oui'> oui
			</td>
			<td>
			<input class="form-control" type='radio' name='justificatif' value='non'> non
			</td>

			</tr>

		</table>
	<input class="form-control" type='submit' value='Valider' name='valider'>
			<input class="form-control" type='reset' value='Annuler' name='annuler'>

	</form>
</div>