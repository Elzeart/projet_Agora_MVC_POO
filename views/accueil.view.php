<?php 
ob_start(); 
?>


<h2 class="titre-section-info">Ici la page d'accueil</h2>


<?php
$content = ob_get_clean();
$titre = "Ici la page d'accueil";
// $titre = "Bienvenue dans xxx";
// $css = "nom_de_la_page_css";               Il est possible je pense de faire l'algo dans le template qui prend le css en inscrivant le css comme ceci.
require "template.php";
?>