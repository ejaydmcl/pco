<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * Pages controller
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class PagesController extends BaseController {
    
    public function __construct() {
        parent::__construct();
       // $this->output->enable_profiler(TRUE);
    }

    public function index() {
        $this->parse('login/login', 'Login', []);
        //$this->parse('profiler/profiler', 'profiler', []);
    }

    /**
     * Registration page
     */
    public function registration_page() {
        $this->parser->parse('login/register', 'Register', []);
    }

}
