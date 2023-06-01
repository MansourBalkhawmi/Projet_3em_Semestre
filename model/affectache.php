<?php

function ajout_affectache_db(array $affectache) {
 
    $conn = get_connection();
    try {
       $sql = "INSERT INTO affectache (idU,idT,Archive) VALUES (:idU,:idT,:Archive)";
        $stmt = $conn->prepare($sql);
       //  var_dump($tache);die;
        $stmt->execute($affectache);
       return true;
   } catch (\Throwable $th) {
       var_dump($th);die;
       return false;
   }
}

function get_all_affectache_db() {
    // connection a la base de donnees
    $id= $_SESSION['iduser'];
    $conn = get_connection();
    // // requete sql
    $sql = "SELECT * FROM affectache aft,users u,tache t WHERE u.idU=aft.idU AND aft.idT=t.idT AND aft.Archive=0 AND aft.idU=$id";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_all_affectacheuser_db() {
    // connection a la base de donnees
    $id= $_SESSION["userConnect"]['idU'];
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM affectache aft,users u,tache t,projet p,categorie_tache ct WHERE u.idU=aft.idU AND p.idP=ct.idP AND ct.idCT=t.idCT AND aft.idT=t.idT AND aft.Archive=0 AND p.idU=$id";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}
