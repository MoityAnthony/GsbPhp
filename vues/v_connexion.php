<div class="col-md-6">
    <div class="formco">
        <form method="POST" action="index.php?uc=connexion&action=valideConnexion" class="">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" id="login" name="login" placeholder="Entrer votre login">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Entrer votre mot de passe">
                </div>
                <div class="col-md-12 row no-gutters text-right button">
                    <div class="col-md-8 row no-gutters">
                        <div class="valide">
                            <button id="valider" type="submit" name="Valider" value="Valider" class="primary-btn text-uppercase">Valider</button>
                            <button type="reset" name="Annuler" value="Annuler" class="primary-btn text-uppercase">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="col-md-6 row no-gutters mdp">
            <form method="POST" action="index.php?uc=MDPoublier&action=id">
                <button id="mdpoublier" type="submit" name="mdplost" value="mdplost" class="primary-btn text-uppercase">
                    <a>Mot de passe oublié ?</a>
                </button>
            </form>
        </div>
    </div>
</div>