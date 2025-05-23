<?php

//CRUD

class Candidature
{
	
	function __construct($bdd)
	{
		$this->bdd = $bdd;
	}


	public function ajouterCandidature($cv, $motivation, $extraDoc,$statut,$idC,$idA,$date)
	{
		$req = $this->bdd->prepare("INSERT INTO Candidature (Cv, Motivation, ExtraDoc, Statut,idCandidat,idAnnonce,dateCand) VALUES (:cv , :motivation, :extraDoc,:statut,:idC,:idA,:dateC)");
		$req->bindParam(':cv', $cv, PDO::PARAM_LOB);
		$req->bindParam(':motivation', $motivation, PDO::PARAM_LOB);
		$req->bindParam(':extraDoc', $extraDoc, PDO::PARAM_LOB);
		$req->bindParam(':statut', $statut);
		$req->bindParam(':idC', $idC);
		$req->bindParam(':idA', $idA);
		$req->bindParam(':dateC', $date);
		return $req->execute();
	}



	public function allCandidature()
	{
		$req = $this->bdd->prepare("SELECT * FROM Candidature");
		$req->execute();
		return $req->fetchAll();
	}

	public function supprimerCandidature($id)
	{

		$req = $this->bdd->prepare("DELETE FROM Candidature WHERE idCandidature = ?");
		return $req->execute([$id]);
	}

    public function updateCandidature($statut, $id)
    {
        $stmt = $this->bdd->prepare("UPDATE Candidature SET statut = :statut WHERE idCandidature = :id");
		$stmt->bindParam(':statut', $statut);
        $stmt->bindParam(':id', $id);
       return $stmt->execute();
    }

    public function getCandidatureById($id) {
        $stmt = $this->bdd->prepare('SELECT * FROM Candidature WHERE idCandidat = ?');
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

	public function getFileContent($idCandidature, $type)
{
    // Define the allowed columns to prevent SQL injection
    $allowedColumns = ['cv', 'motivation', 'extraDoc'];
    if (!in_array($type, $allowedColumns)) {
        throw new Exception("Invalid file type.");
    }

    // Prepare the SQL statement to fetch the file content
    $stmt = $this->bdd->prepare("SELECT $type FROM Candidature WHERE idCandidature = :id");
    $stmt->bindParam(':id', $idCandidature, PDO::PARAM_INT);
    $stmt->execute();

    // Return the BLOB content
    return $stmt->fetchColumn();
}

public function getCandidatureByManager($idManager) {
    $stmt = $this->bdd->prepare(
        'SELECT c.* FROM Candidature c
        JOIN Annonce a ON c.idAnnonce = a.idAnnonce
        WHERE a.idManager = ?'
    );
    $stmt->execute([$idManager]);
    return $stmt->fetchAll();
}

}

?>