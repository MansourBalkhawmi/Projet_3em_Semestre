<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "affectache") {
            if (isset($_GET["idU"])) {
            
            $tache=get_all_tache_db();
            $idU = (int) $_GET["idU"];
            $userEdit = get_users_by_id_bd($idU);
            $_SESSION['iduser']=$userEdit[0]['idU'];
            $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = get_all_affectache_db();
            $affectachelist= get_list_per_page($totalList,$page, 4);
            $nbrPage = get_nbrpage($totalList, 4);
            require_once(ROUTE_DIR . 'view/tache/affectache.html.php');
        }elseif (!isset($_GET["idU"])) {
            
            $tache=get_all_tache_db();
            $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = get_all_affectache_db();
            $affectachelist= get_list_per_page($totalList,$page, 4);
            $nbrPage = get_nbrpage($totalList, 4);
            require_once(ROUTE_DIR . 'view/tache/affectache.html.php');
            }
        }elseif($_GET['view'] == "affectache_list") {
           
            $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = get_all_affectacheuser_db();
            $affectachelist= get_list_per_page($totalList,$page, 7);
            $nbrPage = get_nbrpage($totalList, 7);
            require_once(ROUTE_DIR . 'view/tache/affectache_list.html.php');
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if($_POST["action"] == "affectache") { 
            affectache($_POST);
        }
    }
}


function affectache($data) {
    extract($data);
    foreach ($idT as $key => $value) {
        $affectache = [
            "idU" =>  (int)$_SESSION['iduser'],
            "idT" => (int)$value,
            "Archive" => 0,
        ];
       
        $result = ajout_affectache_db($affectache);
    }
    if($result) {
        $_SESSION["success_operation"] = SUCCESS_MSG;
    } else {
        $_SESSION["error_operation"] = FAILED_MSG;
    }

        header("Location:".WEB_ROUTE."?controller=affectacheController&view=affectache");
   
}

function soustache_edit($data) {
    $arrayError = array();
    extract($data);
        foreach ($idT as $key => $value) {
            $soustache = [
                "idT" => $value,
            ];
    
            $result = edit_soustache_db($soustache);
        }

        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
        header("Location:".WEB_ROUTE."?controller=tacheController&view=soustache");
    
}