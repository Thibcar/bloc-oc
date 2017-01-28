<?php 


// validation de l'inscription
   

if(isset($_POST['register']))
{
    if(!verify_token())
    {
        echo $_SESSION['_token'] . "<br>";
        echo $_POST['_token']  . "<br>";
        die ('VOTRE TOKEN N\'EST PAS VALABLE');
    }
    else {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = sha1(htmlspecialchars($_POST['password']));
        $password_confirm = sha1(htmlspecialchars($_POST['password_confirm']));
        register_validation($username, $email, $password, $password_confirm);
    }
}

function register_validation($username, $email, $password, $password_confirm)
{
    $errors = [];
    if(username_exists($username))
    {
        $errors[] = "Désolé, mais ce nom d'utilisateur est déjà pris";
    }

    if(email_exists($email))
    {
        $errors[] = "Désolé, mais cet email est déjà enregistré";
    }
    if($password !== $password_confirm)
    {
        $errors[] = "Le mot de passe ne correspond pas";
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
        get_register_user($username, $email, $password);
    }
}

// enregistrement d'un utilisateur
function get_register_user($username, $email, $password)
{
    register_user($username, $email, $password);
    $message = "<div class='green'>Vous êtes mainenant enregistré, vous pouvez vous connecter";
    set_message($message);
    header("Location: index.php?type=login");
}

 require "view/blog/register.php";
