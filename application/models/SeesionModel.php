<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SeesionModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }

    public function is_logged_in() {
        if (isset($this->session->userdata['user']['is_active']) == 'TRUE') {
            redirect(base_url('login/login'));
        }
    }

    public function not_logged_in() {
        if ($this->session->userdata['user']['is_active'] != 'TRUE') {
            redirect(base_url());
        }
    }

    public function is_logged_admin() {
        if ($this->session->userdata['user']['role'] != '1') {
            redirect('home');
        }
    }

    public function is_logged_in_Json() {
        if ($this->session->userdata['user']['is_active'] != 'TRUE') {
            echo json_encode(['status' => 0, 'logged' => 'false', 'message' => 'Session expired ! Please Login Your Account !']);
            die;
        }
    }

    public function is_logged_account() {
        if ($this->session->userdata['user']['role'] != '5') {
            echo json_encode(['status' => 0, 'message' => 'Permission Not Allowed !']);
            die;
        }
    }

}
