<?php 
ob_start(); 
if(!empty($_SESSION['alert'])) :
?>
<div class="alert alert-<?= $_SESSION['alert']['type'] ?>" role="alert">
    <?= $_SESSION['alert']['msg'] ?>
</div>
<?php 
unset($_SESSION['alert']);
endif; 
?>

<h2 class="titre-section-info">Trocs</h2>

<?php
$content = ob_get_clean();
$titre = "Les Trocs";
require "template.php";
?>