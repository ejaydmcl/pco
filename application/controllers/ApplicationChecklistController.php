<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * Application checklist page controller
 * 
 * @author JC Dela Cerna Jr. June 2020
 */
class ApplicationChecklistController extends BaseController {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        try {
            // Page title.
            $data['page_title'] = '#';
            $applicationId = $this->session->userdata['application_id'];
            $checklist = $this->getApplicationChecklist($applicationId);
            $application = $this->getApplication($applicationId);
            $data['name_of_firm'] = $application['name_of_establishment'];
            $data['applicationId'] = $applicationId;
            $data['application_type'] = $application['type_fk'];
            $data['is_approved'] = $application['status_fk'] == APPROVED ? true:false;
            $data['is_authorized'] = $this->isAuthorized($application);
            $data['req1'] = isset($checklist['req1'])==null?'0':$checklist['req1'];
            $data['remarks1'] = $checklist['remarks1'];
            $data['req2'] = isset($checklist['req2'])==null?'0':$checklist['req2'];;
            $data['remarks2'] = $checklist['remarks2'];
            $data['req3'] = isset($checklist['req3'])==null?'0':$checklist['req3'];;
            $data['remarks3'] = $checklist['remarks3'];
            $data['req4'] = isset($checklist['req4'])==null?'0':$checklist['req4'];;
            $data['remarks4'] = $checklist['remarks4'];
            $data['req5'] = isset($checklist['req5'])==null?'0':$checklist['req5'];;
            $data['remarks5'] = $checklist['remarks5'];
            $data['req6'] = isset($checklist['req6'])==null?'0':$checklist['req6'];;
            $data['remarks6'] = $checklist['remarks6'];
            $data['req7'] = isset($checklist['req7'])==null?'0':$checklist['req7'];;
            $data['remarks7'] = $checklist['remarks7'];
            $data['req8'] = isset($checklist['req8'])==null?'0':$checklist['req8'];;
            $data['remarks8'] = $checklist['remarks8'];
            $data['req9'] = isset($checklist['req9'])==null?'0':$checklist['req9'];;
            $data['remarks9'] = $checklist['remarks9'];
            $data['req10'] = isset($checklist['req10'])==null?'0':$checklist['req10'];;
            $data['remarks10'] = $checklist['remarks10'];
            $data['req11'] = isset($checklist['req11'])==null?'0':$checklist['req11'];;
            $data['remarks11'] = $checklist['remarks11'];
            $data['req12'] = isset($checklist['req12'])==null?'0':$checklist['req12'];;
            $data['remarks12'] = $checklist['remarks12'];
            
            $this->parse('application/application_checklist_page', 'Application Checklist Page', $data);
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
        }
    }
    
    /**
     * 
     * Get the selected application checklist data.
     */
    public function getApplicationChecklist($applicationId) {
        return $this->ApplicationChecklistModel->getCheckListData($applicationId);
    }
    
    /**
     * Get the application
     */
    public function getApplication($applicationId) {
        return $this->ApplicationChecklistModel->getApplicationData($applicationId);
    }
    
    /**
     * Get the authorized evaluator.
     */
    public function isAuthorized($data) {
        return $this->ApplicationChecklistModel->authorizedToEdit($data);
    }

        /**
     * Record the application checklist
     */
    public function saveChecklistData() {
        $post = $this->input->post();
        // Add the data
        if($post['applicationType'] == _NEW) {
            $data = [
                'application_fk' => $post['applicationId'],
                'application_type' => $post['applicationType'],
                'req1' => $post['req1'],
                'remarks1' => $post['remarks1'],
                'req2' => $post['req2'],
                'remarks2' => $post['remarks2'],
                'req3' => $post['req3'],
                'remarks3' => $post['remarks3'],
                'req4' => $post['req4'],
                'remarks4' => $post['remarks4'],
                'req5' => $post['req5'],
                'remarks5' => $post['remarks5'],
                'req6' => $post['req6'],
                'remarks6' => $post['remarks6'],
                'req7' => $post['req7'],
                'remarks7' => $post['remarks7'],
                'req8' => $post['req8'],
                'remarks8' => $post['remarks8'],
                'req9' => $post['req9'],
                'remarks9' => $post['remarks9'],
                'req10' => $post['req10'],
                'remarks10' => $post['remarks10'],
                'req11' => $post['req11'],
                'remarks11' => $post['remarks11'],
                'req12' => $post['req12'],
                'remarks12' => $post['remarks12']
            ];
        } else {
            $data = [
                'application_fk' => $post['applicationId'],
                'application_type' => $post['applicationType'],
                'req1' => $post['req1'],
                'remarks1' => $post['remarks1'],
                'req2' => $post['req2'],
                'remarks2' => $post['remarks2'],
                'req3' => $post['req3'],
                'remarks3' => $post['remarks3'],
                'req4' => $post['req4'],
                'remarks4' => $post['remarks4'],
                'req5' => $post['req5'],
                'remarks5' => $post['remarks5'],
                'req6' => $post['req6'],
                'remarks6' => $post['remarks6'],
                'req7' => $post['req7'],
                'remarks7' => $post['remarks7'],
                'req8' => $post['req8'],
                'remarks8' => $post['remarks8'],
            ];
        }

        // Add data.
        $res = $this->ApplicationChecklistModel->recordChecklist($data);
        if ($res) {
            $resonse = ['status' => 1, 'message' => 'Successfully save!'];
        } 
        echo json_encode($resonse);
    }
    
}

