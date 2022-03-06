<?php
require_once "models/planteManager.class.php";

class PlanteController{
    private $planteManager;

    public function __construct(){
        $this->planteManager = new PlantManager;
        $this->planteManager->chargementPlantes();
    }

    public function afficherPlantes(){
        $plants = $this->planteManager->getPlantes();
        require "views/plantes.admin.view.php";
    }

    public function afficherPlantesV(){
        $plants = $this->planteManager->getPlantes();
        $famillesVegetaux = $this->planteManager->getFamillesVegetauxBd();
        $typesVegetaux = $this->planteManager->getTypesVegetauxBd();
        require "views/plantesV.view.php";
    }
/* 
    public function afficherParFamilleVegetal(){
        $resultat = $this->planteManager->getFamilleVegetalBd();
    } */


    public function afficherPlante($id){
        $plant = $this->planteManager->getPlantById($id);
        require "views/afficherPlante.view.php";
    }

    public function ajoutPlante(){
        require "views/ajoutPlante.view.php";
    }

    public function ajoutPlanteValidation(){
        $file = $_FILES['image'];
        $repertoire = "public/images/";
        $nomImageAjoute = $this->ajoutImage($file,$repertoire);
        $this->planteManager->ajoutPlanteBd($_POST['titre'],$_POST['infosVegetal'],$_POST['plantationVegetal'],$nomImageAjoute);
        
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Ajout Réalisé"
        ];
        
        header('Location: '. URL . "admin/pAdmin");
    }

    public function supprimerPlante($id){
        $nomImage = $this->planteManager->getPlantById($id)->getImageVegetal();
        unlink("public/images/".$nomImage);
        $this->planteManager->supprimerPlanteBD($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Suppression Réalisée"
        ];
        header('Location: '. URL . "admin/pAdmin");
    }

    public function modifierPlante($id){
        $plant = $this->planteManager->getPlantById($id);
        require "views/modifierPlante.view.php";
    }

    public function modifierPlanteValidation(){
        $imageActuelle = $this->planteManager->getPlantById($_POST['identifiant'])->getImageVegetal();
        $file = $_FILES['image'];

        if($file['size'] > 0){
            unlink("public/images/".$imageActuelle);
            $repertoire = "public/images/";
            $nomImageAjoute = $this->ajoutImage($file,$repertoire);
        } else {
            $nomImageAjoute = $imageActuelle;
        }
        $this->planteManager->modifierPlanteBD($_POST['identifiant'], $_POST['titre'], $_POST['infos'], $nomImageAjoute);
        header('Location: '. URL . "admin/pAdmin");
    }

    public function afficherPlanteParFamille($idFamilleVegetal){
        $familleVegetaux = $this->planteManager->getFamilleVegetauxBd($idFamilleVegetal);
        $famillesVegetaux = $this->planteManager->getFamillesVegetauxBd();
        $typesVegetaux = $this->planteManager->getTypesVegetauxBd();
        require "views/plantesParFamille.view.php";
    }

    public function afficherPlanteParType($idTypeVegetal){
        $typeVegetaux = $this->planteManager->getTypeVegetauxBd($idTypeVegetal);
        $typesVegetaux = $this->planteManager->getTypesVegetauxBd();
        $famillesVegetaux = $this->planteManager->getFamillesVegetauxBd();
        require "views/plantesParType.view.php";
    }

    public function afficherPlanteParFamilleEtType($idFamilleVegetal,$idTypeVegetal){
        $familleEtTypeVegetaux = $this->planteManager->getFamilleEtTypeVegetauxBd($idFamilleVegetal,$idTypeVegetal);
        $typesVegetaux = $this->planteManager->getTypesVegetauxBd();
        $famillesVegetaux = $this->planteManager->getFamillesVegetauxBd();
        require "views/plantesParFamilleEtType.view.php";
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