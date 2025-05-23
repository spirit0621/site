<?php

class Manager
{
	
	function __construct($bdd)
	{
		$this->bdd = $bdd;
	}

    public function getManById($email, $mdp) {
        $stmt = $this->bdd->prepare("SELECT * FROM Manager WHERE email = ?");
        $stmt->execute([$email]);
        $manager = $stmt->fetch(PDO::FETCH_ASSOC);
        return $manager ?: null; // Retourne null si aucun résultat trouvé
    }

    public function updateMdp($mdp, $idM)
    {
        $hashPassword=sha1($mdp);
        $stmt = $this->bdd->prepare("UPDATE Manager SET mdp = :mdp WHERE idManager = :idM");
        $stmt->bindParam(':mdp', $hashPassword);
        $stmt->bindParam(':idM', $idM);
       return $stmt->execute();
    }
}
