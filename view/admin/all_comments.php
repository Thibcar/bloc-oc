<?php $titre = 'Admin - tous les commentaires'; ?>
<?php ob_start(); ?>
<?php display_message(); ?>
<?php generate_token(); ?>
    <div>
        <h4>Souhaitez-vous modérer les commentaires ?</h4>
        <form action="admin.php" method="post">
            <div class="switch">
                <label>
                    Non
                    <?php $options = get_options("moderate");
                    if($options['option_value'] == 1) : ?>
                    <input type="checkbox" name="moderate" checked>
                    <?php else : ?>
                    <input type="checkbox" name="moderate">
                    <?php endif; ?>

                    <span class="lever"></span>
                    Oui
                </label>
            </div>
            <input type="submit" name="moderate_comments" value="Valider">
        </form>
    </div>
   <table class="striped">
            </div>
    <thead>
        <tr>
            <th>Id</th>
            <th>Auteur</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
            <th>Post Id</th>
            <th>Statut</th>
            <th>Approuver/Désapprouver</th>
            <th>Effacer</th>
        </tr>
    </thead>
    <tbody>
       <?php foreach($comments as $comment) : ?>
        <tr>
            <td><?= intval($comment['com_id']); ?></td>
            <td><?= htmlspecialchars($comment['com_author']); ?></td>
            <td><?= htmlspecialchars($comment['com_author_email']); ?></td>
            <td><?= substr(htmlspecialchars($comment['com_message']), 0, 60) . " [...]"; ?></td>
            <td><?= htmlspecialchars($comment['com_date_fr']); ?></td>
            <td><?= htmlspecialchars($comment['com_post_id']); ?></td>
               <?php if($comment['com_statut'] == 0) : ?>
            <td>En attente</td>
               <?php elseif($comment['com_statut'] == 1) : ?>
            <td>Approuvé</td>
               <?php endif; ?>    
               <?php if($comment['com_statut'] == 0) : ?>
            <td><a href="admin.php?com_statut=0&com_id=<?= intval($comment['com_id']); ?>">Approuver</a></td>    
               <?php elseif($comment['com_statut'] == 1) : ?>
            <td><a href="admin.php?com_statut=1&com_id=<?= intval($comment['com_id']); ?>">Désapprouver</a></td>    
                <?php endif; ?>
            <form method="post" action="admin.php">
                <input type="hidden" name="com_id" value="<?= intval($comment['com_id']); ?>" >
                <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'] ?>">
                <td><input type="submit" name="delete_com" value="effacer"></td>
            </form>   
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<ul class="pagination center-align">      
    <?php pagination($pages_number, 'admin.php?section=all_comments&'); ?>  
</ul>
<?php $contenu = ob_get_clean(); ?>
<?php require "view/admin/admin.php"; ?>