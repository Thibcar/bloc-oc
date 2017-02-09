<?php // front controller

session_start();

require "controller/functions.php";
require "model/connexion.php";
require "model/comments.php";
require "model/posts.php";
require "model/login.php";
require "model/users.php";
require "controller/blog/index.php";

// affichage des pages du front-end
if(!isset($_GET['type']))
{
    get_index($pages_number, $per_page);
}
else
{
    $type = htmlspecialchars($_GET['type']);

    switch($type)
    {
        case "post":
            if(isset($_GET['post_id']) && $_GET['post_id'] !== 0)
            {
                $the_post_id = intval($_GET['post_id']);
                single_post($the_post_id);
            }
            break;
        case "login":
            require "controller/login.php";
            break;
        case "register":
            require "controller/register.php";
            break;
        default :
            require "view/blog/404.php";
            break;
    }
}

