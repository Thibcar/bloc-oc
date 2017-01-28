<?php $titre = 'Accueil de mon blog'; ?>
<?php ob_start(); ?>

<?php foreach($posts as $post) : ?>
   <?php
    $the_post_id = $post['post_id'];
    $comments_count = get_comments_count($the_post_id);
    ?>
    <section id="main-content">
        <article>
            <h2><a href="index.php?type=post&post_id=<?= $post['post_id']; ?>"><?= $post['post_title']; ?></a></h2>
            <hr>
            <div class="meta-data">
                <i class="tiny material-icons">event</i><span class="meta date"><?= $post['post_date_fr']; ?></span>
                <i class="tiny material-icons">account_circle</i><span class="meta author"><?= $post['post_author']; ?></span>
                <i class="tiny material-icons">comment</i><span class="meta comment">Commentaires : <?= $comments_count; ?></span>
            </div>
            <hr>
            <div class="article">
                    <?= $post['post_content']; ?>                       
                   <div class="right read-more"><a href="index.php?type=post&post_id=<?= $post['post_id']; ?>" class="btn waves-effect waves-light grey darken-4">Lire l'article</a></div>
            </div>
        </article>
    </section>
    <div class="clearfix"></div>
    <?php endforeach; ?>
    <ul class="pagination center-align">      
        <?php pagination($pages_number, 'index.php?'); ?>  
    </ul>
    <?php $contenu = ob_get_clean(); ?>
    <?php require "gabarit.php"; ?>


    