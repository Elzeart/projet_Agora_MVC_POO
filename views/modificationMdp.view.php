<?php 
ob_start(); 
?>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
<link rel="stylesheet" href="<?= URL ?>/public/css/connexion.css">

<main>
        <div id="container">
            <h1>Modification du mot de passe - <?= $_SESSION['profil']['pseudoUtilisateur']?></h1>
            <?php if($_SESSION['profil']['idDroit'] == 1){$url="admin";} elseif($_SESSION['profil']['idDroit'] == 2){$url="espaceMembre";} ?>
            <form method="POST" action="<?= URL ?>/<?= $url ?>/validationModificationMdp">
            
                
                <label for="ancienMdpUtilisateur"><b>Ancien mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot passe à changer" name="ancienMdpUtilisateur" id="ancienMdpUtilisateur" required>

                <label for="nouveauMdpUtilisateur"><b>Nouveau mot de passe</b></label>
                <input type="password" placeholder="Entrer le nouveau mot passe " name="nouveauMdpUtilisateur" id="nouveauMdpUtilisateur" required>

                <label for="confirmNouveauMdpUtilisateur"><b>Confirmer mot de passe</b></label>
                <input type="password" placeholder="Confirmer le mot passe" name="confirmNouveauMdpUtilisateur" id="confirmNouveauMdpUtilisateur" required>

                <input type="submit" id='submit' value='Valider modidification' disabled>
            </form>

            <div id="container2" class="d-none">
                Les passwords ne correspondent pas
            </div>

        </div>
</main>

<script src="<?= URL ?>/public/javascript/modifMdp.js"></script>

<?php
$content = ob_get_clean();
require "template.php";
?>