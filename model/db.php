<?php
function get_connection() {
    $conn = null;
    $servername = '127.0.0.1';
    $username = 'root';
    $password = '';
    
    //On essaie de se connecter
    try{
        if ($conn == null) {
            $conn = new PDO("mysql:host=".$servername.";dbname=bd_gestion_projet", $username, $password);
            //On définit le mode d'erreur de PDO sur Exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }
    /*On capture les exceptions si une exception est lancée et on affiche
     *les informations relatives à celle-ci*/
    catch(PDOException $e){
      echo( "Erreur : " . $e->getMessage());
    }

    return $conn;
}