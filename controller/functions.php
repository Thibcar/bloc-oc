<?php //fonctions utiles à l'ensemble de l'application


//enregistre un message informatif
function set_message($message)
{
    if(!empty($message))
    {
        $_SESSION['message'] = $message;
    }
    else 
    {
        $message="";
    }
}

//affiche le message informatif
function display_message()
{
    if(isset($_SESSION['message']))
    {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}


// crée la pagination 
function pagination ($pages_number, $location) {   
    $page = get_page();
    $previous = $page - 1;
    $next     = $page + 1;
    if($page > 1) {
        echo "<li><a href='{$location}page=$previous'><i class='material-icons'>chevron_left</i></a></li>";
    }
    for($i = 1 ; $i <= $pages_number; $i++) {        
        if($i == $page) {            
            echo "<li class='active black'><a href='{$location}page={$i}'>" . $i . "</a></li>";            
        } else {                
            echo "<li class='waves-effect'><a href='{$location}page={$i}'>" . $i . "</a></li>";        
        }
    }
    if($page < $pages_number) {
        echo "<li><a href='{$location}page=$next'><i class='material-icons'>chevron_right</i></a></li>";
    }
}

//récupérer la page
function get_page(){
    if(isset($_GET['page'])) {
        $page = ($_GET['page']);
    } else {
        $page = 1;
    }    
    return $page;    
}

// vérifie si l'utilisateur est connecté
function logged_in()
{
    if(isset($_SESSION['username']) || isset($_COOKIE['connexion']))
    {
        return true;
    } 
    else 
    {
        return false;
    }
}

function generate_token()
{
    $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));
    $token = $_SESSION['_token'];
    $_SESSION['_token_time'] = time();
    return $token;
}

function verify_token()
{
    if(isset($_SESSION['_token']) && isset($_SESSION['_token_time']) && isset($_POST['_token']))
    {
        if($_SESSION['_token'] === $_POST['_token'])
        {
            if($_SESSION['_token_time'] >= (time() - 600))
            {
                return true;
            }
            else
            {
                die ('Session expirée');
            }
        }
        else
        {
            die ('Token Invalid');
        }
    }
    else
    {
        die('Impossible d\'effectuer cette opération');
    }
}