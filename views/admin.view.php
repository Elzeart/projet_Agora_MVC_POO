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

<h2 class="titre-section-info">Bienvenue dans espace admin</h2>

<a href="<?= URL ?>admin/profil">Gestion du profil</a> <br>
<a href="<?= URL ?>admin/pAdmin">Gestion des synthéses des végétaux</a> <br>
<a href="<?= URL ?>trocAdmin">Gestion des Trocs</a> <br>
<a href="<?= URL ?>accueilAdmin">Gestion Accueil</a> <br>
<a href="<?= URL ?>ftAdmin">Gestion famille et type végétaux</a> <br>


<?php
$content = ob_get_clean();
$titre = "Bienvenue dans espace admin";
require "template.php";
?>