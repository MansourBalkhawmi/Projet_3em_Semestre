<?php
require(dirname(__DIR__). "/config/constante.php");
require(dirname(__DIR__)."/config/require.php");
open_session();
require(ROUTE_DIR."config/require_model.php");
require(ROUTE_DIR.'lib/router.php');

?>