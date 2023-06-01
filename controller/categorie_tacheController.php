<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "categorie_tache") {
            if (isset($_GET["idP"])){
                $idP = (int) $_GET["idP"];
                $projetEdit = get_projet_by_id_bd($idP);
            $_SESSION['idprojet']=$projetEdit[0]['idP'];
            $page = 1;
            if (isset($_GET['page'])) {
            $page = (int)$_GET['page'];
            }
            $totalList = get_all_categorie_tache_db();
            $categorie_tachelist= get_list_per_page($totalList,$page, 4);
            $nbrPage = get_nbrpage($totalList, 4);
            require_once(ROUTE_DIR . 'view/categorie_tache/categorie_tache.html.php');
        }elseif(!isset($_GET["idP"])) {
 
                $page = 1;
                if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
                }
                $totalList = get_all_categorie_tache_db();
                $categorie_tachelist= get_list_per_page($totalList,$page, 4);
                $nbrPage = get_nbrpage($totalList, 4);
                require_once(ROUTE_DIR . 'view/categorie_tache/categorie_tache.html.php');
            }
        }elseif ($_GET['view'] == "categorie_tache_list") {
            $page = 1;
            if (isset($_GET['page'])) {
            $page = (int)$_GET['page'];
             }
            $totalList = get_all_categorieliste_tache_db();
            $categorie_tachelist= get_list_per_page($totalList,$page, 4);
            $nbrPage = get_nbrpage($totalList, 4);
            require_once(ROUTE_DIR . 'view/categorie_tache/categorie_tache_list.html.php');
        } elseif ($_GET['view'] == "edit") {
            $idCT = (int) $_GET["idCT"];
            $categorie_tacheEdit = get_categorie_tache_by_id_bd($idCT);
          
            require_once(ROUTE_DIR . 'view/categorie_tache/categoriee_tache.html.php');
        }elseif ($_GET['view'] == "delete") {
            $idCT = (int) $_GET["idCT"];
            $categorie_tacheSup= Archiverct($idCT);
        }elseif ($_GET['view'] == "filtrer") {
            Filtrer();
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if($_POST["action"] == "add_categorie_tache") {
            creer_categorie_tache($_POST);
        }elseif($_POST["action"] == "edit") {
            edit_categorie_tache($_POST);
        }
    }
}



function creer_categorie_tache($data) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleCT", $libelleCT);
    
    $idP=$_SESSION['idprojet'];
    if (empty($arrayError)) {
        $categorie_tache = [
            "libelleCT" => $libelleCT,
            "idP" => $idP,
            "Archive" => 0,
        ];
        
        $result = ajout_categorie_tache_db($categorie_tache);
        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
        header("Location:".WEB_ROUTE."?controller=categorie_tacheController&view=categorie_tache");
    } else {
       
        $_SESSION["arrayError"] = $arrayError;
        header("Location:".WEB_ROUTE."?controller=categorie_tacheController&view=categorie_tache");
    }
}

function edit_categorie_tache($data) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleCT", $libelleCT);
    
    if (empty($arrayError)) {
        $categorie_tache = [
            "libelleCT" => $libelleCT,
            "idCT" => $idCT,
        ];
        $result = edit_categorie_tache_db($categorie_tache);
        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
        header("Location:".WEB_ROUTE."?controller=categorie_tacheController&view=categorie_tache");
    } else {
        
        $_SESSION["arrayError"] = $arrayError;
        header("Location:".WEB_ROUTE."?controller=categorie_tacheController&view=categorie_tache");
    }
}

function Archiverct(int $idC):array{
    $result=get_all_categorie_tache_db();
    foreach ($result as $data){
        if ($data['idCT']==$idC){
            return Archive_by_db ($data);            
        }
    }
    return [];
}

function Archive_by_db(array $Newdatas){
    extract($Newdatas);
    $categorie_tache = [
        "Archive" => 1,
        "idCT" => $idCT,
    ];
    Archiver_categorie_tache_db($categorie_tache); 
    header("Location:".WEB_ROUTE."?controller=categorie_tacheController&view=categorie_tache");

}

function Filtrer(){
    if(isset($_GET['submit'])){
    $Categorie_tachelist=Filtrecategorie_tache($_GET['lib']);
    // var_dump($Categorie_tachelist);die;
    require_once(ROUTE_DIR . 'view/categorie_tache/categorie_tache_list.html.php');
    }else{
   
    }
}