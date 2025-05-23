<?php

require_once ("../modele/candidatModel.php");
require_once("../bdd/bdd.php");

$candidat = new Candidat($bdd);
session_start();
$updateMdpC = $candidat->updateMdp($_POST['mdp'],$_SESSION['id']);
$_SESSION['mdp']=$_POST['mdp'];
$_SESSION['mdpChange'] = "Mot de passe changé avec succès.";
header('Location:'.$_SESSION['location'].'/index.php?page=6');
exit;