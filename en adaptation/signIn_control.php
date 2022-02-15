<?php
session_start();
//ajout du formulaire d'inscription html
include('./signIn.php');
//Connexion avec la bdd
include('./connection_bdd.php');
//Class utilisateur
include('./user_model.php');

$nomUtilisateur="";
$prenomUtilisateur="";
$pseudoUtilisateur="";
$mailUtilisateur="";
$ageUtilisateur="";
$telephoneUtilisateur="";
$mdpUtilisateur="";

if(isset($_POST['nomUtilisateur'], $_POST['prenomUtilisateur'], $_POST['pseudoUtilisateur'], $_POST['mailUtilisateur'], $_POST['ageUtilisateur'], $_POST['telephoneUtilisateur'], $_POST['mdpUtilisateur'], $_POST['confirmMdpUtilisateur']))
{
    $nomUtilisateur = htmlspecialchars($_POST['nomUtilisateur']);
    $prenomUtilisateur = htmlspecialchars($_POST['prenomUtilisateur']);
    $pseudoUtilisateur = htmlspecialchars($_POST['pseudoUtilisateur']);
    $mailUtilisateur = htmlspecialchars($_POST['mailUtilisateur']);
    $ageUtilisateur = htmlspecialchars($_POST['ageUtilisateur']);
    $telephoneUtilisateur = htmlspecialchars($_POST['telephoneUtilisateur']);
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
    $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE mailUtilisateur = :mailUtilisateur");
    $req->execute(array('mailUtilisateur'=>$mailUtilisateur));
    $test_mail = $req->fetch();
    if($test_mail){
        // echo "<p>Ce mail est déjà utilisé</p>";
        echo "<script language=javascript> alert('Ce mail est déjà utilisé'); </script>"; die;
    } 
    else {
        // Vérifier si le pseudo existe déjà
        $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE pseudoUtilisateur = :pseudoUtilisateur");
        $req->execute(array('pseudoUtilisateur'=>$pseudoUtilisateur));
        $test_pseudo = $req->fetch();
        if($test_pseudo) {
            // echo "<p>Ce pseudo existe déjà</p>";
            echo "<script language=javascript> alert('Ce pseudo existe déjà'); </script>"; die;
        } 
        else {
            try {    

                $creation=new Utilisateur();

                $creation->setNomUtilisateur($nomUtilisateur);
                $creation->setprenomUtilisateur($prenomUtilisateur);
                $creation->setPseudoUtilisateur($pseudoUtilisateur);
                $creation->setMailUtilisateur($mailUtilisateur);
                $creation->setAgeUtilisateur($ageUtilisateur);
                $creation->setTelephoneUtilisateur($telephoneUtilisateur);
                $creation->setMdpUtilisateur($mdpUtilisateur);

                $creation->createUser($bdd);

                

                echo "<script language=javascript> alert('Création compte validée. Bienvenue !'); 
                window.location.href = 'index.php'; 
                </script>"; 
                die();
                
                } 
            catch(Exception $e){ 
                die('Erreur : '.$e->getMessage());
            }
        }
    }
}

//Non fonctionnel : tentative vérifiaction si pseudo existe
/* if($nomUtilisateur != null && $prenomUtilisateur != null && $pseudoUtilisateur!= null &&  $mailUtilisateur != null && $mdpUtilisateur != null){
    try {  
        $afficher=$bdd->query('SELECT count(*) FROM utilisateurs where pseudoUtilisateur =' .$_POST['pseudoUtilisateur']);
        // $req = $afficher->fetch();
        if($count != 0){
                echo 'Ce pseudo est déjà utilisé';
        } else {
            $creation=new utilisateur();

            $creation->setNomUtilisateur($nomUtilisateur);
            $creation->setprenomUtilisateur($prenomUtilisateur);
            $creation->setPseudoUtilisateur($pseudoUtilisateur);
            $creation->setMailUtilisateur($mailUtilisateur);
            $creation->setAgeUtilisateur($ageUtilisateur);
            $creation->setTelephoneUtilisateur($telephoneUtilisateur);
            $creation->setMdpUtilisateur($mdpUtilisateur);
    
            $creation->createUser($bdd);
        } 
        catch(Exception $e){ 
            die('Erreur : '.$e->getMessage());
        }
    }
} */



//Version sans Class, et sans required dans HTML
/* if($nomUtilisateur == null) {
    echo '<p>Veuillez saisir un nom</p>';
} else if($prenomUtilisateur == null) {
    echo '<p>Veuillez saisir votre prénom</p>';
} else if($pseudoUtilisateur == null) {
    echo '<p>Veuillez saisir un Pseudonyme</p>';
} else if($mailUtilisateur == null) {
    echo '<p>Veuillez saisir un mail</p>';
}  else if($ageUtilisateur == null) {
    echo '<p>Veuillez saisir votre âge</p>';
} else if($telephoneUtilisateur == null) {
    echo '<p>Veuillez saisir votre numéro de téléphone</p>';
}  else if($mdpUtilisateur == null) {
    echo '<p>Veuillez saisir votre mot de pass</p>';
}
else {
    try {    
        $req = 'INSERT INTO utilisateurs (nomUtilisateur, prenomUtilisateur, pseudoUtilisateur, mailUtilisateur, ageUtilisateur, telephoneUtilisateur, mdpUtilisateur) 
        VALUES (:nomUtilisateur, :prenomUtilisateur, :pseudoUtilisateur, :mailUtilisateur, :ageUtilisateur, :telephoneUtilisateur, :mdpUtilisateur)';
        $send = $bdd -> prepare($req);
        $send -> execute(array('nomUtilisateur' => $nomUtilisateur, 'prenomUtilisateur' => $prenomUtilisateur, 'pseudoUtilisateur' => $pseudoUtilisateur, 'mailUtilisateur' => $mailUtilisateur, 'ageUtilisateur'=> $ageUtilisateur, 'telephoneUtilisateur'=>$telephoneUtilisateur, 'mdpUtilisateur'=>$mdpUtilisateur));
    

    }
    catch(Exception $e){ 
        die('Erreur : '.$e->getMessage());
    }
    
        //Afficher le dernier enregistrement.
        //echo '<p> Nom : '.$nomUtilisateur.' Prénom : '.$prenomUtilisateur.' Pseudo : '.$pseudoUtilisateur.'</p>';
        
        //Afficher tous les utilisateurs
        $afficher=$bdd->query('SELECT * FROM utilisateurs');
        while ($donnees = $afficher->fetch()){ 
            echo '<p> Nom de l\'utilisateur :'.$donnees[0].'</p>';
            echo '<p> Prénom de l\'utilisateur :'.$donnees[1].'</p>';
            echo '<p> Pseudo de l\'utilisateur :'.$donnees[2].'</p>';
            echo '<br>';
        }
} */


?>