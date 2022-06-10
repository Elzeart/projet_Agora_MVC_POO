<?php 
ob_start(); 
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


<div class="row">
    <div class="col-6">
        <img src="<?= URL ?>public/images/plants/<?= $plant->getImageVegetal(); ?>" width="200px;">
    </div>
    <div class="col-6">
        <p>Titre : <?= $plant->getNomVegetal(); ?></p>
        <p>Infos : <?= $plant->getInfosVegetal(); ?></p>
        <p>Information sur la plantation : <?= $plant->getPlantationVegetal(); ?></p>
    </div>
</div>


<?php
$content = ob_get_clean();
require "template.php";
?>