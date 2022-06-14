<?php 
ob_start(); 
?>


<link rel="stylesheet" href="<?= URL ?>/public/css/connexion.css">

<main>
        <div id="container">
            
            <form method="POST" action="ValidationConnexion">
                <h1>Connexion</h1>
                
                <label for="pseudoUtilisateur"><b>Pseudo</b></label>
                <input type="text" placeholder="Entrer votre pseudo" name="pseudoUtilisateur" id="pseudoUtilisateur" required>

                <label for="mdpUtilisateur"><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="mdpUtilisateur" id="mdpUtilisateur" required>

                <input type="submit" id='submit' value='Connexion' >
            </form>

            <div id="container2">
                <div id=inscrire><a href="<?= URL ?>inscription">Créer un compte / S'inscrire</a></div>
            </div>

        </div>
</main>



<?php
$page_title = "Connexion";
$page_description = "Connexion à l'Agora Agriculture Urbaine. Partage de savoir et trocs local concernant le monde végétal";
$content = ob_get_clean();
require "template.php";
?>