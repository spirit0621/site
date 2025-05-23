<?php

require_once ("modele/candidatureModel.php");
require_once("bdd/bdd.php");


$candidature = new Candidature($bdd);
$allCandidature = $candidature->allCandidature();



?>