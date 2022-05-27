<?php 
ob_start(); 
?>

<link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">

<h2 class="titre-section-info">Bienvenue dans l'espace membre</h2>

<a href="<?= URL ?>espaceMembre/profil">Gestion du profil</a> <br>
<a href="<?= URL ?>espaceMembre/pTroc">Proposer un troc</a> <br>

<?php
$content = ob_get_clean();
require "template.php";
?>