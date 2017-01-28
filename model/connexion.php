<?php

//connection à la base de données


function getBdd(){
    
$con = new PDO('mysql:host=localhost;dbname=blogoc;charset=utf8','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

return $con;

}
    
