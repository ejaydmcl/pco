<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * 
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class ApplicationPCOBioDaTaPageController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        try {
            // Page title.
            $data['page_title'] = 'BIO-DATA';
            $this->parse('application/application_pco_bio_data_page', 'Application BIO-DATA Page', $data);
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
        } 
    }
}

