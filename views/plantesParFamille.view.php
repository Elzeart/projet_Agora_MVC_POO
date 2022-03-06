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

    <h2 class="titre-section-info">Fiches végétaux par famille</h2>

    <form method="POST" action="<?= URL ?>vegetaux/pTriParFamille/">
            <div class="chekboxs">
            
                <label for="idFamilleVegetal">Familles de végétaux</label>
                    <select name="idFamilleVegetal" onchange="submit()">
                        <?php foreach ($famillesVegetaux as $familleVegetal) : ?>
                            <option value="<?= $familleVegetal['idFamilleVegetal'] ?>"><?= $familleVegetal['nomFamilleVegetal'] ?></option>
                        <?php endforeach?>
                    </select>
            </div>
        </form>

        <form method="POST" action="<?= URL ?>vegetaux/pTriParType/">
            <div class="chekboxs">
            
                <label for="idTypeVegetal">Types de végétaux</label>
                    <select name="idTypeVegetal" onchange="submit()">
                        <?php foreach ($typesVegetaux as $typeVegetal) : ?>
                            <option value="<?= $typeVegetal['idTypeVegetal'] ?>"><?= $typeVegetal['nomTypeVegetal'] ?></option>
                        <?php endforeach?>
                    </select>
            </div>
        </form>

        <br><br>

<h3>Classement par Famille et Type</h3>
<form method="POST" action="<?= URL ?>vegetaux/pTriParFamilleEtType/">
    <div class="chekboxs">
        
        <label for="idFamilleVegetal">Familles de végétaux</label>
            <select name="idFamilleVegetal">
                <?php foreach ($famillesVegetaux as $familleVegetal) : ?>
                    <option value="<?= $familleVegetal['idFamilleVegetal'] ?>"><?= $familleVegetal['nomFamilleVegetal'] ?></option>
                <?php endforeach?>
            </select>
    </div>
    <div class="chekboxs">
        
        <label for="idTypeVegetal">Types de végétaux</label>
            <select name="idTypeVegetal">
                <?php foreach ($typesVegetaux as $typeVegetal) : ?>
                    <option value="<?= $typeVegetal['idTypeVegetal'] ?>"><?= $typeVegetal['nomTypeVegetal'] ?></option>
                <?php endforeach?>
            </select>
    </div>
    <button>Envoyer</button>
</form>

    <section class="section-info" id="infos">
<?php foreach ($familleVegetaux as $plant) : ?>
    
    <a href="<?= URL ?>vegetaux/p/<?= $plant['idVegetal']; ?>">
                <div class="carte-info">
                    <div class="container-photo-info">
                        <img src="<?= URL ?>public/images/<?= $plant['imageVegetal']; ?>">
                    </div>
                    <h2><?= $plant['nomVegetal']; ?></h2>
                    <p>
                        <?= $plant['infosVegetal']; ?>
                    </p>
                </div>
            </a>
    
    <?php endforeach?>
    </section>


</main>

<?php
$content = ob_get_clean();
$titre = "Les Végétaux";
// $titre = "Bienvenue dans xxx";
// $css = "nom_de_la_page_css";               Il est possible je pense de faire l'algo dans le template qui prend le css en inscrivant le css comme ceci.
require "template.php";
?>