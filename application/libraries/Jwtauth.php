<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTAuth {

    protected $CI;

    protected $jwt_key = 'my_key=';
    protected $algorithm = 'HS256';

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function validate_token() {
        $auth = $this->CI->input->get_request_header('Authorization') ?? $_SERVER["REDIRECT_HTTP_AUTHORIZATION"];
        $token = null;

        if ($auth && preg_match('/Bearer\s+(.*)$/i', $auth, $matches)) {
            $token = $matches[1];
        }

        if ($token) {
            $key = $this->jwt_key;
            
            try {
                $decoded_token = JWT::decode($token, new Key($key, $this->algorithm));

                if ($decoded_token->exp < time()) {
                    $this->sendJsonError('Token telah kadaluwarsa', 401);
                }

                $user_id = $decoded_token->user_id;
                $this->CI->session->set_userdata('user_id', $user_id);

            } catch (Exception $e) {
                $this->sendJsonError('Token invalid', 401);
            }
        } else {
            $this->sendJsonError('Tidak ada token ditemukan', 401);
        }
    }

    public function generateToken($additionalPayloads = [])
    {
        $current = time();
        $days = 5; // Token valid for 5 days
        $exp = $current + ($days * 24 * 60 * 60);

        $baseUrl = 'https://vetencode.com';
        $payload = [
            'iss' => $baseUrl,
            'aud' => $baseUrl,
            'iat' => $current, // Set issued at to current time
            'exp' => $exp,     // Set expiration time
            'nbf' => $current, // Set not before to current time
        ];

        foreach ($additionalPayloads as $key => $value) {
            $payload[$key] = $value;
        }

        $jwt = JWT::encode($payload, $this->jwt_key, $this->algorithm);
        return $jwt;
    }

    private function sendJsonError($message, $statusCode) {
        $response = array(
            'success' => false,
            'message' => $message
        );
        
        http_response_code(401);
        echo json_encode($response);
        // Stop the flow of the program
        exit;
    }
}
