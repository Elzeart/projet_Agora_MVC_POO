<?php 
ob_start(); 
?>

<link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">

<div class="row">
    <div class="col-6">
        <img src="<?= URL ?>public/images/<?= $plant->getImageVegetal(); ?>" width="200px;">
    </div>
    <div class="col-6">
        <p>Titre : <?= $plant->getNomVegetal(); ?></p>
        <p>Infos : <?= $plant->getInfosVegetal(); ?></p>
        <p>Information sur la plantation : <?= $plant->getPlantationVegetal(); ?></p>
    </div>
</div>


<?php
$content = ob_get_clean();
$titre = $plant->getNomVegetal();
// $titre = "Bienvenue dans xxx";
// $css = "nom_de_la_page_css";               Il est possible je pense de faire l'algo dans le template qui prend le css en inscrivant le css comme ceci.
require "template.php";
?>