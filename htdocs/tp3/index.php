<?php

namespace App;

use Autoload;
use App\Entity\Product;

require_once "Autoload.php";
Autoload::register();

$product = new Product();

var_dump($product);