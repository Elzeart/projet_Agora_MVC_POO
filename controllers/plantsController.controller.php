<?php
require_once "models/plantsManager.class.php";

class PlantsController{
    private $plantManager;

    public function __construct(){
        $this->plantManager = new PlantManager;
        $this->plantManager->chargementPlants();
    }

    public function afficherPlants(){
        $plants = $this->plantManager->getPlants();
        require "views/plants.admin.view.php";
    }

    public function afficherPlantsV(){
        $plants = $this->plantManager->getPlants();
        require "views/plantsV.view.php";
    }

    public function afficherPlant($id){
        $plant = $this->plantManager->getPlantById($id);
        require "views/afficherPlant.view.php";
    }

    public function ajoutPlant(){
        require "views/ajoutPlant.view.php";
    }

    public function ajoutPlantValidation(){
        $file = $_FILES['image'];
        $repertoire = "public/images/";
        $nomImageAjoute = $this->ajoutImage($file,$repertoire);
        $this->plantManager->ajoutPlantBd($_POST['titre'],$_POST['infosVegetal'],$_POST['plantationVegetal'],$nomImageAjoute);
        
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Ajout Réalisé"
        ];
        
        header('Location: '. URL . "admin/pAdmin");
    }

    public function removePlant($id){
        $nomImage = $this->plantManager->getPlantById($id)->getImageVegetal();
        unlink("public/images/".$nomImage);
        $this->plantManager->removePlantBD($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Suppression Réalisée"
        ];
        header('Location: '. URL . "admin/pAdmin");
    }

    public function modifyPlant($id){
        $plant = $this->plantManager->getPlantById($id);
        require "views/modifyPlant.view.php";
    }

    public function modifyPlantValidation(){
        $imageActuelle = $this->plantManager->getPlantById($_POST['identifiant'])->getImageVegetal();
        $file = $_FILES['image'];

        if($file['size'] > 0){
            unlink("public/images/".$imageActuelle);
            $repertoire = "public/images/";
            $nomImageAjoute = $this->ajoutImage($file,$repertoire);
        } else {
            $nomImageAjoute = $imageActuelle;
        }
        $this->plantManager->modifyPlantBD($_POST['identifiant'], $_POST['titre'], $_POST['infos'], $nomImageAjoute);
        header('Location: '. URL . "admin/pAdmin");
    }

    private function ajoutImage($file, $dir){
        if(!isset($file['name']) || empty($file['name']))
            throw new Exception("Vous devez indiquer une image");
    
        if(!file_exists($dir)) mkdir($dir,0777);
    
        $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        $random = rand(0,99999);
        $target_file = $dir.$random."_".$file['name'];
        
        if(!getimagesize($file["tmp_name"]))
            throw new Exception("Le fichier n'est pas une image");
        if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
            throw new Exception("L'extension du fichier n'est pas reconnu");
        if(file_exists($target_file))
            throw new Exception("Le fichier existe déjà");
        if($file['size'] > 500000)
            throw new Exception("Le fichier est trop gros");
        if(!move_uploaded_file($file['tmp_name'], $target_file))
            throw new Exception("l'ajout de l'image n'a pas fonctionné");
        else return ($random."_".$file['name']);
    }

}