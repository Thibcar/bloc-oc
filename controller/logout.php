<?php 

session_destroy();

if(isset($_COOKIE['connexion']))
{
    unset($_COOKIE['connexion']);
    setcookie('connexion', '', time() - 3600 * 24 * 7);
}

header("Location: index.php?type=login");