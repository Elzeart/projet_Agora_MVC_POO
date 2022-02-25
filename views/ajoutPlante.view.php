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

<h2 class="titre-section-info">Ajout plante</h2>

<form method="POST" action="<?= URL ?>admin/av" enctype="multipart/form-data">
    <div class="form-group">
        <label for="titre">Titre : </label>
        <input type="text" class="form-control" id="titre" name="titre">
    </div>
    <div class="form-group">
        <label for="nbPages">Infos : </label>
        <input type="text" class="form-control" id="infosVegetal" name="infosVegetal">
    </div>
    <div class="form-group">
        <label for="nbPages">Information sur la plantation : </label>
        <input type="text" class="form-control" id="plantationVegetal" name="plantationVegetal">
    </div>
    <div class="form-group">
        <label for="image">Image : </label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>
<?php
$content = ob_get_clean();
$titre = "Ajout dune plante";
// $titre = "Bienvenue dans xxx";
// $css = "nom_de_la_page_css";               Il est possible je pense de faire l'algo dans le template qui prend le css en inscrivant le css comme ceci.
require "template.php";
?>