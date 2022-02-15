<?php 
ob_start(); 
?>
<link rel="stylesheet" href="<?= URL ?>/public/css/inscription.css">

<!-- <h2 class="titre-section-info">La page d'inscription</h2> -->

<main>
        <div id="container">
            <form action="<?=URL?>inscriptionValid" method="post">
                    <h1>Inscription</h1>
                <div id="displayforms">
                    <div class="columnform">
                        <label for="nomUtilisateur">Nom</label>
                        <input type="text" name="nomUtilisateur" placeholder="Entrez un nom" required> <br>
                        <label for="prenomUtilisateur">Prénom</label>
                        <input type="text" name="prenomUtilisateur" placeholder="Entrez un prénom" required> <br>
                        <label for="pseudoUtilisateur">Pseudo</label>
                        <input type="text" name="pseudoUtilisateur" placeholder="Entrez un pseudonyme"> <br>
                    </div>
                    <div class="columnform">
                        <label for="mdpUtilisateur">Mot de passe</label>
                        <input type="password" name="mdpUtilisateur" minlength="8" placeholder="Entrez un mot de passe" required> <br>
                        <label for="confirmMdpUtilisateur">Confirmer mot de passe</label>
                        <input type="password" name="confirmMdpUtilisateur" minlength="8" placeholder="Veillez confirmer le mot de passe" required> <br>
                    </div>
                </div>
                <div class="bouton"><input type="submit" id='submit' value="AJOUTER"></div>
                <a href="<?= URL ?>connexionInscription">Se connecter</a>
                <div id="validation_inscription"> </div>
            </form>
        </div>
    </main>

<?php
$content = ob_get_clean();
$titre = "Inscription formulaire";
require "template.php";
?>