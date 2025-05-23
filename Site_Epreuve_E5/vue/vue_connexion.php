<h1>Se connecter :</h1>
<div class="col-3">
<form action="controleur/connexionControleur.php" method="POST">
	<div class="form-group">
		<label for="email" class="d-flex justify-content-start">Email :</label>
		<input type="text" class="form-control" name="email" placeholder="email@email.fr">
	</div>
	<div class="form-group">
		<label for="mdp" class="d-flex justify-content-start">Mot de passe :</label>
		<input type="text" class="form-control" name="mdp" placeholder="mot de passe">
	</div>
	<br>
	<fieldset>
	<div class="btn-group btn-group-toggle" data-toggle="buttons">
		<label class="btn btn-secondary active">
			<input type="radio" name="role" value="candidat" checked> Candidat
		</label>
		<label class="btn btn-secondary">
			<input type="radio" name="role" value="manager"> Manager
		</label>
	</div>
	</fieldset>
	<br>
	<input type="hidden" name="action" value="connexion">
	<input type="submit" value="valider">
</form>
</div>
<?php
	if (isset($_SESSION['error'])) {
		echo $_SESSION['error'];
		unset($_SESSION['error']); // Supprimez le message après affichage
	}
?>
<h1>S'inscrire :</h1>
<div class="col-3">
	<form action="controleur/connexionControleur.php" method="POST">
		<div class="form-group">
			<label for="nom" class="d-flex justify-content-start">Nom : </label>
			<input type="text" name="nom" class="form-control">
			<div class="form-group">
			<label for="prenom" class="d-flex justify-content-start">Prénom : </label>
			<input type="text" name="prenom" class="form-control">
		</div>
		<div class="form-group">
			<label for="adresse" class="d-flex justify-content-start">Adresse : </label>
			<input type="text" name="adresse" class="form-control">
		</div>
		<div class="form-group">
			<label for="tel" class="d-flex justify-content-start">Numéro de téléphone :</label>
			<input type="text" name="tel" class="form-control">
		</div>
		<div class="form-group">
			<label for="email" class="d-flex justify-content-start">Email :</label>
			<input type="text" name="email" class="form-control">
		</div>
		<div class="form-group">
			<label for="mdp" class="d-flex justify-content-start">Mot de passe :</label>
			<input type="text" name="mdp" class="form-control">
		</div>
		<br>
		<input type="hidden" name="action" value="ajouter">
		<input type="submit" value="valider">
	</form>
</div>