<?php

$per_page     = 5;
$posts_number = post_count();
$pages_number = ceil($posts_number / $per_page);





// gère la page d'accueil du blog
function get_index($pages_number, $per_page) {
    $page = get_page();
    // on s'assure que $page est bien un entier compris entre 0 et le nombre de pages    
    $options = array(
        'options' => array(
            'min_range' => 0,
            'max_range' => $pages_number
        )
    );
    if(filter_var($page, FILTER_VALIDATE_INT, $options) !== false) {
        if($page == 0 || $page == 1) {
            $offset = 0;
        } else {
            $offset = ($page * $per_page) - $per_page;
        }
        try {
            $posts = get_posts($offset, $per_page);

            foreach($posts as $key => $post) {

                $posts[$key]['post_id'] = intval($post['post_id']);
                $posts[$key]['post_title'] = htmlspecialchars($post['post_title']);
                $posts[$key]['post_author'] = htmlspecialchars($post['post_author']);
                $posts[$key]['post_content'] = nl2br(htmlspecialchars($post['post_content']));
            }
            require "view/blog/index.php";
        }
        catch(Exception $e) {
            $msgErreur = $e->getMessage();
            require "view/blog/erreur.php";
        }
    } else {
        require "view/blog/404.php";
    }
}


//affichage d'un seul post
function single_post($the_post_id) {
    $name         = (isset($_POST['name']) ? $_POST['name'] : null);
    $email        = (isset($_POST['email']) ? $_POST['email'] : null);
    $comment      = (isset($_POST['comment']) ? $_POST['comment'] : null);

    // récupère les commentaires postés
    if(isset($_POST['submit_comment'])) {
        $the_post_id = $_POST['post_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];

        if (!empty($name) && !empty($email) && !empty($comment))
        {
            if (!verify_token()) {
                echo $_SESSION['_token'] . "<br>";
                echo $_POST['_token'] . "<br>";
                die ('VOTRE TOKEN N\'EST PAS VALABLE');
            }
            else
            {
                //on vérifie que l'email est bien valide
                if(filter_var($email, FILTER_VALIDATE_EMAIL))
                {

                    //vérifier si il y a modération des commentaires
                    $options = get_options("moderate");
                    $moderate = $options['option_value'];
                    if ($moderate == 0) {
                        $com_statut = 1;
                    } elseif ($moderate == 1) {
                        $com_statut = 0;
                    }
                    add_comment($name, $email, $comment, $the_post_id, $com_statut);

                    if ($com_statut == 1) {
                        $message = "<div class='green'>Votre commentaire a bien été enregistré</div>";
                    } else {
                        $message = "<div class='green'>Votre commentaire est en attente de modération</div>";
                    }

                    set_message($message);

                }
                else
                {
                    $message = "<div class='red'>Veuillez entrer un email valide</div>";
                    set_message($message);
                }
            }
        }
        else
        {
            $message = "<div class='red'>Veuillez-renseigner tous les champs du formulaire</div>";
            set_message($message);
            /*header("Location: index.php?type=post&post_id={$the_post_id}#comments-area");*/
        }
    }

    $post = get_single_post($the_post_id);
    $comments_count = get_comments_count($the_post_id);
    $post_title = htmlspecialchars($post['post_title']);
    $post_author = htmlspecialchars($post['post_author']);
    $post_content = nl2br(htmlspecialchars($post['post_content']));
    require "view/blog/post.php";
}

//affichage des commentaires
function display_comments($the_post_id) {
    $comments = get_comments($the_post_id)->fetchAll();
    foreach($comments as $comment){

        $com_author = htmlspecialchars($comment['com_author']);
        $com_message = nl2br(htmlspecialchars($comment['com_message']));
        $com_author_email = htmlspecialchars($comment['com_author_email']);
        $grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($com_author_email))) . "?d=monsterid";

        include "view/blog/comments.php";
    }
}