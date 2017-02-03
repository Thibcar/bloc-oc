<?php

if(isset($_POST['login'])) {
    if (!verify_token()) {
        echo $_SESSION['_token'] . "<br>";
        echo $_POST['_token'] . "<br>";
        die ('VOTRE TOKEN N\'EST PAS VALABLE');
    } else {
        $username = htmlspecialchars($_POST['username']);
        $password = sha1(htmlspecialchars($_POST['password']));
        $remember = isset($_POST['remember']);
        login_validation($username, $password, $remember);
    }
}

// validation de la connexion
/**
 * @param $username
 * @param $password
 * @param $remember
 */
function login_validation($username, $password, $remember)
{
    $errors = [];
    if(empty($username))
    {
        $errors[] = "Vous devez renseigner un nom d'utilisateur";
    }
    if(empty($password))
    {
        $errors[] = "Vous devez renseigner un mot de passe";
    }
    if(!empty($errors))
    {
        foreach($errors as $error)
        {
            echo "<div class='card-panel red darken-2'>" . $error . "</div>";
        }
    }
    else
    {
        get_login_user($username, $password, $remember);
    }
}

// connexion de l'utilisateur
/**
 * @param $username
 * @param $password
 * @param $remember
 * @return bool
 */
function get_login_user($username, $password, $remember)
{
    if(login_user($username))
    {
        $login_req = login_user($username);
        if($login_req['user_password'] == $password)
        {
            if($remember == "on")
            {
                setcookie('connexion', $username, time() + 3600 * 168);
            }
            $_SESSION['username'] = $username;
            header("Location: admin.php");
        }
        else {
            $message = "<div class='red center-align'>Vous vous êtes trompé de mot de passe</div><br>";
            set_message($message);
            return false;            
        }
    }
    else 
    {
        $message = "<div class='red center-align'>Ce nom d'utilisateur n'existe pas</div><br>";   
        set_message($message);
        return false;
    }
}


if(logged_in())
{
    header("Location: admin.php");
}
else 
{
    require "view/blog/login.php";
    
}



