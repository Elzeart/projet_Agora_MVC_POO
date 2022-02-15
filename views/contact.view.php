<?php 
ob_start(); 
?>

<h2 class="titre-section-info">Contact</h2>

<?php
$content = ob_get_clean();
$titre = "Formulaire de contact";
require "template.php";
?>