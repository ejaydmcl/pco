<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * Home controller
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class DownloadablePageController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['page_title'] = 'Downloadable Page';
        $this->parse('downloadableforms/downloadable_forms', 'Downloadable Page', $data);
    }

}