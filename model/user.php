<?php
function get_user_by_email_password_db(array $user) {
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM users where email=:email AND passwordU=:passwordU";
    // execution de la requete sql
    $stmt = $conn->prepare($sql);
    $stmt->execute($user);
    // ferme la connection a la base de donnees
    $conn = null;
    return $stmt->fetchAll();
}

function ajout_user_db(array $user) {
     $conn = get_connection();
     try {
        $sql = "INSERT INTO users (nomU,prenomU,email,passwordU) VALUES (:nomU,:prenomU,:email,:passwordU)";
        $stmt = $conn->prepare($sql);
         $stmt->execute($user);
        return true;
    } catch (\Throwable $th) {
        var_dump($th);die;
        return false;
    }
}

function edit_user_db(array $user) {
    $conn = get_connection();
    try {
        $sql = "UPDATE users SET prenomU=:prenomU,nomU=:nomU,email=:,passwordU=:passwordU WHERE idU=:idU";
    $stmt = $conn->prepare($sql);
    // var_dump($user);die;
    $stmt->execute($user);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function get_all_users_db() {
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM users ";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_users_by_id_bd(int $idU) {
    $conn = get_connection();
    $sql = "SELECT * FROM users WHERE idU=:idU";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idU' => $idU]);
    $conn = null;
    return $stmt->fetchAll();
}