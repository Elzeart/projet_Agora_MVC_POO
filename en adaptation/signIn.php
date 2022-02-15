<!-- <?php 
    session_start();
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Inscription</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto:ital@1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/singIn.css">
    <link rel="icon" type="image/pngn" href="images/favicon.png">
    
    <script src="./js/nav.js" defer></script>
</head>
<body>
    <?php include('./nav.php'); ?>

    <main>
        <div id="container">
            <form action="" method="post">
                    <h1>Inscription</h1>
                <div id="displayforms">
                    <div class="columnform">
                        <label for="nomUtilisateur">Nom</label>
                        <input type="text" name="nomUtilisateur" placeholder="Entrez un nom" required> <br>
                        <label for="prenomUtilisateur">Prénom</label>
                        <input type="text" name="prenomUtilisateur" placeholder="Entrez un prénom" required> <br>
                        <label for="pseudoUtilisateur">Pseudo</label>
                        <input type="text" name="pseudoUtilisateur" placeholder="Entrez un pseudonyme" required> <br>
                        <label for="mailUtilisateur">Mail</label>
                        <input type="email" name="mailUtilisateur" placeholder="Entrez un mail" required> <br>
                        <label for="ageUtilisateur">Âge</label>
                        <input type="date" name="ageUtilisateur" placeholder="Entrez votre âge"> <br>
                    </div>
                    <div class="columnform">
                        <label for="telephoneUtilisateur">Téléphone</label>
                        <input type="number" name="telephoneUtilisateur" placeholder="Entrez un numéro de téléphone"> <br>
                        <label for="mdpUtilisateur">Mot de passe</label>
                        <input type="password" name="mdpUtilisateur" minlength="8" placeholder="Entrez un mot de passe" required> <br>
                        <label for="confirmMdpUtilisateur">Confirmer mot de passe</label>
                        <input type="password" name="confirmMdpUtilisateur" minlength="8" placeholder="Veillez confirmer le mot de passe" required> <br>
                    </div>
                </div>
                <div class="bouton"><input type="submit" id='submit' value="AJOUTER"></div>
                <a href="./connection_control.php">Se connecter</a>
                <div id="validation_inscription"> </div>
            </form>
        </div>
    </main>

    <?php include('./footer.php'); ?>
</body>
</html>