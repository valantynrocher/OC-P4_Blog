<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'vendor/autoload.php';

$router = new JeanForteroche\Services\Router();
$router->routeReq();