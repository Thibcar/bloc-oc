<?php $titre = $post['post_title']; ?>
<?php ob_start(); ?>
<?php generate_token(); ?>
<section id="main-content">
    <article>
        <h1><?= $post_title; ?></h1>
        <hr>
        <div class="meta-data">
            <i class="tiny material-icons">event</i><span class="meta date"><?= $post['post_date_fr']; ?></span>
            <i class="tiny material-icons">account_circle</i><span class="meta author"><?= $post['post_author']; ?></span>
            <i class="tiny material-icons">comment</i><span class="meta comment">Commentaires : <?= $comments_count; ?></span>
        </div>
        <hr>
        <div class="article">
            <?= $post_content; ?>
        </div>
    </article>
</section>
<div class="clearfix"></div>
<section id="comments-area">
    <?php display_message(); ?>

    <h3>Laisser un commentaire :</h3>

    <div class="row">

        <form action="index.php?type=post&post_id=<?= $the_post_id; ?>" method="post" class="col s12">
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" id="name" name="name" class="validate" value="<?= $name; ?>">
                    <label for="name">Nom</label>
                </div>
                <div class="input-field col s6">
                    <input type="email" id="email" name="email" class="validate" value="<?= $email; ?>">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea name="comment" id="comment" class="materialize-textarea" required><?= $comment; ?></textarea>
                    <label for="comment">Votre commentaire</label>
                </div>
                <input type="hidden" name="post_id" id="post_id" value="<?= $_GET['post_id']; ?>">
                <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'] ?>">
                <div class="input-field col s6">
                    <input type="submit" name="submit_comment" class="submit">
                </div>
            </div>


        </form>
    </div>
    <h3><?= $comments_count. ' '.($comments_count > 1 ? 'commentaires' : 'commentaire'); ?> pour cet article :</h3>
    <?php display_comments($the_post_id); ?>
</section>
<?php $contenu = ob_get_clean(); ?>
<?php require "gabarit.php"; ?>



