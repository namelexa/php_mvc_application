<?php

use Test\Check24\Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$router = new Router;
$router->executeController();