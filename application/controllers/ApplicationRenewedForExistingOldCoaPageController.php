<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * 
 * 
 * @author JC Dela Cerna Jr. May 2019
 */

class ApplicationRenewedForExistingOldCoaPageController extends BaseController {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        try {
            $data = NULL; // Initialized
            if(isset($this->session->userdata['view_renewed_selected_application']['id'])) {
                $selectedApplicationID = $this->session->userdata['view_renewed_selected_application']['id'];
                $selectedBy = $this->session->userdata['view_renewed_selected_application']['selected_by'];
            } else {
                $selectedApplicationID = NULL;
                $selectedBy = NULL;
            }
            // Application data.
            $application = $this->ApplicationDetailsPageModel->getApplicationDetails($selectedApplicationID);
            // For pco users
            if( isset($selectedApplicationID) == TRUE AND isset($selectedBy) == TRUE AND $selectedBy == PCO ) {
                $data['selected_application_id'] = $selectedApplicationID;
                $data['selected_by'] = $selectedBy;
                $data['selected_region'] = $application['region'];
                $data['region'] = $this->getRegion();
                $data['application_origin'] = $application['origin'];
                $data['account_id'] = $application['account_fk'];
                $data['coa'] = $this->getCOAFromOriginId($selectedApplicationID); // #1
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
                $data['p_fee_file_id'] = $application['nafju_fk'];
                $data['status'] = $application['status_fk'];
                $data['processing_fee'] = $application['pfee_fk'];
                $data['flag'] = $application['flag'];
                $data['is_pco'] = TRUE;
            }

            // Insert the user role
            $userRole = array($selectedBy);
            // For embr11 users.
            if(count(array_intersect($userRole, array(SUPER_USER,SYSTEM_ADMINISTRATOR,EMPLOYEE)))) {
                $data['selected_application_id'] = $selectedApplicationID;
                $data['selected_by'] = $selectedBy;
                $data['selected_region'] = $application['region'];
                $data['region'] = $this->getRegion();
                $data['application_origin'] = $application['origin'];
                $data['coa'] = $this->getCOAFromOriginId($selectedApplicationID); // #1
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
                $data['p_fee_file_id'] = $application['nafju_fk'];
                $data['status'] = $application['status_fk'];
                $data['processing_fee'] = $application['pfee_fk'];
                $data['flag'] = $application['flag'];
                $data['is_pco'] = FALSE;
            }
            
            $data['is_application_is_locked'] = $this->isApplicationDisabled($application['employee_fk']);
            
            if($application['sys_gen']) {
                $this->parse('application/application_renewal_details_page', 'Application Renewed Page.', $data);
            } else {
                $this->parse('application/application_renewal_details_for_existing_old_coa_page', 'Application Renewed Page.', $data);
            }
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
	
    /** #1
     * Get the origin coa id
     * 
     * @param {int} $originId This is the coa id of the new application
     * **/
    public function getCOAFromOriginId($id) {
        // Get the coa no and the existing old coa no
        $application = $this->ApplicationRenewalPageModel->getRenewedApplicationById($id);
        // if the application have a existing old coa no
        // this condition is for the coa file that registered in year below 2019 
        // this condition will run
        if($application['old_coa_attachment']) {
            return $this->ApplicationRenewalPageModel->getOldExistingCOANoByID($application['old_coa_attachment']);
        }
        // this condition is for the existing coa no that has registired on the system in year above 2019
        if($application['coa_fk']) {
            return $this->ApplicationRenewalPageModel->getCOANoByID($application['coa_fk']);
        }
    }
    
    /**
     * Is application disabled
     */
    public function isApplicationDisabled($id) {
        try {
            // Current logged user id.
            $user_id = $this->session->userdata['user']['id'];
            $evaluator_user_id = $this->ApplicationModel->getUserID($id);
            if($user_id == $evaluator_user_id) {
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
    
    /**
     * Update renewed application details.
     */
    public function updateRenewedApplicationDetails() {
        try {
            $this->OuthModel->CSRFVerify();
            $post = $this->input->post(); // Get the inputs...
            // Validate the inputs.
            $this->form_validation->set_rules('establishment_name', 'Establishment name', 'required');
            $this->form_validation->set_rules('existing_coa_no', 'Coa number', 'required');
            $this->form_validation->set_rules('date_approved', 'Date approved', 'required');
            $this->form_validation->set_rules('valid_until', 'Date issued', 'required');
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
                $response = ['status' => 0, 'message' => validation_errors()];
                echo json_encode($response);
                die;
            } else {
                 // Upload cnfguration...
                $config['upload_path'] = './uploads/attachment';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] =  104858;
                $this->load->library('upload', $config);
                    
                // New application data...
               $userId = $this->session->userdata['user']['id']; // Current logged userid.
               $application_data = [
                   'account_fk' => $post['account_id'],
                   'origin' => $post['application_origin'] == 0 ? $post['application_id'] : $post['application_origin'],
                   'type_fk' => RENEWAL, 
                   'name_of_establishment' => $post['establishment_name'],
                   'nature_of_business_establishment' => $post['nature_of_business'],
                   'establishment_category_base_on' => $post['establishment_category'],
                   'telephone_no' => $post['telephone_no'],
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
                       $application_data += ['nafju_fk' => $id];
                   }
               } else {
                   $application_data += ['nafju_fk' => $post['naffi_file_id']];
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
                       $application_data += ['joint_affidavit_of_commitment' => $id];
                   }
               } else {
                   $application_data += ['joint_affidavit_of_commitment' => $post['joint_affidavit_of_commitment_id']];
               } 

               // Processing fee
               if($post['processing_fee'] == null) {
                   if ($this->upload->do_upload('processing_fee')) {
                       $pFeeFile = $this->upload->data();
                        // Processing fee
                       $pFeeData = [
                           'used_to' => PROCESSING_FEE,
                           'file_name' => $pFeeFile['file_name'],
                           'file_size' => $pFeeFile['file_size'],
                           'file_ext' => $pFeeFile['file_ext'],
                           'user_fk' => $userId,
                           'date_created' => date('Y-m-d H:i:s')
                       ];

                       $id = $this->AddNewApplicationPageModel->insertAttachmentData($pFeeData);
                       $application_data += ['pfee_fk' => $id];
                   }
               } else {
                   $application_data += ['pfee_fk' => $post['p_fee_file_id']];
               }
               
               // old coa file
               // id the user upload new file
               $old_coa_data = [
                    'id' => $post['existing_coa_id'],
                    'coa_no' => $post['existing_coa_no'],
                    'date_approved' => $post['date_approved'],
                    'valid_until' => $post['valid_until'],
                    'date_modified' => date('Y-m-d H:i:s')
               ];
               if($post['certificate_of_accreditation'] == null) {
                   if ($this->upload->do_upload('certificate_of_accreditation')) {
                       // this is the coa file data to update
                       $old_coa_affi_file = $this->upload->data();
                        $old_coa_affi_data = [
                           'used_to' => CERTIFICATE_OF_ACCREDITATION,
                           'file_name' => $old_coa_affi_file['file_name'],
                           'file_size' => $old_coa_affi_file['file_size'],
                           'file_ext' => $old_coa_affi_file['file_ext'],
                           'user_fk' => $userId,
                           'date_created' => date('Y-m-d H:i:s')
                       ];
                        // upload the new file
                       $id = $this->AddNewApplicationPageModel->insertAttachmentData($old_coa_affi_data);
                       // update the attachment id
                       $old_coa_data += ['attachment' => $id];
                   }
               } else {
                   $old_coa_data += ['attachment' => $post['certificate_of_accreditation_id']];
               }

               // Update the appliaction data...
               $is_updated = $this->AddNewApplicationPageModel->updateRenewalExistingCoa($old_coa_data, $application_data, $post['application_id']);
               if($is_updated['is_success']) {
                   // Notification for the renewal application.
                   $data = [
                       'renewal_id' => $post['application_id'], // The application renewal id.
                       'account_id' => $post['account_id'],
                       'comment' => 'The application has been updated, id no: '.$post['application_id'],// The sender's comment. 
                       'user_fk' => $this->session->userdata['user']['id'], // The user's id sender.
                       'date_created' =>  date('Y-m-d H:i:s'), // Current date.
                       'application_id' => $post['application_id'], // The seleceted application id.
                       'application_status_id' => $post['submit'], // The selected application status id.
                       'application_assignee_id' => null, // null by default.
                   ];
                   $isRenew = $this->renewalNotification($data);
                   if($isRenew) {
                       $response = ['status' => 1, 'message' => 'Successfully updated!', 'redirectUrl' => base_url('application-page')];
                   }
               }
            }
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
        echo json_encode($response);
    }
    
    public function getCurrentSectionChief() {
        return $this->AddNewApplicationPageModel->getSectionChief();
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
                    'forwarded_to' => $this->getCurrentSectionChief()['employee_fk'], 
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