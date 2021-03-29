<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * 
 * 
 * @author JC Dela Cerna Jr. November 2019
 */
class ApplicationTerminatedPageController extends BaseController {

    public function __construct() {
        parent::__construct();
    }
 
     public function index() {
        try {
            // Page title.
            $data['page_title'] = 'Application terminated page';
            
            // Application data.
            $application_id = $this->session->userdata('revoked_application_id');
            $application = $this->selectedApplication($application_id);
            
            // Hidden application data.
            $data['application_id'] = $application['id'];
            $data['account_id'] = $application['account_fk'];
            $data['evaluator_id'] = $application['evaluator_fk'];
            
            // Display application data.
            $user_id = $this->ApplicationDetailsPageModel->getUserIDByAccountID($application['account_fk'])['id'];
            $data['user_profile_picture'] = $this->ApplicationDetailsPageModel->getSelectedPCOProfilePhoto($user_id);
            $data['establishment'] = $application['name_of_establishment'];
            $data['address'] = $application['address'];
            $data['nature_of_business'] = $application['nature_of_business_establishment'];
            $data['telephone_no'] = $application['telephone_no'];
            $data['website'] = $application['website'];
            $data['type_id'] = $application['type_fk'];
            $data['status_id'] = $application['status_fk'];
            $data['evaluator'] = $application['evaluator_fk'];
            $data['date_created'] = $application['date_created'];
            
            // COA data.
            $application_coa = $this->selectedApplicationCOA($application['coa_fk']);
            $data['coa_id'] = $application['coa_fk'];
            $data['coa_no'] = $application_coa['coa_no'];
            $data['approved_by_id'] = $application_coa['approved_by_user_fk'];
            $data['date_approved'] = $application_coa['date_approved'];
            $data['date_expires'] = $application_coa['valid_until'];
            
            // Revoked COA data.
            $revoked_coa = $this->selectedApplicationRevokedCOA($application['id']);
            $data['attachment_id'] = $revoked_coa['attachment_fk'];
            $data['remarks'] = $revoked_coa['remarks'];
            $data['date_terminated'] = $revoked_coa['date_terminated'];
            
            $this->parse('application/application_terminated_page', 'Application termination page', $data);
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
        }
    }
    
    /**
     * Selected application data
     */
    public function selectedApplication($id) { 
        return $this->ApplicationTerminationPageModel->getApplicationForTermination($id);
    }
    
    /**
     * Get selected application COA data.
     * 
     * @param int $id COA id.
     */
    public function selectedApplicationCOA($id) {
        return $this->ApplicationTerminationPageModel->getApplicationCOA($id); 
    }
    
    /**
     * Revoked COA.
     */
    public function selectedApplicationRevokedCOA($id) {
        return $this->ApplicationTerminationPageModel->getApplicationRevokedCOA($id);
    }

}
