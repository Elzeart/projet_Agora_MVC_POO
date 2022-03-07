<?php 
ob_start(); 
if(!empty($_SESSION['alert'])) :
?>
<div class="alert alert-<?= $_SESSION['alert']['type'] ?>" role="alert">
    <?= $_SESSION['alert']['msg'] ?>
</div>
<?php 
unset($_SESSION['alert']);
endif; 
?>

<link rel="stylesheet" href="<?= URL ?>/public/css/contact.css">

<div class="titre-contact"><h2 class="titre-section-info">Contact</h2></div>
<main>
        <form action="">
            <h3>Pour nous joindre merci de remplir le formulaire de contact ci-dessous</h3>  <br><br>
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" placeholder="Nom" >
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" placeholder="Prenom"> </br>
            <label for="email">Adresse électronique</label>
            <input type="email" name="email" id="email" placeholder="Email">
            <label for="liste">Objet</label>
            <select name="liste" id="liste">
                <option value="option1">Demande d'info</option>
                <option value="option2">Adhésion</option>
                <option value="option3">Newsletter</option>
                <option value="option4">Echanges et troc</option>
                <option value="option4">Suggestions</option>
                <option value="option5">Autre</option>
            </select><br/>  
            <textarea name="Votre message" id="Votre_message" cols="30" rows="10"></textarea></br>
            <input type="submit" value="Envoyer"/>
        </form>
    </main>

<?php
$content = ob_get_clean();
$titre = "Formulaire de contact";
// $titre = "Bienvenue dans xxx";
// $css = "nom_de_la_page_css";               Il est possible je pense de faire l'algo dans le template qui prend le css en inscrivant le css comme ceci.
require "template.php";
?>