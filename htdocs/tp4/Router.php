<?php

class Router {

    function process() {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = str_replace('/tp4/index.php', '', $uri);

        $json = file_get_contents('routes.json');
        $data = json_decode($json, TRUE);
        $route = false;

        if ($uri == '') {
            $uri = '/';
        }

        foreach($data as $value) {
            if ($value['path'] == $uri) {
                $route = true;
                $controller = $value['controller'];
                $controller = explode('@', $controller);
            }
        }

        if(!$route) {
            return http_response_code(404);
        }

        $class = "\App\Controller\\" . $controller[0];
        $class = new $class();
        $method = $controller[1];
        return $class->$method();
    }
}