<?php

class Autoload
{

    static function register() {
        spl_autoload_register(function ($class) {
            $class = str_replace('\\', '/', $class);
            require_once($class . '.php');
        });
    }
}