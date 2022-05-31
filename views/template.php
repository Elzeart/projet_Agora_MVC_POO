<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agora Agriculture Urbaine</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&family=Montserrat&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= URL ?>/public/css/common.css">
    <link rel="stylesheet" href="<?= URL ?>/public/css/nav.css">
    <link rel="stylesheet" href="<?= URL ?>/public/css/footer.css">
    <link rel="icon" type="image/pngn" href="<?= URL ?>public/images/favicon.png">
    <script src="<?= URL ?>/public/javascript/nav.js" defer></script>
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
            <?php elseif (!empty($_SESSION['profil']) && !empty($_SESSION['profil']['idDroit'] == 1)) : ?>
                <li><a href="<?= URL ?>admin">Admin</a></li>
                <li><a href="<?= URL ?>deconnexion">Déconnexion</a></li>
            <?php else : ?> 
                <li><a href="<?= URL ?>espaceMembre">Espace membre</a></li>
                <li><a href="<?= URL ?>deconnexion">Déconnexion</a></li>
            <?php endif ?>
        </ul>
    </div>
</nav>

    <div class="container">
        <?php 
            if(!empty($_SESSION['alert'])) {
                echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">';
                foreach($_SESSION['alert'] as $alert){
                    echo    "<div class='alert ". $alert['type'] ."' role='alert'>
                                ".$alert['message']."
                            </div>";
                }
                unset($_SESSION['alert']);
            }
        ?>
        <?= $content ?>
    </div>

    <footer>
    <div class="content-footer">
        <div class="bloc footer-services">
        <h3>Plan du site</h3>
        <ul class="services-list">
            <li><a href="#">Agenda</a></li>
            <li><a href="#">Actualité</a></li>
            <li><a href="#">Végétaux</a></li>
            <li><a href="#">Trocs</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        </div>

        <div class="bloc footer-contact">
        <h3>Coordonnées</h3>
        <p>01 02 03 04 05 06</p>
        <p>mail@contact.com</p>
        <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2848.4221379156575!2d1.4364570157419192!3d44.44501450888534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12ac8932badf663b%3A0x85534b3fbfe238d1!2sAgora%20d&#39;agriculture%20urbaine!5e0!3m2!1sfr!2sfr!4v1643280721077!5m2!1sfr!2sfr" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe></p>
        </div>

        <div class="bloc footer-schedule">
        <h3>Permanence téléphonique</h3>
        <ul class="schedule-list">
            <li>✔️ Lun 18-19</li>
            <li>✔️ Mar 18-19</li>
            <li>✔️ Mer 18-19</li>
            <li>✔️ Jeu 18-19</li>
            <li>✔️ Ven 18-19</li>
            <li>❌ Sam</li>
            <li>❌ Dim</li>
        </ul>
        </div>

        <div class="bloc footer-medias">
        <h3>Réseaux sociaux</h3>
        <ul class="media-list">

            <li>
            <a href="https://www.facebook.com/groups/780227006229474/" target="_blank">
                <svg
                aria-hidden="true"
                focusable="false"
                data-prefix="fab"
                data-icon="facebook"
                class="svg-inline--fa fa-facebook fa-w-16"
                role="img"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512"
                >
                <path
                    fill="currentColor"
                    d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"
                ></path>
                </svg>
                Facebook</a
            >
            </li>

            <li>
            <a href="https://www.youtube.com/watch?v=lkskLcBdL4w" target="_blank">
                <svg
                aria-hidden="true"
                focusable="false"
                data-prefix="fab"
                data-icon="youtube"
                class="svg-inline--fa fa-youtube fa-w-18"
                role="img"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 576 512"
                >
                <path
                    fill="currentColor"
                    d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"
                ></path>
                </svg>
                Youtube</a
            >
            </li>
        </ul>

        </div>
    </div>

    </footer>
    
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
</body>
</html>