<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * Application renewal page controller
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class ApplicationRenewalPageController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        try {
            $data = NULL; // Initialized
            if(isset($this->session->userdata['renew_selected_application']['id'])) {
                $selectedApplicationID = $this->session->userdata['renew_selected_application']['id'];
                $selectedBy = $this->session->userdata['renew_selected_application']['selected_by'];
            } else {
                $selectedApplicationID = NULL;
                $selectedBy = NULL;
            }
            // For pco users
            if( isset($selectedApplicationID) == TRUE AND isset($selectedBy) == TRUE AND $selectedBy == PCO ) {
                $data['selected_application_id'] = $selectedApplicationID;
                $data['selected_by'] = $selectedBy;
                $data['region'] = $this->getRegion();
                $application = $this->ApplicationDetailsPageModel->getApplicationDetails($selectedApplicationID);
                $data['selected_region'] = $application['region'];
                $data['application_origin'] = $application['origin'];
                $data['account_id'] = $application['account_fk'];
                $data['coa'] = $this->ApplicationRenewalPageModel->getCOANoByID($application['coa_fk']);
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
                $data['administartive_case'] = $application['administrative_case'];
                $data['administartive_details'] = $application['ac_details'];
                $data['criminal_case'] = $application['criminal_case'];
                $data['criminal_details'] = $application['cc_details'];
                $data['notarized_affidavit'] = $application['nafju_fk'];
                $data['joint_affidavit_of_commitment'] = $application['joint_affidavit_of_commitment'];
                $data['status'] = $application['status_fk'];
                $data['flag'] = $application['flag'];
                $data['is_pco'] = TRUE;
            }

            // Insert the user role
            $userRole = array($selectedBy);
            // For embr11 users.
            if(count(array_intersect($userRole, array(SUPER_USER,SYSTEM_ADMINISTRATOR,EMPLOYEE)))) {
                $data['selected_application_id'] = $selectedApplicationID;
                $data['selected_by'] = $selectedBy;
                $data['region'] = $this->getRegion();
                $application = $this->ApplicationDetailsPageModel->getApplicationDetails($selectedApplicationID);
                $data['selected_region'] = $application['region'];
                $data['account_id'] = $application['account_fk'];
                $data['pco_name'] = $this->UserModel->getAccountUserFullName($application['account_fk']);
                $data['photo_name'] = $this->ApplicationDetailsPageModel->getSelectedPCOProfilePhoto(
                        $this->ApplicationDetailsPageModel->getUserIDByAccountID($application['account_fk'])['id']);
                $data['date_created'] = $application['date_created'];
                $data['name_of_establishment'] = $application['name_of_establishment'];
                $data['address'] = $application['address'];
                $data['nature_of_business_of_the_establishment'] = $application['nature_of_business_establishment'];
                $data['nature_of_business'] = [];
                $data['establishment_category'] = $application['establishment_category_base_on'];
                $data['telephone_no'] = $application['telephone_no'];
                $data['fax_number'] = $application['fax_no'];
                $data['website'] = $application['website'];
                $data['employment_status'] = $this->AddNewApplicationPageModel->getEmploymentStatusLabel();
                $data['pco_employment_status'] = $this->ApplicationDetailsPageModel->getEmploymentStatusLabelByID($application['pco_e_status_fk']);
                $data['current_position'] = $application['pco_current_position'];
                $data['number_of_years_in_current_position'] = $application['no_of_years_current_position'];
                $data['administartive_case'] = $application['administrative_case'];
                $data['administartive_details'] = $application['ac_details'];
                $data['criminal_case'] = $application['criminal_case'];
                $data['criminal_details'] = $application['cc_details'];
                $data['dully_signed'] = $application['dsad_fk'];
                $data['notarized_affidavit'] = $application['nafju_fk'];
                $data['joint_affidavit_of_commitment'] = $application['joint_affidavit_of_commitment'];
                $data['status'] = $application['status_fk'];
                $data['processing_fee'] = $application['pfee_fk'];
                $data['flag'] = $application['flag'];
                $data['is_pco'] = FALSE;
            }
            $this->parse('application/application_renewal_page', 'Application Renewal Page Table', $data);
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
    
    public function getNatureBusinessList() {
        return $this->AddNewApplicationPageModel->getNatureBusinessList();
    }
    
    public function renewApplication() {
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
            $this->form_validation->set_rules('website', 'website', 'required');
            $this->form_validation->set_rules('pco_employment_status', 'Pco employment status', 'required');
            $this->form_validation->set_rules('current_position', 'Current position', 'required');
            $this->form_validation->set_rules('no_of_years_in_current_position', 'No of years in current position', 'required');
            $this->form_validation->set_rules('administrative_case', 'Administrative case', 'required');
            $this->form_validation->set_rules('criminal_case', 'Criminal case', 'required');
            // Form validation
            if ($this->form_validation->run() == FALSE) {
                $response = ['status' => 0, 'message' => '<span style="color:#900;">' . validation_errors() . '</span>'];
                echo json_encode($response);
                die;
            } else {
                 // Upload cnfguration...
                $config['upload_path'] = './uploads/attachment';
                $config['allowed_types'] = 'pdf|gif|jpg|png';
                $config['max_size'] =  10240; // 10MB
                $this->load->library('upload', $config);
                
                // Update the application
                if(isset($_FILES['notarized_affidavit_of_joint_undertaking']['name'])) {
                    if (!$this->upload->do_upload('notarized_affidavit_of_joint_undertaking')) {
                        echo json_encode(['status' => 1, 'error' => 'Notarized affidavit of joint undertaking', 'message' => $this->upload->display_errors()]);
                        die;
                    }
                    // notarized_affidavit_of_joint_undertaking
                    $nafjuFile = $this->upload->data();
                    // New application file data...
                    $userId = $this->session->userdata['user']['id'];
                    // notarized_affidavit_of_joint_undertaking
                    $nadjuData = [
                        'used_to' => NOTARIZED_AFFIDAVIT_OF_JOINT_UNDERTAKING,
                        'file_name' => $nafjuFile['file_name'],
                        'file_size' => $nafjuFile['file_size'],
                        'file_ext' => $nafjuFile['file_ext'],
                        'user_fk' => $userId,
                        'date_created' => date('Y-m-d H:i:s')
                    ]; 
                    
                    if (!$this->upload->do_upload('joint_affidavit_of_commitment')) {
                        echo json_encode(['status' => 1, 'error' => 'Joint affidavit of commitment', 'message' => $this->upload->display_errors()]);
                        die;
                    }
                    $joint_aff_File = $this->upload->data();
                    $joint_affidavit_of_commitment = [
                        'used_to' => JOINT_AFFIDAVIT_OF_COMMITMENT,
                        'file_name' => $joint_aff_File['file_name'],
                        'file_size' => $joint_aff_File['file_size'],
                        'file_ext' => $joint_aff_File['file_ext'],
                        'user_fk' => $userId,
                        'date_created' => date('Y-m-d H:i:s')
                    ];
                    
                    // New application data...
                    $appData = [
                        'account_fk' => $post['account_id'],
                        'employee_fk' => $this->getCurrentSectionChief($post['region'])['employee_fk'], // By default the application will be submitted to the section chief.
                        'origin' => $post['application_origin'] == 0 ? $post['application_id'] : $post['application_origin'],
                        'type_fk' => RENEWAL, 
                        'status_fk' => $post['submit'],
                        'region' => $post['region'],
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
                        //'name_of_managing_head' => $post['name_of_managing_head'],
                        'administrative_case' => $post['administrative_case'],
                        'ac_details' => $post['administrative_case_details'],
                        'criminal_case' => $post['criminal_case'],
                        'cc_details' => $post['criminal_case_details'],
                        'nafju_fk' => $this->AddNewApplicationPageModel->insertAttachmentData($nadjuData),
                        'joint_affidavit_of_commitment' => $this->AddNewApplicationPageModel->insertAttachmentData($joint_affidavit_of_commitment),
                        'date_created' => date('Y-m-d H:i:s')
                    ];
                    
                    // Update the appliaction data...
                    $isUpdate = $this->ApplicationRenewalPageModel->renewalApplicationData($appData, $post['application_id']);
                    if($isUpdate >= 1) {
                        $flag = ['flag'=>1]; // This will determine if the application is renew.
                        $isFlag = $this->AddNewApplicationPageModel->updateApplicationData($flag, $post['application_id']);
                        if($isFlag) {
                            // Notification for the renewal application.
                            $data = [
                                'region' => $post['region'],
                                'renewal_id' => $isUpdate, // The application renewal id.
                                'comment' => 'Renewal ID# '. $isUpdate,// The sender's comment. 
                                'user_fk' => $this->session->userdata['user']['id'], // The user's id sender.
                                'date_created' =>  date('Y-m-d H:i:s'), // Current date.
                                'application_id' => $post['application_id'], // The seleceted application id.
                                'application_status_id' => $post['submit'], // The selected application status id.
                                'application_assignee_id' => null, // null by default.
                            ];
                            $isRenew = $this->renewalNotification($data);
                            if($isRenew) {
                                $resonse = ['status' => 2, 'message' => 'Successfully submitted !', 'redirectUrl' => base_url('application-page')];
                            }
                        }
                    } else {
                        $resonse = ['status' => 0, 'message' => 'STATUS ERROR CODE: 409 Confict'];
                    }
                } else {
                     // New application data...
                    $userId = $this->session->userdata['user']['id']; // Current logged userid.
                    $appData = [
                        'account_fk' => $post['account_id'],
                        'employee_fk' => $this->getCurrentSectionChief($post['region'])['employee_fk'], // By default the application will be submitted to the section chief.
                        'origin' => $post['application_origin'] == 0 ? $post['application_id'] : $post['application_origin'],
                        'type_fk' => RENEWAL, 
                        'status_fk' => $post['submit'],
                        'region' => $post['region'],
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
                        'date_created' => date('Y-m-d H:i:s')
                    ];
                    
                    // notarized_affidavit_of_joint_undertaking
                    if($post['notarized_affidavit_of_joint_undertaking'] == null) {
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
                    } else {
                        $appData += ['nafju_fk' => $post['naffi_file_id']];
                    } 
                    
                     // joint_affidavit_of_commitment
                    if($post['joint_affidavit_of_commitment'] == null) {
                        if ($this->upload->do_upload('joint_affidavit_of_commitment')) {
                            $joint_affi_file = $this->upload->data();
                             // joint_affidavit_of_commitment
                            $nadjuData = [
                                'used_to' => JOINT_AFFIDAVIT_OF_COMMITMENT,
                                'file_name' => $joint_affi_file['file_name'],
                                'file_size' => $joint_affi_file['file_size'],
                                'file_ext' => $joint_affi_file['file_ext'],
                                'user_fk' => $userId,
                                'date_created' => date('Y-m-d H:i:s')
                            ];

                            $id = $this->AddNewApplicationPageModel->insertAttachmentData($nadjuData);
                            $appData += ['joint_affidavit_of_commitment' => $id];
                        }
                    } else {
                        $appData += ['joint_affidavit_of_commitment' => $post['joint_affidavit_of_commitment_id']];
                    } 
                        
                    // Update the appliaction data...
                    $isUpdate = $this->ApplicationRenewalPageModel->renewalApplicationData($appData, $post['application_id']);
                    if($isUpdate >= 1) {
                        $flag = ['flag'=>1]; // This will determine if the application is renew.
                        $isFlag = $this->AddNewApplicationPageModel->updateApplicationData($flag, $post['application_id']);
                        if($isFlag) {
                            // Notification for the renewal application.
                            $data = [
                                'region' => $post['region'],
                                'renewal_id' => $isUpdate, // The application renewal id.
                                'account_id' => $post['account_id'],
                                'comment' => 'Application submitted for renewal, id no: '. $isUpdate,// The sender's comment. 
                                'user_fk' => $this->session->userdata['user']['id'], // The user's id sender.
                                'date_created' =>  date('Y-m-d H:i:s'), // Current date.
                                'application_id' => $post['application_id'], // The seleceted application id.
                                'application_status_id' => $post['submit'], // The selected application status id.
                                'application_assignee_id' => null, // null by default.
                            ];
                            $isRenew = $this->renewalNotification($data);
                            if($isRenew) {
                                $resonse = ['status' => 2, 'message' => 'Successfully submitted !', 'redirectUrl' => base_url('application-page')];
                            }
                        }
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
    
    public function getCurrentSectionChief($region) {
        return $this->AddNewApplicationPageModel->getSectionChief($region);
    }
    
     /**
      * Add add comment to notify the employee about the
      * application renewal.
      * 
      * @param {array} $data 
      */
    public function renewalNotification($data) {
        try {
            $data1 = [ 
                'comment' => $data['comment'], // The sender's comment. 
                'application_fk' => $data['application_id'], // The selected application
                'user_fk' => $data['user_fk'], // The user's id sender.
                'date_created' =>  $data['date_created'], // Current date.
                ];

            $data2 = [ 
                'application_id' => $data['application_id'], // The seleceted application id.
                'application_status_id' => $data['application_status_id'], // The selected application status id.
                'application_assignee_id' => $data['application_assignee_id'], // The selected application assignee id.
                ];
            
            // Set to user data.
            $this->session->set_userdata('account_fk', $data['account_id']);
            $isSubmitted = $this->ApplicationDetailsPageModel->addComment($data1,$data2);
            if($isSubmitted) {
                $date = ['date_modified'=>date('Y-m-d H:i:s')]; // Date modified...
                $this->ApplicationDetailsPageModel->updateApplicationByID($data['application_id'],$date);
                
                // Application details.
                // Disposition log
                $logDate = date('Y-m-d H:i:s');
                $documentNo = gmdate('Y-m-j', strtotime($logDate) + DATE("Z")); 
                $comment = $data['comment'];
                $dispositionLog = [
                    'application_id' => $data['renewal_id'],
                    'subject' => $comment,
                    'from' => $data['user_fk'],
                    'forwarded_to' => $this->getCurrentSectionChief($data['region'])['employee_fk'], 
                    'document_no' => 'PCO-'.$documentNo.'-ID-'.$data['application_id'], 
                    'document_date' => $logDate,
                    'date_time' => $logDate,
                    'remarks' => $comment,
                ];

                // Insert the disposition log.
                $isSucces = $this->ApplicationDispositionPageModel->dispositionLog($dispositionLog);
                if($isSucces) {
                    return true;
                }
            } 
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
        return false;
    }
}