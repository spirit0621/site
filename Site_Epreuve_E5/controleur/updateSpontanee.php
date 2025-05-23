<?php

require_once ("../modele/spontaneeModel.php");
require_once("../bdd/bdd.php");


$spontanee = new spontanee($bdd);
session_start();
$updateSpontanee = $spontanee->updateSpontanee($_POST['statut'],$_POST['id']);
$_SESSION['dataChange'] = "Données changées avec succès.";
header('Location:'.$_SESSION['location'].'/index.php?page=4');
exit;