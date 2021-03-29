<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * 
 * 
 * @author JC Dela Cerna Jr. November 2019
 */
class ApplicationTerminationPageController extends BaseController {

    public function __construct() {
        parent::__construct();
    }
 
    public function index() {
        try {
            // Page title.
            $data['page_title'] = 'Application termination page';
            
            // Application data.
            $application_id = $this->session->userdata('application_id_for_termination');
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
            
            $data['attachment'] = null;
            $data['remarks'] = null;
            
            $this->parse('application/application_termination_page', 'Application termination page', $data);
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
     * Terminate selected COA.
     */
    public function terminateSelectedCOA() {
        $this->OuthModel->CSRFVerify();
        $post = $this->input->post();
        try {
             if (isset($_FILES['termination_attachment']['name']) && 
                    !empty($_FILES['termination_attachment']['name'])) {
                $config['upload_path'] = './uploads/attachment';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] =  5120; // 5mb.
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('termination_attachment')) {
                    echo json_encode(['status' => 0, 'message' => $this->upload->display_errors()]);
                    die;
                } else {
                    // COA Data.
                    $file = $this->upload->data();
                    $data = [
                        'user_id' => $this->session->userdata['user']['id'],
                        'file_name' => $file['file_name'],
                        'account_id' => $post['account_id'],
                        'application_id' => $post['application_id'],
                        'coa_id' => $post['coa_id'],
                        'remarks' => $post['remarks'],
                        'date_terminated' => date('Y-m-d H:i:s'),
                        'date_created' => date('Y-m-d H:i:s')
                    ];
                    $query = $this->ApplicationTerminationPageModel->terminateCOA($data);
                    if ($query == true) {
                        $response = ['status' => 1, 'message' => 'Successfully revoked!'];
                    } else {
                        $response = ['status' => 0, 'message' => 'Failed to revoke. Please try again!'];
                    }
                }
            }
        } catch (Exception $err) {
            log_message('ERROR', $err);
        }
        echo json_encode($response);
    }
    
    /**
     * Redirect if coa is already terminate.
     */
    public function redirectToApplicationTable() {
        try {
            
        } catch (Exception $err) {
            log_message('ERROR', $err);
        }
    }
}
