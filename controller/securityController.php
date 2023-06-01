<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "email") {
            require_once(ROUTE_DIR . 'view/security/login.html.php');
        }elseif ($_GET['view'] == "accueil") {

            require_once(ROUTE_DIR . 'view/Accueil/accueil.html.php');
        }elseif ($_GET['view'] == "deconnexion") {
            deconnexion();
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    if (isset($_POST['action'])) {
        if($_POST["action"] == "email") {
            email($_POST);
        }elseif($_POST["action"] == "inscrire") {
            inscription($_POST);
        }
    }
}

function email(array $data) {
    $arrayError = [];
    extract($data);
    valide_libelle($arrayError, "email", $email);
    valide_libelle($arrayError, "passwordU", $passwordU);

    if (empty($arrayError)) {
        $user = [
            "email" => $email,
            "passwordU" => $passwordU
        ];

        $result = get_user_by_email_password_db($user);
        if(isset($result)) {
            $_SESSION["userConnect"] = $result[0];
            /* var_dump($result[0]);die; */
            header("Location:".WEB_ROUTE."?controller=securityController&view=accueil");
        } else {
            $_SESSION["arrayError"] = $arrayError;
            header("Location:".WEB_ROUTE."?controller=securityController&view=email");
        }
    } else {
        $_SESSION["arrayError"] = $arrayError;
        header("Location:".WEB_ROUTE."?controller=securityController&view=email");
    }
}

function deconnexion(){
    unset($_SESSION);
    destroy_session();
    header("Location:".WEB_ROUTE);
    exit();
}


