<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Email verify controller
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class EmailVerifyController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['content'] = 'Thank you, your account has been activated successfully';
        $this->parser->parse('login/email_verify', $data);
    }

}
