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
            $l = new Vegetal($vegetal['idVegetal'],$vegetal['nomVegetal'],$vegetal['infosVegetal'],
            $vegetal['plantationVegetal'],$vegetal['imageVegetal']);
            $this->ajoutPlante($l);
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

    public function ajoutPlanteBd($titre,$infosVegetal,$plantationVegetal,$image){
        $req = "
        INSERT INTO vegetaux (nomVegetal, infosVegetal, plantationVegetal, imageVegetal)
        values (:nomVegetal, :infosVegetal, :plantationVegetal, :imageVegetal)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":nomVegetal",$titre,PDO::PARAM_STR);
        $stmt->bindValue(":infosVegetal",$infosVegetal,PDO::PARAM_STR);
        $stmt->bindValue(":plantationVegetal",$plantationVegetal,PDO::PARAM_STR);
        $stmt->bindValue(":imageVegetal",$image,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $plant = new Vegetal($this->getBdd()->lastInsertId(),$titre,$infosVegetal,$plantationVegetal,$image);
            $this->ajoutPlante($plant);
        }        
    }

    // Requête php my admin     DELETE vegetaux FROM `vegetaux` INNER JOIN appartenir ON vegetaux.idVegetal = appartenir.idVegetal INNER JOIN typevegetaux ON typevegetaux.idTypeVegetal = appartenir.idTypeVegetal WHERE `vegetaux`.`idVegetal` = 6; 
    /* $req = "
    DELETE vegetaux FROM vegetaux 
    INNER JOIN appartenir ON vegetaux.idVegetal = appartenir.idVegetal 
    INNER JOIN typevegetaux ON typevegetaux.idTypeVegetal = appartenir.idTypeVegetal 
    WHERE vegetaux.idVegetal = :idVegetal"; */
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
        if($resultat > 0){
            $plant = $this->getPlantById($id);
            unset($plant);
        }
    }

    public function modifierPlanteBD($id, $titre, $infos, $image){
        $req = "
        UPDATE vegetaux 
        SET nomVegetal = :nomVegetal, infosVegetal = :infosVegetal, imageVegetal = :imageVegetal 
        WHERE idVegetal = :idVegetal
        ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idVegetal",$id,PDO::PARAM_INT);
        $stmt->bindValue(":nomVegetal",$titre,PDO::PARAM_STR);
        $stmt->bindValue(":infosVegetal",$infos,PDO::PARAM_STR);
        $stmt->bindValue(":imageVegetal",$image,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
/*             $this->getPlantById($id)->setNomVegetal($titre);
            $this->getPlantById($id)->setNomVegetal($infos);
            $this->getPlantById($id)->setNomVegetal($image); */
            $this->getPlantById($id)->setNomVegetal($titre);
            $this->getPlantById($id)->setinfosVegetal($infos);
            $this->getPlantById($id)->setImageVegetal($image);
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

    //SELECT * FROM `vegetaux` WHERE idFamilleVegetal = 1
    public function getFamilleVegetauxBd($idFamilleVegetal){
        $req = "SELECT * FROM vegetaux WHERE idFamilleVegetal = :idFamilleVegetal ORDER BY nomVegetal"; 
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idFamilleVegetal",$idFamilleVegetal,PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    // SELECT * FROM `vegetaux` 
    // INNER JOIN appartenir ON vegetaux.idVegetal = appartenir.idVegetal
    // INNER JOIN typevegetaux ON typevegetaux.idTypeVegetal = appartenir.idTypeVegetal
    // WHERE typevegetaux.idTypeVegetal = 3;
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
        return $resultat;
    }

    // ok avec query au lieu de prepare
/*     public function getTypeVegetauxBd($idTypeVegetal){
        $req = "SELECT * FROM vegetaux 
        INNER JOIN appartenir ON vegetaux.idVegetal = appartenir.idVegetal 
        INNER JOIN typevegetaux ON typevegetaux.idTypeVegetal = appartenir.idTypeVegetal
        WHERE typevegetaux.idTypeVegetal = $idTypeVegetal"; 
        $stmt = $this->getBdd()->query($req);
        //$stmt->bindValue(":idTypeVegetal",$idTypeVegetal,PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    } */

    //SELECT * FROM `vegetaux` 
    //INNER JOIN appartenir ON vegetaux.idVegetal = appartenir.idVegetal 
    //INNER JOIN typevegetaux ON typevegetaux.idTypeVegetal = appartenir.idTypeVegetal 
    //WHERE typevegetaux.idTypeVegetal = 3 AND vegetaux.idFamilleVegetal = 3; 

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
        return $resultat;
    }


/*     $data = array();

if($received_data->query != '')
{
    $query="SELECT * FROM utilisateurs WHERE nomUtilisateur LIKE '%".$received_data->query."%' ORDER BY idUtilisateur DESC ";
}
else
{
	$query = "SELECT * FROM utilisateurs ORDER BY idUtilisateur DESC";
}

$statement = $bdd->prepare($query);
$statement->execute();
while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	$data[] = $row;
} */


}
