<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * Pollution Control Officer signature requirements controller
 * 
 * @author JC Dela Cerna Jr. August 2019
 */
class PCOSignatureRequirementsController extends BaseController {

    public function index() {
        $data['page_header'] = null;
        $data['description_entry_list'] = $this->getDescriptionEntryList();
        $this->parse('settings/pco_signature_requirements', 'PCO Signature Requirements', $data);
    }
     /**
     * Get description list
     */
    public function getDescriptionEntryList() {
        return $this->PCOSignatureRequirementsPageModel->getDescriptionEntry();
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
            $insert = $this->PCOSignatureRequirementsPageModel->addDescriptionEntryPCOTable($data);
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
            $update = $this->PCOSignatureRequirementsPageModel->removeDescriptionEntryPCOTable($data);
            if($update) {
                $response = ['status' => 1, 'description_entry_id' => $post['id'], 'message' => 'Description entry successfully removed!'];
            }
        } catch (Exception $err) {
            $response = ['status' => 0, 'message' => 'Error: '. $err->getMessage()];
        }
        echo json_encode($response);
    }
}