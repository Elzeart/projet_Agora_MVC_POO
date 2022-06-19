<?php 
ob_start(); 
?>

<link rel="stylesheet" href="<?= URL ?>/public/css/meteo.css">

<h1>Météo Cahors</h1>

<div id="containMétéo">
    <div>
        <h2>Météo Cahors</h2> <br/>
        <h4 id="description"></h4>
        <img id="img" src="" alt="" name="">
        <h4 id="temperature">Température</h4>
        <h4 id="temperatureResentie">Température resentie</h4>
        <h4 id="minTemperature"></h4>
        <h4 id="maxTemperature"></h4>
        <h4 id="pressure"></h4>
        <h4 id="humidity"></h4>
        <h4 id="windSpeed"></h4>
        <h4 id="windDirection"></h4>
        <br/>
    </div>
</div>

<script src="<?= URL ?>/public/javascript/meteo.js"></script>

<?php
$page_title = "Météo locale";
$page_description = "Météo locale. Agora Agriculture Urbaine. Partage de savoir et trocs local concernant le monde végétal";
$content = ob_get_clean();
require "template.php";
?>

