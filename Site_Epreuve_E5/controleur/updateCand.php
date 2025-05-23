<?php

require_once ("../modele/candidatModel.php");
require_once("../bdd/bdd.php");


$candidat = new Candidat($bdd);
session_start();
$updateCand = $candidat->updateCand($_POST['nom'],$_POST['prenom'],$_POST['adresse'],$_POST['tel'],$_POST['email'],$_SESSION['id']);
$getCandidat = $candidat->getCandById($_POST['email']);
$_SESSION['nom']=$getCandidat['nom'];
$_SESSION['prenom']=$getCandidat['prenom'];
$_SESSION['adresse']=$getCandidat['adresse'];
$_SESSION['tel']=$getCandidat['tel'];
$_SESSION['email']=$getCandidat['email'];
$_SESSION['dataChange'] = "Données changées avec succès.";
header('Location:'.$_SESSION['location'].'/index.php?page=6');
exit;