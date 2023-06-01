<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "usersequipe") {
            $equipe_list=get_all_equipe_db();
            $users_list=get_all_users_db();
            $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = get_all_userequipe_db();
            $userequipelist= get_list_per_page($totalList,$page, 4);
            $nbrPage = get_nbrpage($totalList, 4);
            require_once(ROUTE_DIR . 'view/usersequipe/usersequipe.html.php');
        }elseif ($_GET['view'] == "detail") {
            if (isset($_GET['idE'])) {
                $idE = (int) $_GET["idE"];
                $userequipe = get_userequipe_by_id_bd($idE);
                $_SESSION['idE']=$userequipe[0]['idE'];
                $page = 1;
                if (isset($_GET['page'])) {
                    $page = (int)$_GET['page'];
                }
                $totalList = membres_equipe($_SESSION['idE']);
                $membres= get_list_per_page($totalList,$page, 4);
                $nbrPage = get_nbrpage($totalList, 4);
                require_once(ROUTE_DIR . 'view/usersequipe/equipe_detail.html.php');
            }else{
                $page = 1;
                if (isset($_GET['page'])) {
                    $page = (int)$_GET['page'];
                }
                $totalList = membres_equipe($_SESSION['idE']);
                $membres= get_list_per_page($totalList,$page, 4);
                $nbrPage = get_nbrpage($totalList, 4);
                require_once(ROUTE_DIR . 'view/usersequipe/equipe_detail.html.php');
            }
        } elseif ($_GET['view'] == "edit") {
            $equipe_list=get_all_equipe_db();
            $users_list=get_all_users_db();
            $idE = (int) $_GET["idE"];
            $usersequipeEdit = get_userequipe1_by_id_bd($idE);
            require_once(ROUTE_DIR . 'view/usersequipe/usersequipee.html.php');
        }elseif ($_GET['view'] == "delete") {
            $idUE = (int) $_GET["idUE"];
            $membreSup= Archivermembre($idUE);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if($_POST["action"] == "usersequipe") {
            if (isset($_POST['valider'])) {
                extract($_POST);
                $arrayError = array();
                valide_libelle($arrayError, "idE", $idE);
                if (empty($arrayError)) {
                    $_SESSION['idE']=$idE;
                    header("Location:".WEB_ROUTE."?controller=usersequipeController&view=usersequipe");
                }
                $_SESSION["arrayError"] = $arrayError;
                header("Location:".WEB_ROUTE."?controller=usersequipeController&view=usersequipe");
            }elseif (isset($_POST['ajouter'])) {
                ajoute_equipe($_POST);
            }
           
        }elseif($_POST["action"] == "edit") {
            edit_userequipe($_POST);
        }
    }
}

function ajoute_equipe($data){
    extract($_POST);
    $_SESSION['idE']=$idE;
    $arrayError = array();
    if (empty($arrayError)) {
   /*  valid_champ_select2($arrayError, "idU", $idU); */
   foreach ($idU as $value) {
       $equipe = [
            "idE" => (int)$_SESSION['idE'],
            "idU" => (int)$value,
            "Archive" => 0,
        ];
      
        $result = ajout_usersequipe_db($equipe);
    }
       if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
        header("Location:".WEB_ROUTE."?controller=usersequipeController&view=usersequipe");
    }
    $_SESSION["arrayError"] = $arrayError;
    header("Location:".WEB_ROUTE."?controller=usersequipeController&view=usersequipe");
    
}

function edit_userequipe($data){
    extract($data);
   /*  valid_champ_select2($arrayError, "idU", $idU); */
   // recupere liste user_equipe by idequipe
        // parcours liste user equipe
        $liste=get_all_userequip_db();
        foreach ($liste as $val) {
        $trouve = false;
        $userequipe = []; 
   foreach ($idU as $value) {
    if ($val['idU']==$value) {
       
        $userequipe = [
            "idU" => $value,
            "idE" => $idE,
         ];
         $trouve=true;
    }     
    }
    if ($trouve==true) {
        $userequipe = [
            "Archive" => 1,
            "idU" => $value,
            "idUE" => $idUE,
        ];
        $result = Archiver_db($userequipe);
    } else{
        $equipe = [
            "idU" => (int)$value,
            "Archive" => 0,
            "idUE" => $idUE,
        ];
      
        $result = edit_usersequip_db($equipe);
    }  

    if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    header("Location:".WEB_ROUTE."?controller=usersequipeController&view=usersequipe");
}die;
  

}


function Archivermembre(int $idC):array{
    $result=get_all_userequipearchi_db();
    foreach ($result as $data){
        if ($data['idUE']==$idC){
            return Archive_by_db ($data);            
        }
    }
    return [];
}

function Archive_by_db(array $Newdatas){
    extract($Newdatas);
    $user_equipe = [
        "Archive" => 1,
        "idUE" => $idUE,
    ];
    Archiver_EU_db($user_equipe); 
    header("Location:".WEB_ROUTE."?controller=usersequipeController&view=detail");

}

function Filtrer(){
    if(isset($_GET['submit'])){
    $Tachelist=Filtretache($_GET['lib']);
    // var_dump($Tachelist);die;
    require_once(ROUTE_DIR . 'view/tache/tache_list.html.php');
    }else{
   
    }
}