<?php
session_start();
$_SESSION['location']="http://localhost/Site_Epreuve_E5";
if(!isset($_SESSION['role'])){
	$_SESSION['role']="visiteur";
}
//var_dump($_SESSION['role']);
if(($_SESSION['role']== "candidat") ||($_SESSION['role']== "manager")){
	$page6="vue_profil.php";
	$sous6="Mon profil";	
}else{
	$page6="vue_connexion.php";
	$sous6="Se connecter";
}
if(!isset($title)){
	$title = "Fromsoftware Recrutement" ;
}
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			$page = 1;
		}
		switch ($page) {
			case 1:
				$title="Fromsoftware Recrutement";
				break;
			case 2:
				$title="Nos offres d'emplois";
				break;
			case 3:
				$title="Candiatures spontannées";
				break;
			case 4:
				if ($_SESSION['role'] == "candidat") {
					$title = "Mes candidatures";
				} elseif ($_SESSION['role'] == "manager") {
					$title = "Mes annonces";
				}
				break;
			case 5:
				$title="À propos";
				break;
			case 6:
				if($page6=="vue_profil.php"){
					$title="Mon profil";
				}else{
					$title="Se connecter / S'inscrire";
				}
				break;
			case 7:
				$title="Mon profil";
				break;
			case 8:
				$title="Détail offre";
				break;
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title> <?= $title ?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<header>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"> <img src="images/logo_long.png"> </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php?page=1">Acceuil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=2">Offres</a>
        </li>
		<?php
		if ($_SESSION['role'] == "candidat") {
			echo
			'<li class="nav-item">
			<a class="nav-link" href="index.php?page=3">Candidature Spontanée</a>
			</li>
			';}?>
			<?php
			if ($_SESSION['role'] == "candidat") {
			echo
			'<li class="nav-item">
			<a class="nav-link" href="index.php?page=4">Mes candidatures</a>
			</li>
			';}?>
			<?php
			if ($_SESSION['role'] == "manager") {
			echo
			'<li class="nav-item">
			<a class="nav-link" href="index.php?page=4">Mes annonces</a>
			</li>
			';}?>
		<li class="nav-item">
          <a class="nav-link" href="index.php?page=5">À Propos</a>
        </li>
      </ul>
      <form class="d-flex">
        <a class="nav-link" href="index.php?page=6">
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  			<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
  			<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
		</svg>
			<?= $sous6 ?>
		</a>
      </form>
    </div>
  </div>
</nav>
</header>
<center>
<div class="container">
<?php
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			$page = 1;
		}
		switch ($page) {
			case 1:
				require_once("vue/vue_accueil.php");
				break;
			case 2:
				require_once("vue/vue_offres.php");
				break;
			case 3:
				require_once("vue/vue_spontanee.php");
				break;
			case 4:
				require_once("vue/vue_annonces.php");
				break;
			case 5:
				require_once("vue/vue_presentation.php");
				break;
			case 6:
				require_once("vue/$page6");
				break;
			case 7:
				require_once("vue/vue_profil.php");
				break;
			case 8:
				require_once("vue/vue_detail.php");
				break;
		}
		?>
</div>
</center>
</body>
<footer style="">
    <div class="foot1">
        
        <!-- Colonne 1 : À propos -->
        <div class="foot2">
            <h3>À propos de FromSoftware</h3>

            <p>&copy; <?php echo date("Y"); ?> FromSoftware, Inc. Tous droits réservés.</p>
        </div>

        <!-- Colonne 2 : Liens utiles -->
        <div class="foot2">
            <h3>Liens utiles</h3>
            <ul style="list-style: none; padding: 0;">
			<li><a href="https://drive.google.com/file/d/18BY7RCQLyaGNBDsvOJEBA05su7lVlicX/view?usp=sharing" style="color: white; text-decoration: none;">Mentions légales</a></li>
                <li><a href="https://drive.google.com/file/d/1GJJ2YQY8q06UE-lGzpKZRa5uIMKIRhhJ/view?usp=sharing" style="color: white; text-decoration: none;">Support technique</a></li>
                <li><a href="https://drive.google.com/file/d/1g5N0P9mbhol5OighhQ9W7YOnmJEzoRH3/view?usp=sharing" style="color: white; text-decoration: none;">Support Utilisateurs</a></li> 
            </ul>
        </div>

        <!-- Colonne 3 : Réseaux sociaux -->
        <div class="foot2">
            <h3>Suivez-nous</h3>
            <a href="https://twitter.com/fromsoftware_rc" style="color: white; text-decoration: none; display: block;">Twitter</a>
            <a href="https://www.facebook.com/fromsoftware.recruit/" style="color: white; text-decoration: none; display: block;">Facebook</a>
        </div>

    </div>

</footer>
</html>