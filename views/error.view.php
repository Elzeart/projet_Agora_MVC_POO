<?php 
ob_start(); 
?>
<link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">

<h1 class="rounded border border-dark p-2 m-2 text-center text-white bg-info">Erreur !!!</h1>
<h2 class="text-center"><?= $msg; ?></h2>

<?php
$content = ob_get_clean();
/* $titre = "Erreur !!!"; */
// $titre = "Bienvenue dans xxx";
// $css = "nom_de_la_page_css";               Il est possible je pense de faire l'algo dans le template qui prend le css en inscrivant le css comme ceci.
require "template.php";
?>