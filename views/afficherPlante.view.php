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
require "template.php";
?>