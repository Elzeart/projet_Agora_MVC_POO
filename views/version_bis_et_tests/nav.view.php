<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/common.css">
    <link rel="stylesheet" href="./public/css/nav.css">
    <link rel="stylesheet" href="./public/css/footer.css">
    <link rel="stylesheet" href="./public/css/homepage.css">
    <link rel="icon" type="image/pngn" href="<?= URL ?>public/images/favicon.png">
    <script src="./public/javascript/nav.js" defer></script>
</head>
<body>

<nav class="navbar">
    <div class="brand-title">Agora Agriculture Urbaine</div>
    <a href="#" class="toggle-button">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </a>
    <div class="navbar-links">
        <ul>
            <li><a href="<?= URL ?>accueil">Accueil</a></li>
            <li><a href="<?= URL ?>vegetaux">Les végétaux</a></li>
            <li><a href="<?= URL ?>trocs">Espace de troc</a></li>
            <li><a href="<?= URL ?>contact">Contact</a></li>
            <?php if(empty($_SESSION['profil'])) : ?>
                <li><a href="<?= URL ?>connexionInscription">Connexion/Inscription</a></li>
            <?php else : ?> 
                <li><a href="<?= URL ?>espaceMembre">Espace membre</a></li>
                <li><a href="<?= URL ?>deconnexion">Déconnexion</a></li>
            <?php endif ?>
        </ul>
    </div>
</nav>







