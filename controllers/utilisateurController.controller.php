<?php
require_once "models/utilisateurManager.class.php";

class UtilsateurController
{
    private $utilisateurManager;

    public function __construct()
    {
        $this->utilisateurManager = new UtilisateurManager;
    }

    public function connexionForm(){
        require "views/connexion.view.php";
    }
    public function inscriptionForm(){
        require "views/inscription.view.php";
    }

    public function validation_pseudo($pseudoUtilisateur,$mdp){
        if($this->utilisateurManager->combinaisonValide($pseudoUtilisateur,$mdp)){
            if($this->utilisateurManager->compteActive($pseudoUtilisateur)){
                $data = $this->utilisateurManager->getUtilisateurInformation($pseudoUtilisateur);
                $_SESSION['profil'] = [
                    "pseudoUtilisateur" => $data['pseudoUtilisateur'],
                    "idDroit" => $data['idDroit'],
                    "idUtilisateur" => $data['idUtilisateur'],
                ];
                if($_SESSION['profil']['idDroit'] == 1){
                    header('Location: '.URL.'admin');
                } else {
                    header('Location: '.URL.'espaceMembre');
                }
            } else {
            $_SESSION['alert'][] = [
                "type" => "alert-danger",
                "message" => "Le compte ".$pseudoUtilisateur." n'a pas été activé par mail 
                <a href='renvoyerMailValidation/".$pseudoUtilisateur."'>Renvoyer le mail de validation</a>"
            ];
            header('Location: '.URL.'connexionInscription');
            }
        } else {
            throw new Exception("Pseudo ou mot de passe non valide");
        }
    }

    public function profil(){
        $data = $this->utilisateurManager->getUtilisateurInformation($_SESSION['profil']['pseudoUtilisateur']);
        $_SESSION['profil']['idDroit'] = $data['idDroit'];
        require "views/profil.view.php";
    }

    public function deconnexion(){
        $_SESSION['alert'][] = [
            "type" => "alert-success",
            "message" => "Vous êtes déconnecté"
        ];
        unset($_SESSION['profil']);
        /* setcookie(Toolbox::COOKIE_NAME,"",time() - 3600); */
        /* session_destroy(); */
        header('Location: '.URL.'connexionInscription');
    }

    public function inscriptionValid($nomUtilisateur, $prenomUtilisateur, $pseudoUtilisateur, $mdpUtilisateur, $mailUtilisateur, ){
        if($this->utilisateurManager->verifPseudoDisponible($pseudoUtilisateur)){
            if($this->utilisateurManager->verifMailDisponible($mailUtilisateur)){
                $mdpCrypte = password_hash($mdpUtilisateur, PASSWORD_DEFAULT);
                $clef = rand(0,9999);
                if($this->utilisateurManager->bdCreerCompte($nomUtilisateur, $prenomUtilisateur, $pseudoUtilisateur, $mdpCrypte, $mailUtilisateur, $clef, "profils/profil.png", 2)){
                    $this->envoiMailValidation($pseudoUtilisateur, $mailUtilisateur, $clef);
                    $_SESSION['alert'][] = [
                        "type" => "alert-success",
                        "message" => "Le compte a été créé, un mail de validation vous a été envoyé !"
                    ];
                    header('Location: '.URL.'connexionInscription');
                } else {
                    throw new Exception("Errreur lors de la création du compte !");
                }
            } else {
                throw new Exception("Ce mail est déjà utilisé !");
            }
        } else {
            throw new Exception("Le psuedo est déjà utilisé !");
        }
    }

    private function envoiMailValidation($pseudoUtilisateur, $mailUtilisateur, $clef){
        $urlVerification = URL."validationMail/".$pseudoUtilisateur."/".$clef;
        $sujet = "Création du compte sur le site Agora";
        $message = "Pour valider votre compte veuillez cliquer sur le lien suivant ".$urlVerification;
        self::envoiMail($mailUtilisateur, $sujet, $message);
    }

    public static function envoiMail($destinataire, $sujet, $message){
        $header = "From: luipourquoi1@gmail.com";
        if(mail($destinataire, $sujet, $message, $header)){
            $_SESSION['alert'][] = [
                "type" => "alert-success",
                "message" => "Mail envoyé"
            ];
        } else {
            $_SESSION['alert'][] = [
                "type" => "alert-danger",
                "message" => "Mail non envoyé"
            ];
        };
    }

    public function renvoyerMailValidation($pseudoUtilisateur){
        $utilisateur = $this->utilisateurManager->getUtilisateurInformation($pseudoUtilisateur);
        $this->envoiMailValidation($pseudoUtilisateur, $utilisateur['mailUtilisateur'], $utilisateur['clef']);
        header('Location: '.URL."connexionInscription");
    }

    public function validationCompte($pseudoUtilisateur, $clef){
        if($this->utilisateurManager->bdValidationCompte($pseudoUtilisateur, $clef)){
            $_SESSION['alert'][] = [
                "type" => "alert-success",
                "message" => "Le compte a été activé. Vous pouvez vous connecter."
            ];
            header('Location: '.URL.'connexionInscription');
        } else {
            $_SESSION['alert'][] = [
                "type" => "alert-danger",
                "message" => "Le compte n'a pas été activé. Veuillez consulter votre mail et cliquer sur le lien de validation !"
            ];
            header('Location: '.URL.'inscription');
        }
    }
    public function validationModificationMail($mailUtilisateur) {
        if($this->utilisateurManager->bdModificationMailUtilisateur($_SESSION['profil']['pseudoUtilisateur'], $mailUtilisateur)){
            $_SESSION['alert'][] = [
                "type" => "alert-success",
                "message" => "La modification est effectuée"
            ];
        } else {
            $_SESSION['alert'][] = [
                "type" => "alert-danger",
                "message" => "Aucune modification effectuée"
            ];
        }
        //header('Location: '.URL.'admin/profil');
    }

    public function modificationMdp(){
        require "views/modificationMdp.view.php";
    }

    public function validationModificationMdp($ancienMdpUtilisateur, $nouveauMdpUtilisateur, $confirmNouveauMdpUtilisateur){
        if($nouveauMdpUtilisateur === $confirmNouveauMdpUtilisateur){
            if($this->utilisateurManager->combinaisonValide($_SESSION['profil']['pseudoUtilisateur'], $ancienMdpUtilisateur)){
                $mdpHash = password_hash($nouveauMdpUtilisateur, PASSWORD_DEFAULT);
                if($this->utilisateurManager->bdModificationMdpUtilisateur($_SESSION['profil']['pseudoUtilisateur'], $mdpHash)){
                    $_SESSION['alert'][] = [
                        "type" => "alert-success",
                        "message" => "La modification du mot de passe a été effectuée"
                    ];
                    // header("Location: ".URL."admin/profil");
                } else {
                    $_SESSION['alert'][] = [
                        "type" => "alert-danger",
                        "message" => "La modification de mot de passe a échouée"
                    ];
                    // header("Location: ".URL."admin/modificationMdp");
                }
            } else {
                $_SESSION['alert'][] = [
                    "type" => "alert-danger",
                    "message" => "Votre pseudo et votre mot de passe ne correspondent pas"
                ];
                // header("Location: ".URL."admin/modificationMdp");
            }
        } else {
            $_SESSION['alert'][] = [
                "type" => "alert-danger",
                "message" => "Les mots de passe ne correspondent pas"
            ];
            // header("Location: ".URL."admin/modificationMdp");
        }
    }

    public function suppressionCompte(){
        $this->dossierSuppressionImageUtilisateur($_SESSION['profil']['pseudoUtilisateur']);
        rmdir("public/images/profils/".$_SESSION['profil']['pseudoUtilisateur']);
        if($this->utilisateurManager->bdSuppressionCompte($_SESSION['profil']['pseudoUtilisateur'])){
            $_SESSION['alert'][] = [
                "type" => "alert-success",
                "message" => "La suppression du compte est effectuée"
            ];
            $this->deconnexion();
        } else {
            $_SESSION['alert'][] = [
                "type" => "alert-danger",
                "message" => "La suppression n'a pas été effectuée"
            ];
            header("Location: ".URL."admin/profil");
        }
    }

    public function validationModificationImage($image){


            try {
                $repertoire = "public/images/profils/".$_SESSION['profil']['pseudoUtilisateur']."/";
                $nomImage = Toolbox::ajoutImage($image, $repertoire); //Ajout image dnas le répertoire
                //Suppression de l'ancienne image
                $this->dossierSuppressionImageUtilisateur($_SESSION['profil']['pseudoUtilisateur']);
                //Ajout de la nouvelle image dans la BD
                $nomImageBd = "profils/".$_SESSION['profil']['pseudoUtilisateur']."/".$nomImage;
                if($this->utilisateurManager->bdAjoutImage($_SESSION['profil']['pseudoUtilisateur'], $nomImageBd)){
                    $_SESSION['alert'][] = [
                        "type" => "alert-success",
                        "message" => "La modification de l'image de profil a été effectuée"
                    ];
                } else {
                    $_SESSION['alert'][] = [
                        "type" => "alert-danger",
                        "message" => "La modification de l'image de profil n'a pas été effectuée"
                    ];
                }
            } catch (Exception $e) {
                $_SESSION['alert'][] = [
                    "type" => "alert-danger",
                    "message" => $e->getMessage(),
                ];
            }
        header("Location: ".URL."admin/profil");
    }

    private function dossierSuppressionImageUtilisateur($pseudoUtilisateur) {
        $ancienneImage = $this->utilisateurManager->getImageUtilisateur($_SESSION['profil']['pseudoUtilisateur']);
        if($ancienneImage !== "profils/profil.png"){
            unlink("public/images/".$ancienneImage);
        }
    }

    public function droits(){
        $utilisateurs = $this->utilisateurManager->getUtilisateurs();
        require "views/droits.view.php";
    }

    public function modificationDroit($pseudoUtilisateur, $idDroit){
        if($this->utilisateurManager->bdModificationDroitUtilisateur($pseudoUtilisateur, $idDroit)){
            $_SESSION['alert'][] = [
                "type" => "alert-success",
                "message" => "La modification des droits a été effectuée"
            ];
        } else {
            $_SESSION['alert'][] = [
                "type" => "alert-danger",
                "message" => "La modification des droits n'a pas été effectuée"
            ];
        }
        header("Location: ".URL."admin/droits");
    }


}