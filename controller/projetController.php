<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "projet") {
            require_once(ROUTE_DIR . 'view/projet/projet.html.php');
        }elseif ($_GET['view'] == "projet_list") {
            $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = get_all_projet_db();
            $Projetlist= get_list_per_page($totalList,$page, 4);
            $nbrPage = get_nbrpage($totalList, 4);
            require_once(ROUTE_DIR . 'view/projet/projet_list.html.php');
        } elseif ($_GET['view'] == "edit") {
            $idP = (int) $_GET["idP"];
            $projetEdit = get_projet_by_id_bd($idP);
            require_once(ROUTE_DIR . 'view/projet/projet.html.php');
        }elseif ($_GET['view'] == "delete") {
            $idP = (int) $_GET["idP"];
            $projetSup= Archiver($idP);
        }elseif ($_GET['view'] == "filtrer") {
            Filtrer();
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['action'])) {
        if($_POST["action"] == "add_projet") {
            creer_projet($_POST);
        }elseif($_POST["action"] == "edit") {
            edit_projet($_POST);
        }
    }
}



function creer_projet($data) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "nomP", $nomP);
    valide_libelle($arrayError, "descriptionP", $descriptionP);
    
    $userconnect=$_SESSION["userConnect"]['idU'];
    if (empty($arrayError)) {
        $Projet = [
            "nomP" => $nomP,
            "descriptionP" => $descriptionP,
            "idU" => $userconnect,
            "Archive" => 0,
        ];

        $result = ajout_projet_db($Projet);
        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
        header("Location:".WEB_ROUTE."?controller=projetController&view=projet_list");
    } else {
       
        $_SESSION["arrayError"] = $arrayError;
        header("Location:".WEB_ROUTE."?controller=projetController&view=projet");
    }
}

function edit_projet($data) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "nomP", $nomP);
    valide_libelle($arrayError, "descriptionP", $descriptionP);
    
    if (empty($arrayError)) {
        $user = [
            "nomP" => $nomP,
            "descriptionP" => $descriptionP,
            "idP" => $idP,
        ];
        
        $result = edit_projet_db($user);
        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
        header("Location:".WEB_ROUTE."?controller=projetController&view=projet_list");
    } else {
        
        $_SESSION["arrayError"] = $arrayError;
        header("Location:".WEB_ROUTE."?controller=projetController&view=projet");
    }
}

function Archiver(int $idC):array{
    $result=get_all_projet_db();
    foreach ($result as $data){
        if ($data['idP']==$idC){
            return Archive_by_db ($data);            
        }
    }
    return [];
}

function Archive_by_db(array $Newdatas){
    extract($Newdatas);
    $projet = [
        "Archive" => 1,
        "idP" => $idP,
    ];
    Archiver_projet_db($projet); 
    header("Location:".WEB_ROUTE."?controller=projetController&view=projet_list");

}

function Filtrer(){
    if(isset($_GET['submit'])){
    $Projetlist=Filtreprojet($_GET['lib']);
    // var_dump($Projetlist);die;
    require_once(ROUTE_DIR . 'view/projet/projet_list.html.php');
    }else{
   
    }
}