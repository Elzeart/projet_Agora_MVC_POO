<?php 
ob_start(); 
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


<h1 class="rounded border border-dark p-2 m-2 text-center text-white bg-info">Erreur !!!</h1>
<h2 class="text-center"><?= $msg; ?></h2>

<?php
$page_title = "Page d'erreur";
$page_description = "Page d'erreur. Agora Agriculture Urbaine. Partage de savoir et trocs local concernant le monde végétal";
$content = ob_get_clean();
require "template.php";
?>