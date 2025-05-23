<?php
require_once ("../modele/candidatModel.php");
require_once("../modele/managerModel.php");
require_once("../bdd/bdd.php");
if(isset($_POST['action'])) {


$candidatController = new CandidatController($bdd);

switch ($_POST['action']) {

case 'ajouter':

    $candidatController->create();
    break;

case 'connexion':
    $candidatController->login();
    break;

case'deco':
    session_start();
    $_SESSION['role']='visiteur';
    header('Location: '.$_SESSION['location'].'/index.php');
    break;

default:
    session_start();
    header('Location: '.$_SESSION['location'].'/index.php');
    break;
}
}


class CandidatController
{
private $candidat;
private $manager;

function __construct($bdd)
{
    $this->candidat = new Candidat($bdd);
    $this->manager = new Manager($bdd);
}

public function create()
{
session_start();
//ici je récupère l'email pr le comparer à la base de données et voir si ça existe
$candidat = $this->candidat->getCandById($_POST['email']);
if ($candidat != null){
    $_SESSION['error'] = "Création de compte impossible.<br>Email déjà utilisé !";
    header('Location: '.$_SESSION['location'].'/index.php?page=6');
}else{
//verif

$this->candidat->addCand($_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['tel'], $_POST['email'], $_POST['mdp']);
$_SESSION['error'] = "Compte créé avec succès !";
//redirection 
header('Location: '.$_SESSION['location'].'/index.php?page=6');
}
}

public function login() {
    // Démarrage de la session
    session_start();

    // Vérifier si le rôle est "manager"
    if ($_POST['role'] == "manager") {
        $manager = $this->manager->getManById($_POST['email'], $_POST['mdp']);

        // Vérification des identifiants
        if (($manager != null) && (sha1($_POST['mdp'])== $manager['mdp'])) {
            $_SESSION['role'] = "manager";
            $_SESSION['nom']=$manager['nom'];
            $_SESSION['prenom']=$manager['prenom'];
            $_SESSION['tel']=$manager['tel'];
            $_SESSION['email']=$manager['email'];
            $_SESSION['id']=$manager['idManager'];
            header('Location: '.$_SESSION['location'].'/index.php');
            exit;
        } else {
            $_SESSION['role'] = "visiteur";
            $_SESSION['error'] = "Combinaison email/mot de passe introuvable.";
            header('Location: '.$_SESSION['location'].'/index.php?page=6');
            exit;
        }
    } 
    // Vérifier si le rôle est "candidat"
    else if ($_POST['role'] == "candidat") {
        $candidat = $this->candidat->getCandById($_POST['email']);

        // Vérification des identifiants
        if (($candidat != null) && (sha1($_POST['mdp'])== $candidat['mdp'])) {
            $_SESSION['role'] = "candidat";
            $_SESSION['nom']=$candidat['nom'];
            $_SESSION['prenom']=$candidat['prenom'];
            $_SESSION['adresse']=$candidat['adresse'];
            $_SESSION['tel']=$candidat['tel'];
            $_SESSION['email']=$candidat['email'];
            $_SESSION['id']=$candidat['idCandidat'];
            //ici faut que je stocke les données du candidat dans session
            header('Location: '.$_SESSION['location'].'/index.php');
            exit;
        } else {
            $_SESSION['role'] = "visiteur";
            $_SESSION['error'] = "Combinaison email/mot de passe introuvable.";
            header('Location: '.$_SESSION['location'].'/index.php?page=6');
            exit;
        }
    } 
    // Si le rôle n'est pas reconnu
    else {
        $_SESSION['role'] = "visiteur";
        $_SESSION['error'] = "Role non reconnu.";
        header('Location: '.$_SESSION['location'].'/index.php?page=6');
        exit;
    }
}



}