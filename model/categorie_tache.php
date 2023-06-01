<?php

 function ajout_categorie_tache_db(array $categorie_tache) {

     $conn = get_connection();
     try {
        $sql = "INSERT INTO categorie_tache (libelleCT,idP,Archive) VALUES (:libelleCT,:idP,:Archive)";
         $stmt = $conn->prepare($sql);
        //  var_dump($categorie_tache);die;
         $stmt->execute($categorie_tache);
        return true;
    } catch (\Throwable $th) {
        var_dump($th);die;
        return false;
    }
}

function edit_categorie_tache_db(array $categorie_tache) {
    $conn = get_connection();
    try {
        $sql = "UPDATE categorie_tache SET libelleCT=:libelleCT WHERE idCT=:idCT";
    $stmt = $conn->prepare($sql);
    // var_dump($categorie_tache);die;
    $stmt->execute($categorie_tache);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function get_all_categorie_tache_db() {
    // connection a la base de donnees
    $id= $_SESSION["userConnect"]['idU'];
    $id1= $_SESSION['idprojet'];
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM projet p,categorie_tache ct WHERE p.idP=ct.idP AND ct.Archive=0 AND p.idU=$id and ct.idP=$id1";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}
function get_all_categorieliste_tache_db() {
    // connection a la base de donnees
    $id= $_SESSION["userConnect"]['idU'];
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM projet p,categorie_tache ct WHERE p.idP=ct.idP AND ct.Archive=0 AND p.idU=$id";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_categorie_tache_by_id_bd(int $idCT) {
    $conn = get_connection();
    $sql = "SELECT * FROM categorie_tache WHERE idCT=:idCT";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idCT' => $idCT]);
    $conn = null;
    return $stmt->fetchAll();
}

function Archiver_categorie_tache_db($categorie_tache){
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    try {
        $sql = "UPDATE categorie_tache SET Archive=:Archive  WHERE idCT=:idCT";
        $stmt = $conn->prepare($sql);
        $stmt->execute(($categorie_tache));
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function Filtrecategorie_tache ($filtre) {
    $conn = get_connection();
    $stmt = $conn->prepare("SELECT * FROM categorie_tache WHERE libelleCT LIKE'%".$filtre."%' ");
    $stmt->execute();
    return $stmt->fetchAll();
}