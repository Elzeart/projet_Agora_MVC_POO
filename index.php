<?php
session_start();

define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "controllers/planteController.controller.php";
require_once "controllers/utilisateurController.controller.php";
$planteController = new PlanteController;
$utilisateurController = new UtilsateurController;

try{
    if(empty($_GET['page'])){
        require "views/accueil.view.php";
    } else {
        $url = explode("/", filter_var($_GET['page']),FILTER_SANITIZE_URL);

        switch($url[0]){
            case "accueil" : 
                require "views/accueil.view.php";
            break;
            case "vegetaux" : 
                if(empty($url[1])){
                    $planteController->afficherPlantesV();
                } else if($url[1] === "p") {
                    $planteController->afficherPlante($url[2]);
                } /* else if($url[1] === "a") {
                    $plantController->ajoutPlant();
                } else if($url[1] === "av") {
                    $plantController->ajoutPlantValidation();
                } else if($url[1] === "m") {
                    $plantController->modifyPlant($url[2]);
                } else if($url[1] === "mv") {
                    $plantController->modifyPlantValidation();
                } else if($url[1] === "s") {
                    $plantController->removePlant($url[2]);
                } */ else {
                    throw new Exception("La page n'existe pas. Erreur 404 !!!");
                }
            break;
            case "trocs" : 
                require "views/trocs.view.php";
            break;
            case "contact" : 
                require "views/contact.view.php";
            break;
            case "connexionInscription" : 
                /* require "views/connexion.view.php"; */
                $utilisateurController->connexionForm();
            break;
            case "ValidationConnexion" : 
                if(!empty($_POST['pseudoUtilisateur']) && !empty($_POST['mdpUtilisateur'])){
                    $pseudo = htmlentities($_POST['pseudoUtilisateur']);
                    $mdp = htmlentities($_POST['mdpUtilisateur']);
                    $utilisateurController->validation_pseudo($pseudo,$mdp);
                } else {
                    throw new Exception("Pseudo ou mot de passe non renseigné");
                    header('Location: '.URL.'connexionInscription');
                }
            break;
            case "inscription" : 
                /* require "views/inscription.view.php"; */
                $utilisateurController->inscriptionForm();
            break;
            case "inscriptionValid" : 
                /* $utilisateurController->inscriptionValid(); */
            break;
            case "admin" : 
                if(empty($_SESSION['profil'])){
                    throw new Exception("Veuillez vous connecter !");
                } else {
                    if(empty($url[1])){
                        require "views/admin.view.php";
                        /* $plantController->afficherPlants(); */
                    } else if($url[1] === "pAdmin") {
                        $planteController->afficherPlantes();
                    } else if($url[1] === "p") {
                        $planteController->afficherPlante($url[2]);
                    } else if($url[1] === "a") {
                        $planteController->ajoutPlante();
                    } else if($url[1] === "av") {
                        $planteController->ajoutPlanteValidation();
                    } else if($url[1] === "m") {
                        $planteController->modifierPlante($url[2]);
                    } else if($url[1] === "mv") {
                        $planteController->modifierPlanteValidation();
                    } else if($url[1] === "s") {
                        $planteController->supprimerPlante($url[2]);
                    } else if($url[1] === "profil") {
                        $utilisateurController->profil();
                    } else {
                        throw new Exception("La page n'existe pas. Erreur 404 !!!");
                    }
                }
            break;
            case "espaceMembre" : 
                if(empty($url[1])){
                    require "views/espaceMembre.view.php";
                    /* $plantController->afficherPlants(); */
                } else if($url[1] === "pMembre") {
                    $planteController->afficherPlantes();
                } else {
                    throw new Exception("La page n'existe pas. Erreur 404 !!!");
                }
            break;
            case "deconnexion" : 
                $utilisateurController->deconnexion();
/*                 session_start();
                session_destroy();
                echo "<script language=javascript> alert('Deconnexion !'); </script>"; 
                header('Location: '.URL.'accueil'); */
            break;

            default : throw new Exception("La page n'existe pas. Erreur 404 !!!");
        }
    }
}
catch(Exception $e){
    $msg = $e->getMessage();
    require "views/error.view.php";
}
