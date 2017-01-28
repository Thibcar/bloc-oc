<?php $titre = 'Page de connexion'; ?>
<?php ob_start(); ?> 
 <?php generate_token(); ?>
<div class="row">  
   <h3 class="center-align">Connectez-vous pour accéder à l'espace d'administration</h3>
   <?php display_message(); ?>
    <form class="col s4 push-s4" method="post" action="index.php?type=login">
       <div class="input-field">
          <input placeholder="Pseudo" id="username" type="text" class="validate" name="username">
          <label for="username">Pseudo</label>
        </div>        
       <div class="input-field">
          <input id="password" type="password" class="validate" name="password">
          <label for="password">Mot de Passe</label>
        </div>       
       <div class="input-field">
          <input id="login" type="submit" class="validate" name="login" value="Se connecter">
          <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'] ?>">
        </div>
         <div class="input-field">
            <input id="remember" type="checkbox" name="remember" value="remember">
            <label for="remember">Se souvenir de moi</label>
        </div>
    </form>
  </div>
  <?php $contenu = ob_get_clean(); ?>
    <?php require "gabarit.php"; ?>

