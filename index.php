<?php

require_once ('controllers/frontend/Router.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$router = new Router();
$router->routeReq();