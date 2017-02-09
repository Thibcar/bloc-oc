<?php

//connection à la base de données
include_once 'parameters.php';

function getBdd(){
    
$con = new PDO('mysql:host=' . DB_HOST .';dbname=' . DB_NAME . ';charset=utf8',DB_USER,DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

return $con;

}
    
