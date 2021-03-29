<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

class ProfileController extends BaseController {
    
    public function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
    }

    public function index() {
        $data['page_title'] = ''; 
        // Get user role
        $data['user_role'] = $this->UserModel->getUserRoleLabel();
        // Get user designation
        $data['designation'] = $this->UserModel->getEmployeeDesignationLabel();
        // Get logged user profile photo.
        $data['picture_file_name'] = $this->ProfileModel->getProfilePhoto();
        // Get logged user signature.
        $data['signature_file_name'] = $this->ProfileModel->getUserSignature();
        // Get logged user information.
        $userInfo = $this->ProfileModel->getUserInformation(isset($this->session->userdata['user']['id'])==FALSE?0:$this->session->userdata['user']['id']);
        // User role.
        $data['user_role_fk'] = isset($this->session->userdata['user']['role_fk'])==FALSE?0:$this->session->userdata['user']['role_fk'];
        // User designation.
        $data['designation_fk'] = isset($this->session->userdata['user']['designation_fk'])==FALSE?0:$this->session->userdata['user']['designation_fk'];
        
        // Personal data for PCO.
        $url = null;
        $pcoAccountFk = isset($this->session->userdata['account']['account_fk'])==FALSE?NULL:$this->session->userdata['account']['account_fk'];
        if(isset($pcoAccountFk)) {
            $account = $this->ProfileModel->getAccountInformation($pcoAccountFk);
            $data['user_id'] = $this->session->userdata['user']['id'];
            $data['account_fk'] = $account['id'];
            $data['pco_id'] = $account['pco_id'];
            $data['pco_name'] = $account['first_name'].' '. $account['middle_name'].' '.$account['last_name'].' '. $account['name_extension'];
            $data['first_name'] = $account['first_name'];
            $data['last_name'] = $account['last_name'];
            $data['middle_name'] = $account['middle_name'];
            $data['extension_name'] = $account['name_extension'];
            $data['gender'] = $account['sex'];
            $data['citizenship'] = $account['citizenship'];
            $data['address'] = $account['address'];
            $data['telephone_no'] = $account['telephone_no'];
            $data['email'] = $userInfo['email'];
            $data['mobile_phone_no'] = $account['cellular_phone_no'];
            $data['date_created'] = $account['date_created'];
            // Managing head data
            $data['is_managing_head'] = $account['managing_head'];
            $managing_head_data = $this->getManagingHead($account['id']);
            $data['managing_head_name'] = $managing_head_data['name_of_managing_head'];
            // Attachment id.
            $data['managing_head_certificate'] = $managing_head_data['attachment_fk'];
            $data['is_view_by_evaluator'] = false;
            // Check if the application is locked.
            $data['is_profile_locked'] = $this->isApplicationAndPCOProfileDisabled($account['id']);
            $url = 'profile/pco/pco_profile';
        }
        // Personal data for PCO user employee.
        $pcoEmployeeFk = isset($this->session->userdata['user']['employee_fk'])==FALSE?NULL:$this->session->userdata['user']['employee_fk'];
        $pcoEmployeeDesignationFk = isset($this->session->userdata['user']['designation_fk'])==FALSE?NULL:$this->session->userdata['user']['designation_fk'];
        if(isset($pcoEmployeeFk) || isset($pcoEmployeeDesignationFk)) {
            
            // This will determine the current logged user.
            $selectedAccountID = isset($this->session->userdata['selected_pco_profile']['id'])==TRUE? // The selected account id. Selected by the current user logged.
                    $this->session->userdata['selected_pco_profile']['id']:NULL;
            // The profile data selected by user employee.
            $selectedBy = isset($this->session->userdata['selected_pco_profile']['selected_by'])==TRUE?
                    $this->session->userdata['selected_pco_profile']['selected_by']:NULL;
            // The uri which the request came from. 
            $uri = isset($this->session->userdata['selected_pco_profile']['url'])==TRUE?
                    $this->session->userdata['selected_pco_profile']['url']:NULL;
            // Insert the user role
            $userRole = array($selectedBy);
             // For embr11 users.
            if(count(array_intersect($userRole, array(SUPER_USER,SYSTEM_ADMINISTRATOR,EMPLOYEE))) AND $uri == SELECTED_PCO_PROFILE) { 
                $selectedAccountData = $this->ProfileModel->getUserDataByAccountID($selectedAccountID);
                // Get logged user profile photo.
                $data['picture_file_name'] = $this->ProfileModel->getProfilePhotoByUserID($selectedAccountData['user_id']);
                // Get logged user signature.
                $data['signature_file_name'] = $this->ProfileModel->getUserSignatureByUserID($selectedAccountData['user_id']);
                // Get logged user information.
                $userInfo = $this->ProfileModel->getUserInformation($selectedAccountData['user_id']);
                // User role.
                $data['user_role_fk'] = $selectedAccountData['user_role'];
                // User designation.
                $data['designation_fk'] = $selectedAccountData['designation_id'];;
                // Account data...
                $account = $this->ProfileModel->getAccountInformation($selectedAccountData['account_id']);
                $data['user_id'] = $selectedAccountData['user_id'];
                $data['account_fk'] = $account['id'];
                $data['pco_id'] = $account['pco_id'];
               // $extension = $account['name_extension']==null? '':', '.$account['name_extension'];
                $data['pco_name'] = $account['first_name'].' '. $account['middle_name'].' '. $account['last_name'].' '. $account['name_extension'];
                $data['first_name'] = $account['first_name'];
                $data['last_name'] = $account['last_name'];
                $data['middle_name'] = $account['middle_name'];
                $data['extension_name'] = $account['name_extension'];
                $data['gender'] = $account['sex'];
                $data['citizenship'] = $account['citizenship'];
                $data['address'] = $account['address'];
                $data['telephone_no'] = $account['telephone_no'];
                $data['email'] = $userInfo['email'];
                $data['mobile_phone_no'] = $account['cellular_phone_no'];
                $data['date_created'] = $account['date_created'];
                // Flag for edit.
                $data['is_view_by_evaluator'] = true;
                // Managing head data
                $data['is_managing_head'] = $account['managing_head'];
                $managing_head_data = $this->getManagingHead($account['id']);
                $data['managing_head_name'] = $managing_head_data['name_of_managing_head'];
                // Attachment id.
                $data['managing_head_certificate'] = $managing_head_data['attachment_fk'];
                // Check if the application is locked. default value is false is locked.
                $data['is_profile_locked'] =  false; //$this->isApplicationAndPCOProfileDisabled($account['id']);
                // Selected account data.
                $this->session->set_userdata('account', ['selected_account_fk' => (isset($data['account_fk']) == TRUE ? $data['account_fk'] : NULL)]);                               
                $url = 'profile/pco/pco_profile';
            } else {
                // The current user logged selected profile.. 
                $employee = $this->ProfileModel->getEmployeeInformation($pcoEmployeeFk);
                $data['user_id'] = $this->session->userdata['user']['id'];
                $data['region'] = $employee['region'];
                $data['employee_fk'] = $employee['id'];
                $data['employee_name'] = $employee['first_name'].' '. $employee['middle_name'].' '. $employee['last_name'].' '.$employee['name_extension'];
                $data['first_name'] = $employee['first_name'];
                $data['last_name'] = $employee['last_name'];
                $data['middle_name'] = $employee['middle_name'];
                $data['extension_name'] = $employee['name_extension'];
                $data['gender'] = $employee['sex'];
                $data['citizenship'] = $employee['citizenship'];
                $data['address'] = $employee['address'];
                $data['telephone_no'] = $employee['telephone_no']; 
                $data['mobile_phone_no'] = $employee['mobile_no']; 
                $data['email'] = $userInfo['email'];
                $data['date_created'] = $employee['date_created'];
                $url = 'profile/employee/employee_profile';
            }
        }
        $this->parse($url, 'Profile', $data);
    }
    
     /**
      * Is application and PCO profile disabled.
      * Check the account if the PCO client account have an ongoing application.
      * The application and PCO profile is disable when the application is not routed to
      * his/her account.  
      * 
      * @param {int} $id 
      */
    public function isApplicationAndPCOProfileDisabled($id) {
        try {
            $is_locked = $this->ApplicationModel->getApplication($id);
            if($is_locked) {
                return true;
            } else {				
				$is_renewal_present = $this->ApplicationModel->checkifPCOhasfileRenewalApplication($id);
				if($is_renewal_present) {
				   return TRUE;
				} else {
					$is_account = $this->ApplicationModel->checkAccount($id);
					if($is_account) {
						return true;
					}
				}
			}
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
        }
        return false;
    }
    
    /**
     * Get the managing head data
     */
    public function getManagingHead($account_id) {
        return $this->ProfileModel->getPCOManagingHead($account_id);
    }

    /**
     * Upload user photo
     */
    public function uploadPhoto() {
        $this->OuthModel->CSRFVerify();
        $resonse = ['status' => 0, 'message' => 'false'];
        if (isset($_FILES['userPhoto']['name']) && !empty($_FILES['userPhoto']['name'])) {
            $config['upload_path'] = './uploads/profiles';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 0;
            $config['max_width'] = 0;
            $config['max_height'] = 0;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('userPhoto')) {
                echo json_encode(['status' => 0, 'message' => $this->upload->display_errors()]);
                die;
            } else {
                $file_data = $this->upload->data();
                $data = [
                    'used_to' => 'PROFILE_PHOTO',
                    'file_name' => $file_data['file_name'],
                    'user_fk' => $this->session->userdata['user']['id']
                ];
                $query = $this->UserModel->UpdateProfileImageByUserID($data);
                if ($query == true) {
                    $picture_url = base_url('/uploads/profiles/' . $file_data['file_name']);
                    $resonse = ['status' => 1, 'message' => 'Profile Image Upload Successfully !', 'picture_url' => $picture_url];
                } else {
                    $resonse = ['status' => 0, 'message' => 'Local error callback.'];
                }
            }
        }
        echo json_encode($resonse);
    }
    
    /**
     * Redirect the user profile picture requirements.
     */
    public function redirectUserToPictureReq() {
        $message = ['status' => 1,
            'message' => 'You are now redirected to profile picture requirements page.',
            'redirectUrl' => base_url('picture-requirements')
        ];
       
        echo json_encode($message);
    } 
    
    /**
     * Redirect the user signature requirements.
     */
    public function redirectUserToSignatureReq() {
        $message = ['status' => 1,
            'message' => 'You are now redirected to signature requirements page.',
            'redirectUrl' => base_url('signature-requirements')
        ];
       
        echo json_encode($message);
    } 
    
    /**
     * Upload user signature.
     */
    public function uploadUserSignature() {
        $this->OuthModel->CSRFVerify();
        $resonse = ['status' => 0, 'message' => 'false'];
        if (isset($_FILES['userSignature']['name']) && !empty($_FILES['userSignature']['name'])) {
            $config['upload_path'] = './uploads/signature';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 500;
            //$config['max_width']            = 1024;
            //$config['max_height']           = 768;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('userSignature')) {
                echo json_encode(['status' => 0, 'message' => $this->upload->display_errors()]);
                die;
            } else {
                $file_data = $this->upload->data();
                $data = [
                    'used_to' => 'USER_SIGNATURE',
                    'file_name' => $file_data['file_name'],
                    'user_fk' => $this->session->userdata['user']['id']
                ];
                $query = $this->UserModel->UpdateUserSignatureImageByUserID($data);
                if ($query == true) {
                    $picture_url = base_url('/uploads/signature/' . $file_data['file_name']);
                    $resonse = ['status' => 1, 'message' => 'Signature Image Upload Successfully !', 'picture_url' => $picture_url];
                } else {
                    $resonse = ['status' => 0, 'message' => 'Local error callback.'];
                }
            }
        }
        echo json_encode($resonse);
    }
    
    /**
     * Update PCO personal data.
     */
    public function updatePCOPersonalProfile() {
        $this->OuthModel->CSRFVerify();
        $this->form_validation->set_rules('first_name', 'First name', 'required');
        $this->form_validation->set_rules('last_name', 'Last name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        // Validate the input
        if ($this->form_validation->run() == FALSE) {
            $response = ['status' => 0, 'message' => '<span style="color:#900;">' . validation_errors() . '</span>'];
            echo json_encode($response);
            die;
        } else {
             if (isset($_FILES['managing_head_certificate']['name']) && 
                !empty($_FILES['managing_head_certificate']['name'])) {
                $config['upload_path'] = './uploads/attachment';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] =  5120; // 5mb.
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('managing_head_certificate')) {
                    echo json_encode(['status' => 0, 'message' => $this->upload->display_errors()]);
                    die;
                } else {
                    $file = $this->upload->data();
                    $post = $this->input->post();
                    $personal_profile_data = [
                        'update_personal_data_attachment' => true,
                        'date_created' => date('Y-m-d H:i:s'),
                        'file_name' => $file['file_name'],
                        'user_id' => $post['user_id'],
                        'account_fk' => isset($post['account_fk'])==TRUE?$post['account_fk']:NULL,
                        'employee_fk' => isset($post['employee_fk'])==TRUE?$post['employee_fk']:NULL,
                        'first_name' => $post['first_name'],
                        'last_name' => $post['last_name'],
                        'middle_name' => $post['middle_name'],
                        'extension_name' => $post['extension_name'],
                        'sex' => $post['gender'],
                        'citizenship' => $post['citizenship'],
                        'address' => $post['address'],
                        'telephone_no' => $post['telephone_number'],
                        'cellular_phone_no' => $post['mobile_no'],
                        'email_address' => $post['email'],
                        'is_managing_head' => $post['is_managing_head'],
                        'managing_head' => $post['managing_head'],
                        'attachment_id' => $post['attachment_id'],
                        'role_fk' => $post['role'],
                        'designation_fk' => $post['designation']
                        
                    ];
                    // For PCO account user
                    if(isset($personal_profile_data['account_fk'])) {
                        // update pco account data.
                        $res = $this->ProfileModel->updatePCOAccountData($personal_profile_data);
                    }
                    
                    // For employee
//                    if(isset($personal_profile_data['employee_fk'])) {
//                        // Update the employee table
//                        $res = $this->ProfileModel->updateEmployeeData($personal_profile_data);
//                    }                   
                }
            } else {
                $post = $this->input->post();
                $personal_profile_data = [
                    'update_personal_data' => true,
                    'date_modified' => date('Y-m-d H:i:s'),
                    'user_id' => $post['user_id'],
                    'account_fk' => isset($post['account_fk'])==TRUE?$post['account_fk']:NULL,
                    'employee_fk' => isset($post['employee_fk'])==TRUE?$post['employee_fk']:NULL,
                    'first_name' => $post['first_name'],
                    'last_name' => $post['last_name'],
                    'middle_name' => $post['middle_name'],
                    'extension_name' => $post['extension_name'],
                    'sex' => $post['gender'],
                    'citizenship' => $post['citizenship'],
                    'address' => $post['address'],
                    'telephone_no' => $post['telephone_number'],
                    'cellular_phone_no' => $post['mobile_no'],
                    'email_address' => $post['email'],
                    'is_managing_head' => $post['is_managing_head'],
                    'managing_head' => $post['managing_head'],
                    'attachment_id' => $post['attachment_id'],
                    'role_fk' => $post['role'],
                    'designation_fk' => $post['designation']

                ];
                // For PCO account user
                if(isset($personal_profile_data['account_fk'])) {
                    // update pco account data.
                    $res = $this->ProfileModel->updatePCOAccountData($personal_profile_data);
                }
                 // For employee
                if(isset($personal_profile_data['employee_fk'])) {
                    // Update the employee table
                    $res = $this->ProfileModel->updateEmployeeData($personal_profile_data);
                }   
                
            }
            if($res) {
                $response = ['status' => 1, 'message' => 'Successfully save!'];
            } else {
                $response = ['status' => 0, 'message' => 'Local error callback.'];
            }
        }
        echo json_encode($response);
    }

    /**
     * This function will update the user data
     * 
     * @deprecated number
     */
    public function updateUserPersonalProfile() {
        $this->OuthModel->CSRFVerify();
        $this->form_validation->set_rules('first_name', 'First name', 'required');
        $this->form_validation->set_rules('last_name', 'Last name', 'required');
        $this->form_validation->set_rules('middle_name', 'Middle name', 'required');
        //$this->form_validation->set_rules('extension_name', 'Extension name', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('citizenship', 'Citizenship', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        //$this->form_validation->set_rules('telephone_number', 'Telephone no', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('mobile_no', 'Mobile phone no.', 'required');
        
        // Validate the input
        if ($this->form_validation->run() == FALSE) {
            $response = ['status' => 0, 'message' => '<span style="color:#900;">' . validation_errors() . '</span>'];
            echo json_encode($response);
            die;
        } else {
            $post = $this->input->post();
            // PCO account or Employee data.
            $data = [
                'user_id' => $post['user_id'],
                'account_fk' => isset($post['account_fk'])==TRUE?$post['account_fk']:NULL,
                'employee_fk' => isset($post['employee_fk'])==TRUE?$post['employee_fk']:NULL,
                'first_name' => $post['first_name'],
                'last_name' => $post['last_name'],
                'middle_name' => $post['middle_name'],
                'extension_name' => $post['extension_name'],
                'sex' => $post['gender'],
                'citizenship' => $post['citizenship'],
                'address' => $post['address'],
                'telephone_no' => $post['telephone_number'],
                'cellular_phone_no' => $post['mobile_no'],
                'email_address' => $post['email'],
                'role_fk' => $post['role'],
                'designation_fk' => $post['designation'],
                'date_created' => date('Y-m-d H:i:s')
            ];
            
            // For PCO account user
            if(isset($post['account_fk'])) {
                // update pco account data.
                $res = $this->ProfileModel->updateAccountData($data);
            }
            
            // For employee
            if(isset($data['employee_fk'])) {
                // Update the employee table
                $res = $this->ProfileModel->updateEmployeeData($data);
            }
            if($res) {
                $resonse = ['status' => 1, 'message' => 'Successfully save !'];
            } else {
                $resonse = ['status' => 0, 'message' => 'Local error callback.'];
            }
        }
        echo json_encode($resonse);
    }
    
    /**
     * Update old password.
     */
    public function updatePassword() {
        try {
            $this->OuthModel->CSRFVerify();
            $post = $this->input->post();
            if (empty($post['old'])) {
                echo json_encode(['status' => 0, 'message' => 'Old password required !']);
            } else if (empty($post['new'])) {
                echo json_encode(['status' => 0, 'message' => 'New password required !']);
            } else if (strlen($post['confirm']) < 4) {
                echo json_encode(['status' => 0, 'message' => 'Password must contain at least 4 characters ! ']);
            } else if ($post['new'] != $post['confirm']) {
                echo json_encode(['status' => 0, 'message' => "Password and confirm password not match."]);
            } else {
                $oldPassword = $this->PCOModel->checkOldPassword();
                $hashed = $oldPassword['password'];
                if ($this->OuthModel->VerifyPassword($post['old'], $hashed) == 1) {
                    $user_id = $oldPassword['id'];
                    $update = $this->PCOModel->updatePassword($user_id, $post['new'], $this->OuthModel->HashPassword($post['new']));
                    if ($update == true) {
                        echo json_encode(['status' => 1, 'message' => "Password updated !"]);
                    } else {
                        echo json_encode(['status' => 0, 'message' => "Faild, Please try again !"]);
                    }
                } else {
                    echo json_encode(['status' => 0, 'message' => "Invalid old password, please enter your correct password !"]);
                }
            }
        } catch(Exception $err) {
            show_error($err->getMessage());
        }
    }
    
    /**
     * Add PRC license.
     * 
     */
    public function addLicense() {
       // $post = $this->input->post();
        try {
            $this->OuthModel->CSRFVerify();
            $response = ['status' => 0, 'message' => $_FILES['prc_license_certificate']['name']];
            if (isset($_FILES['prc_license_certificate']['name']) && !empty($_FILES['prc_license_certificate']['name'])) {
                $config['upload_path'] = './uploads/attachment';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] =  5120;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('prc_license_certificate')) {
                    echo json_encode(['status' => 0, 'message' => $this->upload->display_errors()]);
                    die;
                } else {
                    $file = $this->upload->data();
                    $post = $this->input->post();
                    
                    $data = [
                        'add_license_data' => true, // Flag for adding a license data.
                        'date_created' => date('Y-m-d H:i:s'),
                        // attachment data.
                        'used_to' => PRC_LICENSE, // used_to on the table attachment.
                        'file_name' => $file['file_name'], // file name on the table attachment.
                        'user_fk' => $this->session->userdata['user']['id'], // user_fk on the table attachment.
                        // License data.
                        'account_fk' => $post['account_fk'], // account_fk on the table license
                        'date_issued' => $post['date_issued'], // date_issued on the table license.
                        'license_no' => $post['prc_license_no'], // license_no on the table license.
                        'validity' => $post['validity'] // validity on the table license.
                    ];
                    $query = $this->UserModel->UpdatePCOPRCLicenseByUserID($data);
                    if ($query == true) {
                        $response = ['status' => 1, 'message' => 'Successfully save !'];
                    } else {
                        $response = ['status' => 0, 'message' => 'Local error callback.'];
                    }
                }
            }
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
        }
        echo json_encode($response);
    }
    
    /**
     * Add license
     * 
     * @deprecated since version number
     */
    public function addLicenseDeprecated() {
        try {
            $post = $this->input->post();
            // PCO account data.
            $data = [
                'account_fk' => $post['account_fk'],
                //'license_type' => $post['type_of_license'],
                'date_issued' => $post['date_issued'],
                'license_no' => $post['prc_license_no'],
                'validity' => $post['validity']
            ];
            // For PCO account user
            if(isset($post['account_fk'])) {
                // update pco account data.
                $result = $this->ProfileModel->addLiscenseData($data);
            } else {
                $response = ['status' => 0, 'message' => '<span style="color:#900;">STATUS ERROR CODE: 500</span>'];
                echo json_encode($response);
                die;
            }
            if($result) {
                $resonse = ['status' => 1, 'message' => 'Successfully save !'];
            } else {
                $resonse = ['status' => 0, 'message' => 'Local error callback.'];
            }
        } catch(Exception $err) {
            show_error($err->getMessage());
        }
        echo json_encode($resonse);
    }
    
    
    /**
     * Edit PRC license.
     * 
     */
    public function editLicense() {
        try {
            $this->OuthModel->CSRFVerify();
            //$resonse = ['status' => 0, 'message' => $_FILES['work_experience_certificate']['name']];
            // This will record the data into the database. 
            // The license data including the attachment file.
            if (isset($_FILES['edit_prc_license_certificate']['name']) && 
                    !empty($_FILES['edit_prc_license_certificate']['name'])) {
                $config['upload_path'] = './uploads/attachment';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] =  5120; // 5mb.
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('edit_prc_license_certificate')) {
                    echo json_encode(['status' => 0, 'message' => $this->upload->display_errors()]);
                    die;
                } else {
                    $file = $this->upload->data();
                    $post = $this->input->post();
                    // The data to be modify.
                    $data = [
                        'update_attachment_data' => true, // Flag for attachment with data only.
                        'date_modified' => date('Y-m-d H:i:s'),
                        'license_id' => $post['license_id'],
                        'attachment_id' => $post['attachment_id'],
                        'file_name' => $file['file_name'],
                        'user_fk' => $this->session->userdata['user']['id'],
                        'license_no' => $post['edit_prc_license_no'], // license_no on the table license.
                        'date_issued' => $post['edit_date_issued'], // date_issued on the table license.
                        'validity' => $post['edit_validity'] // validity on the table license.
                    ];
                    $query = $this->UserModel->UpdatePCOPRCLicenseByUserID($data);
                    if ($query == true) {
                        $response = ['status' => 1, 'message' => 'Successfully save !'];
                    } else {
                        $response = ['status' => 0, 'message' => 'Local error callback.'];
                    }
                }
            } else {
                // Update the license data text only...
                $post = $this->input->post();
                // The data to be modify.
                $data = [
                    'update_license_data' => true, // Flag for udapte data only.
                    'date_modified' => date('Y-m-d H:i:s'),
                    'license_id' => $post['license_id'],
                    'user_fk' => $this->session->userdata['user']['id'],
                    'license_no' => $post['edit_prc_license_no'], // license_no on the table license.
                    'date_issued' => $post['edit_date_issued'], // date_issued on the table license.
                    'validity' => $post['edit_validity'] // validity on the table license.
                ];
                $query = $this->UserModel->UpdatePCOPRCLicenseByUserID($data);
                if ($query == true) {
                    $response = ['status' => 1, 'message' => 'Successfully save !'];
                } else {
                    $response = ['status' => 0, 'message' => 'Local error callback.'];
                }
            }
        } catch (Exception $err) {
            log_message('ERROR', $err->getTraceAsString());
        } 
        echo json_encode($response);
    }


    /**
     * Edit license
     */
//    public function editLicenseDeprecated() {
//        try {
//            $post = $this->input->post();
//            // PCO account data.
//            $data = [
//                'license_fk' => $post['license_fk'],
//                //'license_type' => null, // Set to null, not included. 
//                'date_issued' => $post['edit_date_issued'],
//                'license_no' => $post['edit_prc_license_no'],
//                'validity' => $post['edit_validity']
//            ];
//            // For PCO account user
//            if(isset($post['license_fk'])) {
//                // update pco account data.
//                $result = $this->ProfileModel->editLiscenseData($data);
//            } else {
//                $response = ['status' => 0, 'message' => '<span style="color:#900;">STATUS ERROR CODE: 409 Confict</span>'];
//                echo json_encode($response);
//                die;
//            }
//            if($result) {
//                $resonse = ['status' => 1, 'message' => 'Successfully save !'];
//            } else {
//                $resonse = ['status' => 0, 'message' => 'STATUS ERROR CODE: 500'];
//            }
//        } catch(Exception $err) {
//            show_error($err->getMessage());
//        }
//        echo json_encode($resonse);
//    }

        /**
     * Fetch license data
     */
    public function licenseDataTable() {
        try {
            $this->OuthModel->CSRFVerify();
            $requestData = $_REQUEST;
            $table = "license";
            $fields = "*";
            $id = '';

            $accountFk = isset($this->session->userdata['account']['account_fk']) != TRUE? 
                    $this->session->userdata['account']['selected_account_fk']: $this->session->userdata['account']['account_fk'] ; 
            $where = " WHERE `account_fk` =".$accountFk;
            $sql = "SELECT " . $fields;
            $sql .= " FROM " . $table . $where;
            $query = $this->db->query($sql);
            $totalRecords = $query->num_rows();
            $totalFiltered = $totalRecords;
            $where = " WHERE `account_fk` =".$accountFk;
            $sql = "SELECT " . $fields;
            $sql .= " FROM " . $table . $where;
            if (!empty($requestData['search']['value'])) {
                $searchValue = $requestData['search']['value'];
                $sql .= " AND `license_type` LIKE '%" . $searchValue . "%' ";
                $sql .= " AND `license_no` LIKE '%" . $searchValue . "%' ";
                $sql .= " OR `license_type` LIKE '%" . $searchValue . "%' ";
                $sql .= " OR `license_no` LIKE '%" . $searchValue . "%' ";
            }
            $query = $this->db->query($sql);
            $totalFiltered = $query->num_rows();
            //ORDER BY id DESC	
            $sql .= " ORDER BY date_created  " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
            $query = $this->db->query($sql);
            $SearchResults = $query->result();

            $data = array();
            foreach ($SearchResults as $row) {
                $data = array(); 
                $id = $row->id;
               // $data[] = $row->license_type; // Not include.
                $data[] = $row->license_no ;
                $data[] = $row->date_issued;
                $data[] = $row->validity;
                //$data[] = '<span id=' . $id . ' class="label label-info">'. $row->license_type . '</span>';
                //$data[] = '<span id=' . $id . ' class="label label-info">'. $row->license_no . '</span>';
                //$data[] = '<span id=' . $id . ' class="label label-info">'. gmdate('F j, Y', strtotime($row->date_issued) + date('Z')) . '</span>';
                //$data[] = '<span id=' . $id . ' class="label label-info">'. gmdate('F j, Y', strtotime($row->validity) + date('Z')) . '</span>';
                
                $data[] = '<span id=' . $id . ' class="label label-danger pull-left" style="margin-right: 10px;"><a href='. 
                        base_url('uploads'). "/attachment/" . $this->ProfileModel->getAttachmentFileName($row->attachment_fk) .
                        ' target="_blank" style="color:#ffffff;"> <span class="fa fa-file-pdf-o" ></span> view</a> </span>'.
                        $this->ProfileModel->getAttachmentFileName($row->attachment_fk);
                
                $data[] = '<span id=' . $id . ' class="label label-info"><a onclick="editLicense('.$id.','. $row->attachment_fk .')" href="javascript:void(0);" style="color:#ffffff;"> <span class="fa fa-edit" ></span> Edit</a> </span>';
                //$data[] = '<span id=' . $id . ' class="label label-info"><a onclick="editLicense('.$id.')" href="javascript:void(0);"> Edit</a> </span> &nbsp; <span id=' . $id . ' class="label label-info"><a onclick="viewLicense('.$id.')" href="javascript:void(0);">View<a/></span>';
                $dataList[] = $data;
            }
            $json_data = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => intval($totalRecords), // total number of records
                "recordsFiltered" => intval($totalFiltered), // total number of records after searching,  
                "data" => $dataList==null?[]:$dataList   // total data array
            );
        } catch(Exception $err) {
            show_error($err->getMessage());
        }
        echo json_encode($json_data);  // send data as json format	
    }
    
    
    /**
     * Add vocational or attainment
     * 
     */
    public function addPCOVocationalOrTechnicalAttainment() {
        $post = $this->input->post();
        try {
            $this->OuthModel->CSRFVerify();
            // Validate the input
            if ($post['graduated'] == 'undefined') {
                $response = ['status' => 0, 'message' => '<span style="color:#900;">The Attainment. field is required</span>'];
                echo json_encode($response);
                die;
            }
            if (isset($_FILES['vocational_certificate']['name']) && 
                    !empty($_FILES['vocational_certificate']['name'])) {
                $config['upload_path'] = './uploads/attachment';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] =  5120; // 5mb.
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('vocational_certificate')) {
                    echo json_encode(['status' => 0, 'message' => $this->upload->display_errors()]);
                    die;
                } else {
                    $file = $this->upload->data();
                    //$post = $this->input->post(); 
                    $data = [
                        'add_pco_educational_attainment_vocational_or_technical' => true, // Flag for adding the new attainment.
                        // For attachment table.
                        'user_fk' => $this->session->userdata['user']['id'],
                        'file_name' => $file['file_name'],
                        // For educational attainment table.
                        'account_fk' => $post['account_fk'],
                        'school' => $post['school'],
                        'school_address' => $post['school_address'],
                        'course' => $post['course'],
                        'degree_or_units_earned' => $post['degree_or_units_earned'],
                        'from_date' => $post['from_date'],
                        'to_date' => $post['to_date'],
                        'graduated' => $post['graduated'],
                        'date_created' => date('Y-m-d H:i:s') 
                    ];
                    
                    // Route the data to model and save.
                    $query = $this->ProfileModel->addPCOVocationalOrTechnical($data);
                    if($query == true) {
                        $response = ['status' => 1, 'message' => 'Successfully!'];
                    } else {
                        $response = ['status' => 0, 'message' => 'Local error callback.'];
                    }
                }
            }
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
        }
        echo json_encode($response);
    }
    
    /**
     * Add PCO college Degree.
     * 
     */
    public function addPCOCollegeDegree() {
        $post = $this->input->post();
        try {
            $this->OuthModel->CSRFVerify();
            // Validate the input
            if ($post['graduated'] == 'undefined') {
                $response = ['status' => 0, 'message' => '<span style="color:#900;">The Attainment. field is required</span>'];
                echo json_encode($response);
                die;
            }
            if (isset($_FILES['college_diploma']['name']) && 
                    !empty($_FILES['college_diploma']['name'])) {
                $config['upload_path'] = './uploads/attachment';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] =  5120; // 5mb.
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('college_diploma')) {
                    echo json_encode(['status' => 0, 'message' => $this->upload->display_errors()]);
                    die;
                } else {
                    $file = $this->upload->data();
                    //$post = $this->input->post(); 
                    $data = [
                        'add_pco_educational_attainment_college_degree' => true, // Flag for adding the new attainment.
                        // For attachment table.
                        'user_fk' => $this->session->userdata['user']['id'],
                        'file_name' => $file['file_name'],
                        // For educational attainment table.
                        'account_fk' => $post['account_fk'],
                        'school' => $post['school'],
                        'college_school_address' => $post['college_school_address'],
                        'course' => $post['course'],
                        'degree_or_units_earned' => $post['degree_or_units_earned'],
                        'from_date' => $post['from_date'],
                        'to_date' => $post['to_date'],
                        'graduated' => $post['graduated'],
                        'date_created' => date('Y-m-d H:i:s') 
                    ];
                    
                    // Route the data to model and save.
                    $query = $this->ProfileModel->addPCOEducationalAttainment($data);
                    if($query == true) {
                        $response = ['status' => 1, 'message' => 'Successfully!'];
                    } else {
                        $response = ['status' => 0, 'message' => 'Local error callback.'];
                    }
                }
            }
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
        }
        echo json_encode($response);
    }

    /**
     * Update educational attainment
     * 
     * @deprecated
     */
    public function addEducational() {
        try {
            $post = $this->input->post();
            // PCO account educational attainment data.
            $data = [
                'account_fk' => $post['account_fk'],
                'school' => $post['school'],
                'address' => $post['address'],
                'course' => $post['course'],
                'degree_or_units_earned' => $post['degree_or_units_earned'],
                'from_date' => $post['from_date'],
                'to_date' => $post['to_date'],
            ];
            // For PCO account fk
            if(isset($post['account_fk'])) {
                // update pco account data.
                $result = $this->ProfileModel->addEducationalData($data);
            } else {
                $response = ['status' => 0, 'message' => '<span style="color:#900;">STATUS ERROR CODE: 500</span>'];
                echo json_encode($response);
                die;
            }
            if($result) {
                $response = ['status' => 1, 'message' => 'Successfully save !'];
            } else {
                $response = ['status' => 0, 'message' => 'Local error callback.'];
            }
        } catch(Exception $err) {
            show_error($err->getMessage());
        }
        echo json_encode($response);
    }
    
    /**
     * Edit PCO College Degree
     * 
     * @param array $data 
     */
    public function editPCOCollegeDegree() {
        $post = $this->input->post(); 
        try {
            $this->OuthModel->CSRFVerify();
            // Validate the input
            if ($post['graduated'] == 'undefined') {
                $response = ['status' => 0, 'message' => '<span style="color:#900;">The Attainment. field is required</span>'];
                echo json_encode($response);
                die;
            }
            if (isset($_FILES['college_diploma']['name']) && 
                    !empty($_FILES['college_diploma']['name'])) {
                $config['upload_path'] = './uploads/attachment';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] =  5120; // 5mb.
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('college_diploma')) {
                    echo json_encode(['status' => 0, 'message' => $this->upload->display_errors()]);
                    die;
                } else {
                    $file = $this->upload->data();
                   // $post = $this->input->post(); 
                    $data = [
                        'edit_pco_educational_attainment_college_degree' => true, // Flag for updating the educational attainment.
                        // For attachment table.
                        'user_fk' => $this->session->userdata['user']['id'],
                        'attachment_id' => $post['attachment_id'],
                        'file_name' => $file['file_name'],
                        // For educational attainment table.
                        'educational_id' => $post['educational_id'], // Educational attainment id.
                        'account_fk' => $post['account_fk'],
                        'school' => $post['school'],
                        'address' => $post['college_school_address'],
                        'course' => $post['course'],
                        'degree_or_units_earned' => $post['degree_or_units_earned'],
                        'from_date' => $post['from_date'],
                        'to_date' => $post['to_date'],
                        'graduated' => $post['graduated'],
                        'date_modified' => date('Y-m-d H:i:s') 
                    ];
                }
            } else {
               // $post = $this->input->post(); 
                $data = [
                    'edit_pco_educational_attainment_college_degree_data' => true, // Flag for updating the educational attainment.
                    // For attachment table.
                    'user_fk' => $this->session->userdata['user']['id'],
                   // 'file_name' => $file['file_name'],
                    // For educational attainment table.
                    'educational_id' => $post['educational_id'], // Educational attainment id.
                    'account_fk' => $post['account_fk'],
                    'school' => $post['school'],
                    'address' => $post['college_school_address'],
                    'course' => $post['course'],
                    'degree_or_units_earned' => $post['degree_or_units_earned'],
                    'from_date' => $post['from_date'],
                    'to_date' => $post['to_date'],
                    'graduated' => $post['graduated'],
                    'date_modified' => date('Y-m-d H:i:s') 
                ];
            }

            // Route the data to model and save.
            $query = $this->ProfileModel->editPCOEducationalAttainment($data);
            if($query == true) {
                $response = ['status' => 1, 'message' => 'Successfully!'];
            } else {
                $response = ['status' => 0, 'message' => 'Local error callback.'];
            }
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
        }
        echo json_encode($response);
    }
    
    /**
     * Edit educational attainment
     */
    public function editEducational() {
        try {
            $post = $this->input->post();
            // PCO account educational attainment data.
            $data = [
                'educational_id' => $post['educational_id'],
                'school' => $post['edit_school'],
                'address' => $post['edit_address'],
                'course' => $post['edit_course'],
                'degree_or_units_earned' => $post['edit_degree_or_units_earned'],
                'from_date' => $post['edit_from_date'],
                'to_date' => $post['edit_to_date'],
            ];
            // For PCO account fk
            if(isset($post['educational_id'])) {
                // update pco account data.
                $result = $this->ProfileModel->editEducationalData($data);
            } else {
                $response = ['status' => 0, 'message' => '<span style="color:#900;">STATUS ERROR CODE: 500</span>'];
                echo json_encode($response);
                die;
            }
            if($result) {
                $resonse = ['status' => 1, 'message' => 'Successfully save !'];
            } else {
                $resonse = ['status' => 0, 'message' => 'STATUS ERROR CODE: 500'];
            }
        } catch(Exception $err) {
            show_error($err->getMessage());
        }
        echo json_encode($resonse);
    }

    /**
     * Fetch educational data from the database
     */
    public function educationalDataTable(){
        try {
            $this->OuthModel->CSRFVerify();
            //$post = $this->input->post();
            $requestData = $_REQUEST;
            $table = "educational_attainment";
            $fields = "*";
            $id = '';

            $accountFk = isset($this->session->userdata['account']['account_fk']) != TRUE? 
                    $this->session->userdata['account']['selected_account_fk']: $this->session->userdata['account']['account_fk'] ; 
            $where = " WHERE `account_fk` = ".$accountFk;
            $sql = "SELECT " . $fields;
            $sql .= " FROM " . $table . $where;
            $query = $this->db->query($sql);
            $totalRecords = $query->num_rows();
            $totalFiltered = $totalRecords;
            
            $where = " WHERE `account_fk` = ".$accountFk;
            $sql = "SELECT " . $fields;
            $sql .= " FROM " . $table . $where;
            
            if (!empty($requestData['search']['value'])) {
                $searchValue = $requestData['search']['value'];
                $sql .= " AND `school` LIKE '%" . $searchValue . "%' ";
                $sql .= " AND `address` LIKE '%" . $searchValue . "%' ";
                $sql .= " OR `school` LIKE '%" . $searchValue . "%' ";
                $sql .= " OR `address` LIKE '%" . $searchValue . "%' ";
            }
            $query = $this->db->query($sql);
            $totalFiltered = $query->num_rows();
            //ORDER BY id DESC	
            $sql .= " ORDER BY type  " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
            $query = $this->db->query($sql);
            $SearchResults = $query->result();

            $data = array();
            foreach ($SearchResults as $row) {
                $data = array(); 
                $id = $row->id;
                $data[] = $row->school;
                $data[] = $row->type;
                $data[] = $row->course;
                $data[] = $row->degree_or_units_earned;
                $data[] = $row->from_date;
                $data[] = $row->to_date;
                $data[] = '<input type="checkbox" ' . ($row->graduated == 1 ? 'checked' : 'unchecked') . ' >';
                $data[] = '<span id=' . $id . ' class="label label-danger pull-left" style="margin-right: 10px;"><a href='. 
                        base_url('uploads'). "/attachment/" . $this->ProfileModel->getAttachmentFileName($row->attachment_fk) .
                        ' target="_blank" style="color:#ffffff;"> <span class="fa fa-file-pdf-o" ></span> view</a> </span>'. 
                        $this->ProfileModel->getAttachmentFileName($row->attachment_fk);
                $data[] = $row->address;
                $data[] = '<span id=' . $id . ' class="label label-info"><a onclick="editEducational('.$id.','.$row->attachment_fk.')" href="javascript:void(0);" style="color:#ffffff;"> <span class="fa fa-edit" ></span> Edit</a> </span>';
                $dataList[] = $data;
            }
            $json_data = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => intval($totalRecords), // total number of records
                "recordsFiltered" => intval($totalFiltered), // total number of records after searching,  
                "data" => $dataList==null?[]:$dataList   // total data array
            );
        } catch(Exception $err) {
            show_error($err->getMessage());
        }
        echo json_encode($json_data);  // send data as json format	
    }
    
    /**
     * Add work experience
     */
    public function addWorkExperience() {
        try {
            $this->OuthModel->CSRFVerify();
            $resonse = ['status' => 0, 'message' => $_FILES['work_experience_certificate']['name']];
            if (isset($_FILES['work_experience_certificate']['name']) && !empty($_FILES['work_experience_certificate']['name'])) {
                $config['upload_path'] = './uploads/attachment';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] =  2048;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('work_experience_certificate')) {
                    echo json_encode(['status' => 0, 'message' => $this->upload->display_errors()]);
                    die;
                } else {
                    $file = $this->upload->data();
                    $post = $this->input->post();
                    
                    // Check if present is true or false.
                    $present = null;
                    if($post['present'] == 'true') {
                        $present = 1;
                    } else {
                        $present = 0;
                    }
                    
                    $data = [
                        'account_fk' => $post['account_fk'],
                        'used_to' => WORK_EXPERIENCE,
                        'file_name' => $file['file_name'],
                        'user_fk' => $this->session->userdata['user']['id'],
                        'company' => $post['company'],
                        'position' => $post['position'],
                        'employment_status' => $post['employment_status'],
                        'from_date' => $post['from_date'],
                        'to_date' => $post['to_date'],
                        'present' => $present
                    ];
                    $query = $this->UserModel->UpdatePCOWorkExperienceByUserID($data);
                    if ($query == true) {
                        $resonse = ['status' => 1, 'message' => 'Successfully save !'];
                    } else {
                        $resonse = ['status' => 0, 'message' => 'STATUS ERROR CODE: 409 Confict'];
                    }
                }
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
        echo json_encode($resonse);
    }
    
    /**
     * Add work experience
     */
    public function editWorkExperience() {
        try {
            $this->OuthModel->CSRFVerify();
            //$resonse = ['status' => 0, 'message' => $_FILES['work_experience_certificate']['name']];
            if (isset($_FILES['work_experience_certificate']['name']) && !empty($_FILES['work_experience_certificate']['name'])) {
                $config['upload_path'] = './uploads/attachment';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] =  2048;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('work_experience_certificate')) {
                    echo json_encode(['status' => 0, 'message' => $this->upload->display_errors()]);
                    die;
                } else {
                    $file = $this->upload->data();
                    $post = $this->input->post();
                    
                    // Check if present is true or false.
                    $present = null;
                    if($post['present'] == 'true') {
                        $present = 1;
                    } else {
                        $present = 0;
                    }
                    
                    $data = [
                        'work_experience_id' => $post['work_experience_id'],
                        'attachment_id' => $post['attachment_id'],
                        'used_to' => WORK_EXPERIENCE,
                        'file_name' => $file['file_name'],
                        'user_fk' => $this->session->userdata['user']['id'],
                        'company' => $post['company'],
                        'position' => $post['position'],
                        'employment_status' => $post['employment_status'],
                        'from_date' => $post['from_date'],
                        'to_date' => $post['to_date'],
                        'present' => $present
                    ];
                    $query = $this->UserModel->UpdatePCOWorkExperienceByUserID($data);
                    if ($query == true) {
                        $resonse = ['status' => 1, 'message' => 'Successfully save !'];
                    } else {
                        $resonse = ['status' => 0, 'message' => 'STATUS ERROR CODE: 409 Confict'];
                    }
                }
            } else {
                // Update the data text only...
                $post = $this->input->post();
                
                // Check if present is true or false.
                $present = null;
                if($post['present'] == 'true') {
                    $present = 1;
                } else {
                    $present = 0;
                }
                
                $data = [
                        'is_work_ex_data' => 'true', // Flag for work experience table...
                        'work_experience_id' => $post['work_experience_id'],
                        'attachment_id' => $post['attachment_id'],
                        'company' => $post['company'],
                        'position' => $post['position'],
                        'employment_status' => $post['employment_status'],
                        'from_date' => $post['from_date'],
                        'to_date' => $post['to_date'],
                        'present' => $present
                    ];
                    $query = $this->UserModel->UpdatePCOWorkExperienceByUserID($data);
                    if ($query == true) {
                        $resonse = ['status' => 1, 'message' => 'Successfully save !'];
                    } else {
                        $resonse = ['status' => 0, 'message' => 'STATUS ERROR CODE: 409 Confict'];
                    }
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
        echo json_encode($resonse);
    }
    
    /**
     * Fetch work experience data from the database
     */
    public function workExperienceDataTable(){
        try {
            $this->OuthModel->CSRFVerify();
            $requestData = $_REQUEST;
            $table = "work_experience";
            $fields = "*";
            $id = '';

            $accountFk = isset($this->session->userdata['account']['account_fk']) != TRUE? 
                    $this->session->userdata['account']['selected_account_fk']: $this->session->userdata['account']['account_fk'] ; 
            $where = " WHERE `account_fk` = ".$accountFk;
            $sql = "SELECT " . $fields;
            $sql .= " FROM " . $table . $where;
            $query = $this->db->query($sql);
            $totalRecords = $query->num_rows();
            $totalFiltered = $totalRecords;
            
            $where = " WHERE `account_fk` = ".$accountFk;
            $sql = "SELECT " . $fields;
            $sql .= " FROM " . $table . $where;
            
            if (!empty($requestData['search']['value'])) {
                $searchValue = $requestData['search']['value'];
                $sql .= " AND `company` LIKE '%" . $searchValue . "%' ";
                $sql .= " AND `position` LIKE '%" . $searchValue . "%' ";
                $sql .= " OR `company` LIKE '%" . $searchValue . "%' ";
                $sql .= " OR `position` LIKE '%" . $searchValue . "%' ";
            }
            $query = $this->db->query($sql);
            $totalFiltered = $query->num_rows();
            //ORDER BY id DESC	
            $sql .= " ORDER BY date_created  " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
            $query = $this->db->query($sql);
            $SearchResults = $query->result();

            $data = array();
            foreach ($SearchResults as $row) {
                $data = array(); 
                $id = $row->id;
                $data[] = $row->company;
                $data[] = $row->position;
                $data[] = $row->employment_status;
                $data[] = $row->from_date;
                $data[] = $row->to_date;
                //$data[] = $row->present;
                
                if($row->present) {
                    $data[] = '<span> <input type="checkbox" checked></span>'; // true
                } else {
                    $data[] = '<span> <input type="checkbox" unchecked></span>'; // false
                }
                
                $data[] = '<span id=' . $id . ' class="label label-danger pull-left" style="margin-right: 10px;"><a href='. 
                        base_url('uploads'). "/attachment/" . $this->ProfileModel->getAttachmentFileName($row->attachment_fk) .
                        ' target="_blank" style="color:#ffffff;"> <span class="fa fa-file-pdf-o" ></span> view</a> </span>'.
                        $this->ProfileModel->getAttachmentFileName($row->attachment_fk);
                $data[] = '<span id=' . $id . ' class="label label-info"><a onclick="editWorkExperienceData('.$id.','.$row->attachment_fk.')" href="javascript:void(0);" style="color:#ffffff;"> <span class="fa fa-edit" ></span> Edit</a> </span>';
                $dataList[] = $data;
            }
            $json_data = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => intval($totalRecords), // total number of records
                "recordsFiltered" => intval($totalFiltered), // total number of records after searching,  
                "data" => $dataList==null?[]:$dataList   // total data array
            );
        } catch(Exception $err) {
            show_error($err->getMessage());
        }
        echo json_encode($json_data);  // send data as json format	
    }
    
    /**
     * Add training and seminars
     */
    public function addTrainingAndSeminars() {
        try {
            $this->OuthModel->CSRFVerify();
            //$resonse = ['status' => 0, 'message' => $_FILES['work_experience_certificate']['name']];
            if (isset($_FILES['training_and_seminars_certificate']['name']) && !empty($_FILES['training_and_seminars_certificate']['name'])) {
                $config['upload_path'] = './uploads/attachment';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] =  2048;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('training_and_seminars_certificate')) {
                    echo json_encode(['status' => 0, 'message' => $this->upload->display_errors()]);
                    die;
                } else {
                    $file = $this->upload->data();
                    $post = $this->input->post();
                    $data = [
                        'account_fk' => $post['account_fk'],
                        'used_to' => TRAINING_AND_SEMINARS,
                        'file_name' => $file['file_name'],
                        'user_fk' => $this->session->userdata['user']['id'],
                        'title' => $post['title'],
                        'no_of_hours' => $post['no_of_hours']
                    ];
                    $query = $this->UserModel->updatePCOTrainingAndSeminarsByUserID($data);
                    if ($query == true) {
                        $resonse = ['status' => 1, 'message' => 'Successfully save !'];
                    } else {
                        $resonse = ['status' => 0, 'message' => 'STATUS ERROR CODE: 409 Confict'];
                    }
                }
            } 
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
        echo json_encode($resonse);
    }
    
    /**
     * Fetch training and seminars data from the database
     */
    public function trainingAndSeminarsDataTable(){
        try {
            $this->OuthModel->CSRFVerify();
            $requestData = $_REQUEST;
            $table = "training_and_seminars";
            $fields = "*";
            $id = '';

            $accountFk = isset($this->session->userdata['account']['account_fk']) != TRUE? 
                    $this->session->userdata['account']['selected_account_fk']: $this->session->userdata['account']['account_fk'] ; 
            $where = " WHERE `account_fk` = ".$accountFk;
            $sql = "SELECT " . $fields;
            $sql .= " FROM " . $table . $where;
            $query = $this->db->query($sql);
            $totalRecords = $query->num_rows();
            $totalFiltered = $totalRecords;
            
            $where = " WHERE `account_fk` = ".$accountFk;
            $sql = "SELECT " . $fields;
            $sql .= " FROM " . $table . $where;
            
            if (!empty($requestData['search']['value'])) {
                $searchValue = $requestData['search']['value'];
                $sql .= " AND `title` LIKE '%" . $searchValue . "%' ";
                $sql .= " AND `no_of_hours` LIKE '%" . $searchValue . "%' ";
                $sql .= " OR `title` LIKE '%" . $searchValue . "%' ";
                $sql .= " OR `no_of_hours` LIKE '%" . $searchValue . "%' ";
            }
            $query = $this->db->query($sql);
            $totalFiltered = $query->num_rows();
            //ORDER BY id DESC	
            $sql .= " ORDER BY date_created  " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
            $query = $this->db->query($sql);
            $SearchResults = $query->result();

            $data = array();
            foreach ($SearchResults as $row) {
                $data = array(); 
                $id = $row->id;
                $data[] = $row->title;
                $data[] = $row->no_of_hours;
                $data[] = '<span id=' . $id . ' class="label label-danger pull-left" style="margin-right: 10px;"><a href='. base_url('uploads'). "/attachment/" . $this->ProfileModel->getAttachmentFileName($row->attachment_fk) .' target="_blank" style="color:#ffffff;"> <span class="fa fa-file-pdf-o" ></span> view</a> </span>'. $this->ProfileModel->getAttachmentFileName($row->attachment_fk);
                $data[] = '<span id=' . $id . ' class="label label-info"><a onclick="editTrainingSeminarsData('.$id.','.$row->attachment_fk.')" href="javascript:void(0);" style="color:#ffffff;"> <span class="fa fa-edit" ></span> Edit</a> </span>';
                $dataList[] = $data;
            }
            $json_data = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => intval($totalRecords), // total number of records
                "recordsFiltered" => intval($totalFiltered), // total number of records after searching,  
                "data" => $dataList==null?[]:$dataList   // total data array
            );
        } catch(Exception $err) {
            show_error($err->getMessage());
        }
        echo json_encode($json_data);  // send data as json format	
    }

    /**
     * Edit training and seminars
     */
    public function editTrainingAndSeminars() {
        try {
            $this->OuthModel->CSRFVerify();
            //$resonse = ['status' => 0, 'message' => $_FILES['work_experience_certificate']['name']];
            if (isset($_FILES['edit_training_and_seminars_certificate']['name']) && !empty($_FILES['edit_training_and_seminars_certificate']['name'])) {
                $config['upload_path'] = './uploads/attachment';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] =  20480;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('edit_training_and_seminars_certificate')) {
                    echo json_encode(['status' => 0, 'message' => $this->upload->display_errors()]);
                    die;
                } else {
                    // Update the attachment file and the training and seminars table...
                    $file = $this->upload->data();
                    $post = $this->input->post();
                    $data = [
                        'training_and_seminars_id' => $post['training_and_seminars_id'],
                        'attachment_id' => $post['attachment_id'],
                        'used_to' => TRAINING_AND_SEMINARS,
                        'file_name' => $file['file_name'],
                        'user_fk' => $this->session->userdata['user']['id'],
                        'edit_title' => $post['edit_title'],
                        'edit_no_of_hours' => $post['edit_no_of_hours']

                    ];
                    $query = $this->UserModel->updatePCOTrainingAndSeminarsByUserID($data);
                    if ($query == true) {
                        $resonse = ['status' => 1, 'message' => 'Successfully save !'];
                    } else {
                        $resonse = ['status' => 0, 'message' => 'STATUS ERROR CODE: 409 Confict'];
                    }
                }
            } else {
                // Update the data text only...
                $post = $this->input->post();
                $data = [
                        'is_training_seminars_data' => 'true', // Flag for training and seminars table...
                        'training_and_seminars_id' => $post['training_and_seminars_id'],
                        'attachment_id' => $post['attachment_id'],
                        'edit_title' => $post['edit_title'],
                        'edit_no_of_hours' => $post['edit_no_of_hours']
                    ];
                    $query = $this->UserModel->updatePCOTrainingAndSeminarsByUserID($data);
                    if ($query == true) {
                        $resonse = ['status' => 1, 'message' => 'Successfully save !'];
                    } else {
                        $resonse = ['status' => 0, 'message' => 'STATUS ERROR CODE: 409 Confict'];
                    }
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
        echo json_encode($resonse);
    }
    
    public function user_update_profile_data() {
        $this->OuthModel->CSRFVerify();
        $request = $this->input->post();

        if (!empty($request['first_name'])) {
            $post['first_name'] = $request['first_name'];
        }
        if (!empty($request['last_name'])) {
            $post['last_name'] = $request['last_name'];
        }

        if (!empty($request['email'])) {
            $post['email'] = $request['email'];
        }
        if (!empty($request['mobile_no'])) {
            $post['mobile_no'] = $request['mobile_no'];
        }
        if (!empty($request['address'])) {
            $post['address'] = $request['address'];
        }
        if (!empty($request['about'])) {
            $post['about'] = $request['about'];
        }
        if (!empty($request['pincode'])) {
            $post['pincode'] = $request['pincode'];
        }

        $post['name'] = $request['first_name'] . ' ' . $request['last_name'];
        $post['ip_address'] = $this->input->ip_address();
        $post['modified'] = date('Y-m-d H:i:s');
        $query = $this->OveModel->UpdateData($this->OuthModel->xss_clean($post));
        if ($query == true) {
            $message = [
                'status' => 1,
                'message' => 'Profile updated !',
                'updateName' => $post['name']
            ];
        } else {
            $message = [
                'status' => 0,
                'message' => 'Faild to updated !'
            ];
        }
        echo json_encode($message);
    }

    public function forgot_password() {
        $this->parser->parse('login/forgot_password_template', []);
    }

    public function forgot_password_email() {
        $this->OuthModel->CSRFVerify();

        $email = $this->input->get('email');
        $ifexists = $this->UserModel->IfExistEmail($email);

        if ($ifexists != false) {

            $new_password = $this->OuthModel->RandomPassword();

            $user_id = $ifexists['id'];
            $update = $this->OveModel->UpdatePassword($user_id, $this->OuthModel->HashPassword($new_password));
            if ($update == true) {
                $message = ['status' => 1, 'message' => "Your new password has been sent to your email address. !"];
            } else {
                $message = ['status' => 0, 'message' => "Faild to password updated, Please try again !"];
            }
        } else {
            $message = [
                'status' => 0,
                'message' => 'Sorry Your Email Not exists in the database !'
            ];
        }

        echo json_encode($message);
    }

}
