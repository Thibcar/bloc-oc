<?php


/** récupère les utilisateurs
 * @return array
 */
function get_users()
{
    $con = getBdd();
    $req = $con -> query("SELECT username FROM users");
    $users = $req -> fetchAll();
    $req -> closeCursor();
    return $users;
}