<?php $titre = 'Admin - éditer un article'; ?>
<?php ob_start(); ?>
<?php $users = get_users(); ?>
<?php generate_token(); ?>
<?php display_message(); ?>
<form action="admin.php" method="post" class="col s12">
    <div class="row">
        <div class="col s6">
            <div class="input-field col s12">
                <input type="text" id="title" name="title" class="validate" value="<?= $post_title; ?>" required>
                <label for="title">Titre</label>
            </div>
            <div class="input-field col s12">
               
                   <select class="browser-default" name="author">
                    <option value="<?= $post_author; ?>" selected ><?= $post_author; ?></option>
                    <?php foreach($users as $user) : ?>
                        <?php if($user['username'] != $post_author) : ?>
                    <option value="<?= $user['username']; ?>"><?= $user['username']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                
            </div>
        </div>
    </div>
    <div class="input-field col s12">
        <label for="mytextarea">Votre article</label>
        <textarea name="content" id="mytextarea" class="materialize-textarea" required cols="auto">
            <?= strip_tags($post_content); ?>
        </textarea>

    </div>
    <input type="hidden" name="post_id" id="post_id" value="<?= $_GET['post_id']; ?>">
    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'] ?>">
    <div class="input-field col s6">

        <input type="submit" name="edit_post" class="submit" value="Enregistrer les modifications">
    </div>



</form>
<?php $contenu = ob_get_clean(); ?>
<?php require "view/admin/admin.php"; ?>