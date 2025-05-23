<?php

require_once ("../modele/managerModel.php");
require_once("../bdd/bdd.php");

$manager = new Manager($bdd);
session_start();
$updateMdpM = $manager->updateMdp($_POST['mdp'],$_SESSION['id']);
$_SESSION['mdp']=$_POST['mdp'];
$_SESSION['mdpChange'] = "Mot de passe changé avec succès.";
header('Location:'.$_SESSION['location'].'/index.php?page=6');
exit;