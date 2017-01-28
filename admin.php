<?php

session_start();
require "controller/functions.php";
require "controller/admin/admin.php";
require "model/connexion.php";
require "model/comments.php";
require "model/posts.php";
require "model/login.php";
require "model/users.php";


// ajout d'un nouvel article
if(isset($_POST['submit'])) {
    if (!verify_token()) {
        echo $_SESSION['_token'] . "<br>";
        echo $_POST['_token'] . "<br>";
        die ('VOTRE TOKEN N\'EST PAS VALABLE');
    } else {
        $post_title = htmlspecialchars($_POST['title']);
        $post_author = htmlspecialchars($_POST['author']);
        $post_content = nl2br(htmlspecialchars($_POST['content']));
        $post_content = strip_tags($post_content);
        add_post($post_title, $post_content, $post_author);
        $message = "<div class='green'>Votre article a bien été posté</div>";
        set_message($message);
        header("Location: admin.php?section=all_posts");
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
    if(!verify_token())
    {
        echo $_SESSION['_token'] . "<br>";
        echo $_POST['_token']  . "<br>";
        die ('VOTRE TOKEN N\'EST PAS VALABLE');
    }
    elseif(isset($_POST['post_id']))
    {
        $post_title = htmlspecialchars($_POST['title']);
        $post_author = htmlspecialchars($_POST['author']);
        $post_content = nl2br(htmlspecialchars($_POST['content']));
        $post_content = strip_tags($post_content);
        $the_post_id = intval($_POST['post_id']);
        update_post($post_title, $post_author, $post_content,$the_post_id);
        $message = "<div class='green'>Vos modifications ont bien été prises en compte</div>";
        set_message($message);
        header ("Location: admin.php?section=edit_post&post_id=$the_post_id");
    }
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


//Gestion de l'affichage de l'administration
if(!isset($_GET['section'])) 
{
    require "view/admin/admin.php";
} 
else 
{
    $section = htmlspecialchars($_GET['section']);
    
    switch($section) 
    {
        case "all_posts":
            display_posts_data();
            break;
        case "add_post":
            require "view/admin/add_post.php";
            break;
        case "edit_post":
            edit_post();
            break;
        case "all_comments":
            display_comments_data();
            break;
        case "logout";
            require "controller/logout.php";
    }
    
}

if(!logged_in())
{
    $message = "<div class='red'>Vous devez être connecté pour accéder à l'espace d'administration</div>";
    set_message($message);
    header("Location: index.php?type=login");
}

    