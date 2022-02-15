<?php 
ob_start(); 
?>

<link rel="stylesheet" href="<?= URL ?>/public/css/connexion.css">

<!-- <h2 class="titre-section-info">Ici la page de connexion</h2> -->

<main>
        <div id="container">
            
            <form method="POST">
                <h1>Connexion</h1>
                
                <label for="mailUtilisateur"><b>Mail utilisateur</b></label>
                <input type="email" placeholder="Entrer un mail" name="mailUtilisateur" required>

                <label for="mdpUtilisateur"><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="mdpUtilisateur" required>

                <input type="submit" id='submit' value='Connexion' >
            </form>

            <div id="container2">
                <div id=inscrire><a href="<?= URL ?>inscription">Créer un compte / S'inscrire</a></div>
            </div>

        </div>
</main>



<?php
$content = ob_get_clean();
$titre = "Formulaire inscription";
require "template.php";
?>