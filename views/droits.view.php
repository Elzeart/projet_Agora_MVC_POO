<?php 
ob_start(); 
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<h2 class="titre-section-info">Gestion des droits</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Pseudo</th>
                <th>Acitivation code</th>
                <th>Rôle</th>
            </tr>
            <?php foreach ($utilisateurs as $utilisateur) : ?>
                <tr>
                    <td><?= $utilisateur['pseudoUtilisateur'] ?></td>
                    <td><?= $utilisateur['activationCode'] == 0 ? "compte non actif" : "compte actif" ?></td>
                    <td>
                        <?php if($utilisateur['idDroit'] == 1) : ?>
                            Admin
                        <?php else : ?>
                            <form method="POST" action="<?= URL ?>admin/modificationDroit">
                                <input type="hidden" name="pseudoUtilisateur" value="<?= $utilisateur['pseudoUtilisateur'] ?>" />
                                <select class="form-select" name="idDroit" onchange="confirm('Voulez vous confirmer la modification') ? submit() : document.location.reload()">
                                    <option value="2" <?= $utilisateur['idDroit'] == "2" ? "selected" : "" ?>>Membre</option>
                                    <option value="3" <?= $utilisateur['idDroit'] == "3" ? "selected" : "" ?>>Désactiver</option>
                                    <option value="1" <?= $utilisateur['idDroit'] == "1" ? "selected" : "" ?>>Admin</option>
                                </select>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach?>
        </thead>
    </table>


<?php
$content = ob_get_clean();
// $titre = "Bienvenue dans xxx";
// $css = "nom_de_la_page_css";               Il est possible je pense de faire l'algo dans le template qui prend le css en inscrivant le css comme ceci.
require "template.php";
?>