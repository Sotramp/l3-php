<?php

namespace App;

use Autoload;
use Router;

require_once "Autoload.php";
Autoload::register();

$router = new Router();
$router->process();