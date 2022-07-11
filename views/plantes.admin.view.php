<?php 
ob_start(); 
?>

    <link rel="stylesheet" href="<?= URL ?>/public/css/plantes.admin.css">

    <h1 class="titre-section-info">Fiches végétaux</h1>

<table class="table-style">
    <thead>
        <tr>
            <th>Image</th>
            <th>Titre</th>
            <th>Synthèse</th>
            <th>Information sur la plantation :</th>
            <th colspan="2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        for($i=0; $i < count($plants);$i++) : 
        ?>
        <tr>
            <td class="align-middle"><img src="<?= URL ?>public/images/plants/<?= $plants[$i]->getImageVegetal(); ?>
            " width="60px;" alt="Image : <?= $plants[$i]->getNomVegetal(); ?>"></td>
            <td class="align-middle"><a href="<?= URL ?>admin/p/<?= $plants[$i]->getIdVegetal(); ?>"><?= $plants[$i]->getNomVegetal(); ?></a></td>
            <td class="align-middle"><?= $plants[$i]->getInfosVegetal(); ?></td>
            <td class="align-middle"><?= $plants[$i]->getPlantationVegetal(); ?></td>
            <td class="align-middle">
                <a href="<?= URL ?>admin/m/<?= $plants[$i]->getIdVegetal(); ?>" class="btn btn-warning">Modifier</a>
            </td>
            <td class="align-middle">
                <form method="POST" action="<?= URL ?>admin/s/<?= $plants[$i]->getIdVegetal(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer la plante ?');">
                    <button class="btnSup" type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endfor; ?>
    </tbody>
</table>
<a href="<?= URL ?>admin/a/" class="btnAjout">Ajouter</a> 

<?php
$page_title = "Gestion des fiches de plantes";
$page_description = "Gestion des fiches de plantes. Agora Agriculture Urbaine. Partage de savoir et trocs local concernant le monde végétal";
$content = ob_get_clean();
require "template.php";
?>