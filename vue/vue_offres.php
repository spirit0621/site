<h1>Nos offres d'emplois</h1>
<?php if($_SESSION['role']=="manager"){?>
	<h2>Ajouter une annonce</h2>
	</center>
	<div class="mb-3" style="padding-left: 253px; padding-right: 253px; line-height: 17px;">
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
			<center>
			<input type="hidden" name="action" value="ajouter">
			<input type="submit" value="Ajouter">
			</center>
		</form>
	</div>
<center>
<?php
}
include_once("./controleur/selectAllAnn.php");
//include('./parts/search.php');
    foreach ($allAnn as $value) {
        echo'
		<div class="col-8 annonce">
                <h3>'.$value['titre'].'</h3>
				<div class="blanc">
                <p class="loc d-flex justify-content-start">Localisation :'.$value['adresse'].'</p>
                <p class="type d-flex justify-content-start">Type de contrat :'.$value['typeCon'].'</p>
                <p class="desc d-flex justify-content-start">Description :'.substr($value['description'],0,300).'...</p>
				<p class="desc d-flex justify-content-start">Salaire :'.$value['salaire'].'€/mois</p>
				<p class="desc d-flex justify-content-start">Durée :'.$value['duree'].'</p>
				</div>
                <p class="date d-flex justify-content-end">'.$value['dateAnn'].'</p>
            <form action="controleur/annonceControleur.php" method="POST">
				<input type="hidden" name="idA" value="'.$value['idAnnonce'].'">
				<input type="hidden" name="action" value="detail">
				<input type="submit" value="Voir le détail de l\'annonce">
			</form>';
			if($_SESSION['role']=="manager"){
				echo'<form action="controleur/annonceControleur.php" method="POST">
					<input type="hidden" name="idA" value="'.$value['idAnnonce'].'">
					<input type="hidden" name="action" value="supprimer">
					<input type="submit" value="Supprimer l\'annonce">
				</form>';
			}
		echo'</div>';
    }
?>