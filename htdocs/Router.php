<?php


class Router
{

    private $controller = null;
    private $method = null;

    public function __construct()
    {
        $this->uri = (isset($_SERVER['REQUEST_URI']))? $_SERVER['REQUEST_URI'] : "/";
    }

    function process()
    {
        if(!$this->exist()){
            $this->setRouteControllerByName("notFound");
        }
        return (new $this->controller())->{$this->method}();
    }

    private function getRoutesConfig() : array
    {
        $routesJson = file_get_contents("routes.json");
        return json_decode($routesJson, true);
    }

    private function exist() : bool
    {
        foreach ($this->getRoutesConfig() as $route){
            if(isset($route['path']) && $route['path'] === $this->uri){
                $configController = explode('@',$route['controller']);
                $this->controller = $configController[0];
                $this->method = $configController[1];
                return true;
            }
        }
        return false;
    }

    private function setRouteControllerByName(string $name) : void
    {
        $routesJson = json_decode(file_get_contents("routes.json"), true);
        if(isset($routesJson[$name])){
            $configController = explode('@',$routesJson[$name]['controller']);
            $this->controller = $configController[0];
            $this->method = $configController[1];
        }

    }
}