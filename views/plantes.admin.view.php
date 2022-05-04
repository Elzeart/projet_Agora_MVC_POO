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
    <!-- <link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?= URL ?>/public/css/plantes.admin.css">

    <h2 class="titre-section-info">Fiches végétaux</h2>


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
                        <td class="align-middle"><img src="<?= URL ?>public/images/plants/<?= $plants[$i]->getImageVegetal(); ?>" width="60px;"></td>
                        <td class="align-middle"><a href="<?= URL ?>admin/p/<?= $plants[$i]->getIdVegetal(); ?>"><?= $plants[$i]->getNomVegetal(); ?></a></td>
                        <td class="align-middle"><?= $plants[$i]->getInfosVegetal(); ?></td>
                        <td class="align-middle"><?= $plants[$i]->getPlantationVegetal(); ?></td>
                        <td class="align-middle"><a href="<?= URL ?>admin/m/<?= $plants[$i]->getIdVegetal(); ?>" class="btn btn-warning">Modifier</a></td>
                        <td class="align-middle">
                            <form method="POST" action="<?= URL ?>admin/s/<?= $plants[$i]->getIdVegetal(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer la plante ?');">
                                <button class="btn btn-danger" type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
                <a href="<?= URL ?>admin/a/" class="btnAjout">Ajouter</a> 

<!--             <table class="table text-center">
    <tr class="table-dark">  
        <th>Image</th>
        <th>Titre</th>
        <th>Synthèse</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php 
    for($i=0; $i < count($plants);$i++) : 
    ?>
    <tr>
        <td class="align-middle"><img src="<?= URL ?>public/images/<?= $plants[$i]->getImageVegetal(); ?>" width="60px;"></td>
        <td class="align-middle"><a href="<?= URL ?>admin/p/<?= $plants[$i]->getIdVegetal(); ?>"><?= $plants[$i]->getNomVegetal(); ?></a></td>
        <td class="align-middle"><?= $plants[$i]->getInfosVegetal(); ?></td>
        <td class="align-middle"><a href="<?= URL ?>admin/m/<?= $plants[$i]->getIdVegetal(); ?>" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle">
            <form method="POST" action="<?= URL ?>admin/s/<?= $plants[$i]->getIdVegetal(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer la plante ?');">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
    <?php endfor; ?>
</table>
<a href="<?= URL ?>admin/a/" class="btn btn-success d-block">Ajouter</a> -->


<?php
$content = ob_get_clean();
$titre = "Les Végétaux";
// $titre = "Bienvenue dans xxx";
// $css = "nom_de_la_page_css";               Il est possible je pense de faire l'algo dans le template qui prend le css en inscrivant le css comme ceci.
require "template.php";
?>