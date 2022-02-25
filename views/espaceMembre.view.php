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
<link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">

<h2 class="titre-section-info">Bienvenue dans l'espace membre</h2>

<a href="<?= URL ?>espaceMembre/profil">Gestion du profil</a> <br>
<a href="<?= URL ?>espaceMembre/pTroc">Proposer un troc</a> <br>

<?php
$content = ob_get_clean();
$titre = "Bienvenue dans espace admin";
// $titre = "Bienvenue dans xxx";
// $css = "nom_de_la_page_css";               Il est possible je pense de faire l'algo dans le template qui prend le css en inscrivant le css comme ceci.
require "template.php";
?>