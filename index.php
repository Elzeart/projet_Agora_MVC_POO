<?php
session_start();

define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "controllers/plantsController.controller.php";
require_once "controllers/utilisateurController.controller.php";
$plantController = new PlantsController;
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
            /* case "vegetaux" : require "views/plants.view.php";
            break; */
            /* case "admin" : require "views/admin.view.php";
            break; */
            case "trocs" : 
                require "views/trocs.view.php";
            break;
            case "contact" : 
                require "views/contact.view.php";
            break;
            case "connexionInscription" : 
                /* require "views/connexion.view.php"; */
                $utilisateurController->connexion();
            break;
            case "inscription" : 
                /* require "views/inscription.view.php"; */
                $utilisateurController->inscriptionForm();
            break;
            case "inscriptionValid" : 
                $utilisateurController->inscriptionValid();
            break;
            case "admin" : 
                if(empty($url[1])){
                    require "views/admin.view.php";
                    /* $plantController->afficherPlants(); */
                } else if($url[1] === "pAdmin") {
                    $plantController->afficherPlants();
                } else if($url[1] === "p") {
                    $plantController->afficherPlant($url[2]);
                } else if($url[1] === "a") {
                    $plantController->ajoutPlant();
                } else if($url[1] === "av") {
                    $plantController->ajoutPlantValidation();
                } else if($url[1] === "m") {
                    $plantController->modifyPlant($url[2]);
                } else if($url[1] === "mv") {
                    $plantController->modifyPlantValidation();
                } else if($url[1] === "s") {
                    $plantController->removePlant($url[2]);
                } else {
                    throw new Exception("La page n'existe pas");
                }
            break;
            case "espaceMembre" : 
                require "views/user_member.view.php";
            break;
            case "deconnexion" : 
                session_start();
                session_destroy();
                echo "<script language=javascript> alert('Deconnexion !'); </script>"; 
                header('location: ./index.php');
            break;
            case "vegetaux" : 
                if(empty($url[1])){
                    $plantController->afficherPlantsV();
                } else if($url[1] === "p") {
                    $plantController->afficherPlant($url[2]);
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
                    throw new Exception("La page n'existe pas");
                }
            break;
            default : throw new Exception("La page n'existe pas");
        }
    }
}
catch(Exception $e){
    $msg = $e->getMessage();
    require "views/error.view.php";
}
