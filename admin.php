<?php

require_once ('controllers/admin/Router.php');

session_start();

$router = new Router();
$router->routeReq();