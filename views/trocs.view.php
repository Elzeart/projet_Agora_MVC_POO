<?php 
ob_start(); 
?>

<link rel="stylesheet" href="<?= URL ?>/public/css/troc.css">

<h2 class="titre-section-info">Trocs</h2>

    <div class="chekboxs">
        <form method="POST" action="#">
            <label class="container">Légumes</label>
            <input type="checkbox" checked="checked" onchange="submit()">
            <label class="container">Fruits</label>
            <input type="checkbox" checked="checked" onchange="submit()">
        </form>
    </div>

    <div class="cards">
        <div class="card">
            <h2 class="card-title">Rose</h2>
            <img src="<?= URL ?>public/images/ephemere/RosePetale.jpg" alt="">
            <p class="card-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. At deleniti blanditiis deserunt accusamus aliquam eveniet quia exercitationem, doloremque, fugit doloribus ab? Iure beatae quo dolorum fugit sunt. Quae, cumque laboriosam? <a href="">Contacter</a> </p>
        </div>

        <div class="card">
            <h2 class="card-title">Plantes</h2>
            <img src="<?= URL ?>public/images/ephemere/plante2.webp" alt="">
            <p class="card-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. At deleniti blanditiis deserunt accusamus aliquam eveniet quia exercitationem, doloremque, fugit doloribus ab? Iure beatae quo dolorum fugit sunt. Quae, cumque laboriosam? <a href="">Contacter</a> </p>
        </div>
        <div class="card">
            <h2 class="card-title">Prêle</h2>
            <img src="<?= URL ?>public/images/ephemere/plante3.jpg" alt="">
            <p class="card-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. At deleniti blanditiis deserunt accusamus aliquam eveniet quia exercitationem, doloremque, fugit doloribus ab? Iure beatae quo dolorum fugit sunt. Quae, cumque laboriosam? <a href="">Contacter</a> </p>
        </div>
        <div class="card">
            <h2 class="card-title">Prune</h2>
            <img src="<?= URL ?>public/images/ephemere/prune.jpg" alt="">
            <p class="card-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. At deleniti blanditiis deserunt accusamus aliquam eveniet quia exercitationem, doloremque, fugit doloribus ab? Iure beatae quo dolorum fugit sunt. Quae, cumque laboriosam? <a href="">Contacter</a> </p>
        </div>
        <div class="card">
            <h2 class="card-title">Plantes</h2>
            <img src="<?= URL ?>public/images/ephemere/plante1.webp" alt="">
            <p class="card-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. At deleniti blanditiis deserunt accusamus aliquam eveniet quia exercitationem, doloremque, fugit doloribus ab? Iure beatae quo dolorum fugit sunt. Quae, cumque laboriosam? <a href="">Contacter</a> </p>
        </div>
        <div class="card">
            <h2 class="card-title">Violettes</h2>
            <img src="<?= URL ?>public/images/ephemere/violette.jpeg" alt="">
            <p class="card-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. At deleniti blanditiis deserunt accusamus aliquam eveniet quia exercitationem, doloremque, fugit doloribus ab? Iure beatae quo dolorum fugit sunt. Quae, cumque laboriosam? <a href="">Contacter</a> </p>
        </div>
    </div>

<?php
$page_title = "Trocs";
$page_description = "Espace de trocs. Agora Agriculture Urbaine. Partage de savoir et trocs local concernant le monde végétal";
$content = ob_get_clean();
require "template.php";
?>