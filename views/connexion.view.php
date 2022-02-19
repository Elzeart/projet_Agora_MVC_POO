<?php 
ob_start(); 
if(!empty($_SESSION['alert'])) :
?>
<link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
<div class="alert alert-<?= $_SESSION['alert']['type'] ?>" role="alert">
    <?= $_SESSION['alert']['msg'] ?>
</div>
<?php 
unset($_SESSION['alert']);
endif; 
?>

<link rel="stylesheet" href="<?= URL ?>/public/css/connexion.css">
<!-- <h2 class="titre-section-info">Ici la page de connexion</h2> -->

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
$content = ob_get_clean();
$titre = "Formulaire inscription";
require "template.php";
?>