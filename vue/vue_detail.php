<div class="detail">
	<h2><?=$_SESSION['detail']['titre']?></h2>
	<div class="row">
		<div class="col-4">
			<div class="ligne justify-content-start"><h3>Adresse : </h3><p><?=$_SESSION['detail']['adresse']?></p></div><br>
			<div class="ligne justify-content-start"><h3>Type de contrat : </h3><p><?=$_SESSION['detail']['typeCon']?></p></div><br>
			<div class="ligne justify-content-start"><h3>Durée du contrat : </h3><p><?=$_SESSION['detail']['duree']?></p></div><br>
			<div class="ligne justify-content-end"><h3>Date de publication :</h3><p><?=$_SESSION['detail']['dateAnn']?></p></div><br>
		</div>
		<div class="col-8">	
			<div class="descriptif justify-content-start"><h3>Description : </h3><p><?=str_replace("\n", "<br/>",$_SESSION['detail']['description'])?></p></div><br>
		</div>
	</div>
</div>
<?php if($_SESSION['role']=="candidat"){?>
<h2>Postuler</h2>
<br>
<div class="mb-3" style="line-height: 17px;">
	<form action="controleur/candidatureControleur.php" method="post" enctype="multipart/form-data">
			<div id="candidature">
				<label for="cv" class="form-label"><b>CV * :</b></label>
				<input type="file" id="cv" name="cv" class="form-control" accept="application/pdf" required> <br><br>

				<label for="motivation" class="form-label"><b>Lettre de motivation (optionnel) :</b></label>
				<input type="file" id="motivation" name="motivation" class="form-control" accept="application/pdf"> <br><br>

				<label for="extraDoc" class="form-label"><b>Dossier supplémentaire (optionnel) :</b></label>
				<input type="file" id="extraDoc" name="extraDoc" class="form-control" accept="application/pdf"> <br><br>

				<input type="hidden" name="statut" value="attente">
				<input type="hidden" name="idC" value="<?= $_SESSION['id'] ?>">
				<input type="hidden" name="idA" value="<?= $_SESSION['idA'] ?>">
				<input type="hidden" name="date" value="<?=date("Y.m.d")?>">
				<input type="hidden" name="action" value="ajouter">
				<input type="submit" value="valider">
			</div>
	</form>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    let inputsFichier = document.querySelectorAll("input[type='file']");

    inputsFichier.forEach(input => {
        input.addEventListener("change", function() {
            let fichier = this.files[0];
            if (fichier) {
                let extension = fichier.name.split('.').pop().toLowerCase();
                if (extension !== "pdf") {
                    alert("❌ Seuls les fichiers PDF sont acceptés !");
                    this.value = ""; // Réinitialise le champ fichier
                }
            }
        });
    });
});
</script>
<?php
}
if($_SESSION['role']=="manager"){?>
	<h2>Modifier l'annonce</h2>
	<br>
	<div class="mb-3" style="line-height: 17px;">
		<form action="controleur/annonceControleur.php" method="POST">
			<label class="form-label" for="titre">Titre de l'annonce : </label>
			<br>
			<textarea class="form-control" type="text" name="titre" rows="1" cols="50"></textarea>
			<br>
			<label class="form-label" for="adresse">Adresse de l'annonce : </label>
			<br>
			<textarea class="form-control" type="text" name="adresse" rows="1"> </textarea>
			<br>
			<label class="form-label" for="typeCon">Type de contrat : </label>
			<br>
			<textarea class="form-control" type="text" name="typeCon" rows="1"> </textarea>
			<br>
			<label class="form-label" for="duree">Durée du contrat (noter "indéterminée" pour CDI) :</label>
			<br>
			<textarea class="form-control" type="text" name="duree" rows="1"> </textarea>
			<br>
			<label class="form-label" for="salaire">Salaire :</label>
			<input class="form-control" type="number" name="salaire">
			<br>
			<label class="form-label" for="description">Description de l'annonce : </label>
			<br>
			<textarea class="form-control" type="text" name="description" rows="5"> </textarea>
			<br>
			<input type="hidden" name="action" value="modifier">
			<input type="submit" value="valider">
		</form>
	</div>
<?php
}