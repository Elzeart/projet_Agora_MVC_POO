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
        $req = $this->getBdd()->prepare("SELECT * FROM vegetaux");
        $req->execute();
        $lesVegetaux = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        /* var_dump($lesVegetaux); */
        foreach($lesVegetaux as $vegetal){
            $l = new Vegetal($vegetal['idVegetal'],$vegetal['nomVegetal'],$vegetal['infosVegetal'],$vegetal['plantationVegetal'],$vegetal['imageVegetal']);
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

    public function supprimerPlanteBD($id){
        $req = "
        Delete from vegetaux where idVegetal = :idVegetal
        ";
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

}
