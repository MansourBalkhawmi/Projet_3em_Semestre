<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "tache") {
            $categorie_tache=get_all_categorieliste_tache_db();
            $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = get_all_tache_db();
            $tachelist= get_list_per_page($totalList,$page, 4);
            $nbrPage = get_nbrpage($totalList, 4);
            require_once(ROUTE_DIR . 'view/tache/tache.html.php');
        }elseif ($_GET['view'] == "tache_list") {
          /*   $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = get_all_tache_db();
            $Tachelist= get_list_per_page($totalList,$page, 4);
            $nbrPage = get_nbrpage($totalList, 4); */
            require_once(ROUTE_DIR . 'view/tache/tache_list.html.php');
        } elseif ($_GET['view'] == "edit") {
            $idT = (int) $_GET["idT"];
            $tacheEdit = get_tache_by_id_bd($idT);
            require_once(ROUTE_DIR . 'view/tache/tachee.html.php');
        }elseif ($_GET['view'] == "edit1") {
            $categorie_tache=get_all_categorieliste_tache_db();
            $idT = (int) $_GET["idT"];
            $tacheEdit = get_tache_by_id_bd($idT);
            require_once(ROUTE_DIR . 'view/tache/tachee1.html.php');
        }elseif ($_GET['view'] == "delete") {
            $idT = (int) $_GET["idT"];
            $tacheSup= Archiver($idT);
        } elseif ($_GET['view'] == "soustache") {
            if (isset($_GET['idT'])) {
                $idT = (int) $_GET["idT"];
                $tacheEdit = get_tache_by_id_bd($idT);
                $_SESSION['idt']=$tacheEdit[0]['idT'];
                $page = 1;
                if (isset($_GET['page'])) {
                    $page = (int)$_GET['page'];
                }
                $totalList = get_all_soustache_db();
                $soustachelist= get_list_per_page($totalList,$page, 4);
                $nbrPage = get_nbrpage($totalList, 4);
                require_once(ROUTE_DIR . 'view/tache/soustache.html.php');
            }elseif (!isset($_GET['idT'])) {
                $page = 1;
                if (isset($_GET['page'])) {
                    $page = (int)$_GET['page'];
                }
                $totalList = get_all_soustache_db();
                $soustachelist= get_list_per_page($totalList,$page, 4);
                $nbrPage = get_nbrpage($totalList, 4);
                require_once(ROUTE_DIR . 'view/tache/soustache.html.php');
            }
        } elseif ($_GET['view'] == "editsoustache") {
            $idST = (int) $_GET["idST"];
            $soustacheEdit = get_soustache_by_id_bd($idST);

            require_once(ROUTE_DIR . 'view/tache/soustachee.html.php');
        }elseif ($_GET['view'] == "deletesoustache") {
            $idST = (int) $_GET["idST"];
            $tacheSup=Archiversoustache($idST);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
 
    if (isset($_POST['action'])) {
        if($_POST["action"] == "add_tache") {
            creer_tache($_POST,$_FILES);
        }elseif($_POST["action"] == "edit") {
            edit_tache($_POST,$_FILES);
        }elseif($_POST["action"] == "edit1") {
            edit_tache1($_POST);
        }elseif($_POST["action"] == "soustache") {
            soustache($_POST);
        }elseif($_POST["action"] == "soustacheEdit") {
            soustache_edit($_POST);
        }
    }
}



function creer_tache($data, $files) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleT", $libelleT);
    valide_libelle($arrayError, "descriptionT", $descriptionT);
    valide_libelle($arrayError, "date_debut", $date_debut);
    valide_libelle($arrayError, "date_fin", $date_fin);
    valide_libelle($arrayError, "idCT", $idCT);
    
   
    if (empty($arrayError)) {
        $Tache = [
            "libelleT" => $libelleT,
            "descriptionT" => $descriptionT,
            "date_debut" => $date_debut,
            "date_fin" => $date_fin,
            "imageT" =>  $files['imageT']['name'] ,
            "idCT" => $idCT,
            "Archive" => 0,
        ];
        to_uploads_tache($files,"imageT");
        $result = ajout_tache_db($Tache);
        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
        header("Location:".WEB_ROUTE."?controller=tacheController&view=tache");
    } else {
       
        $_SESSION["arrayError"] = $arrayError;
        header("Location:".WEB_ROUTE."?controller=tacheController&view=tache");
    }
}

function edit_tache($data,$files) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleT", $libelleT);
    valide_libelle($arrayError, "descriptionT", $descriptionT);
    valide_libelle($arrayError, "date_debut", $date_debut);
    valide_libelle($arrayError, "date_fin", $date_fin);
    valide_libelle($arrayError, "idCT", $idCT);
    if (empty($arrayError)) {
        $tache = [
            "libelleT" => $libelleT,
            "descriptionT" => $descriptionT,
            "date_debut" => $date_debut,
            "date_fin" => $date_fin,
            "imageT" =>  $files['imageT']['name'] ,
            "idCT" => $idCT,
            "idT" => $idT,
        ];
        to_uploads_tache($files,"imageT");
        $result = edit_tache_db($tache);
        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
        header("Location:".WEB_ROUTE."?controller=tacheController&view=tache");
    } else {
        
        $_SESSION["arrayError"] = $arrayError;
        header("Location:".WEB_ROUTE."?controller=tacheController&view=edit");
    }
}
function edit_tache1($data) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "idCT", $idCT);
    if (empty($arrayError)) {
        $tache = [
            "idCT" => $idCT,
            "idT" => $idT,
        ];
        $result = edit_tache_db1($tache);
        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
        header("Location:".WEB_ROUTE."?controller=tacheController&view=tache");
    } else {
        
        $_SESSION["arrayError"] = $arrayError;
        header("Location:".WEB_ROUTE."?controller=tacheController&view=edit1");
    }
}

function soustache($data) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleST", $libelleST);
    $idT=$_SESSION['idt'];
    if (empty($arrayError)) {
        $soustache = [
            "libelleST" => $libelleST,
            "idT" => $idT,
            "Archive" => 0,
        ];

        $result = ajout_soustache_db($soustache);

        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
        header("Location:".WEB_ROUTE."?controller=tacheController&view=soustache");
    } else {
        
        $_SESSION["arrayError"] = $arrayError;
        header("Location:".WEB_ROUTE."?controller=tacheController&view=soustache");
    }
}

function soustache_edit($data) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleST", $libelleST);
    $idT=$_SESSION['idt'];
    if (empty($arrayError)) {
        $soustache = [
            "libelleST" => $libelleST,
            "idST" => $idST,
        ];

        $result = edit_soustache_db($soustache);

        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
        header("Location:".WEB_ROUTE."?controller=tacheController&view=soustache");
    } else {
        
        $_SESSION["arrayError"] = $arrayError;
        header("Location:".WEB_ROUTE."?controller=tacheController&view=soustache");
    }
}

function Archiver(int $idC):array{
    $result=get_all_tache_db();
    foreach ($result as $data){
        if ($data['idT']==$idC){
            return Archive_by_db ($data);            
        }
    }
    return [];
}

function Archive_by_db(array $Newdatas){
    extract($Newdatas);
    $tache = [
        "Archive" => 1,
        "idT" => $idT,
    ];
    Archiver_tache_db($tache); 
    header("Location:".WEB_ROUTE."?controller=tacheController&view=tache");

}

function Archiversoustache(int $idC):array{
    $result=get_all_soustache_db();
    foreach ($result as $data){
        if ($data['idST']==$idC){
            return stArchive_by_db ($data);            
        }
    }
    return [];
}

function stArchive_by_db(array $Newdatas){
    extract($Newdatas);
    $soustache = [
        "Archive" => 1,
        "idST" => $idST,
    ];
    Archiver_soustache_db($soustache); 
    header("Location:".WEB_ROUTE."?controller=tacheController&view=soustachex");

}

function Filtrer(){
    if(isset($_GET['submit'])){
    $Tachelist=Filtretache($_GET['lib']);
    // var_dump($Tachelist);die;
    require_once(ROUTE_DIR . 'view/tache/tache_list.html.php');
    }else{
   
    }
}