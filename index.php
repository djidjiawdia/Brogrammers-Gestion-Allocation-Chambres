<?php

// define("ROOT", 'http://djiadjidiaw.alwaysdata.net');
define("ROOT", 'http://localhost/gestionAllocationChambres');

require_once './libs/Router.php';

$router = new Router();
$router->route();