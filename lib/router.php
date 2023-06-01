<?php
if (isset($_REQUEST['controller'])) {
   if ($_REQUEST['controller'] == "securityController") {
        require_once(ROUTE_DIR.'controller/securityController.php');
    }elseif ($_REQUEST['controller'] == "userController") {
        require_once(ROUTE_DIR.'controller/userController.php');
    }elseif ($_REQUEST['controller'] == "projetController") {
        require_once(ROUTE_DIR.'controller/projetController.php');
    }elseif ($_REQUEST['controller'] == "categorie_tacheController") {
        require_once(ROUTE_DIR.'controller/categorie_tacheController.php');
    }elseif ($_REQUEST['controller'] == "tacheController") {
        require_once(ROUTE_DIR.'controller/tacheController.php');
    }elseif ($_REQUEST['controller'] == "equipeController") {
        require_once(ROUTE_DIR.'controller/equipeController.php');
    }elseif ($_REQUEST['controller'] == "usersequipeController") {
        require_once(ROUTE_DIR.'controller/usersequipeController.php');
    }elseif ($_REQUEST['controller'] == "affectacheController") {
        require_once(ROUTE_DIR.'controller/affectacheController.php');
    }
}else {
    require_once(ROUTE_DIR.'view/security/login.html.php');
}