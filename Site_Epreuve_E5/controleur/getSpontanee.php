<?php

require_once ("modele/spontaneeModel.php");
require_once("bdd/bdd.php");


$spontanee = new Spontanee($bdd);
$getSpontanee = $spontanee ->getSpontaneeById($_SESSION['id']);


?>