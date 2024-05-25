<?php
class App {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();
        
        if (isset($url[0]) && file_exists('app/controllers/' . ucwords($url[0]) . 'Controller.php')) {
            
            $this->controller = ucwords($url[0]) . 'Controller';
            unset($url[0]);
        }

        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_SERVER['REQUEST_URI'])) {
            $url = $_SERVER['REQUEST_URI'];
            $url = explode('?', $url)[0];
            $url = trim($url, '/');
            $urlSegments = explode('/', $url);

            // İlk segmentin projenin kök dizini olduğunu varsayarak
            if ($urlSegments[0] == 'deal_website') {
                array_shift($urlSegments);
            }

            return $urlSegments;
        }
        return [];
    }
}
?>