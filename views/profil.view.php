<?php 
ob_start(); 
?>

<h1 style="padding-top : 100px"> Profil de <?= $data['pseudoUtilisateur'] ?></h1>
<?= $_SESSION['profil']['idDroit'] ?>

<?php
$content = ob_get_clean();
// $titre = "Bienvenue dans espace admin";
require "template.php";
?>