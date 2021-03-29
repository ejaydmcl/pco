<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * 
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class ProfilePictureReqController extends BaseController {
    
     public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['page_header'] = $this->getPageHeaderData();
        $data['male_photo_header'] = $this->getMalePhotoHeaderData();
        $data['female_photo_header'] = $this->getFemalePhotoHeaderData();
        $data['description_entry_list'] = $this->getDescriptionEntryList();
        $this->parse('profile/pco/profile_picture_req', 'Profile picture requirements', $data);
    }
    
     
    /**
     * Get page header
     *  */
    public function getPageHeaderData() {
        return $this->PCOPhotoRequirementsPageModel->getPageHeader()['value'];
    }
    
    /**
     * Get male photo header
     *  */
    public function getMalePhotoHeaderData() {
        return $this->PCOPhotoRequirementsPageModel->getMalePhotoHeader()['value'];
    }
    
    /**
     * Get female photo header
     *  */
    public function getFemalePhotoHeaderData() {
        return $this->PCOPhotoRequirementsPageModel->getFemalePhotoHeader()['value'];
    }
    
    /**
     * Get description list
     */
    public function getDescriptionEntryList() {
        return $this->PCOPhotoRequirementsPageModel->getDescriptionEntry();
    }
}