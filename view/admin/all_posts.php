<?php $titre = 'Admin - tous les articles'; ?>
<?php ob_start(); ?>
<?php display_message(); ?>
<?php generate_token(); ?>
<table class="striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Auteur</th>
            <th>Titre</th>           
            <th>Date</th>
            <th>Voir</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($posts_data as $post_data) : ?>
        <tr>
            <td><?= intval($post_data['post_id']); ?></td>
            <td><?= htmlspecialchars($post_data['post_author']); ?></td>
            <td><?= htmlspecialchars($post_data['post_title']); ?></td>           
            <td><?= htmlspecialchars($post_data['post_date_fr']); ?></td>
            <td><a href="index.php?type=post&post_id=<?= intval($post_data['post_id']); ?>">Voir le post</a></td>
            <td><a href="admin.php?section=edit_post&post_id=<?= intval($post_data['post_id']); ?>">Editer</a></td>
            <form method="post" action="admin.php">
                <input type="hidden" name="post_id" value="<?= intval($post_data['post_id']); ?>" >

                <td><input type="submit" name="delete" value="Effacer"></td>
            </form>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<ul class="pagination center-align">      
    <?php pagination($pages_number, 'admin.php?section=all_posts&'); ?>  
</ul>
<?php $contenu = ob_get_clean(); ?>
<?php require "view/admin/admin.php"; ?>