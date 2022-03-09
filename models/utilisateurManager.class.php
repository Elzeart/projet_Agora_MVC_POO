<?php
require_once "utilisateur.class.php";
require_once "connexion_bdd.class.php";
class UtilisateurManager extends Model{

    private function recupMdpUtilisateur($pseudoUtilisateur){
        $req = "SELECT mdpUtilisateur FROM utilisateurs WHERE pseudoUtilisateur = :pseudoUtilisateur";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":pseudoUtilisateur", $pseudoUtilisateur,PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['mdpUtilisateur'];
    }

    public function combinaisonValide($pseudo,$mdp){
        $mdpBD = $this->recupMdpUtilisateur($pseudo);
        return password_verify($mdp,$mdpBD);
    }

    public function compteActive($pseudoUtilisateur){
        $req = "SELECT activationCode FROM utilisateurs WHERE pseudoUtilisateur = :pseudoUtilisateur";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":pseudoUtilisateur", $pseudoUtilisateur,PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return ($resultat['activationCode'] == 1);
    }

    public function getUtilisateurInformation($pseudoUtilisateur){
        $req = "SELECT * FROM utilisateurs WHERE pseudoUtilisateur = :pseudoUtilisateur";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":pseudoUtilisateur", $pseudoUtilisateur,PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function verifPseudoDisponible($pseudoUtilisateur){
        $utilisateur = $this->getUtilisateurInformation($pseudoUtilisateur);
        return empty($utilisateur);

    }

    public function bdCreerCompte($pseudoUtilisateur, $mdpCrypte, $mailUtilisateur, $clef, $imageUtilisateur, $idDroit){
        $req = "INSERT INTO utilisateurs (pseudoUtilisateur, mdpUtilisateur, mailUtilisateur, activationCode, clef, imageUtilisateur, idDroit) 
        VALUES (:pseudoUtilisateur, :mdpUtilisateur, :mailUtilisateur, 0, :clef, :imageUtilisateur, :idDroit)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":pseudoUtilisateur", $pseudoUtilisateur,PDO::PARAM_STR);
        $stmt->bindValue(":mdpUtilisateur", $mdpCrypte,PDO::PARAM_STR);
        $stmt->bindValue(":mailUtilisateur", $mailUtilisateur,PDO::PARAM_STR);
        $stmt->bindValue(":clef", $clef,PDO::PARAM_INT);
        $stmt->bindValue(":imageUtilisateur", $imageUtilisateur,PDO::PARAM_STR);
        $stmt->bindValue(":idDroit", $idDroit,PDO::PARAM_INT);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdValidationCompte($pseudoUtilisateur, $clef){
        $req = "UPDATE utilisateurs set activationCode = 1 WHERE pseudoUtilisateur = :pseudoUtilisateur and clef = :clef";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":pseudoUtilisateur", $pseudoUtilisateur, PDO::PARAM_STR);
        $stmt->bindValue(":clef", $clef, PDO::PARAM_INT);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdModificationMailUtilisateur($pseudoUtilisateur, $mailUtilisateur){
        $req = "UPDATE utilisateurs set mailUtilisateur = :mailUtilisateur WHERE pseudoUtilisateur = :pseudoUtilisateur";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindParam(':mailUtilisateur', $mailUtilisateur, PDO::PARAM_STR);
        $stmt->bindParam(':pseudoUtilisateur', $pseudoUtilisateur, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdModificationMdpUtilisateur($pseudoUtilisateur, $mdpHash){
        $req = "UPDATE utilisateurs set mdpUtilisateur = :mdpUtilisateur WHERE pseudoUtilisateur = :pseudoUtilisateur";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindParam(':mdpUtilisateur', $mdpHash, PDO::PARAM_STR);
        $stmt->bindParam(':pseudoUtilisateur', $pseudoUtilisateur, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdSuppressionCompte($pseudoUtilisateur){
        $req = "DELETE FROM utilisateurs WHERE pseudoUtilisateur = :pseudoUtilisateur";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindParam(':pseudoUtilisateur', $pseudoUtilisateur, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdAjoutImage($pseudoUtilisateur, $nomImageBd){
        $req = "UPDATE utilisateurs set imageUtilisateur = :imageUtilisateur WHERE pseudoUtilisateur = :pseudoUtilisateur";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":pseudoUtilisateur", $pseudoUtilisateur,PDO::PARAM_STR);
        $stmt->bindValue(":imageUtilisateur", $nomImageBd,PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function getImageUtilisateur($pseudoUtilisateur){
        $req = "SELECT imageUtilisateur FROM utilisateurs WHERE pseudoUtilisateur = :pseudoUtilisateur";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":pseudoUtilisateur", $pseudoUtilisateur,PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['imageUtilisateur'];
    }

    public function getUtilisateurs(){
        $req = "SELECT * FROM utilisateurs";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    }

    public function bdModificationDroitUtilisateur($pseudoUtilisateur, $idDroit){
        $req = "UPDATE utilisateurs set idDroit = :idDroit WHERE pseudoUtilisateur = :pseudoUtilisateur";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":pseudoUtilisateur", $pseudoUtilisateur,PDO::PARAM_STR);
        $stmt->bindValue(":idDroit", $idDroit,PDO::PARAM_INT);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    

}
