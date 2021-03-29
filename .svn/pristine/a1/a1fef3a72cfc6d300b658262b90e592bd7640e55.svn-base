<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class NatureOfBusinessModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }

    public function createNatureOfBusiness($data) {
        $res = $this->db->insert('nature_of_business', $data);
        if ($res == 1) {
            return true;
        } else {
            return false;
        }
    }

}
