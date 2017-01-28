<?php $titre = 'Page d\'inscription'; ?>
<?php ob_start(); ?> 
<?php generate_token(); ?>
<div class="row">
   <h3 class="center-align">Enregistrez-vous pour accéder à l'espace d'administration</h3>
    <form class="col s4 push-s4" method="post" action="index.php?type=register">
       <div class="input-field">
          <input placeholder="Pseudo" id="username" type="text" class="validate" name="username">
          <label for="username">Pseudo</label>
        </div>
        <div class="input-field">
          <input id="email" type="email" class="validate" name="email">
          <label for="email">Email</label>
        </div>
       <div class="input-field">
          <input id="password" type="password" class="validate" name="password">
          <label for="password">Mot de Passe</label>
        </div>
       <div class="input-field">
          <input id="confirm_password" type="password" class="validate" name="password_confirm">
          <label for="confirm_password">Confirmez votre mot de passe</label>
        </div>
       <div class="input-field">
          <input id="login" type="submit" class="validate" name="register" value="S'enregistrer">
          <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'] ?>">

        </div>
    </form>
  </div>
  <?php $contenu = ob_get_clean(); ?>
    <?php require "gabarit.php"; ?>