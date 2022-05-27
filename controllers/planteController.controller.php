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

    public function afficherPlantesVA(){
        $plants = $this->planteManager->getPlantes();
        $date = date("m");
        if($date > "03" && $date < "06"){
            $imageAccueil='printemps';
        } else if($date > "06" && $date < "09"){
            $imageAccueil='ete';
        } else if($date > "09"){
            $imageAccueil='automne';
        } else {
            $imageAccueil='hivers';
        }
        require "views/accueil.view.php";
    }

    public function afficherPlante($id){
        $plant = $this->planteManager->getPlantById($id);
        require "views/afficherPlante.view.php";
    }

    public function ajoutPlante(){
        $famillesVegetaux = $this->planteManager->getFamillesVegetauxBd();
        $typesVegetaux = $this->planteManager->getTypesVegetauxBd();
        require "views/ajoutPlante.view.php";
    }

    public function ajoutPlanteValidation(){
        $file = $_FILES['image'];
        $repertoire = "public/images/plants/";
        $nomImageAjoute = Toolbox::ajoutImage($file,$repertoire);
        $this->planteManager->ajoutPlanteBd($_POST['titre'],$_POST['infosVegetal'],$_POST['plantationVegetal'],$nomImageAjoute, $_POST['idFamilleVegetal'], $_POST['idTypeVegetal']);
        
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
        $famillesVegetaux = $this->planteManager->getFamillesVegetauxBd();
        $typesVegetaux = $this->planteManager->getTypesVegetauxBd();
        require "views/modifierPlante.view.php";
    }

    public function modifierPlanteValidation(){
        $imageActuelle = $this->planteManager->getPlantById($_POST['identifiant'])->getImageVegetal();
        $file = $_FILES['image'];

        if($file['size'] > 0){
            unlink("public/images/plants/".$imageActuelle);
            $repertoire = "public/images/plants/";
            $nomImageAjoute = Toolbox::ajoutImage($file,$repertoire);
        } else {
            $nomImageAjoute = $imageActuelle;
        }
        $this->planteManager->modifierPlanteBD($_POST['identifiant'], $_POST['titre'], $_POST['infos'], $_POST['infoPlantation'], $nomImageAjoute, $_POST['idFamilleVegetal'], $_POST['idTypeVegetal']);
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

    public function recherche($recherche) {
        $this->planteManager = new PlantManager;
        $this->planteManager->getRecherche($recherche);
        $plants = $this->planteManager->getPlantes();
        $famillesVegetaux = $this->planteManager->getFamillesVegetauxBd();
        $typesVegetaux = $this->planteManager->getTypesVegetauxBd();
        require "views/plantesV.view.php";
    }

}