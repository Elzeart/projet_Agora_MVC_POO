<?php 
ob_start(); 
?>

    <link rel="stylesheet" href="<?= URL ?>/public/css/planteHasard.css">

    <h1>Test API plantes</h1>
    <div id="containPlanteHasard">
        <h2 id="titre"></h2>
        <p id="parag"></p>
        <img id="im" src="" alt="" name="">
        <script>
            let imgAffichage = document.getElementById("im");
            let titre =  document.getElementById("titre");
            let parag = document.getElementById("parag");
            fetch("<?= URL ?>public/json/plante.json")
            .then(res => res.json())
            .then(data=> {
                let hasard = Math.floor(Math.random()*708);
                imgAffichage.src=data[hasard].image;
                imgAffichage.name=data[hasard].name;
                titre.innerText = data[hasard].name;
                parag.innerText = data[hasard].description;
            });
        </script>
    </div>

<?php
$page_title = "Plante au hasard";
$page_description = "Découvrer une plante";
$content = ob_get_clean();
require "template.php";
?>



