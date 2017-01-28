<?php // gère le système de connexion à l'interface d'administration

/*require_once "model/connexion.php";*/


// vérifie si un username est déjà pris
function username_exists($username)
{
    $con = getBdd(); 
    $req = $con -> prepare("SELECT user_id FROM users WHERE username = ?");
    $req -> execute([$username]);
    if($req -> rowCount() == 1)
    {
        return true;
    }
    else 
    {
        return false;
    }
}

// vérifie si un email est déjà enregistré
function email_exists($user_email)
{
    $con = getBdd();
    $req = $con -> prepare("SELECT user_id FROM users WHERE user_email = ?");
    $req -> execute([$user_email]);
    if($req -> rowCount() == 1)
    {
        return true;
    }
    else
    {
    return false;        
    }    
}

function register_user($username, $user_email, $password)
{
    $con = getBdd();
    $req = $con -> prepare("INSERT INTO users(username, user_email, user_password) VALUES(:username, :email, :password)");
    $req -> bindParam(':username', $username, PDO::PARAM_STR);
    $req -> bindParam(':email', $user_email, PDO::PARAM_STR);
    $req -> bindParam(':password', $password, PDO::PARAM_STR);
    $req -> execute();
    $req -> closeCursor();    
}

function login_user($username)
{
    $con = getBdd();
    $req = $con -> prepare("SELECT user_id, user_password FROM users WHERE username = ?");
    $req -> bindParam(1, $username, PDO::PARAM_STR);
    $req -> execute();
    if($req -> rowCount() == 1)
    {
        $login_req = $req -> fetch();
        return $login_req;
    }
    else 
    {
        return false;
    }    
}
