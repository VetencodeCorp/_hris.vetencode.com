<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Test extends RestController {
	function __construct()
    {
        parent::__construct();
        
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            exit();
        }
    }
    
    public function index_options()
	{
		$bearer = $this->input->get_request_header('Authorization');
		$basic = $this->input->server('PHP_AUTH_USER');
		responseJSON([
	    	'success' => true,
	        'message' => 'Test',
	        'bearer' => $bearer,
	        'basic' => $basic,
	        'server_http_auth' => isset($_SERVER["HTTP_AUTHORIZATION"]) ? $_SERVER["HTTP_AUTHORIZATION"] : 'nothing',
	        'server_php_auth' => isset($_SERVER["PHP_AUTH_USER"]) ? $_SERVER["PHP_AUTH_USER"] : 'nothing2',
	        'server' => $_SERVER,
	    ]);
	}

	public function index_get()
	{
		$bearer = $this->input->get_request_header('REDIRECT_HTTP_AUTHORIZATION');
		$basic = $this->input->server('PHP_AUTH_USER');
		responseJSON([
	    	'success' => true,
	        'message' => 'Test',
	        'bearer' => $bearer,
	        'basic' => $basic,
	        'server_http_auth' => isset($_SERVER["HTTP_AUTHORIZATION"]) ? $_SERVER["HTTP_AUTHORIZATION"] : 'nothing',
	        'server_php_auth' => isset($_SERVER["PHP_AUTH_USER"]) ? $_SERVER["PHP_AUTH_USER"] : 'nothing2',
	        'server' => $_SERVER,
	    ]);
	}


}