<?php 
ob_start(); 
?>

<h2 class="titre-section-info">Trocs</h2>

<?php
$content = ob_get_clean();
$titre = "Les Trocs";
require "template.php";
?>