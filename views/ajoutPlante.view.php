<?php 
ob_start(); 
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<h1 class="titre-section-info text-center">Ajout plante</h1>

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
        <label for="nbPages">Informations sur la plantation : </label>
        <input type="text" class="form-control" id="plantationVegetal" name="plantationVegetal">
    </div>
    <div class="form-group">
        <label for="image">Image : </label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <br>

    <div class="form-group">
        <label for="idFamilleVegetal">Familles de végétaux</label> &ensp;
        <select name="idFamilleVegetal">
            <?php foreach ($famillesVegetaux as $familleVegetal) : ?>
                <option value="<?= $familleVegetal['idFamilleVegetal'] ?>"><?= $familleVegetal['nomFamilleVegetal'] ?></option>
            <?php endforeach?>
        </select>
    </div>
    <br>

    <div class="form-group">
        <label for="idTypeVegetal">Types de végétaux</label> &ensp;
        <select name="idTypeVegetal">
            <?php foreach ($typesVegetaux as $typeVegetal) : ?>
                <option value="<?= $typeVegetal['idTypeVegetal'] ?>"><?= $typeVegetal['nomTypeVegetal'] ?></option>
            <?php endforeach?>
        </select>
    </div>
    <br>

    <button type="submit" class="btn btn-primary">Valider</button>
</form>
<?php
$page_title = "Ajouter une plante";
$page_description = "Administrateur peut ajouter une plante. Agora Agriculture Urbaine. Partage de savoir et trocs local concernant le monde végétal";
$content = ob_get_clean();
require "template.php";
?>