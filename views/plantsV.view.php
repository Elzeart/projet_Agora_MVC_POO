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

<link rel="stylesheet" href="<?= URL ?>/public/css/plants.css">

<main>

<h2 class="titre-section-info">Fiches végétaux</h2>

<section class="section-info" id="infos">
<?php 
    for($i=0; $i < count($plants);$i++) : 
?>
<a href="<?= URL ?>vegetaux/p/<?= $plants[$i]->getIdVegetal(); ?>">
            <div class="carte-info">
                <div class="container-photo-info">
                    <img src="public/images/<?= $plants[$i]->getImageVegetal(); ?>">
                </div>
                <h2><?= $plants[$i]->getNomVegetal(); ?></h2>
                <p>
                    <?= $plants[$i]->getInfosVegetal(); ?>
                </p>
            </div>
        </a>
<?php endfor; ?>
</section>

</main>

<?php
$content = ob_get_clean();
$titre = "Les Végétaux";
require "template.php";
?>