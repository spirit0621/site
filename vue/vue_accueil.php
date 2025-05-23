
<div id="acceuil">
    <h1>Bienvenue chez FROMSOFTWARE !</h1>

    <?php
        //include('./parts/search.php');
        include_once("controleur/selectAllAnn.php");
    ?>

    <h2>Nos dernières offres !</h2>
    <div class="row d-flex justify-content-around">
    <?php
    include_once("./controleur/selectAllAnn.php");
    $i=0;
    foreach ($allAnn as $value) 
    {
        $i++;
        echo'
        <div class="col-3 acceuil-annonce">
            <h3>'.$value['titre'].'</h3>
            <div class="blanc">
                <p class="loc-acceuil d-flex justify-content-start">Localisation : '.$value['adresse'].'</p>
                <p class="type-acceuil d-flex justify-content-start">Type de contrat : '.$value['typeCon'].'</p>
                <p class="desc-acceuil d-flex justify-content-start">Description : '.substr($value['description'],0,90).'...</p>
            </div>
            <p class="date-acceuil d-flex justify-content-end">'.$value['dateAnn'].'</p>
        <form action="controleur/annonceControleur.php" method="POST">
			<input type="hidden" name="idA" value="'.$value['idAnnonce'].'">
			<input type="hidden" name="action" value="detail">
			<input type="submit" class="annbt" value="Voir le détail de l\'annonce">
		</form>
        </div>
        ';
        if($i>2){
            break;
        }
    }
    ?>    
    <a href="./index.php?page=2">Voir plus d'offres ?</a>
</div>