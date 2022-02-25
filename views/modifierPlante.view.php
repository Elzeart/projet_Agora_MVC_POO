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

<form method="POST" action="<?= URL ?>admin/mv" enctype="multipart/form-data">
    <div class="form-group">
        <label for="titre">Changer titre : </label>
        <input type="text" class="form-control" id="titre" name="titre" value="<?= $plant->getNomVegetal() ?>">
    </div>
    <div class="form-group">
        <label for="nbPages">Changer infos : </label>
        <input type="text" class="form-control" id="nbPages" name="infos" value="<?= $plant->getInfosVegetal() ?>">
    </div>
    <h3>Image : </h3>
    <img src="<?= URL ?>public/images/<?= $plant->getImageVegetal() ?>" alt="">
    <div class="form-group">
        <label for="image">Changer image : </label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <input type="hidden" name="identifiant" value="<?= $plant->getIdVegetal() ?>">
    <button type="submit" class="btn btn-primary">Valider</button>
</form>

<?php
$content = ob_get_clean();
$titre = "Modification d'une plante' : ".$plant->getIdVegetal();
// $titre = "Bienvenue dans xxx";
// $css = "nom_de_la_page_css";               Il est possible je pense de faire l'algo dans le template qui prend le css en inscrivant le css comme ceci.
require "template.php";
?>