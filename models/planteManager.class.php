<?php

require_once "connexion_bdd.class.php";
require_once "plante.class.php";

class PlantManager extends Model{
    private $plants;

    public function ajoutPlante($plant){
        $this->plants[] = $plant;
    }

    public function getPlantes(){
        return $this->plants;
    }

    public function chargementPlantes(){
        $req = $this->getBdd()->prepare("SELECT * FROM vegetaux ORDER BY nomVegetal");
        $req->execute();
        $lesVegetaux = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        foreach($lesVegetaux as $vegetal){
            $plant = new Vegetal($vegetal['idVegetal'],$vegetal['nomVegetal'],$vegetal['infosVegetal'],
            $vegetal['plantationVegetal'],$vegetal['imageVegetal'], $vegetal['idFamilleVegetal']);
            $this->ajoutPlante($plant);
        }
    }

    public function getRecherche($recherche){
        $req = "SELECT * FROM vegetaux WHERE nomVegetal LIKE :nomVegetal ORDER BY nomVegetal"; 
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":nomVegetal","%$recherche%",PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        foreach($resultat as $vegetal){
            $plant = new Vegetal($vegetal['idVegetal'],$vegetal['nomVegetal'],$vegetal['infosVegetal'],
            $vegetal['plantationVegetal'],$vegetal['imageVegetal'], $vegetal['idFamilleVegetal']);
            $this->ajoutPlante($plant);
        }
    }

    public function getPlantById($id){
        for($i=0; $i < count($this->plants);$i++){
            if($this->plants[$i]->getIdVegetal() === $id){
                return $this->plants[$i];
            }
        }
        throw new Exception("La plante n'existe pas");
    }

    public function ajoutPlanteBd($titre,$infosVegetal,$plantationVegetal,$image, $idFamilleVegetal, $idTypeVegetal, $idUtilisateur){
        $req = "
        INSERT INTO vegetaux (nomVegetal, infosVegetal, plantationVegetal, imageVegetal, idFamilleVegetal, idUtilisateur)
        values (:nomVegetal, :infosVegetal, :plantationVegetal, :imageVegetal, :idFamilleVegetal, :idUtilisateur)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":nomVegetal",$titre,PDO::PARAM_STR);
        $stmt->bindValue(":infosVegetal",$infosVegetal,PDO::PARAM_STR);
        $stmt->bindValue(":plantationVegetal",$plantationVegetal,PDO::PARAM_STR);
        $stmt->bindValue(":imageVegetal",$image,PDO::PARAM_STR);
        $stmt->bindValue(":idFamilleVegetal",$idFamilleVegetal,PDO::PARAM_INT);
        $stmt->bindValue(":idUtilisateur",$idUtilisateur,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        // Facultatif ?
        if($resultat > 0){
            $lastInsertId = $this->getBdd()->lastInsertId();
            $plant = new Vegetal($lastInsertId,$titre,$infosVegetal,$plantationVegetal,$image, $idFamilleVegetal);
            $this->ajoutPlante($plant);

            $req = "
            INSERT INTO appartenir (idTypeVegetal, idVegetal)
            values (:idTypeVegetal, :idVegetal)";
            $stmt = $this->getBdd()->prepare($req);
            $stmt->bindValue(":idTypeVegetal",$idTypeVegetal,PDO::PARAM_INT);
            $stmt->bindValue(":idVegetal",$lastInsertId,PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
        }        
    }

    public function supprimerPlanteBD($id){
        $req = "
        DELETE vegetaux FROM vegetaux 
        INNER JOIN appartenir ON vegetaux.idVegetal = appartenir.idVegetal 
        INNER JOIN typevegetaux ON typevegetaux.idTypeVegetal = appartenir.idTypeVegetal 
        WHERE vegetaux.idVegetal = :idVegetal";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idVegetal",$id,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        // Facultatif ?
        if($resultat > 0){
            $plant = $this->getPlantById($id);
            unset($plant);
        }
    }

    public function modifierPlanteBD($id, $titre, $infos, $infoPlantation, $image, $idFamilleVegetal, $idTypeVegetal){
        $req = "
        UPDATE vegetaux 
        SET nomVegetal = :nomVegetal, infosVegetal = :infosVegetal, plantationVegetal = :plantationVegetal, imageVegetal = :imageVegetal, idFamilleVegetal = :idFamilleVegetal 
        WHERE idVegetal = :idVegetal
        ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idVegetal",$id,PDO::PARAM_INT);
        $stmt->bindValue(":nomVegetal",$titre,PDO::PARAM_STR);
        $stmt->bindValue(":infosVegetal",$infos,PDO::PARAM_STR);
        $stmt->bindValue(":plantationVegetal",$infoPlantation,PDO::PARAM_STR);
        $stmt->bindValue(":imageVegetal",$image,PDO::PARAM_STR);
        $stmt->bindValue(":idFamilleVegetal",$idFamilleVegetal,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        $req2 = "
            UPDATE appartenir SET idTypeVegetal = :idTypeVegetal
            WHERE idVegetal = :idVegetal
            ";
        $stmt = $this->getBdd()->prepare($req2);
        $stmt->bindValue(":idTypeVegetal",$idTypeVegetal,PDO::PARAM_INT);
        $stmt->bindValue(":idVegetal",$id,PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        // Facultatif ?
        if($resultat > 0){
            $this->getPlantById($id)->setNomVegetal($titre);
            $this->getPlantById($id)->setinfosVegetal($infos);
            $this->getPlantById($id)->setImageVegetal($image);
            $this->getPlantById($id)->setPlantationVegetal($infoPlantation);
            $this->getPlantById($id)->setFamilleVegetal($idFamilleVegetal);
        }
    }

    public function getFamillesVegetauxBd(){
        $req = "SELECT * FROM familleVegetaux ORDER BY nomFamilleVegetal"; 
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function getTypesVegetauxBd(){
        $req = "SELECT * FROM typeVegetaux ORDER BY nomTypeVegetal"; 
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function getFamilleVegetauxBd($idFamilleVegetal){
        $req = "SELECT * FROM vegetaux WHERE idFamilleVegetal = :idFamilleVegetal ORDER BY nomVegetal"; 
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idFamilleVegetal",$idFamilleVegetal,PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        // Facultatif ?
        foreach($resultat as $vegetal){
            $plant = new Vegetal($vegetal['idVegetal'],$vegetal['nomVegetal'],$vegetal['infosVegetal'],
            $vegetal['plantationVegetal'],$vegetal['imageVegetal'], $vegetal['idFamilleVegetal']);
            $this->ajoutPlante($plant);
        }
    }

    public function getTypeVegetauxBd($idTypeVegetal){
        $req = "SELECT * FROM vegetaux 
        INNER JOIN appartenir ON vegetaux.idVegetal = appartenir.idVegetal 
        INNER JOIN typevegetaux ON typevegetaux.idTypeVegetal = appartenir.idTypeVegetal
        WHERE typevegetaux.idTypeVegetal = :idTypeVegetal
        ORDER BY nomVegetal";  
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idTypeVegetal",$idTypeVegetal,PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        // Facultatif ?
        foreach($resultat as $vegetal){
            $plant = new Vegetal($vegetal['idVegetal'],$vegetal['nomVegetal'],$vegetal['infosVegetal'],
            $vegetal['plantationVegetal'],$vegetal['imageVegetal'], $vegetal['idFamilleVegetal']);
            $this->ajoutPlante($plant);
        }
    }

    public function getFamilleEtTypeVegetauxBd($idFamilleVegetal,$idTypeVegetal){
        $req = "SELECT * FROM vegetaux 
        INNER JOIN appartenir ON vegetaux.idVegetal = appartenir.idVegetal 
        INNER JOIN typevegetaux ON typevegetaux.idTypeVegetal = appartenir.idTypeVegetal
        WHERE typevegetaux.idTypeVegetal = :idTypeVegetal AND vegetaux.idFamilleVegetal = :idFamilleVegetal
        ORDER BY nomVegetal";  
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idTypeVegetal",$idTypeVegetal,PDO::PARAM_INT);
        $stmt->bindValue(":idFamilleVegetal",$idFamilleVegetal,PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        // Facultatif ?
        foreach($resultat as $vegetal){
            $plant = new Vegetal($vegetal['idVegetal'],$vegetal['nomVegetal'],$vegetal['infosVegetal'],
            $vegetal['plantationVegetal'],$vegetal['imageVegetal'], $vegetal['idFamilleVegetal']);
            $this->ajoutPlante($plant);
        }
    }

    public function getFamilleTypeVegetauxPlant($idVegetal){
        $req = "SELECT * FROM typevegetaux 
        INNER JOIN appartenir ON appartenir.idTypeVegetal = typevegetaux.idTypeVegetal
        INNER JOIN vegetaux ON vegetaux.idVegetal = appartenir.idVegetal
        WHERE vegetaux.idVegetal = :idVegetal";  
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idVegetal",$idVegetal,PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function getFamillePlant($idFamilleVegetal){
        $req = "SELECT * FROM famillevegetaux 
        WHERE idFamilleVegetal = :idFamilleVegetal";  
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idFamilleVegetal",$idFamilleVegetal,PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }

    // Rappel sur la syntaxe phpmyadmin
    /* SELECT * FROM `typevegetaux` 
    INNER JOIN `appartenir` ON `appartenir`.idTypeVegetal = `typevegetaux`.idTypeVegetal
    INNER JOIN `vegetaux` ON `vegetaux`.idVegetal = `appartenir`.idVegetal
    WHERE `vegetaux`.idVegetal = 2; */
    /* SELECT * FROM `famillevegetaux` 
    WHERE idFamilleVegetal = 2;  */

}
