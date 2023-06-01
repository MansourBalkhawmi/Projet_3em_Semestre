<?php

 function ajout_equipe_db(array $equipe) {

     $conn = get_connection();
     try {
        $sql = "INSERT INTO equipe (nomE,idP,Archive) VALUES (:nomE,:idP,:Archive)";
         $stmt = $conn->prepare($sql);
         $stmt->execute($equipe);
        return true;
    } catch (\Throwable $th) {
        var_dump($th);die;
        return false;
    }
}

function edit_equipe_db(array $equipe) {
    $conn = get_connection();
    try {
        $sql = "UPDATE equipe SET nomE=:nomE,idP=:idP WHERE idE=:idE";
    $stmt = $conn->prepare($sql);
    // var_dump($equipe);die;
    $stmt->execute($equipe);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}


function get_all_equipe_db() {
    // connection a la base de donnees
    $id= $_SESSION["userConnect"]['idU'];
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM users u,projet p,equipe e WHERE  u.idU=p.idU AND p.idP=e.idP AND e.Archive=0 AND p.idU=$id";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}



function get_equipe_by_id_bd(int $idE) {
    $conn = get_connection();
    $sql = "SELECT * FROM equipe WHERE idE=:idE";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idE' => $idE]);
    $conn = null;
    return $stmt->fetchAll();
}

function Archiver_equipe_db($equipe){
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    try {
        $sql = "UPDATE equipe SET Archive=:Archive  WHERE idE=:idE";
        $stmt = $conn->prepare($sql);
        $stmt->execute(($equipe));
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function Filtreequipe ($filtre) {
    $conn = get_connection();
    $stmt = $conn->prepare("SELECT * FROM equipe WHERE libelleT LIKE'%".$filtre."%' ");
    $stmt->execute();
    return $stmt->fetchAll();
}