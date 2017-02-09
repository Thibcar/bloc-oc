<?php $titre = 'Une erreur est survenue'; ?>
<?php ob_start(); ?>
<h1 class="center-align">ERREUR 404</h1>
<p>Désolé mais aucun résultat ne correspond à votre requête.</p>
<?php $contenu = ob_get_clean(); ?>
<?php require "gabarit.php"; ?>
