<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * Pollution Control Officer photo requirements controller.
 * 
 * @author JC Dela Cerna Jr. August 2019
 */
class PCOPhotoRequirementsController extends BaseController {

    public function index() {
        
        $data['page_header'] = $this->getPageHeaderData();
        $data['male_photo_header'] = $this->getMalePhotoHeaderData();
        $data['female_photo_header'] = $this->getFemalePhotoHeaderData();
        $data['description_entry_list'] = $this->getDescriptionEntryList();
        $this->parse('settings/pco_photo_requirements', 'PCO Photo Requirements', $data);
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

    /***
     * Update page header.
     */
    public function updatePageHeader() {
        $post = $this->input->post();
        $response = null;
        try {
            $data = [
                'value' => $post['page_header'],
                'modified_by_user_fk' => $this->session->userdata['user']['id'],
                'date_modified' => date('Y-m-d H:i:s')
            ]; 
            $update = $this->PCOPhotoRequirementsPageModel->updatePageHeaderPCOTable($data);
            if($update) {
                $response = ['status' => 1, 'message' => 'Page header successfully updated!'];
            }
        } catch (Exception $err) {
            $response = ['status' => 0, 'message' => 'Error: '. $err->getMessage()];
        }
        echo json_encode($response);
    }
    
    /***
     * Update page header.
     */
    public function updateMalePhotoHeader() {
        $post = $this->input->post();
        $response = null;
        try {
            $data = [
                'value' => $post['male_photo_header'],
                'modified_by_user_fk' => $this->session->userdata['user']['id'],
                'date_modified' => date('Y-m-d H:i:s')
            ]; 
            $update = $this->PCOPhotoRequirementsPageModel->updateMalePhotoHeaderPCOTable($data);
            if($update) {
                $response = ['status' => 1, 'message' => 'Male photo header successfully updated!'];
            }
        } catch (Exception $err) {
            $response = ['status' => 0, 'message' => 'Error: '. $err->getMessage()];
        }
        echo json_encode($response);
    }
    
    /***
     * Update page header.
     */
    public function updateFemalePhotoHeader() {
        $post = $this->input->post();
        $response = null;
        try {
            $data = [
                'value' => $post['female_photo_header'],
                'modified_by_user_fk' => $this->session->userdata['user']['id'],
                'date_modified' => date('Y-m-d H:i:s')
            ]; 
            $update = $this->PCOPhotoRequirementsPageModel->updateFemalePhotoHeaderPCOTable($data);
            if($update) {
                $response = ['status' => 1, 'message' => 'Female photo header successfully updated!'];
            }
        } catch (Exception $err) {
            $response = ['status' => 0, 'message' => 'Error: '. $err->getMessage()];
        }
        echo json_encode($response);
    }
    
    /**
     * Add description entry
     */
    public function addDescriptionEntry() {
        $post = $this->input->post();
        $response = null;
        try {
            $data = [
                'column' => 'DESCRIPTION_ENTRY',
                'value' => $post['description_entry'],
                'created_by_user_fk' => $this->session->userdata['user']['id'],
                'date_created' => date('Y-m-d H:i:s')
            ]; 
            $insert = $this->PCOPhotoRequirementsPageModel->addDescriptionEntryPCOTable($data);
            if($insert) {
                $response = ['status' => 1, 'description_entry_id' => $insert, 'description_entry' => $post['description_entry'], 'message' => 'Description entry successfully updated!'];
            }
        } catch (Exception $err) {
            $response = ['status' => 0, 'message' => 'Error: '. $err->getMessage()];
        }
        echo json_encode($response);
    }
    
    /**
     * Remove description entry
     */
    public function removeDescriptionEntry() {
        $post = $this->input->post();
        $response = null;
        try {
            $data = [
                'id' => $post['id']
            ]; 
            $update = $this->PCOPhotoRequirementsPageModel->removeDescriptionEntryPCOTable($data);
            if($update) {
                $response = ['status' => 1, 'description_entry_id' => $post['id'], 'message' => 'Description entry successfully removed!'];
            }
        } catch (Exception $err) {
            $response = ['status' => 0, 'message' => 'Error: '. $err->getMessage()];
        }
        echo json_encode($response);
    }
}