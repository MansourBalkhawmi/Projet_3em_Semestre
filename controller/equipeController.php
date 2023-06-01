<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "equipe") {
            $projet_list=get_all_projet_db();
            $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = get_all_equipe_db();
            $equipelist= get_list_per_page($totalList,$page, 4);
            $nbrPage = get_nbrpage($totalList, 4);
            require_once(ROUTE_DIR . 'view/equipe/equipe.html.php');
        } elseif ($_GET['view'] == "edit") {
            $projet_list=get_all_projet_db();
            $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = get_all_equipe_db();
            $equipelist= get_list_per_page($totalList,$page, 4);
            $nbrPage = get_nbrpage($totalList, 4);
            $idE = (int) $_GET["idE"];
            $equipeEdit = get_equipe_by_id_bd($idE);
            require_once(ROUTE_DIR . 'view/equipe/equipe.html.php');
        }elseif ($_GET['view'] == "delete") {
            $idE = (int) $_GET["idE"];
            $equipeSup= Archiver($idE);
        }elseif ($_GET['view'] == "filtrer") {
            Filtrer();
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
 
    if (isset($_POST['action'])) {
        if($_POST["action"] == "add_equipe") {
            creer_equipe($_POST);
        }elseif($_POST["action"] == "edit") {
            edit_equipe($_POST);
        }
    }
}



function creer_equipe($data) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "nomE", $nomE);
    valide_libelle($arrayError, "idP", $idP);
    
   
    if (empty($arrayError)) {
        $Equipe = [
            "nomE" => $nomE,
            "idP" => $idP,
            "Archive" => 0,
        ];
      
        $result = ajout_equipe_db($Equipe);
        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
        header("Location:".WEB_ROUTE."?controller=equipeController&view=equipe");
    } else {
       
        $_SESSION["arrayError"] = $arrayError;
        header("Location:".WEB_ROUTE."?controller=equipeController&view=equipe");
    }
}

function edit_equipe($data) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "nomE", $nomE);
    valide_libelle($arrayError, "idP", $idP);
    if (empty($arrayError)) {
        $equipe = [
            "nomE" => $nomE,
            "idP" => $idP,
            "idE" => $idE,
        ];
    
        $result = edit_equipe_db($equipe);
        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
        header("Location:".WEB_ROUTE."?controller=equipeController&view=equipe");
    } else {
        
        $_SESSION["arrayError"] = $arrayError;
        header("Location:".WEB_ROUTE."?controller=equipeController&view=edit");
    }
}


function Archiver(int $idC):array{
    $result=get_all_equipe_db();
    foreach ($result as $data){
        if ($data['idE']==$idC){
            return Archive_by_db ($data);            
        }
    }
    return [];
}

function Archive_by_db(array $Newdatas){
    extract($Newdatas);
    $equipe = [
        "Archive" => 1,
        "idE" => $idE,
    ];
    Archiver_equipe_db($equipe); 
    header("Location:".WEB_ROUTE."?controller=equipeController&view=equipe");

}

function Filtrer(){
    if(isset($_GET['submit'])){
    $Equipelist=Filtreequipe($_GET['lib']);
    // var_dump($Equipelist);die;
    require_once(ROUTE_DIR . 'view/equipe/equipe_list.html.php');
    }else{
   
    }
}