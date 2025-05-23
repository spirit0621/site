<?php

//CRUD

class Spontanee
{
	
	function __construct($bdd)
	{
		$this->bdd = $bdd;
	}


	public function ajouterSpontanee($cv, $motivation, $extraDoc,$statut,$idC,$date)
	{
		$req = $this->bdd->prepare("INSERT INTO Spontanee (Cv, Motivation, ExtraDoc, Statut,idCandidat,dateCand) VALUES (:cv , :motivation, :extraDoc,:statut,:idC,:dateC)");
		$req->bindParam(':cv', $cv, PDO::PARAM_LOB);
		$req->bindParam(':motivation', $motivation, PDO::PARAM_LOB);
		$req->bindParam(':extraDoc', $extraDoc, PDO::PARAM_LOB);
		$req->bindParam(':statut', $statut);
		$req->bindParam(':idC', $idC);
		$req->bindParam(':dateC', $date);
		return $req->execute();
	}



	public function allSpontanee()
	{
		$req = $this->bdd->prepare("SELECT * FROM Spontanee");
		$req->execute();
		return $req->fetchAll();
	}

	public function supprimerSpontanee($id)
	{

		$req = $this->bdd->prepare("DELETE FROM Spontanee WHERE idSpontanee = ?");
		return $req->execute([$id]);
	}

    public function updateSpontanee($statut, $id)
    {
        $stmt = $this->bdd->prepare("UPDATE Spontanee SET statut = :statut WHERE idSpontanee = :id");
		$stmt->bindParam(':statut', $statut);
        $stmt->bindParam(':id', $id);
       return $stmt->execute();
    }

    public function getSpontaneeById($id) {
        $stmt = $this->bdd->prepare('SELECT * FROM Spontanee WHERE idCandidat = ?');
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

	public function getFileContent($idSpontanee, $type)
{
    // Define the allowed columns to prevent SQL injection
    $allowedColumns = ['cv', 'motivation', 'extraDoc'];
    if (!in_array($type, $allowedColumns)) {
        throw new Exception("Invalid file type.");
    }

    // Prepare the SQL statement to fetch the file content
    $stmt = $this->bdd->prepare("SELECT $type FROM Spontanee WHERE idSpontanee = :id");
    $stmt->bindParam(':id', $idSpontanee, PDO::PARAM_INT);
    $stmt->execute();

    // Return the BLOB content
    return $stmt->fetchColumn();
}


}


?>