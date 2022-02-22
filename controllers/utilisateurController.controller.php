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
                $_SESSION['profil'] = [
                    "pseudoUtilisateur" => $pseudoUtilisateur,
                ];
                header('Location: '.URL.'admin');
            } else {
            $_SESSION['alert'][] = [
                "type" => "alert-danger",
                "message" => "Le compte ".$pseudoUtilisateur." n'a pas été activé par mail <a href='renvoyerMailValidation/".$pseudoUtilisateur."'>Renvoyer le mail de validation</a>"
            ];
            header('Location: '.URL.'connexionInscription');
            //throw new Exception("Le compte ".$pseudoUtilisateur." n'a pas été activé par mail <a href='renvoyerMailValidation/".$pseudoUtilisateur."'>Renvoyer le mail de validation</a>");
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
        unset($_SESSION['profil']);
        session_destroy();
        header('Location: '.URL.'accueil');
    }

    public function inscriptionValid($pseudoUtilisateur, $mdpUtilisateur, $mailUtilisateur){
        if($this->utilisateurManager->verifPseudoDisponible($pseudoUtilisateur)){
            $mdpCrypte = password_hash($mdpUtilisateur, PASSWORD_DEFAULT);
            $clef = rand(0,9999);
            if($this->utilisateurManager->bdCreerCompte($pseudoUtilisateur, $mdpCrypte, $mailUtilisateur, $clef)){
                $this->envoiMailValidation($pseudoUtilisateur, $mailUtilisateur, $clef);
                $_SESSION['alert'][] = [
                    "type" => "alert-success",
                    "message" => "Le compte a été créé, un mail de validation vous a été envoyé !"
                ];
                // Toolbox::ajouterMessageAlerte("La compte a été créé, Un mail de validation vous a été envoyé !", Toolbox::COULEUR_VERTE);
                header('Location: '.URL.'connexionInscription');
            } else {
                throw new Exception("Errreur lors de la création du compte !");
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
            // echo "<script language=javascript> alert('Mail envoyé !'); </script>"; 
            // Toolbox::ajouterMessageAlerte("Mail envoyé !", Toolbox::COULEUR_VERTE);
        } else {
            $_SESSION['alert'][] = [
                "type" => "alert-danger",
                "message" => "Mail non envoyé"
            ];
            // echo "<script language=javascript> alert('Mail non envoyé !'); </script>"; 
            // Toolbox::ajouterMessageAlerte("Mail non envoyé !", Toolbox::COULEUR_ROUGE);
        };
    }

    public function renvoyerMailValidation($pseudoUtilisateur){
        $utilisateur = $this->utilisateurManager->getUtilisateurInformation($pseudoUtilisateur);
        $this->envoiMailValidation($pseudoUtilisateur, $utilisateur['mailUtilisateur'], $utilisateur['clef']);
        header('Location: '.URL."connexionInscription");
    }

}