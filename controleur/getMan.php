<?php

require_once ("modele/managerModel.php");
require_once("bdd/bdd.php");


$manager = new Manager($bdd);
$getMan = $manager->getManById($_POST['email'],$_POST['mdp']);

return $getMan;

?>