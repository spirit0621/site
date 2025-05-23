<?php

require_once ("../modele/candidatureModel.php");
require_once("../bdd/bdd.php");


$candidature = new candidature($bdd);
session_start();
$updateCandidature = $candidature->updateCandidature($_POST['statut'],$_POST['id']);
$_SESSION['dataChange'] = "Données changées avec succès.";
header('Location:'.$_SESSION['location'].'/index.php?page=4');
exit;