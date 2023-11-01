<?php

namespace api\mainController;

require 'database.php';
class mainController
{
    protected $status;
    protected $method;
    private $endpoint;
    protected $db;


    public function __construct()
    {
        $this->status = 'API RUNNING OK';
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->endpoint = $_SERVER['QUERY_STRING'];
        $this->db = new database();
    }

    public function statusResponse($message){
        $status = ['status' => $this->status,
                   'method' => $this->method,
                    'endpoint'=> $this->endpoint,
            ];
        if ($message){
             $status['message'] = $message;
        }
        return $status;
    }

    protected function Response($data = null, $message = null)
    {
        $response = [$this->statusResponse($message)];
        if (!empty($data)){
            $response['data'] = $data;
        }

        header("Content-Type:application/json");
        echo json_encode($response, true);
    }

}