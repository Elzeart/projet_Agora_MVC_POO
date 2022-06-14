<?php 
ob_start(); 
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<h1 class="titre-section-info">Bienvenue dans espace admin</h1>

<a href="<?= URL ?>admin/profil" class="text-dark text-decoration-none">Gestion du profil</a> <br>
<a href="<?= URL ?>accueilAdmin" class="text-dark text-decoration-none">Gestion Accueil</a> <br>
<a href="<?= URL ?>admin/pAdmin" class="text-dark text-decoration-none">Gestion des synthéses des végétaux</a> <br>
<a href="<?= URL ?>admin/trocAdmin" class="text-dark text-decoration-none">Gestion des Trocs</a> <br>
<a href="<?= URL ?>admin/ftAdmin" class="text-dark text-decoration-none">Gestion famille et type végétaux</a> <br>
<a href="<?= URL ?>admin/droits" class="text-dark text-decoration-none">Gestion des droits</a> <br>

<?php
$page_title = "Aministration du site";
$page_description = "Page d'administration de l'Agora Agriculture Urbaine";
$content = ob_get_clean();
require "template.php";
?>