<?php
require_once "utilisateur.class.php";
require_once "connection_bdd.class.php";
class UtilisateurManager extends Model{

    public function comparerUtilisateurMailPseudoBD($mailUtilisateur, $pseudoUtilisateur){
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
    }

}
