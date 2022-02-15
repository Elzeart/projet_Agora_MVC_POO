<?php
require_once "models/utilisateurManager.class.php";

class UtilsateurController
{
    private $utilisateurManager;

    public function __construct()
    {
        $this->utilisateurManager = new UtilisateurManager;
    }

    public function connexion(){
        require "views/connexion.view.php";
    }
    public function inscriptionForm(){
        require "views/inscription.view.php";
    }

    public function inscriptionValid(){
        $nomUtilisateur="";
        $prenomUtilisateur="";
        $pseudoUtilisateur="";
        $mailUtilisateur="";
        $mdpUtilisateur="";

        
        if(isset($_POST['nomUtilisateur'], $_POST['prenomUtilisateur'], $_POST['pseudoUtilisateur'], $_POST['mailUtilisateur'], $_POST['mdpUtilisateur'], $_POST['confirmMdpUtilisateur']))
        {
            $nomUtilisateur = htmlspecialchars($_POST['nomUtilisateur']);
            $prenomUtilisateur = htmlspecialchars($_POST['prenomUtilisateur']);
            $pseudoUtilisateur = htmlspecialchars($_POST['pseudoUtilisateur']);
            $mailUtilisateur = htmlspecialchars($_POST['mailUtilisateur']);
            $mdpUtilisateur = htmlspecialchars($_POST['mdpUtilisateur']);
            $confirmMdpUtilisateur = htmlspecialchars($_POST['confirmMdpUtilisateur']);

        }

        if($nomUtilisateur != null && $prenomUtilisateur != null && $pseudoUtilisateur!= null &&  $mailUtilisateur != null && $mdpUtilisateur != null && $confirmMdpUtilisateur != null)
        {
            // Vérifier si mdp correspond à la confirmation mdp
            if($mdpUtilisateur != $confirmMdpUtilisateur){
                // die('Mot de passe et confirmation mot de passe ne sont pas identiques');
                // echo "<script language=javascript type=text/javascript> window.alert('Le mot de passe et la confirmation du mot de passe ne sont pas identiques'); </script>"; die;
                echo "<script language=javascript> alert('Le mot de passe et la confirmation du mot de passe ne sont pas identiques'); </script>"; die;
            }

            // Vérifier que le contenu email est un email. Pour éviter de contourner le front
            if(!filter_var($mailUtilisateur, FILTER_VALIDATE_EMAIL)){
                // die('L\'adresse email est incorrecte');
                echo "<script language=javascript> alert('L\'adresse email est incorrecte'); </script>"; die;
            }
    
            // Vérifier si le mail existe déjà

           /*  $utilisateurExiste = $this->utilisateurManager->comparerUtilisateurMailPseudoBD($_POST['mailUtilisateur'], $_POST['pseudoUtilisateur']); */
            /* if(!$utilisateurExiste){ */
                    
                $hash_mdp = password_hash($_POST['mdpUtilisateur'], PASSWORD_DEFAULT);

                $this->utilisateurManager->insererUtilisateurDB($_POST['nomUtilisateur'], $_POST['prenomUtilisateur'], $_POST['pseudoUtilisateur'], $_POST['mailUtilisateur'], $hash_mdp);
            /* }else{
                throw new Exception("L'utilisateur existe déjà.");
            } */

            
            
        }

        header("Location: ".URL."accueil");

    }



}