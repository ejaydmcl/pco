<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * Print pages controller
 * 
 * @author Julhani. May 2019
 */
class PrintApplicationController extends BaseController {

    public function index() {
      $this->parser->parse('application/print_application', []);
//        $this->parse('application/print_application', 'Application Page Table', $data);
    }
}