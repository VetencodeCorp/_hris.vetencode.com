<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Input extends CI_Input {
    
    public function __construct() {
        parent::__construct();
    }

    public function raw_input_stream() {
        return file_get_contents('php://input');
    }

    public function json($index = NULL, $xss_clean = TRUE) {
       $raw_data = $this->raw_input_stream();
       $data = json_decode($raw_data, TRUE);
       
       if ($xss_clean) {
           $data = $this->_xss_clean_array($data);
       }
       
       if ($index !== NULL) {
           return isset($data[$index]) ? $data[$index] : NULL;
       }

       return $data;
   }

   private function _xss_clean_array($data) {
       if (is_array($data)) {
           foreach ($data as &$value) {
               $value = $this->security->xss_clean($value);
           }
           unset($value); // unset reference
       } else {
           $data = $this->security->xss_clean($data);
       }
       return $data;
   }
}
