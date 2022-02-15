<?php 
ob_start(); 
?>
<h2 class="titre-section-info">Ici la page d'accueil</h2>


<?php
$content = ob_get_clean();
$titre = "Ici la page d'accueil";
require "template.php";
?>