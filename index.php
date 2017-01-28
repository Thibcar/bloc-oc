<?php // front controller

session_start();

require "controller/blog/index.php";
require "controller/functions.php";
require "model/connexion.php";
require "model/comments.php";
require "model/posts.php";
require "model/login.php";
require "model/users.php";


$per_page = 5;
$posts_number = post_count();
$pages_number = ceil($posts_number / $per_page);





// récupère les commentaires postés
if(isset($_POST['submit_comment']))
{
    if(!verify_token())
    {
        echo $_SESSION['_token'] . "<br>";
        echo $_POST['_token']  . "<br>";
        die ('VOTRE TOKEN N\'EST PAS VALABLE');
    }
    else
    {
        $the_post_id = $_POST['post_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        add_comment($name, $email, $message, $the_post_id);
        $message = "<div class='green'>Votre commentaire est en attente de modération</div>";
        set_message($message);

        header("Location: index.php?type=post&post_id={$the_post_id}#comments-area");
    }
}



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
    }
}

