<?php

 function ajout_tache_db(array $tache) {

     $conn = get_connection();
     try {
        $sql = "INSERT INTO tache (libelleT,descriptionT,date_debut,date_fin,imageT,idCT,Archive) VALUES (:libelleT,:descriptionT,:date_debut,:date_fin,:imageT,:idCT,:Archive)";
         $stmt = $conn->prepare($sql);
        //  var_dump($tache);die;
         $stmt->execute($tache);
        return true;
    } catch (\Throwable $th) {
        var_dump($th);die;
        return false;
    }
}

function edit_tache_db(array $tache) {
    $conn = get_connection();
    try {
        $sql = "UPDATE tache SET libelleT=:libelleT,descriptionT=:descriptionT,date_debut=:date_debut,date_fin=:date_fin,imageT=:imageT,idCT=:idCT WHERE idT=:idT";
    $stmt = $conn->prepare($sql);
    // var_dump($tache);die;
    $stmt->execute($tache);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function edit_tache_db1(array $tache) {
    $conn = get_connection();
    try {
        $sql = "UPDATE tache SET idCT=:idCT WHERE idT=:idT";
    $stmt = $conn->prepare($sql);
    // var_dump($tache);die;
    $stmt->execute($tache);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function get_all_tache_db() {
    // connection a la base de donnees
    $id= $_SESSION["userConnect"]['idU'];
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM projet p,categorie_tache ct,tache t WHERE p.idP=ct.idP AND ct.idCT=t.idCT AND t.Archive=0 AND p.idU=$id";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_tache_by_id_bd(int $idT) {
    $conn = get_connection();
    $sql = "SELECT * FROM tache WHERE idT=:idT";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idT' => $idT]);
    $conn = null;
    return $stmt->fetchAll();
}

function Archiver_tache_db($tache){
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    try {
        $sql = "UPDATE tache SET Archive=:Archive  WHERE idT=:idT";
        $stmt = $conn->prepare($sql);
        $stmt->execute(($tache));
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function ajout_soustache_db(array $soustache) {
 
    $conn = get_connection();
    try {
       $sql = "INSERT INTO sous_tache (libelleST,idT,Archive) VALUES (:libelleST,:idT,:Archive)";
        $stmt = $conn->prepare($sql);
       //  var_dump($tache);die;
        $stmt->execute($soustache);
       return true;
   } catch (\Throwable $th) {
       var_dump($th);die;
       return false;
   }
}
function edit_soustache_db(array $soustache) {
    $conn = get_connection();
    try {
        $sql = "UPDATE sous_tache SET libelleST=:libelleST WHERE idST=:idST";
    $stmt = $conn->prepare($sql);
    // var_dump($tache);die;
    $stmt->execute($soustache);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function get_all_soustache_db() {
    // connection a la base de donnees
    $id= $_SESSION['idt'];
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM sous_tache  WHERE Archive=0 AND idT=$id";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_soustache_by_id_bd(int $idST) {
    $conn = get_connection();
    $sql = "SELECT * FROM sous_tache WHERE idST=:idST";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idST' => $idST]);
    $conn = null;
    return $stmt->fetchAll();
}

function Archiver_soustache_db($soustache){
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    try {
        $sql = "UPDATE sous_tache SET Archive=:Archive  WHERE idST=:idST";
        $stmt = $conn->prepare($sql);
        $stmt->execute(($soustache));
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function Filtretache ($filtre) {
    $conn = get_connection();
    $stmt = $conn->prepare("SELECT * FROM tache WHERE libelleT LIKE'%".$filtre."%' ");
    $stmt->execute();
    return $stmt->fetchAll();
}