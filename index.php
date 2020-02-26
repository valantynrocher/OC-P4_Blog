<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once ('controllers/frontend/Router.php');

$router = new Router();
$router->routeReq();