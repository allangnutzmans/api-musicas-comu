<?php

namespace api\mainController;

use api\methodsControllers\DeleteMethod;
use api\methodsControllers\GetMethod;
use api\methodsControllers\PostMethod;
use api\methodsControllers\PutMethod;

require_once 'HttpMethods.php';

define('APIMETHODS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'methodsController' . DIRECTORY_SEPARATOR);

class ApiRouter implements HttpMethods
{
    public $route;
    private const ALLOW_METHODS = ['GET', 'POST', 'PUT', 'DELETE'];
    private $method;

    private array $endpoint = [];

    public function __construct() {
        $this->route = parse_url($_SERVER['REQUEST_URI']);
        $this->method = $_SERVER['REQUEST_METHOD'];
        parse_str($_SERVER['QUERY_STRING'], $this->endpoint);
        $this->getRoute();
        $this->postRoute($this->endpoint);
        $this->deleteRoute();
        $this->putRoute();
    }

    public function getRoute(){
        if ($this->method == 'GET') {
            require APIMETHODS . 'GetMethod.php';
            $get = new GetMethod();
            if (array_key_exists('id', $this->endpoint)) {
                $id = $this->endpoint['id'];
                $get->ReadById($id);
            } else {
                $get->ReadAll();
            }
        }
    }


    public function postRoute($endpoint)
    {
        if ($this->method == 'POST') {
            include APIMETHODS .'PostMethod.php';
            new PostMethod($endpoint);
        }
    }

    public function deleteRoute()
    {
        if ($this->method == 'DELETE') {
            include APIMETHODS .'DeleteMethod.php';
            new DeleteMethod($this->endpoint);
        }
    }

    public function putRoute()
    {
        if ($this->method == 'PUT') {
            include APIMETHODS .'PutMethod.php';
            new PutMethod($this->endpoint);
        }
    }
}
