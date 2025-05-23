<?php
require_once("../bdd/bdd.php");
require_once("../modele/candidatureModel.php");

// Check if required parameters are provided
if (!isset($_GET['id']) || !isset($_GET['type'])) {
    die("Invalid request.");
}

$idCandidature = intval($_GET['id']);
$type = $_GET['type']; // Should be 'cv', 'motivation', or 'extraDoc'

// Validate the type to prevent misuse
$allowedTypes = ['cv', 'motivation', 'extraDoc'];
if (!in_array($type, $allowedTypes)) {
    die("Invalid file type requested.");
}

// Fetch the file content from the database
try {
    $candidatureModel = new Candidature($bdd);
    $candidature = $candidatureModel->getCandidatureById($idCandidature);

    if (!$candidature) {
        die("Candidature not found.");
    }

    $fileContent = $candidature[$type]; // Fetch the file's binary content
    $fileName = $type . "_candidature_" . $idCandidature . ".pdf"; // Example filename

    // Set headers to force download
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename=\"$fileName\"");
    header("Content-Length: " . strlen($fileContent));

    // Output the file content
    echo $fileContent;

} catch (Exception $e) {
    echo "Error while fetching the file: " . $e->getMessage();
}
?>
