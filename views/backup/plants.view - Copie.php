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
    for($i=0; $i < count($plants);$i++) : 
    ?>
    <tr>
        <td class="align-middle"><img src="public/images/<?= $plants[$i]->getImageVegetal(); ?>" width="60px;"></td>
        <td class="align-middle"><a href="<?= URL ?>vegetaux/p/<?= $plants[$i]->getIdVegetal(); ?>"><?= $plants[$i]->getNomVegetal(); ?></a></td>
        <td class="align-middle"><?= $plants[$i]->getInfosVegetal(); ?></td>
        <td class="align-middle"><a href="<?= URL ?>vegetaux/m/<?= $plants[$i]->getIdVegetal(); ?>" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle">
            <form method="POST" action="<?= URL ?>vegetaux/s/<?= $plants[$i]->getIdVegetal(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer la plante ?');">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
    <?php endfor; ?>
</table>
<a href="<?= URL ?>vegetaux/a" class="btn btn-success d-block">Ajouter</a>


<?php
$content = ob_get_clean();
$titre = "Les Végétaux";
require "template.php";
?>