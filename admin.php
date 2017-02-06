<?php

session_start();
require "controller/functions.php";
require "model/connexion.php";
require "model/comments.php";
require "model/posts.php";
require "model/login.php";
require "model/users.php";
require "controller/admin/admin.php";


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

    