<?php 
ob_start(); 
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


<h2 class="titre-section-info">Bienvenue dans l'espace membre</h2>

<a href="<?= URL ?>espaceMembre/profil">Gestion du profil</a> <br>
<a href="<?= URL ?>espaceMembre/pTroc">Proposer un troc</a> <br>

<?php
$content = ob_get_clean();
require "template.php";
?>