<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * 
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class ProfileSignatureReqController extends BaseController {
    
     public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['page_title'] = null;
        $data['description_entry_list'] = $this->getDescriptionEntryList();
        $this->parse('profile/pco/pco_signature', 'Profile signature requirements', $data);
    }
    
    /**
     * Get description list
     */
    public function getDescriptionEntryList() {
       return $this->PCOSignatureRequirementsPageModel->getDescriptionEntry();
    }
}