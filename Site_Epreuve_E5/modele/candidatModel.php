<?php

//CRUD

class Candidat
{
	
	function __construct($bdd)
	{
		$this->bdd = $bdd;
	}


	public function addCand($nom, $prenom, $adresse, $tel,$email,$mdp)
	{
        $hashPassword=sha1($mdp);
		$req = $this->bdd->prepare("INSERT INTO Candidat (Nom, Prenom, Adresse, Tel,Email,Mdp) VALUES (:nom , :prenom, :adresse, :tel,:email,:mdp)");
		$req->bindParam(':nom', $nom);
		$req->bindParam(':prenom', $prenom);
		$req->bindParam(':adresse', $adresse);
		$req->bindParam(':tel', $tel);
        $req->bindParam(':email', $email);
        $req->bindParam(':mdp', $hashPassword);

		return $req->execute();
	}



	public function allCand()
	{
		$req = $this->bdd->prepare("SELECT * FROM Candidat");
		$req->execute();
		return $req->fetchAll();
	}

	public function deleteCand($idC)
	{

		$req = $this->bdd->prepare("DELETE FROM Candidat WHERE idCandidat = ?");
		return $req->execute([$idC]);
	}

    //pas de update pour le mdp on la fait seule vu que changer ses infos et son mdp ça sera séparé 
    public function updateCand($nom, $prenom, $adresse, $tel,$email, $idC)
    {
        $stmt = $this->bdd->prepare("UPDATE Candidat SET nom = :nom, prenom = :prenom ,
        	adresse= :adresse, tel = :tel,email=:email WHERE idCandidat = :idC");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':idC', $idC);
       return $stmt->execute();
    }

    public function updateMdp($mdp, $idC)
    {
        $hashPassword=sha1($mdp);
        $stmt = $this->bdd->prepare("UPDATE Candidat SET mdp = :mdp WHERE idCandidat = :idC");
        $stmt->bindParam(':mdp', $hashPassword);
        $stmt->bindParam(':idC', $idC);
       return $stmt->execute();
    }

    public function getCandById($email) {
        $stmt = $this->bdd->prepare("SELECT * FROM Candidat WHERE email = ?");
        $stmt->execute([$email]);
        $candidat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $candidat ?: null; // Retourne null si aucun résultat trouvé
    }
    

}
