<?php
require_once("../modele/spontaneeModel.php");
require_once("../bdd/bdd.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $spontaneeController = new SpontaneeController($bdd);

    switch ($_POST['action']) {
        case 'ajouter':
            $spontaneeController->create();
            break;

        case 'supprimer':
            $spontaneeController->delete();
            break;

        default:
            session_start();
            header('Location: ' . $_SESSION['location'] . '/index.php');
            break;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['type'], $_GET['id'])) {
    // Handle file streaming
    try {
        $spontaneeController = new SpontaneeController($bdd);
        $spontaneeController->streamFile($_GET['type'], intval($_GET['id']));
    } catch (Exception $e) {
        http_response_code(500);
        echo "An error occurred: " . $e->getMessage();
        exit();
    }
} else {
    http_response_code(400);
    echo "Invalid request.";
    exit();
}

class SpontaneeController
{
    private $spontanee;

    function __construct($bdd)
    {
        $this->spontanee = new Spontanee($bdd);
    }

    public function create()
    {
        if (isset($_FILES['cv']['tmp_name'], $_POST['statut'], $_POST['idC'])) {
            try {
                $cv = file_get_contents($_FILES['cv']['tmp_name']);
                $motivation = isset($_FILES['motivation']['tmp_name']) && !empty($_FILES['motivation']['tmp_name'])
                    ? file_get_contents($_FILES['motivation']['tmp_name'])
                    : null;
                $extraDoc = isset($_FILES['extraDoc']['tmp_name']) && !empty($_FILES['extraDoc']['tmp_name'])
                    ? file_get_contents($_FILES['extraDoc']['tmp_name'])
                    : null;
                $statut = filter_var($_POST['statut']);
                $idC = filter_var($_POST['idC'], FILTER_VALIDATE_INT);
                $date = filter_var($_POST['date']);
                $this->spontanee->ajouterSpontanee($cv, $motivation, $extraDoc, $statut, $idC,$date);

                session_start();
                header('Location: ' . $_SESSION['location'] . '/index.php?success=1');
            } catch (Exception $e) {
                echo "Error while adding spontanee: " . $e->getMessage();
                exit();
            }
        } else {
            echo "Files are missing. Please upload all required files.";
        }
    }

    public function delete()
    {
        if (isset($_POST['idSpontanee'])) {
            try {
                $idSpontanee = intval($_POST['idSpontanee']);
                $this->spontanee->supprimerSpontanee($idSpontanee);
                session_start();
                header('Location: ' . $_SESSION['location'] . '/index.php?success=1');
            } catch (Exception $e) {
                echo "Error while deleting spontanee: " . $e->getMessage();
                exit();
            }
        } else {
            echo "Spontanee ID is missing.";
        }
    }

    public function streamFile($type, $id)
    {
        $allowedTypes = ['cv', 'motivation', 'extraDoc'];
        if (!in_array($type, $allowedTypes)) {
            http_response_code(400);
            echo "Invalid file type.";
            exit();
        }

        try {
            $fileContent = $this->spontanee->getFileContent($id, $type);

            if ($fileContent) {
                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename="' . $type . '_' . $id . '.pdf"');
                echo $fileContent;
                exit();
            } else {
                http_response_code(404);
                echo "File not found.";
                exit();
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo "An error occurred while fetching the file: " . $e->getMessage();
            exit();
        }
    }
}
?>
