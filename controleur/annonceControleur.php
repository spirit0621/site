<?php
require_once ("../modele/annonceModel.php");
require_once("../bdd/bdd.php");

if(isset($_POST['action'])) {


	    $annController = new AnnonceController($bdd);

	switch ($_POST['action']) {

		case 'ajouter':
		 $annController->create();
			break;

		case 'supprimer':
		 $annController->delete();
			break;

		case 'detail':
			$annController->getAnn();
			   break;
		
		case 'modifier':
			$annController->updateAnn();
			break;

		default:
			# code...
			break;
	}
}


class AnnonceController 
{
	private $annonce;

	function __construct($bdd)
	{
		$this->annonce = new Annonce($bdd);
	}

	public function create()
	{

		//verif
		session_start();
		$this->annonce->addAnn($_POST['titre'], $_POST['adresse'], $_POST['typeCon'],$_POST['description'],$_POST['salaire'],$_POST['duree'],date('d/m/Y'),$_SESSION['id']);
		//redirection 
		
		header('Location:'.$_SESSION['location'].'/index.php');
		exit;

	}

	public function delete()
	{
		session_start();
		$this->annonce->deleteAnn($_POST['idA']);
		header('Location:'.$_SESSION['location'].'/index.php');
		exit;
	}

	public function getAnn(){
		session_start();
		$_SESSION['detail'] = $this->annonce->getAnnById($_POST['idA']);
		$_SESSION['idA']=$_POST['idA'];
		header('Location:'.$_SESSION['location'].'/index.php?page=8');
		exit;
	}

	public function updateAnn(){
		session_start();
		$this->annonce->updateAnn($_POST['titre'],$_POST['adresse'],$_POST['typeCon'],$_POST['description'],$_POST['salaire'],$_POST['duree'],$_SESSION['detail']['idAnnonce']);
		$_SESSION['detail']['titre']=$_POST['titre'];
		$_SESSION['detail']['adresse']=$_POST['adresse'];
		$_SESSION['detail']['typeCon']=$_POST['typeCon'];
		$_SESSION['detail']['description']=$_POST['description'];
		$_SESSION['detail']['salaire']=$_POST['salaire'];
		$_SESSION['detail']['duree']=$_POST['duree'];
		header('Location:'.$_SESSION['location'].'/index.php?page=8');
		exit;
	}
}

?>