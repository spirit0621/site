<?php

require_once ("modele/annonceModel.php");
require_once("bdd/bdd.php");


$annonce = new Annonce($bdd);
$getTitreByCand = $annonce ->getTitreByCand($_SESSION['id']);


?>