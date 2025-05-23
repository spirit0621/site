<h1>Profil</h1>
<form action="controleur/connexionControleur.php" method="POST" style="background-color: white">
    <input type="hidden" name="action" value="deco">
    <input type="submit" value="Se déconnecter">
</form>
<br>
<table id="profil">
        <tr><th scope="row">Nom : </th><td><?= $_SESSION['nom']; ?></td></tr>
        <tr><th scope="row">Prénom : </th><td><?= $_SESSION['prenom']; ?></td></tr>
		<?php if($_SESSION['role']=='candidat'){ ?>
        <tr><th scope="row">Adresse : </th><td><?= $_SESSION['adresse']; ?></td></tr>
        <?php }?>
        <tr><th scope="row">Numéro de téléphone : </th><td><?= $_SESSION['tel']; ?></td></tr>
        <tr><th scope="row">Email : </th><td><?= $_SESSION['email']; ?></td></tr>
</table>
<?php if($_SESSION['role']=='candidat'){
    $control="controleur/mdpCand.php";
}else if($_SESSION['role']=='manager'){
    $control="controleur/mdpMan.php";
}
if($_SESSION['role']=='candidat'){ ?>
<br>
<h2>Modifier ses données</h2>
<br>
<div class="col-3" style="line-height: 17px">
	<form action="controleur/updateCand.php" method="POST">
		<label for="nom" class="d-flex justify-content-start">Nom : </label>
		<input type="text" name="nom" class="form-control">
		<br>
		<label for="prenom" class="d-flex justify-content-start">Prénom : </label>
		<input type="text" name="prenom" class="form-control">
		<br>
		<label for="adresse" class="d-flex justify-content-start">Adresse : </label>
		<input type="text" name="adresse" class="form-control">
		<br>
		<label for="tel" class="d-flex justify-content-start">Numéro de téléphone :</label>
		<input type="text" name="tel" class="form-control">
		<br>
		<label for="email" class="d-flex justify-content-start">Email :</label>
		<input type="text" name="email" class="form-control">
		<br>
		<input type="submit" value="valider">
	</form>
</div>
<?php  }
	if (isset($_SESSION['dataChange'])) {
		echo $_SESSION['dataChange'];
		unset($_SESSION['dataChange']); // Supprimez le message après affichage
	}
?>
<br>
<h2>Modifier son mot de passe</h2>
<br>
<div class="col-3">
	<form action="<?= $control ?>" method="POST">
		<label for="nom" class="d-flex justify-content-start">Nouveau mot de passe : </label>
		<input type="text" name="mdp" class="form-control">
		<br>
		<input type="submit" value="valider">
	</form>
</div>
<?php 
	if (isset($_SESSION['mdpChange'])) {
		echo $_SESSION['mdpChange'];
		unset($_SESSION['mdpChange']); // Supprimez le message après affichage
	}
?>