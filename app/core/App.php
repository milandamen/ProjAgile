<?php
/**
 * Created by PhpStorm.
 * User: SysAdmin
 * Date: 3/2/2015
 * Time: 7:58 PM
 */

class App
{
    //default controller and method
    protected $controller = 'Home';
    protected $method = 'index';

    //parameters
    protected $params = [];

    //constructor
    public function __construct()
    {
        //parse the url
        $url = $this->parseUrl();

        //if controller exists set controller
        if(file_exists('../app/controller/' . $url[0] . '.php')){
            $this->controller = $url[0];
            unset($url[0]);
        }

        //require controller
        require_once '../app/controller/' . $this->controller . '.php';

        //set controller
        $this->controller = new $this->controller;

        //if method is set and exists set method
        if(isset($url[1]))
        {
            if(method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        //parse parameters
        $this->parameters = $url ? array_values($url) : [];

        //send parameters to controller method
        call_user_func_array([$this->controller, $this->method], $this->parameters);

    }

    //url parser
    public function parseUrl()
    {
        //if url is set return exploded, filtered and trimmed url
        if(isset($_GET['url'])){
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}