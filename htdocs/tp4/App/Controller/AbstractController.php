<?php


namespace App\Controller;

define('APP_PATH', dirname(dirname(__FILE__)) . "/");

abstract class AbstractController
{

    function render($template, $args)
    {
        extract($args);
        ob_start();
        include(APP_PATH . '../templates/' . $template);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}