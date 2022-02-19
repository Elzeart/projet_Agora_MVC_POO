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

<h1 style="padding-top : 100px"> Profil de <?= $data['pseudoUtilisateur'] ?></h1>
<?= $_SESSION['profil']['idDroit'] ?>

<?php
$content = ob_get_clean();
// $titre = "Bienvenue dans espace admin";
require "template.php";
?>