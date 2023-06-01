<?php
function open_session() {
    if (session_status()== PHP_SESSION_NONE) {
        session_start();
    }
}

function destroy_session(){
    session_destroy();
}

function is_user_connect() {
    return isset($_SESSION['connectedUser']);
}

function is_admin() {
    if (is_user_connect()) {
        $role = $_SESSION['connectedRole'];
        return isset($role["libelle"]) && $role["libelle"]=="ADMIN";
    }

    return false;
}

function is_operateur() {
    if (is_user_connect()) {
        $role = $_SESSION['connectedRole'];
        return isset($role["libelle"]) && $role["libelle"]=="OPERATEUR";
    }

    return false;
}

?>
