<?php 
ob_start(); 
?>
<link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">

<h2 class="titre-section-info">Bienvenue dans espace admin</h2>

<a href="<?= URL ?>admin/profil">Gestion du profil</a> <br>
<a href="<?= URL ?>accueilAdmin">Gestion Accueil</a> <br>
<a href="<?= URL ?>admin/pAdmin">Gestion des synthéses des végétaux</a> <br>
<a href="<?= URL ?>admin/trocAdmin">Gestion des Trocs</a> <br>
<a href="<?= URL ?>admin/ftAdmin">Gestion famille et type végétaux</a> <br>
<a href="<?= URL ?>admin/droits">Gestion des droits</a> <br>


<?php
$content = ob_get_clean();
$titre = "Bienvenue dans espace admin";
// $titre = "Bienvenue dans xxx";
// $css = "nom_de_la_page_css";               Il est possible je pense de faire l'algo dans le template qui prend le css en inscrivant le css comme ceci.
require "template.php";
?>