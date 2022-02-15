<?php
session_start();
//ajout du formulaire d'inscription html
include('./connection.php');
//Connexion avec la bdd
include('./connection_bdd.php');
//Class utilisateur
include('./user_model.php');

$mailUtilisateur="";
$mdpUtilisateur="";

if(isset($_POST['mailUtilisateur'], $_POST['mdpUtilisateur'])){
    $mailUtilisateur = htmlspecialchars($_POST['mailUtilisateur']);
    $mdpUtilisateur = htmlspecialchars($_POST['mdpUtilisateur']);

    if($mailUtilisateur != null && $mdpUtilisateur != null){
    $creation=new Utilisateur();
    $creation->setMailUtilisateur($mailUtilisateur);
    $creation->setMdpUtilisateur($mdpUtilisateur);

    $creation->connectionUtilisateur($bdd);
    }
}





// if(isset($_POST['mailUtilisateur'], $_POST['mdpUtilisateur'])){
//     $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE mailUtilisateur = :mailUtilisateur");
//     $req->execute(array('mailUtilisateur'=>$mailUtilisateur));
//     $test_utilisateur = $req->fetch();

//     if(!$test_utilisateur){
//         die("Erreur de saisie de mail ou de mot de passe");
//     }

//     if(!password_verify($_POST["mdpUtilisateur"], $test_utilisateur["mdpUtilisateur"])){
//         die("Erreur de saisie de mail ou mot de passe");
//     } else {echo"Bienvenue"};

    // $id = $bdd->lastInsertId();

    // session_start();

    // $_SESSION["Utilisateur"] = $utilisateur;

    // $_SESSION["Utilisateur"] = [
    //     "id" = $id,
    //     "nomUtilisateur" = $_POST['nomUtilisateur'],
    //     "prenomUtilisateur" = $_POST['prenomUtilisateur'],
    //     "pseudoUtilisateur" = $_POST['pseudoUtilisateur'],
    //     "mailUtilisateur" = $_POST['mailUtilisateur'],
    //     "ageUtilisateur" = $_POST['ageUtilisateur'],
    //     "telephoneUtilisateur" = $_POST['telephoneUtilisateur'],
    //     "mdpUtilisateur" = $_POST['mdpUtilisateur'],
    // ];

    // header("index.php");

// }

?>