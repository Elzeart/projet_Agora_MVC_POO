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

    <h2 class="titre-section-info">Fiches végétaux</h2>

    <table class="table text-center">
    <tr class="table-dark">  
        <th>Image</th>
        <th>Titre</th>
        <th>Synthèse</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php 
    /* for($i=0; $i < count($plants);$i++) :  */
    foreach($plants as $plant) : 
    ?>
    <tr>
        <td class="align-middle"><img src="public/images/<?= $plant->getImageVegetal(); ?>" width="60px;"></td>
        <td class="align-middle"><a href="<?= URL ?>vegetaux/p/<?= $plant->getIdVegetal(); ?>"><?= $plant->getNomVegetal(); ?></a></td>
        <td class="align-middle"><?= $plant->getInfosVegetal(); ?></td>
        <td class="align-middle"><a href="<?= URL ?>vegetaux/m/<?= $plant->getIdVegetal(); ?>" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle">
            <form method="POST" action="<?= URL ?>vegetaux/s/<?= $plant->getIdVegetal(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer la plante ?');">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
    <?php 
    endforeach;
    /* endfor; */ 
    ?>
    </table>
<a href="<?= URL ?>vegetaux/a" class="btn btn-success d-block">Ajouter</a>


<?php
$content = ob_get_clean();
$titre = "Les Végétaux";
require "template.php";
?>