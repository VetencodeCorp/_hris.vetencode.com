<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Auth extends RestController {
	function __construct()
    {
        parent::__construct();

        protectByKey('4p1keyF0rHR1S');
		
        $this->load->model('mapi','api');
        $this->load->library('jwtauth');
    }

	public function login_post()
	{
		$phone = getRequest('phone');
		$password = md5(getRequest('password') ?? '');

		if (!$phone || !$password) {
			responseJSON([
				'phone' => $phone,
				'password' => $password,
	    		'success' => false, 
	    		'message' => 'Nomor ponsel dan password diperlukan',
	    		'data' => null,
	    	], 400);
		}
		$user_data 	= ['active' => 1, 'phone' => $phone, 'password' => $password];
		$user = $this->api->get_user($user_data);

		if (!$user->num_rows()) {
			responseJSON([
	    		'success' => false, 
	    		'message' => 'Nomor ponsel atau kata sandi salah',
	    		'data' => null,
	    	], 401);
		} else {
			$realUser = $user->row();

			$payload['user_id'] = $realUser->id;
			$jwt = $this->jwtauth->generateToken($payload);
			
			responseJSON([
	    		'success' => true, 
	    		'message' => 'Login berhasil',
	    		'data' => (object)[
	    			'token' => $jwt,
	    			'photo' => "https://ui-avatars.com/api/?name={$realUser->fullname}&color=343a55&background=f1f0f3",
	    			'id' => $realUser->id,
	    			'fullname' => $realUser->fullname,
	    			'phone' => $realUser->phone,
	    			'access' => $realUser->position,
	    			'access_id' => $realUser->access_id,
	    		],
	    	]);
		}
	}

}