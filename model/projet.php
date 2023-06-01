<?php

 function ajout_projet_db(array $projet) {

     $conn = get_connection();
     try {
        $sql = "INSERT INTO projet (nomP,descriptionP,idU,Archive) VALUES (:nomP,:descriptionP,:idU,:Archive)";
         $stmt = $conn->prepare($sql);
        //  var_dump($projet);die;
         $stmt->execute($projet);
        return true;
    } catch (\Throwable $th) {
        var_dump($th);die;
        return false;
    }
}

function edit_projet_db(array $projet) {
    $conn = get_connection();
    try {
        $sql = "UPDATE projet SET nomP=:nomP,descriptionP=:descriptionP WHERE idP=:idP";
    $stmt = $conn->prepare($sql);
    // var_dump($projet);die;
    $stmt->execute($projet);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function get_all_projet_db() {
    // connection a la base de donnees
    $id= $_SESSION["userConnect"]['idU'];
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM projet WHERE Archive=0 and idU=$id";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_projet_by_id_bd(int $idP) {
    $conn = get_connection();
    $sql = "SELECT * FROM projet WHERE idP=:idP";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idP' => $idP]);
    $conn = null;
    return $stmt->fetchAll();
}

function Archiver_projet_db($projet){
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    try {
        $sql = "UPDATE projet SET Archive=:Archive  WHERE idP=:idP";
        $stmt = $conn->prepare($sql);
        $stmt->execute(($projet));
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function Filtreprojet ($filtre) {
    $conn = get_connection();
    $stmt = $conn->prepare("SELECT * FROM projet WHERE nomP LIKE'%".$filtre."%' ");
    $stmt->execute();
    return $stmt->fetchAll();
}