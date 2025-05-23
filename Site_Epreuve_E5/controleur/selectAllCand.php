<?php

require_once ("modele/candidatModel.php");
require_once("bdd/bdd.php");


$candidat = new Candidat($bdd);
$allCand = $candidat->allCand();



?>