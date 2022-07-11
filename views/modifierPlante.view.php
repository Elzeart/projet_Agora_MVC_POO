<?php 
ob_start(); 
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<h1 class="titre-section-info text-center">Modifier une plante</h1>

<form method="POST" action="<?= URL ?>admin/mv" enctype="multipart/form-data">
    <div class="form-group">
        <label for="titre">Changer titre : </label>
        <input type="text" class="form-control" id="titre" name="titre" value="<?= $plant->getNomVegetal() ?>">
    </div>
    <div class="form-group">
        <label for="infos">Changer infos : </label>
        <input type="text" class="form-control" id="infos" name="infos" value="<?= $plant->getInfosVegetal() ?>">
    </div>
    <div class="form-group">
        <label for="infoPlantation">Infos plantation : </label>
        <input type="text" class="form-control" id="infoPlantation" name="infoPlantation" value="<?= $plant->getPlantationVegetal() ?>">
    </div>
    <div class="form-group pt-2 pb-2">
        <label for="image">Image actuelle : </label>
        <img src="<?= URL ?>public/images/plants/<?= $plant->getImageVegetal() ?>" alt="Image : <?= $plant->getNomVegetal() ?>" class="w-25">
    </div>
    <div class="form-group pb-2">
        <label for="image">Changer image : </label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <div class="form-group">
        <label for="idFamilleVegetal">Familles de végétaux</label> &ensp;
        <select name="idFamilleVegetal">
            <option value="<?= $plant->getIdFamilleVegetal() ?>"><?= $familleVegetalEnCours['nomFamilleVegetal'] ?></option>
            <?php foreach ($famillesVegetaux as $familleVegetal) : ?>
                <option value="<?= $familleVegetal['idFamilleVegetal'] ?>"><?= $familleVegetal['nomFamilleVegetal'] ?></option>
            <?php endforeach?>
        </select>
    </div>
    <br>

    <div class="form-group">
        <label for="idTypeVegetal">Types de végétaux</label> &ensp;
        <select name="idTypeVegetal">
            <option value="<?= $typeFamillePlant['idTypeVegetal'] ?>"><?= $typeFamillePlant['nomTypeVegetal'] ?></option>
            <?php foreach ($typesVegetaux as $typeVegetal) : ?>
                <option value="<?= $typeVegetal['idTypeVegetal'] ?>"><?= $typeVegetal['nomTypeVegetal'] ?></option>
            <?php endforeach?>
        </select>
    </div>
    <div class="form-group pb-1">
        <input type="hidden" name="identifiant" value="<?= $plant->getIdVegetal() ?>">
        <button type="submit" class="btn btn-primary">Valider</button>
    </div>
</form>

<?php
$page_title = "Modifier une plante";
$page_description = "Modifier une plante par un administrateur. Agora Agriculture Urbaine. Partage de savoir et trocs local concernant le monde végétal";
$content = ob_get_clean();
require "template.php";
?>

