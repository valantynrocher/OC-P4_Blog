<?php

require_once ('controllers/admin/Router.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$router = new Router();
$router->routeReq();