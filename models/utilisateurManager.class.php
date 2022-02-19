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
        // return ($resultat['activationCode'] === 1) ? true : false;
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

    public function bdCreerCompte($pseudoUtilisateur, $mdpCrypte, $mailUtilisateur, $clef){
        $req = "INSERT INTO utilisateurs (pseudoUtilisateur, mdpUtilisateur, mailUtilisateur, activationCode, clef) 
        VALUES (:pseudoUtilisateur, :mdpUtilisateur, :mailUtilisateur, 0, :clef)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":pseudoUtilisateur", $pseudoUtilisateur,PDO::PARAM_STR);
        $stmt->bindValue(":mdpUtilisateur", $mdpCrypte,PDO::PARAM_STR);
        $stmt->bindValue(":mailUtilisateur", $mailUtilisateur,PDO::PARAM_STR);
        $stmt->bindValue(":clef", $clef,PDO::PARAM_INT);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

/*     public function comparerUtilisateurMailPseudoBD($mailUtilisateur, $pseudoUtilisateur){
        $sql = "SELECT * FROM utilisateurs WHERE mailUtilisateur = :mailUtilisateur";
        $req = $this->getBdd()->prepare($sql);
        $result = $req->execute([
            ":mailUtilisateur"=>$mailUtilisateur
        ]);
        $data = $req->fetch(PDO::FETCH_OBJ);
        if (empty($data)){
            $sql2 = "SELECT * FROM utilisateurs WHERE pseudoUtilisateur = :pseudoUtilisateur";
            $req2 = $this->getBdd()->prepare($sql2);
            $result2 = $req2->execute([
                ":pseudoUtilisateur"=>$pseudoUtilisateur
            ]);
            $data2 = $req2->fetch(PDO::FETCH_OBJ);
            if(empty($data2)){
                $utilisateur = new Utilisateur($data2->idUtilisateur, $data2->nomUtilisateur, $data2->prenomUtilisateur, $data2->pseudoUtilisateur, $data2->mailUtilisateur, $data2->mdpUtilisateur);
                return $utilisateur;
            }
            else{
                // return null;
                echo "<script language=javascript> alert('Ce pseudo est déjà utilisé'); </script>";
                header('Location: '. URL . "inscription");
            }
            // $user = new User($data->id_user,$data->pseudo,$data->password,$data->id_role);
            // return $user;
        }
        else{
            //return null;
            echo "<script language=javascript> alert('Ce mail est déjà utilisé'); </script>";
            header('Location: '. URL . "inscription");
        }
    }

    public function insererUtilisateurDB($nomUtilisateur, $prenomUtilisateur, $pseudoUtilisateur, $mailUtilisateur, $mdpUtilisateur){
        $sql = "INSERT INTO utilisateurs (nomUtilisateur, prenomUtilisateur, pseudoUtilisateur, mailUtilisateur, mdpUtilisateur) VALUES (:nomUtilisateur, :prenomUtilisateur, :pseudoUtilisateur, :mailUtilisateur, :mdpUtilisateur)";
        $req = $this->getBdd()->prepare($sql);
        $result = $req->execute([
            ":nomUtilisateur"=>$nomUtilisateur,
            ":prenomUtilisateur"=>$prenomUtilisateur,
            ":pseudoUtilisateur"=>$pseudoUtilisateur,
            ":mailUtilisateur"=>$mailUtilisateur,
            ":mdpUtilisateur"=>$mdpUtilisateur,
        ]);
        return $result;
    }
    
    public function lastId(){
        $lastId = $this->getBdd()->lastInsertId();
        return $lastId;
    } */

}
