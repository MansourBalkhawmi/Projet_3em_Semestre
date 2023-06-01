<?php

function ajout_usersequipe_db(array $equipe) {


    $conn = get_connection();
    try {
       $sql = "INSERT INTO user_equipe (idE,idU,Archive) VALUES (:idE,:idU,:Archive)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($equipe);
       return true;
   } catch (\Throwable $th) {
       var_dump($th);die;
       return false;
   }
}

function edit_usersequip_db(array $userequipe) {
    $conn = get_connection();
    try {
        

        $sql = "UPDATE user_equipe SET idU=:idU,Archive=:Archive WHERE idUE=:idUE";
        $stmt = $conn->prepare($sql);
        $stmt->execute($userequipe);
        var_dump($userequipe);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}



function get_all_userequipe_db() {
    // connection a la base de donnees
    $id= $_SESSION["userConnect"]['idU'];
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM users u,user_equipe ue,equipe e,projet p WHERE  u.idU=ue.idU AND ue.idE=e.idE AND p.idP=e.idP AND ue.Archive=0 AND p.idU=$id GROUP BY(ue.idE)";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}
function Archiver_EU_db($userequipe){
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    try {
        $sql = "UPDATE user_equipe SET Archive=:Archive  WHERE idUE=:idUE";
        $stmt = $conn->prepare($sql);
        $stmt->execute(($userequipe));
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function get_all_userequipearchi_db() {
    // connection a la base de donnees
    $id= $_SESSION["userConnect"]['idU'];
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM user_equipe WHERE Archive=0 ";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_userequipe_by_id_bd(int $idE) {
    $conn = get_connection();
    $sql = "SELECT * FROM user_equipe WHERE idE=:idE";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idE' => $idE]);
    $conn = null;
    return $stmt->fetchAll();
}
function get_userequipe1_by_id_bd(int $idE) {
    $conn = get_connection();
    $sql = "SELECT * FROM user_equipe WHERE idE=:idE";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idE' => $idE]);
    $conn = null;
    return $stmt->fetchAll();
}

function membres_equipe() {
    // connection a la base de donnees
    $id=$_SESSION['idE'];
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM users u,user_equipe ue,equipe e WHERE  u.idU=ue.idU AND ue.idE=e.idE  AND ue.Archive=0 AND e.idE=$id";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_all_userequip_db() {
    // connection a la base de donnees
    $id= $_SESSION["userConnect"]['idU'];
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM user_equipe";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function Archiver_db($user_equipe){
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    try {
        $sql = "UPDATE user_equipe SET Archive=:Archive,idU=:idU  WHERE idUE=:idUE";
        $stmt = $conn->prepare($sql);
        $stmt->execute(($user_equipe));
        return true;
    } catch (\Throwable $th) {
        var_dump($th);die;
        return false;
    }
}