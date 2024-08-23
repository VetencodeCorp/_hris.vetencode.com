<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function protectByKey(string $key)
{
	$ci =& get_instance();
	$inputedKey = $ci->input->get('key');
	if ($key != $inputedKey) {
		$ci->output->set_status_header(403);
	    $ci->output->set_content_type('application/json');
	    echo json_encode([
	    	'success' => false,
	        'status' => 'fail',
	        'message' => 'Forbidden'
	    ]);
	    exit;	
	}
}

function responseJSON(array $data = [], int $statusCode = 200)
{
	$ci =& get_instance();
	$ci->output->set_status_header($statusCode);
	$ci->output->set_content_type('application/json');

	echo json_encode($data);
	exit;
}

function getRequest($index)
{
	$ci = &get_instance();
	if (isset($_SERVER['CONTENT_TYPE'])) {
		$isFormUrlEncoded = strpos($_SERVER['CONTENT_TYPE'], 'application/x-www-form-urlencoded') !== false;
		$isFormData = strpos($_SERVER['CONTENT_TYPE'], 'multipart/form-data') !== false;
		if ($isFormUrlEncoded || $isFormData) {
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {
				return $ci->input->get($index, true);
			} else {
				return $ci->input->post($index, true);
			}
		}
	}
	$request = $ci->input->json();
	return isset($request[$index]) ? $request[$index] : null;
}