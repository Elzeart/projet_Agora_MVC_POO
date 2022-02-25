<?php
session_start();

define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "controllers/planteController.controller.php";
require_once "controllers/utilisateurController.controller.php";
require_once "controllers/Toolbox.class.php";
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
                } else {
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
                $utilisateurController->inscriptionForm();
            break;
            case "inscriptionValidation" : 
                if(!empty($_POST['nomUtilisateur']) && !empty($_POST['prenomUtilisateur']) && !empty($_POST['pseudoUtilisateur']) && !empty($_POST['mailUtilisateur']) && !empty($_POST['mdpUtilisateur']) && !empty($_POST['confirmMdpUtilisateur'])){
                    $nomUtilisateur = htmlentities($_POST['nomUtilisateur']);
                    $prenomUtilisateur = htmlentities($_POST['prenomUtilisateur']);
                    $pseudoUtilisateur = htmlentities($_POST['pseudoUtilisateur']);
                    $mailUtilisateur = htmlentities($_POST['mailUtilisateur']);
                    $mdpUtilisateur = htmlentities($_POST['mdpUtilisateur']);
                    $confirmMdpUtilisateur = htmlentities($_POST['confirmMdpUtilisateur']);
                    $utilisateurController->inscriptionValid($pseudoUtilisateur, $mdpUtilisateur, $mailUtilisateur);
                } else {
                    throw new Exception("Veuillez remplir les informations oblligatoires !");
                }
            break;
            case "renvoyerMailValidation" : $utilisateurController->renvoyerMailValidation($url[1]);
            break;
            case "validationMail" : $utilisateurController->validationCompte($url[1], $url[2]);
            break;
            case "espaceMembre" : 
                if(empty($_SESSION['profil'])){
                    throw new Exception("Veuillez vous connecter !");
                } elseif (!empty($_SESSION['profil']) && !empty($_SESSION['profil']['idDroit'] != 2)) {
                    throw new Exception("Vous n'avez pas les droits pour cette page !");
                } 
/*                 elseif (!Toolbox::checkCookieConnexion()) {
                    setcookie(Toolbox::COOKIE_NAME,"",time() - 3600);
                    unset($_SESSION['profil']);
                    throw new Exception("Veuillez vous reconnecter !");
                } */ else {
                    /* Toolbox::genererCookieConnexion(); *///Regénérer le cookie
                    if(empty($url[1])){
                        require "views/espaceMembre.view.php";
                    } else if($url[1] === "pTroc") {
                        echo 'Future page de proposition de troc';
                    } else if($url[1] === "profil") {
                        $utilisateurController->profil();
                    } else if($url[1] === "validationModificationMail") {
                        $utilisateurController->validationModificationMail(htmlentities($_POST['mailUtilisateur']));
                    } else if($url[1] === "modificationMdp") {
                        $utilisateurController->modificationMdp();
                    } 
                    else if($url[1] === "validationModificationMdp") {
                        if(!empty($_POST['ancienMdpUtilisateur']) && !empty($_POST['nouveauMdpUtilisateur']) && !empty($_POST['confirmNouveauMdpUtilisateur'])){
                            $ancienMdpUtilisateur = htmlentities($_POST['ancienMdpUtilisateur']);
                            $nouveauMdpUtilisateur = htmlentities($_POST['nouveauMdpUtilisateur']);
                            $confirmNouveauMdpUtilisateur = htmlentities($_POST['confirmNouveauMdpUtilisateur']);
                            $utilisateurController->validationModificationMdp($ancienMdpUtilisateur, $nouveauMdpUtilisateur, $confirmNouveauMdpUtilisateur);
                        } else {
                            $_SESSION['alert'][] = [
                                "type" => "alert-danger",
                                "message" => "Vous n'avez pas renseigné toutes les informations"
                            ];
                            header("Location: ".URL."admin/modificationMdp");
                        }
                        
                    } else if($url[1] === "suppressionCompte") {
                        $utilisateurController->suppressionCompte();
                    } 
                    else if($url[1] === "validationModificationImage") {
                        if($_FILES['image']['size'] > 0){
                            $utilisateurController->validationModificationImage($_FILES['image']);
                        } else {
                            $_SESSION['alert'][] = [
                                "type" => "alert-danger",
                                "message" => "Vous n'avez pas modifié l'image"
                            ];
                            header("Location: ".URL."admin/validationModificationImage");
                        }
                        
                    }
                    else {
                        throw new Exception("La page n'existe pas. Erreur 404 !!!");
                    }
                }
            break;
            case "admin" : 
                if(empty($_SESSION['profil'])){
                    throw new Exception("Veuillez vous connecter !");
                } elseif (!empty($_SESSION['profil']) && !empty($_SESSION['profil']['idDroit'] != 1)) {
                    throw new Exception("Vous n'avez pas les droits pour cette page !");
                }
                else {
                    if(empty($url[1])){
                        require "views/admin.view.php";
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
                    } else if($url[1] === "validationModificationMail") {
                        $utilisateurController->validationModificationMail(htmlentities($_POST['mailUtilisateur']));
                    } else if($url[1] === "modificationMdp") {
                        $utilisateurController->modificationMdp();
                    } 
                    else if($url[1] === "validationModificationMdp") {
                        if(!empty($_POST['ancienMdpUtilisateur']) && !empty($_POST['nouveauMdpUtilisateur']) && !empty($_POST['confirmNouveauMdpUtilisateur'])){
                            $ancienMdpUtilisateur = htmlentities($_POST['ancienMdpUtilisateur']);
                            $nouveauMdpUtilisateur = htmlentities($_POST['nouveauMdpUtilisateur']);
                            $confirmNouveauMdpUtilisateur = htmlentities($_POST['confirmNouveauMdpUtilisateur']);
                            $utilisateurController->validationModificationMdp($ancienMdpUtilisateur, $nouveauMdpUtilisateur, $confirmNouveauMdpUtilisateur);
                        } else {
                            $_SESSION['alert'][] = [
                                "type" => "alert-danger",
                                "message" => "Vous n'avez pas renseigné toutes les informations"
                            ];
                            header("Location: ".URL."admin/modificationMdp");
                        }
                        
                    } else if($url[1] === "suppressionCompte") {
                        $utilisateurController->suppressionCompte();
                    } 
                    else if($url[1] === "validationModificationImage") {
                        if($_FILES['image']['size'] > 0){
                            $utilisateurController->validationModificationImage($_FILES['image']);
                        } else {
                            $_SESSION['alert'][] = [
                                "type" => "alert-danger",
                                "message" => "Vous n'avez pas modifié l'image"
                            ];
                            header("Location: ".URL."admin/validationModificationImage");
                        }
                        
                    } else if($url[1] === "droits") {
                        $utilisateurController->droits();
                    } else if($url[1] === "modificationDroit") {
                        $utilisateurController->modificationDroit($_POST['pseudoUtilisateur'], $_POST['idDroit']);
                    }
                    else {
                        throw new Exception("La page n'existe pas. Erreur 404 !!!");
                    }
                }
            break;
            case "deconnexion" : 
                $utilisateurController->deconnexion();
            break;
            default : throw new Exception("La page n'existe pas. Erreur 404 !!!");
        }
    }
}
catch(Exception $e){
    $msg = $e->getMessage();
    require "views/error.view.php";
}
