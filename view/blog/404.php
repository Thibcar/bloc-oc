<?php 

$titre = 'Une erreur est survenue'; ?>
<?php ob_start(); ?>
<p>Désolé mais aucun résultat ne correspond à votre requête.</p>
<?php $contenu = ob_get_clean(); ?>
<?php require "gabarit.php"; ?>
