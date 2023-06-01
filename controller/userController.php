<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "email") {
            require_once(ROUTE_DIR . 'view/security/email.html.php');
        }elseif ($_GET['view'] == "accueil") {

            require_once(ROUTE_DIR . 'view/Accueil/accueil.html.php');
        }elseif ($_GET['view'] == "deconnexion") {
            deconnexion();
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if($_POST["action"] == "inscrire") {
            inscription($_POST);
        }
    }
}




function inscription($data) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "nomU", $nomU);
    valide_libelle($arrayError, "prenomU", $prenomU);
    valide_libelle($arrayError, "email", $email);
    valide_libelle($arrayError, "passwordU", $passwordU);
    
    
    if (empty($arrayError)) {
        $user = [
            "nomU" => $nomU,
            "prenomU" => $prenomU,
            "email" => $email,
            "passwordU" => $passwordU,
        ];

        $result = ajout_user_db($user);
        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
        header("Location:".WEB_ROUTE."?controller=userController&view=accueil");
    } else {
        var_dump($arrayError);die;
        $_SESSION["arrayError"] = $arrayError;
        header("Location:".WEB_ROUTE."?controller=userController&view=user");
    }
}

function edit_user($data,$files) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "nomU", $nomU);
    valide_libelle($arrayError, "prenomU", $prenomU);
    valide_champs($arrayError, "email", $email);
    valide_champs($arrayError, "passwordU", $passwordU);
    if (empty($arrayError)) {
        $user = [
            "prenomU" => $prenomU,
            "nomU" => $nomU,
            "email" => $email,
            "passwordU" => $passwordU,
            "idU" => $idU,
        ];

        $result = edit_user_db($user);
        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
        header("Location:".WEB_ROUTE."?controller=userController&view=user_list");
    } else {
        
        $_SESSION["arrayError"] = $arrayError;
        header("Location:".WEB_ROUTE."?controller=userController&view=user");
    }
}