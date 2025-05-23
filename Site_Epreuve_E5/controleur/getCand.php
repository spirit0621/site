<?php
require_once("../bdd/bdd.php");
require_once ("../modele/candidatModel.php");

$candidat = new Candidat($bdd);
$getCand = $candidat->getCandById($_SESSION['id']);