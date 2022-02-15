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
    <link rel="stylesheet" href="./css/connection.css">
    <link rel="icon" type="image/pngn" href="images/favicon.png">
    
    <script src="./js/nav.js" defer></script>
</head>
<body>
    <?php include('./nav.php'); ?>

    <main>
        <div class="container">
            
            <form method="POST">
                <h1>Connexion</h1>
                
                <label for="mailUtilisateur"><b>Mail utilisateur</b></label>
                <input type="email" placeholder="Entrer un mail" name="mailUtilisateur" required>

                <label for="mdpUtilisateur"><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="mdpUtilisateur" required>

                <input type="submit" id='submit' value='Connexion' >
            </form>

            <div class="container2">
                <div id=inscrire><a href="./signIn_control.php">Créer un compte / S'inscrire</a></div>
            </div>

        </div>
    </main>

    <?php include('./footer.php'); ?>
</body>
</html>