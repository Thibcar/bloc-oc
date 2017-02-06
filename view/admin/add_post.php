<?php $titre = "ajouter un article"; ?>
<?php ob_start(); ?>
<?php generate_token(); ?>
<?php
$_SESSION['title'] = isset($_SESSION['title']) ? $_SESSION['title'] : null;
$_SESSION['content'] = isset($_SESSION['content']) ? $_SESSION['content'] : null;
?>


<h3>Vous pouvez créer votre article</h3>
<?php display_message(); ?>
<form action="admin.php" method="post" class="col s12">
    <div class="row">
       <div class="col s6">
        <div class="input-field col s12">
            <input type="text" id="title" name="title" class="validate" value="<?= $_SESSION['title']; ?>" required>
            <label for="title">Titre</label>
        </div>
        <div class="input-field col s12">
            <input type="hidden" id="author" name="author" class="validate" value="<?= $_SESSION['username']; ?>">

        </div>
    </div>
   </div>
    <div class="input-field col s12">
        <label for="mytextarea">Votre article</label>
        <textarea name="content" id="mytextarea" class="materialize-textarea"><?= $_SESSION['content']; ?></textarea>
    </div>
    <div class="input-field col s6">
        <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'] ?>">
        <input type="submit" name="submit" class="submit">
    </div>
</form>
<?php unset($_SESSION['title']); ?>
<?php unset($_SESSION['content']); ?>
<?php $contenu = ob_get_clean(); ?>
<?php require "view/admin/admin.php"; ?>
    

