<?php // gère le système de connexion à l'interface d'administration


/** vérifie si un username est déjà pris
 * @param $username
 * @return bool
 */
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


/** vérifie si un email est déjà enregistré
 * @param $user_email
 * @return bool
 */
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

/** enregistre un utilisateur
 * @param $username
 * @param $user_email
 * @param $password
 */
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

/** connecte l'utilisateur
 * @param $username
 * @return bool|mixed
 */
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
