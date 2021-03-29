<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * 
 * Add user controller
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class ApplicationFullDetailsPageController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function index() { 
        try {
            $data = NULL; // Initialized
            if(isset($this->session->userdata['view_selected_application_details']['id'])) {
                $selectedApplicationID = $this->session->userdata['view_selected_application_details']['id'];
                $selectedBy = $this->session->userdata['view_selected_application_details']['selected_by'];
            } else {
                $selectedApplicationID = NULL;
                $selectedBy = NULL;
            }
            // Application data.
            $application = $this->ApplicationDetailsPageModel->getApplicationDetails($selectedApplicationID);
            
           // echo var_dump($application);
            
            // For pco users
            if( isset($selectedApplicationID) == TRUE AND isset($selectedBy) == TRUE AND $selectedBy == PCO ) {
                $data['selected_region'] = $application['region'];
                $data['region'] = $this->getRegion();
                $data['selected_application_id'] = $selectedApplicationID;
                $data['selected_by'] = $selectedBy;
               // $application = $this->ApplicationDetailsPageModel->getApplicationDetails($selectedApplicationID);
                $data['application_status_id'] = $application['status_fk'];
                $data['application_type_id'] = $application['type_fk'];
                $data['account_id'] = $application['account_fk'];
                $data['pco_name'] = $this->UserModel->getAccountUserFullName($application['account_fk']);
                $data['photo_name'] = $this->ApplicationDetailsPageModel->getSelectedPCOProfilePhoto(
                        $this->ApplicationDetailsPageModel->getUserIDByAccountID($application['account_fk'])['id']);
                $data['date_created'] = $application['date_created'];
                $data['name_of_establishment'] = $application['name_of_establishment'];
                $data['address'] = $application['address'];
                $data['nature_of_business_of_the_establishment'] = $application['nature_of_business_establishment'];
                // Nature of business list.
                $data['nature_of_business'] = $this->getNatureBusinessList();
                $data['establishment_category'] = $application['establishment_category_base_on'];
                $data['telephone_no'] = $application['telephone_no'];
                $data['fax_number'] = $application['fax_no'];
                $data['website'] = $application['website'];
                $data['employment_status'] = $this->AddNewApplicationPageModel->getEmploymentStatusLabel();
                $data['pco_employment_status'] = $this->ApplicationDetailsPageModel->getEmploymentStatusLabelByID($application['pco_e_status_fk']);
                $data['current_position'] = $application['pco_current_position'];
                $data['number_of_years_in_current_position'] = $application['no_of_years_current_position'];
                $data['name_of_managing_head'] = $application['name_of_managing_head'];
                $data['managing_head_certificate'] = $application['mhc_fk'];
                $data['administartive_case'] = $application['administrative_case'];
                $data['administartive_details'] = $application['ac_details'];
                $data['criminal_case'] = $application['criminal_case'];
                $data['criminal_details'] = $application['cc_details'];
                $data['dully_signed'] = $application['dsad_fk'];
                $data['certificate_of_employment'] = $application['coe_fk'];
                $data['notarized_affidavit'] = $application['nafju_fk'];
                $data['status'] = $application['status_fk'];
                $data['processing_fee'] = $application['pfee_fk'];
				$data['is_view_by_pco'] = TRUE;
                $data['flag'] = TRUE;
            }

            // Insert the user role
            $userRole = array($selectedBy);
            // For embr11 users.
            if(count(array_intersect($userRole, array(SUPER_USER,SYSTEM_ADMINISTRATOR,EMPLOYEE)))) {
                $data['selected_region'] = $application['region'];
                $data['region'] = $this->getRegion();
                $data['selected_application_id'] = $selectedApplicationID;
                $data['selected_by'] = $selectedBy;
                //$application = $this->ApplicationDetailsPageModel->getApplicationDetails($selectedApplicationID);
                $data['account_id'] = $application['account_fk'];
                $data['pco_name'] = $this->UserModel->getAccountUserFullName($application['account_fk']);
                $data['photo_name'] = $this->ApplicationDetailsPageModel->getSelectedPCOProfilePhoto(
                        $this->ApplicationDetailsPageModel->getUserIDByAccountID($application['account_fk'])['id']);
                $data['application_status_id'] = $application['status_fk'];
				$data['date_created'] = $application['date_created'];
                $data['name_of_establishment'] = $application['name_of_establishment'];
                $data['address'] = $application['address'];
                $data['nature_of_business_of_the_establishment'] = $application['nature_of_business_establishment'];
                $data['nature_of_business'] = []; // This must be Empty.
                $data['establishment_category'] = $application['establishment_category_base_on'];
                $data['telephone_no'] = $application['telephone_no'];
                $data['fax_number'] = $application['fax_no'];
                $data['website'] = $application['website'];
                $data['employment_status'] = $this->AddNewApplicationPageModel->getEmploymentStatusLabel();
                $data['pco_employment_status'] = $this->ApplicationDetailsPageModel->getEmploymentStatusLabelByID($application['pco_e_status_fk']);
                $data['current_position'] = $application['pco_current_position'];
                $data['number_of_years_in_current_position'] = $application['no_of_years_current_position'];
                $data['name_of_managing_head'] = $application['name_of_managing_head'];
                $data['managing_head_certificate'] = $application['mhc_fk'];
                $data['administartive_case'] = $application['administrative_case'];
                $data['administartive_details'] = $application['ac_details'];
                $data['criminal_case'] = $application['criminal_case'];
                $data['criminal_details'] = $application['cc_details'];
                $data['dully_signed'] = $application['dsad_fk'];
                $data['certificate_of_employment'] = $application['coe_fk'];
                $data['notarized_affidavit'] = $application['nafju_fk'];
                $data['status'] = $application['status_fk'];
                $data['processing_fee'] = $application['pfee_fk'];
				$data['is_view_by_pco'] = FALSE;
                $data['flag'] = FALSE;
            }
            
            // Application status. If the application is editable.
            $data['is_application_editable'] = $this->isApplicationEditable($application['employee_fk']);
            $this->parse('application/application_full_details_page', 'Application full details', $data);
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
    }
    
    /**
     * Get region
     * 
     */
    public function getRegion() {
        return $this->PCOOrganizationModel->getRegion();
    }
	
    public function getCurrentSectionChief($region) {
        return $this->AddNewApplicationPageModel->getSectionChief($region);
    }
    
    /**
     * If application is editable.
     * 
     * @return {boolean} True or False
     */
    public function isApplicationEditable($id) {
        try {
            // Current logged user id.
            $user_id = $this->session->userdata['user']['id'];
            $forwarded_to_user_id = $this->ApplicationModel->getUserID($id);
            if($user_id == $forwarded_to_user_id) {
                return true;
            } 
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
        }
        return false;
    }


    public function getNatureBusinessList() {
        return $this->AddNewApplicationPageModel->getNatureBusinessList();
    }
    
    public function selectedPCOProfile() {
         try {
            $post = $this->input->post();
            if(isset($post['id'])) { //  The selected Account ID.
                // Get the current logge user type
                $userType = $this->UserModel->getUserType($this->session->userdata['user']['id']); 
                $type = NULL;
                switch ($userType['role_fk']) {
                    case SUPER_USER:
                        $type = SUPER_USER;
                        break;
                    case SYSTEM_ADMINISTRATOR:
                        $type = SYSTEM_ADMINISTRATOR;
                        break;
                    case EMPLOYEE:
                        $type = EMPLOYEE;
                        break;
                    case PCO:
                        $type = PCO;
                        break;
                    default:
                        break;
                }
                
                // This where the request came from...
                $url = $post['url']; 
  
                // Save the user type data.
                $this->session->set_userdata('selected_pco_profile', ['id' => $post['id'], 'selected_by' => $type, 'url' => $url] );
                $response = ['status' => 1, 'message' => 'View selected profile !', 'redirectUrl' => base_url('profile')];
            } else {
                $response = ['status' => 0,'message' => 'No data found.'];
            }
            echo json_encode($response);
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
    
    /**
     * editApplication
     */
    public function editApplication() {
        try {
            $this->OuthModel->CSRFVerify();
            $post = $this->input->post(); // Get the inputs...
            // Validate the inputs.
            $this->form_validation->set_rules('region', 'Region', 'required');
            $this->form_validation->set_rules('establishment_name', 'Establishment name', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('nature_of_business', 'Nature of usiness', 'required');
            $this->form_validation->set_rules('establishment_category', 'Establishment category', 'required');
            $this->form_validation->set_rules('telephone_no', 'Telephone no', 'required');
            $this->form_validation->set_rules('fax_no', 'fax no', 'required');
            $this->form_validation->set_rules('website', 'website', 'required');
            $this->form_validation->set_rules('pco_employment_status', 'Pco employment status', 'required');
            $this->form_validation->set_rules('current_position', 'Current position', 'required');
            $this->form_validation->set_rules('no_of_years_in_current_position', 'No of years in current position', 'required');
            $this->form_validation->set_rules('administrative_case', 'Administrative case', 'required');
            $this->form_validation->set_rules('criminal_case', 'Criminal case', 'required');
            // This will do the logic to save and submit the application.
            $forwardedTo = null;
            if ($post['submit'] == 0) { 
                // Forwarded to assigned evaluator.              
                $forwardedTo = $post['account_fk'];
            }
            if ($post['submit'] == SAVE) { 
                // If the application is save the application is not forwarded to Section chief.
                $forwardedTo = $post['account_fk'];
            } 
            if($post['submit'] == SUBMIT) {
                // ID the application is submitted the app. is forwarded to section chief.
                $forwardedTo = $this->getCurrentSectionChief($post['region'])['employee_fk'];
            }
			
            if ($this->form_validation->run() == FALSE) {
                $response = ['status' => 0, 'message' => '<span style="color:#900;">' . validation_errors() . '</span>'];
                echo json_encode($response);
                die;
            } else {
                 // Upload cnfguration...
                $config['upload_path'] = './uploads/attachment';
                $config['allowed_types'] = 'pdf|gif|jpg|png';
                $config['max_size'] = 10240; // 10MB;
                $this->load->library('upload', $config);
                
                // Update the application
                if(isset($_FILES['dully_sined_appointment_or_designation']['name']) && 
                        isset($_FILES['certificate_of_employment']['name']) && 
                        isset($_FILES['notarized_affidavit_of_joint_undertaking']['name']) && 
                        isset($_FILES['processing_fee']['name'])) {
                    // Upload the file first...
                    if (!$this->upload->do_upload('dully_sined_appointment_or_designation')) {
                        echo json_encode(['status' => 1, 'error' => 'Dully sined appointment or designation', 'message' => $this->upload->display_errors()]);
                        die;
                    }
                    // dully_sined_appointment_or_designation
                    $dsadFile = $this->upload->data();
                    if (!$this->upload->do_upload('certificate_of_employment')) {
                        echo json_encode(['status' => 1, 'error' => 'Certificate of employment', 'message' => $this->upload->display_errors()]);
                        die;
                    }
                    // certificate_of_employment
                    $coeFile = $this->upload->data();
                    if (!$this->upload->do_upload('notarized_affidavit_of_joint_undertaking')) {
                        echo json_encode(['status' => 1, 'error' => 'Notarized affidavit of joint undertaking', 'message' => $this->upload->display_errors()]);
                        die;
                    }
                    // notarized_affidavit_of_joint_undertaking
                    $nafjuFile = $this->upload->data();
                    if (!$this->upload->do_upload('processing_fee')) {
                        echo json_encode(['status' => 1, 'error' => 'Processing fee', 'message' => $this->upload->display_errors()]);
                        die;
                    }
                    // Processing fee.
                    $pFeeFile = $this->upload->data();
                    // New application file data...
                    $userId = $this->session->userdata['user']['id'];
              
                    // dully_sined_appointment_or_designation
                    $dsadData = [
                        'used_to' => DULLY_SINED_APPOINTMENT_OR_DESIGNATION,
                        'file_name' => $dsadFile['file_name'],
                        'file_size' => $dsadFile['file_size'],
                        'file_ext' => $dsadFile['file_ext'],
                        'user_fk' => $userId,
                        'date_created' => date('Y-m-d H:i:s')
                    ];

                    // certificate_of_employment
                    $coeData = [
                        'used_to' => CERTIFICATE_OF_EMPLOYMENT,
                        'file_name' => $coeFile['file_name'],
                        'file_size' => $coeFile['file_size'],
                        'file_ext' => $coeFile['file_ext'],
                        'user_fk' => $userId,
                        'date_created' => date('Y-m-d H:i:s')
                    ];
                    // notarized_affidavit_of_joint_undertaking
                    $nadjuData = [
                        'used_to' => NOTARIZED_AFFIDAVIT_OF_JOINT_UNDERTAKING,
                        'file_name' => $nafjuFile['file_name'],
                        'file_size' => $nafjuFile['file_size'],
                        'file_ext' => $nafjuFile['file_ext'],
                        'user_fk' => $userId,
                        'date_created' => date('Y-m-d H:i:s')
                    ];
                    // Processing fee.
                    $pFeeData = [
                        'used_to' => PROCESSING_FEE,
                        'file_name' => $pFeeFile['file_name'],
                        'file_size' => $pFeeFile['file_size'],
                        'file_ext' => $pFeeFile['file_ext'],
                        'user_fk' => $userId,
                        'date_created' => date('Y-m-d H:i:s')
                    ];

                    // New application data...
                    $appData = [
                        'region' => $post['region'],
                        'account_fk' => $post['account_fk'],
                        'employee_fk' => $forwardedTo,
                        'type_fk' => $post['application_type_id'], // 
                        'status_fk' => $post['submit'] == 0?$post['application_status']:$post['submit'],
                        'name_of_establishment' => $post['establishment_name'],
                        'address' => $post['address'],
                        'nature_of_business_establishment' => $post['nature_of_business'],
                        'establishment_category_base_on' => $post['establishment_category'],
                        'telephone_no' => $post['telephone_no'],
                        'fax_no' => $post['fax_no'],
                        'website' => $post['website'],
                        'pco_e_status_fk' => $post['pco_employment_status'],
                        'pco_current_position' => $post['current_position'],
                        'no_of_years_current_position' => $post['no_of_years_in_current_position'],
                        'administrative_case' => $post['administrative_case'],
                        'ac_details' => $post['administrative_case_details'],
                        'criminal_case' => $post['criminal_case'],
                        'cc_details' => $post['criminal_case_details'],
                        'dsad_fk' => $this->AddNewApplicationPageModel->insertAttachmentData($dsadData),
                        'coe_fk' => $this->AddNewApplicationPageModel->insertAttachmentData($coeData),
                        'nafju_fk' => $this->AddNewApplicationPageModel->insertAttachmentData($nadjuData),
                        'pfee_fk' => $this->AddNewApplicationPageModel->insertAttachmentData($pFeeData),
                        'date_modified' => date('Y-m-d H:i:s')
                    ];
                    
                    // Update the appliaction data...
                    $isUpdate = $this->AddNewApplicationPageModel->updateApplicationData($appData, $post['application_id']);
                    if($isUpdate) {
                        $resonse = ['status' => 2, 'message' => 'Successfully Updated !', 'redirectUrl' => base_url('application-page')];
                    } else {
                        $resonse = ['status' => 0, 'message' => 'STATUS ERROR CODE: 409 Confict'];
                    }
                } else {
                    // New application data...
                    $userId = $this->session->userdata['user']['id']; // Current logged userid.
                    $appData = [
                        'region' => $post['region'],
                        'account_fk' => $post['account_fk'],
                        'employee_fk' => $forwardedTo,
                        'type_fk' => $post['application_type_id'], 
                        'status_fk' => $post['submit'] == 0?$post['application_status']:$post['submit'], 
                        'name_of_establishment' => $post['establishment_name'],
                        'address' => $post['address'],
                        'nature_of_business_establishment' => $post['nature_of_business'],
                        'establishment_category_base_on' => $post['establishment_category'],
                        'telephone_no' => $post['telephone_no'],
                        'fax_no' => $post['fax_no'],
                        'website' => $post['website'],
                        'pco_e_status_fk' => $post['pco_employment_status'],
                        'pco_current_position' => $post['current_position'],
                        'no_of_years_current_position' => $post['no_of_years_in_current_position'],
                        'name_of_managing_head' => $post['name_of_managing_head'],
                        'administrative_case' => $post['administrative_case'],
                        'ac_details' => $post['administrative_case_details'],
                        'criminal_case' => $post['criminal_case'],
                        'cc_details' => $post['criminal_case_details'],
                        'date_modified' => date('Y-m-d H:i:s')
                    ];
                    
                    // Upload the file first...
                    if ($this->upload->do_upload('managing_head_certificate')) {
                        // managing_head_certificate
                        $mhcFile = $this->upload->data();
                        // New application file data...
                        $mchData = [
                            // managing_head_certificate
                            'used_to' => MANAGING_HEAD_CERTIFICATE,
                            'file_name' => $mhcFile['file_name'],
                            'file_ext' => $mhcFile['file_size'],
                            'file_size' => $mhcFile['file_ext'],  
                            'user_fk' => $userId,
                            'date_created' => date('Y-m-d H:i:s')
                        ];
                        $id = $this->AddNewApplicationPageModel->insertAttachmentData($mchData);
                        $appData += ['mhc_fk' => $id];
                    }
                    
                    // dully_sined_appointment_or_designation
                    if ($this->upload->do_upload('dully_sined_appointment_or_designation')) {
                        $dsadFile = $this->upload->data();
                         $dsadData = [
                            'used_to' => DULLY_SINED_APPOINTMENT_OR_DESIGNATION,
                            'file_name' => $dsadFile['file_name'],
                            'file_size' => $dsadFile['file_size'],
                            'file_ext' => $dsadFile['file_ext'],
                            'user_fk' => $userId,
                            'date_created' => date('Y-m-d H:i:s')
                        ];
                        $id = $this->AddNewApplicationPageModel->insertAttachmentData($dsadData);
                        $appData += ['dsad_fk' => $id];
                    }
                    
                    // certificate_of_employment
                    if ($this->upload->do_upload('certificate_of_employment')) {
                        $coeFile = $this->upload->data();
                        // certificate_of_employment
                        $coeData = [
                            'used_to' => CERTIFICATE_OF_EMPLOYMENT,
                            'file_name' => $coeFile['file_name'],
                            'file_size' => $coeFile['file_size'],
                            'file_ext' => $coeFile['file_ext'],
                            'user_fk' => $userId,
                            'date_created' => date('Y-m-d H:i:s')
                        ];
                        $id = $this->AddNewApplicationPageModel->insertAttachmentData($coeData);
                        $appData += ['coe_fk' => $id];
                    }
                    
                    // notarized_affidavit_of_joint_undertaking
                    if ($this->upload->do_upload('notarized_affidavit_of_joint_undertaking')) {
                        $nafjuFile = $this->upload->data();
                         // notarized_affidavit_of_joint_undertaking
                        $nadjuData = [
                            'used_to' => NOTARIZED_AFFIDAVIT_OF_JOINT_UNDERTAKING,
                            'file_name' => $nafjuFile['file_name'],
                            'file_size' => $nafjuFile['file_size'],
                            'file_ext' => $nafjuFile['file_ext'],
                            'user_fk' => $userId,
                            'date_created' => date('Y-m-d H:i:s')
                        ];
                        
                        $id = $this->AddNewApplicationPageModel->insertAttachmentData($nadjuData);
                        $appData += ['nafju_fk' => $id];
                    }
                    
                    // Processing fee.
                    if ($this->upload->do_upload('processing_fee')) {
                        $pFeeFile = $this->upload->data();
                        $pFeeData = [
                            'used_to' => PROCESSING_FEE,
                            'file_name' => $pFeeFile['file_name'],
                            'file_size' => $pFeeFile['file_size'],
                            'file_ext' => $pFeeFile['file_ext'],
                            'user_fk' => $userId,
                            'date_created' => date('Y-m-d H:i:s')
                        ];
                        
                        $id = $this->AddNewApplicationPageModel->insertAttachmentData($pFeeData);
                        $appData += ['pfee_fk' => $id];
                    }
                     
                    // Update the appliaction data...
                    $isUpdate = $this->AddNewApplicationPageModel->updateApplicationData($appData, $post['application_id']);
                    if($isUpdate) {
                        $resonse = ['status' => 2, 'message' => 'Successfully Updated !', 'redirectUrl' => base_url('application-page')];
                    } else {
                        $resonse = ['status' => 0, 'message' => 'STATUS ERROR CODE: 409 Confict'];
                    }
                }
            }
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
        echo json_encode($resonse);
    }
}