
<!-- //////////////////////////////////////////////////////////////////////////////////////// -->

<!-- Pour afficher en foreach les cards -->

<section class="section-info" id="infos">
<?php foreach ($plants as $plant) : ?>
    
    <a href="<?= URL ?>vegetaux/p/<?= $plant->getIdVegetal(); ?>">
                <div class="carte-info">
                    <div class="container-photo-info">
                        <img src="public/images/<?= $plant->getImageVegetal(); ?>">
                    </div>
                    <h2><?= $plant->getNomVegetal(); ?></h2>
                    <p>
                        <?= $plant->getInfosVegetal(); ?>
                    </p>
                </div>
            </a>
    
    <?php endforeach?>
    </section>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->

<!-- Pour afficher origine avec for et $i les cards -->

<section class="section-info" id="infos">
    <?php for($i=0; $i < count($plants);$i++) : ?>
    
    <a href="<?= URL ?>vegetaux/p/<?= $plants[$i]->getIdVegetal(); ?>">
                <div class="carte-info">
                    <div class="container-photo-info">
                        <img src="public/images/<?= $plants[$i]->getImageVegetal(); ?>">
                    </div>
                    <h2><?= $plants[$i]->getNomVegetal(); ?></h2>
                    <p>
                        <?= $plants[$i]->getInfosVegetal(); ?>
                    </p>
                </div>
            </a>
    
    <?php endfor; ?>
    </section>

    <!-- //////////////////////////////////////////////////////////////////////////////////////// -->


