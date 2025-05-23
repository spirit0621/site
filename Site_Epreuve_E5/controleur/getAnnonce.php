<?php
require_once("./bdd/bdd.php");
require_once ("./modele/annonceModel.php");

$annonce = new Annonce($bdd);
$getAnn = $annonce->getAnnById($value['idAnnonce']);