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
<link rel="stylesheet" href="<?= URL ?>/public/css/espaceMembre.css">

<main>
        <div id="container">
            
            <form method="POST">
                <!-- <h1>Espace utilisateur</h1> -->
                <h2>Bienvenue <?php echo $_SESSION['profil']['pseudoUtilisateur'] ?></h2>
                
                <h3>Supprimer</h3> <br>

                <label for="telephoneUtilisateur"><b>Téléphone</b></label>
                <!-- <input type="number" placeholder="Pour modifer votre téléphone, entrez un nouveau numéro" name="telephoneUtilisateur"> -->
                <!-- <input type="number" placeholder="Téléphone actuel : <?php echo $_SESSION['profil']['pseudoUtilisateur'] ?>" name="telephoneUtilisateur"> -->

                <input type="submit" id='submit' value='Supprimer le numéro de téléphone : <?php echo $_SESSION['profil']['pseudoUtilisateur'] ?>' >

                <h3>Modifier</h3> <br>

                <label for="pseudoUtilisateur"><b>Pseudo</b></label>
                <input type="email" placeholder="Pour modifer votre pseudo : <?php echo $_SESSION['profil']['pseudoUtilisateur'] ?>" name="pseudoUtilisateur">

                <input type="submit" id='submit' value='Modifier' >

                <a href="deconnexion.php">Deconnexion</a> <br>
            </form>
        </div>
    </main>

<?php
$content = ob_get_clean();
$titre = "Bienvenue dans espace membre";
require "template.php";
?>