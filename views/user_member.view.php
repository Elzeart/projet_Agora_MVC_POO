<?php 
ob_start(); 
?>

Espace Membre

<?php
$content = ob_get_clean();
$titre = "Bienvenue dans espace membre";
require "template.php";
?>