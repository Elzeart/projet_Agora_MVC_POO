<?php
require_once "models/planteManager.class.php";

class PlanteController{
    private $planteManager;

    public function __construct(){
        $this->planteManager = new PlantManager;
        $this->planteManager->chargementPlantes();
    }

    public function modifierPlante($id){
        $plant = $this->planteManager->getPlantById($id);
        $famillesVegetaux = $this->planteManager->getFamillesVegetauxBd();
        $typesVegetaux = $this->planteManager->getTypesVegetauxBd();
        $idVegetal = $plant->getIdVegetal();
        $typeFamillePlant = $this->planteManager->getFamilleTypeVegetauxPlant($idVegetal);
        $familleVegetalEnCours = $this->planteManager->getFamillePlant($plant->getIdFamilleVegetal());
        require "views/modifierPlante.view.php";
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
        if($date >= "03" && $date < "06"){
            $imageAccueil='printemps';
        } else if($date >= "06" && $date < "09"){
            $imageAccueil='ete';
        } else if($date >= "09"){
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

    public function ajoutPlanteValidation($titre,$infosVegetal,$plantationVegetal,$idFamilleVegetal,$idTypeVegetal){
        $idUtilisateur = $_SESSION['profil']['idUtilisateur'];
        $file = $_FILES['image'];
        $repertoire = "public/images/plants/";
        $nomImageAjoute = Toolbox::ajoutImage($file,$repertoire);
        /* Ajout ici du set. Puis mettre les this-> dans les managers */
/*         $plant = new Vegetal($vegetal['idVegetal'],$titre,$infosVegetal,$plantationVegetal,$nomImageAjoute,$idFamilleVegetal); */
        $this->planteManager->ajoutPlanteBd($titre,$infosVegetal,$plantationVegetal,$nomImageAjoute,$idFamilleVegetal,$idTypeVegetal, $idUtilisateur);
        $_SESSION['alert'] = [
            "type" => "success",
            "message" => "Ajout Réalisé"
        ];
        header('Location: '. URL . "admin/pAdmin");
    }

    public function supprimerPlante($id){
        $nomImage = $this->planteManager->getPlantById($id)->getImageVegetal();
        unlink("public/images/".$nomImage);
        $this->planteManager->supprimerPlanteBD($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "message" => "Suppression Réalisée"
        ];
        header('Location: '. URL . "admin/pAdmin");
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
        $this->planteManager->modifierPlanteBD($_POST['identifiant'], $_POST['titre'], $_POST['infos'], $_POST['infoPlantation'], 
        $nomImageAjoute, $_POST['idFamilleVegetal'], $_POST['idTypeVegetal']);
        $_SESSION['alert'] = [
            "type" => "success",
            "message" => "Modification Réalisée"
        ];
        header('Location: '. URL . "admin/pAdmin");
    }

    public function afficherPlanteParFamille($idFamilleVegetal){
        $this->planteManager = new PlantManager;
        $this->planteManager->getFamilleVegetauxBd($idFamilleVegetal);
        $plants = $this->planteManager->getPlantes();
        $famillesVegetaux = $this->planteManager->getFamillesVegetauxBd();
        $typesVegetaux = $this->planteManager->getTypesVegetauxBd();
        require "views/plantesV.view.php";
    }

    public function afficherPlanteParType($idTypeVegetal){
        $this->planteManager = new PlantManager;
        $this->planteManager->getTypeVegetauxBd($idTypeVegetal);
        $plants = $this->planteManager->getPlantes();
        $typesVegetaux = $this->planteManager->getTypesVegetauxBd();
        $famillesVegetaux = $this->planteManager->getFamillesVegetauxBd();
        require "views/plantesV.view.php";
    }

    public function afficherPlanteParFamilleEtType($idFamilleVegetal,$idTypeVegetal){
        $this->planteManager = new PlantManager;
        $this->planteManager->getFamilleEtTypeVegetauxBd($idFamilleVegetal,$idTypeVegetal);
        $plants = $this->planteManager->getPlantes();
        $typesVegetaux = $this->planteManager->getTypesVegetauxBd();
        $famillesVegetaux = $this->planteManager->getFamillesVegetauxBd();
        require "views/plantesV.view.php";
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