<?php
// ajout d'un nouvel article

if(isset($_POST['submit'])) {
    $_SESSION['title'] = $_POST['title'];
    $_SESSION['content'] = $_POST['content'];

    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_content = $_POST['content'];
    $post_content = strip_tags($post_content);

    if(!empty($post_title) && !empty($post_content))
    {

        if (!verify_token()) {
            echo $_SESSION['_token'] . "<br>";
            echo $_POST['_token'] . "<br>";
            die ('VOTRE TOKEN N\'EST PAS VALABLE');
        } else {

            add_post($post_title, $post_content, $post_author);
            $message = "<div class='green'>Votre article a bien été posté</div>";
            set_message($message);
            header("Location: admin.php?section=all_posts");

        }
    }
    else
    {
        $message = "<div class='red'>Veuillez-renseigner tous les champs du formulaire</div>";
        set_message($message);
        header("Location: admin.php?section=add_post");
    }
}

//effacer un article

if (isset($_POST['delete']) && isset($_POST['post_id']))
{
    if(!verify_token())
    {
        echo $_SESSION['_token'] . "<br>";
        echo $_POST['_token']  . "<br>";
        die ('VOTRE TOKEN N\'EST PAS VALABLE');
    }
    else
    {
        $post_id = intval($_POST['post_id']);
        delete_post($post_id);
    }
}

//éditer un article
if(isset($_POST['edit_post']))
{
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_content = $_POST['content'];
    $post_content = strip_tags($post_content);
    $the_post_id = intval($_POST['post_id']);
    if(!empty($post_title) && !empty($post_content))
    {
        if(!verify_token())
        {
            echo $_SESSION['_token'] . "<br>";
            echo $_POST['_token']  . "<br>";
            die ('VOTRE TOKEN N\'EST PAS VALABLE');
        }
        elseif(isset($_POST['post_id']))
        {

            update_post($post_title, $post_author, $post_content,$the_post_id);
            $message = "<div class='green'>Vos modifications ont bien été prises en compte</div>";
            set_message($message);
            header ("Location: admin.php?section=edit_post&post_id=$the_post_id");
        }

    }
    else
    {
        $message = "<div class='red'>Veuillez-renseigner tous les champs du formulaire</div>";
        set_message($message);
        header ("Location: admin.php?section=edit_post&post_id=$the_post_id");
    }
}

//modération des commentaires
if(isset($_POST['moderate_comments']))
{
    $name = "moderate";
    if(isset($_POST['moderate']))
    {
        $value = 1;
    }
    else
    {
        $value = 0;
    }

    update_options($name, $value);
    header("Location: admin.php?section=all_comments");
}

//changer le statut d'un commentaire
if(isset($_GET['com_statut']) && (isset($_GET['com_id'])))
{
    $the_com_id = intval($_GET['com_id']);
    if($_GET['com_statut'] == 0)
    {
        approve_comment($the_com_id);
        $message = "<div class='green'>Le commentaire est publié</div>";
        set_message($message);
        header("Location: admin.php?section=all_comments");
    }
    elseif($_GET['com_statut'] == 1)
    {
        unapprove_comment($the_com_id);
        $message = "<div class='green'>Le commentaire est en attente de validation</div>";
        set_message($message);
        header("Location: admin.php?section=all_comments");
    }
}

//effacer un commentaire
if(isset($_POST['delete_com']) && isset($_POST['com_id']))
{
    if(!verify_token())
    {
        echo $_SESSION['_token'] . "<br>";
        echo $_POST['_token']  . "<br>";
        die ('VOTRE TOKEN N\'EST PAS VALABLE');
    }
    else {
        $the_com_id = intval($_POST['com_id']);
        delete_comment($the_com_id);
        $message = "<div class='green'>Le commentaire a été effacé</div>";
        set_message($message);
        header("Location: admin.php?section=all_comments");
    }
}


/**
 * afficher les articles
 */
function display_posts_data()
{
    $per_page = 10;
    $posts_number = post_count();
    $pages_number = ceil($posts_number / $per_page);
    $page = get_page();
      
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
            
    $posts_data = get_posts($offset, $per_page);
    require "view/admin/all_posts.php";    
    }
}


/**
 * éditer un article
 */
function edit_post()
{
    if(isset($_GET['post_id'])) 
    {
        $the_post_id = intval($_GET['post_id']);
        $post = get_single_post($the_post_id);
        $post_title = htmlspecialchars($post['post_title']);
        $post_author = htmlspecialchars($post['post_author']);
        $post_content = nl2br(htmlspecialchars($post['post_content']));
    
        require "view/admin/edit_post.php";
    }
    
}


/**
 * récupérer les données des commentaires
 */
function display_comments_data()
{
    $per_page = 10;
    $posts_number = post_count();
    $pages_number = ceil($posts_number / $per_page);
    $page = get_page();
      
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
            
    $comments = get_all_comments($offset, $per_page);
    require "view/admin/all_comments.php";    
    }
}

