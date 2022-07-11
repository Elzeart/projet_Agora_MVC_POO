<?php
session_start();

define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
"://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']));

require_once "controllers/planteController.controller.php";
require_once "controllers/utilisateurController.controller.php";
require_once "controllers/Toolbox.class.php";
$planteController = new PlanteController;
$utilisateurController = new UtilsateurController;

try{
    if(empty($_GET['page'])){
        $planteController->afficherPlantesVA();     
    } else {
        $url = explode("/", filter_var($_GET['page']),FILTER_SANITIZE_URL);
        switch($url[0]){
            case "accueil" : 
                $planteController->afficherPlantesVA();
            break;
            case "vegetaux" : 
                if(empty($url[1])){
                    $planteController->afficherPlantesV();
                } else if($url[1] === "p") {
                    $planteController->afficherPlante(Toolbox::secureHTML($url[2]));
                } 
                else if($url[1] === "pTriParFamille") {
                    $planteController->afficherPlanteParFamille(Toolbox::secureHTML($_POST['idFamilleVegetal']));
                } 
                else if($url[1] === "pTriParType") {
                    $planteController->afficherPlanteParType(Toolbox::secureHTML($_POST['idTypeVegetal']));
                } 
                else if($url[1] === "pTriParFamilleEtType") {
                    $planteController->afficherPlanteParFamilleEtType(Toolbox::secureHTML($_POST['idFamilleVegetal']),Toolbox::secureHTML($_POST['idTypeVegetal']));
                } else if($url[1] === "recherche") {
                    $planteController->recherche(Toolbox::secureHTML($_POST["recherche"]));
                } 
                else {
                    throw new Exception("La page n'existe pas. Erreur 404 !!!");
                }
            break;
            case "planteHasard" :
                require "views/planteHasard.view.php";
            break;
            case "trocs" : 
                require "views/trocs.view.php";
            break;
            case "contact" : 
                require "views/contact.view.php";
            break;
            case "ValidationConnexion" : 
                if(!empty($_POST['pseudoUtilisateur']) && !empty($_POST['mdpUtilisateur'])){
                    $pseudo = Toolbox::secureHTML($_POST['pseudoUtilisateur']);
                    $mdp = Toolbox::secureHTML($_POST['mdpUtilisateur']);
                    $utilisateurController->validation_pseudo($pseudo,$mdp);
                } else {
                    throw new Exception("Pseudo ou mot de passe non renseigné");
                    header('Location: '.URL.'connexionInscription');
                }
            break;
            case "connexionInscription" : 
                $utilisateurController->connexionForm();
            break;
            case "inscription" : 
                $utilisateurController->inscriptionForm();
            break;
            case "inscriptionValidation" : 
                if(isset($_POST['nomUtilisateur']) && !empty($_POST['nomUtilisateur']) && isset($_POST['prenomUtilisateur']) && !empty($_POST['prenomUtilisateur']) 
                && isset($_POST['pseudoUtilisateur']) && !empty($_POST['pseudoUtilisateur']) && isset($_POST['mailUtilisateur']) && !empty($_POST['mailUtilisateur']) 
                && isset($_POST['mdpUtilisateur']) && !empty($_POST['mdpUtilisateur']) && isset($_POST['confirmMdpUtilisateur']) && !empty($_POST['confirmMdpUtilisateur'])){
                    if($_POST['mdpUtilisateur'] === $_POST['confirmMdpUtilisateur']){
                        if(filter_var($_POST['mailUtilisateur'], FILTER_VALIDATE_EMAIL)){
                            $nomUtilisateur = Toolbox::secureHTML($_POST['nomUtilisateur']);
                            $prenomUtilisateur = Toolbox::secureHTML($_POST['prenomUtilisateur']);
                            $pseudoUtilisateur = Toolbox::secureHTML($_POST['pseudoUtilisateur']);
                            $mailUtilisateur = Toolbox::secureHTML($_POST['mailUtilisateur']);
                            $mdpUtilisateur = Toolbox::secureHTML($_POST['mdpUtilisateur']);
                            $confirmMdpUtilisateur = Toolbox::secureHTML($_POST['confirmMdpUtilisateur']);
                            $utilisateurController->inscriptionValid($nomUtilisateur, $prenomUtilisateur, $pseudoUtilisateur, $mdpUtilisateur, $mailUtilisateur);
                        }else{
                            throw new Exception($_POST["mailUtilisateur"] . " n'est pas un mail valide");
                        }
                    } else {
                        throw new Exception("Les mots de passes ne sont pas identiques !");
                    }
                } else {
                    throw new Exception("Veuillez remplir les informations oblligatoires !");
                }
            break;
            case "renvoyerMailValidation" : $utilisateurController->renvoyerMailValidation(Toolbox::secureHTML($url[1]));
            break;
            case "validationMail" : $utilisateurController->validationCompte(Toolbox::secureHTML($url[1]), Toolbox::secureHTML($url[2]));
            break;
            case "espaceMembre" : 
                if(empty($_SESSION['profil'])){
                    throw new Exception("Veuillez vous connecter !");
                } elseif (!empty($_SESSION['profil']) && !empty($_SESSION['profil']['idDroit'] != 2)) {
                    throw new Exception("Vous n'avez pas les droits pour cette page !");
                } else {
                    if(empty($url[1])){
                        require "views/espaceMembre.view.php";
                    } else if($url[1] === "pTroc") {
                        echo 'Future page de proposition de troc';
                    } else if($url[1] === "profil") {
                        $utilisateurController->profil();
                    } else if($url[1] === "validationModificationMail") {
                        $utilisateurController->validationModificationMail(Toolbox::secureHTML($_POST['mailUtilisateur'])); 
                        header("Location: ".URL."espaceMembre/profil");
                    } else if($url[1] === "modificationMdp") {
                        $utilisateurController->modificationMdp();
                    } 
                    else if($url[1] === "validationModificationMdp") {
                        if(isset($_POST['ancienMdpUtilisateur']) && !empty($_POST['ancienMdpUtilisateur']) && isset($_POST['nouveauMdpUtilisateur']) && !empty($_POST['nouveauMdpUtilisateur']) && isset($_POST['confirmNouveauMdpUtilisateur']) && !empty($_POST['confirmNouveauMdpUtilisateur'])){
                            $ancienMdpUtilisateur = Toolbox::secureHTML($_POST['ancienMdpUtilisateur']);   
                            $nouveauMdpUtilisateur = Toolbox::secureHTML($_POST['nouveauMdpUtilisateur']);   
                            $confirmNouveauMdpUtilisateur = Toolbox::secureHTML($_POST['confirmNouveauMdpUtilisateur']);   
                            $utilisateurController->validationModificationMdp($ancienMdpUtilisateur, $nouveauMdpUtilisateur, $confirmNouveauMdpUtilisateur);
                        } else {
                            $_SESSION['alert'][] = [
                                "type" => "alert-danger",
                                "message" => "Vous n'avez pas renseigné toutes les informations"
                            ];
                        }
                        header("Location: ".URL."espaceMembre/profil");
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
                        }
                        header("Location: ".URL."espaceMembre/profil");
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
                    } else if($url[1] === "m") {
                        $planteController->modifierPlante(Toolbox::secureHTML($url[2]));
                    } else if($url[1] === "mv") {
                        $planteController->modifierPlanteValidation();
                    } else if($url[1] === "pAdmin") {
                        $planteController->afficherPlantes();
                    } else if($url[1] === "p") {
                        $planteController->afficherPlante(Toolbox::secureHTML($url[2]));
                    } else if($url[1] === "a") {
                        $planteController->ajoutPlante();
                    } else if($url[1] === "av") {
                        $titre = Toolbox::secureHTML($_POST['titre']);
                        $infosVegetal = Toolbox::secureHTML($_POST['infosVegetal']);
                        $plantationVegetal = Toolbox::secureHTML($_POST['plantationVegetal']);
                        $idFamilleVegetal = Toolbox::secureHTML($_POST['idFamilleVegetal']);
                        $idTypeVegetal = Toolbox::secureHTML($_POST['idTypeVegetal']);
                        $planteController->ajoutPlanteValidation($titre,$infosVegetal,$plantationVegetal,$idFamilleVegetal,$idTypeVegetal);
                    }  else if($url[1] === "s") {
                        $planteController->supprimerPlante(Toolbox::secureHTML($url[2]));
                    } else if($url[1] === "profil") {
                        $utilisateurController->profil();
                    } else if($url[1] === "validationModificationMail") {
                        $utilisateurController->validationModificationMail(Toolbox::secureHTML($_POST['mailUtilisateur']));
                        header("Location: ".URL."admin/profil");
                    } else if($url[1] === "modificationMdp") {
                        $utilisateurController->modificationMdp();
                        header("Location: ".URL."admin/profil");
                    } 
                    else if($url[1] === "validationModificationMdp") {
                        if(isset($_POST['ancienMdpUtilisateur']) && !empty($_POST['ancienMdpUtilisateur']) && isset($_POST['nouveauMdpUtilisateur']) && !empty($_POST['nouveauMdpUtilisateur']) && isset($_POST['confirmNouveauMdpUtilisateur']) && !empty($_POST['confirmNouveauMdpUtilisateur'])){
                            $ancienMdpUtilisateur = Toolbox::secureHTML($_POST['ancienMdpUtilisateur']);   
                            $nouveauMdpUtilisateur = Toolbox::secureHTML($_POST['nouveauMdpUtilisateur']);   
                            $confirmNouveauMdpUtilisateur = Toolbox::secureHTML($_POST['confirmNouveauMdpUtilisateur']); 
                            $utilisateurController->validationModificationMdp($ancienMdpUtilisateur, $nouveauMdpUtilisateur, $confirmNouveauMdpUtilisateur);
                        } else {
                            $_SESSION['alert'][] = [
                                "type" => "alert-danger",
                                "message" => "Vous n'avez pas renseigné toutes les informations"
                            ];
                        }
                        header("Location: ".URL."admin/profil");
                        
                    } else if($url[1] === "suppressionCompte") {
                        $utilisateurController->suppressionCompte();
                        header('Location: '.URL.'connexionInscription');
                    } 
                    else if($url[1] === "validationModificationImage") {
                        if($_FILES['image']['size'] > 0){
                            $utilisateurController->validationModificationImage($_FILES['image']);
                        } else {
                            $_SESSION['alert'][] = [
                                "type" => "alert-danger",
                                "message" => "Vous n'avez pas modifié l'image"
                            ];
                        }
                        header("Location: ".URL."admin/profil");
                        
                    } else if($url[1] === "droits") {
                        $utilisateurController->droits();
                    } else if($url[1] === "modificationDroit") {
                        $utilisateurController->modificationDroit(Toolbox::secureHTML($_POST['pseudoUtilisateur']), Toolbox::secureHTML($_POST['idDroit']));
                    }
                    else {
                        throw new Exception("La page n'existe pas. Erreur 404 !!!");
                    }
                }
            break;
            case "deconnexion" : 
                $utilisateurController->deconnexion();
            break;
            case "meteo" : 
                require "views/meteo.view.php";
            break;
            default : throw new Exception("La page n'existe pas. Erreur 404 !!!");
        }
    }
}
catch(Exception $e){
    $msg = $e->getMessage();
    require "views/error.view.php";
}
