<?php 
ob_start(); 
?>

<link rel="stylesheet" href="<?= URL ?>/public/css/plants.css">

<main>

    <h2 class="titre-section-info">Fiches végétaux</h2>

    <div class="contain">

        <div id="container-boxs">
            <h3>Classement par Famille ou Type</h3>
            <form method="POST" action="<?= URL ?>vegetaux/pTriParFamille/">
                <div class="chekboxs">
                
                    <label for="idFamilleVegetal">Familles de végétaux</label> &ensp;
                    <select name="idFamilleVegetal" onchange="submit()">
                        <?php foreach ($famillesVegetaux as $familleVegetal) : ?>
                            <option value="<?= $familleVegetal['idFamilleVegetal'] ?>"><?= $familleVegetal['nomFamilleVegetal'] ?></option>
                        <?php endforeach?>
                    </select>
                </div>
            </form>
            <form method="POST" action="<?= URL ?>vegetaux/pTriParType/">
                <div class="chekboxs">
                
                    <label for="idTypeVegetal">Types de végétaux</label> &ensp;
                    <select name="idTypeVegetal" onchange="submit()">
                        <?php foreach ($typesVegetaux as $typeVegetal) : ?>
                            <option value="<?= $typeVegetal['idTypeVegetal'] ?>"><?= $typeVegetal['nomTypeVegetal'] ?></option>
                        <?php endforeach?>
                    </select>
                </div>
            </form>
        </div>

        <div id="container-boxs">
                <form method="POST" action="<?= URL ?>vegetaux/recherche/">
                    <div class="chekboxs">
                        <input type="search" name="recherche" placeholder="recherche">
                    </div>
                    <div class="button">
                        <button type="submit">Envoyer</button>
                    </div>
            </form>
        </div>

        <div id="container-boxs">
            <form method="POST" action="<?= URL ?>vegetaux/pTriParFamilleEtType/">
                <h3>Classement par Famille et Type</h3>
                <div class="chekboxs">
                    
                    <label for="idFamilleVegetal">Familles de végétaux</label> &ensp;
                        <select name="idFamilleVegetal">
                            <?php foreach ($famillesVegetaux as $familleVegetal) : ?>
                                <option value="<?= $familleVegetal['idFamilleVegetal'] ?>"><?= $familleVegetal['nomFamilleVegetal'] ?></option>
                            <?php endforeach?>
                        </select>
                </div>
                <div class="chekboxs">
                    
                    <label for="idTypeVegetal">Types de végétaux</label> &ensp;
                        <select name="idTypeVegetal">
                            <?php foreach ($typesVegetaux as $typeVegetal) : ?>
                                <option value="<?= $typeVegetal['idTypeVegetal'] ?>"><?= $typeVegetal['nomTypeVegetal'] ?></option>
                            <?php endforeach?>
                        </select>
                    
                </div>
                <div class="button"><button>Envoyer</button></div>
            </form>
        </div>

    </div>

        

    <section class="section-info" id="infos">
        <?php foreach ($plants as $plant) : ?>
            <a href="<?= URL ?>vegetaux/p/<?= $plant->getIdVegetal(); ?>">
                <div class="carte-info">
                    <div class="container-photo-info">
                        <img src="<?= URL ?>public/images/plants/<?= $plant->getImageVegetal(); ?>" alt="...">
                    </div>
                    <h2><?= $plant->getNomVegetal(); ?></h2>
                    <p>
                        <?= $plant->getInfosVegetal(); ?>
                    </p>
                </div>
            </a>
        <?php endforeach?>
    </section>

</main>

<?php
$page_title = "Fiches plantes";
$page_description = "Fiches plantes de l'Agora Agriculture Urbaine. Partage de savoir et trocs local concernant le monde végétal";
$content = ob_get_clean();
require "template.php";
?>