<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

class EditUserCredentialsController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $userID = isset($this->session->userdata['user']['id'])?$this->session->userdata['user']['id']:0;
        
       // echo 'is autho: '. $this->authorizedUser($userID);
        
        if($this->authorizedUser($userID)) {
            // Selected user id.
            $selectedUser = $this->session->userdata['user_credentials']['id'];
            $selectedUserInfo = $this->UserModel->getUserInformation($selectedUser);
            // Selected user data
            $data['id'] = $selectedUser;
            $data['email'] = $selectedUserInfo['email'];
            $data['password'] = $selectedUserInfo['raw_password'];
            $data['is_active'] = $selectedUserInfo['is_active'];
            $data['verified'] = $selectedUserInfo['is_email_verify'];
            $data['notification'] = $selectedUserInfo['notification'];
            
            // Selected user role
            $userRole = $this->getUserRole($selectedUser);
            $data['role'] = $userRole;
            
            // User role lis
            $listOfUserRole = $this->getUserRoleList();
            $data['list_of_role'] = $listOfUserRole;
            
            // Selected user designation list
            $designationList = $this->getDesignationList($selectedUser);
            $data['list_of_designation'] = $designationList;
            
            // User designation 
            $userDesignation = $this->getDesignationByID($selectedUser);
            $data['designation'] = $userDesignation;
            
            $this->parse('user/edit_user_credentials', 'Edit user credentials', $data);
        } else {
            show_404();
        }
    }
    
    public function getUserRoleList() {
        return $this->UserModel->getUserRoleLabel();
    }


    public function getUserRole($id) {
        return $this->UserModel->getUserRoleLabelByID($id);
    }
    
    public function getDesignationList() {
        return $this->UserModel->getEmployeeDesignationLabel();
    }
    
    public function getDesignationByID($id) {
        return $this->UserModel->getUserDesignation($id);
    }
    
    public function editUserCredentials() {
        // Validate the input
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('is_active', 'Active', 'required');
        $this->form_validation->set_rules('is_email_verify', 'Verify', 'required');
        $this->form_validation->set_rules('notification', 'Notification', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $response = ['status' => 0, 'message' => '<span style="color:#900;">' . validation_errors() . '</span>'];
            echo json_encode($response);
            die;
        } else {
            $post = $this->input->post();
            // Compare the two password
            if($post['password'] != $post['retype_password']) {
                $response = ['status' => 0, 'message' => '<span style="color:#900;">Password not match...</span>'];
                echo json_encode($response);
                die;
            }
            
            // User data
            $data = [
                'id' => $post['id'],
                'email' => $post['email'],
                'username' => $post['email'],
                'raw_password' => $post['password'],
                'password' => $this->OuthModel->HashPassword($post['password']),
                'is_active' => $post['is_active'],
                'is_email_verify' => $post['is_email_verify'],
                'notification' => $post['notification'],
                'role_fk' => $post['role'],
                'designation_fk' => $post['designation'],
                'date_modified' => date('Y-m-d H:i:s')
                ];
            
            // Update user data.
            $res = $this->UserModel->editUserCredentials($data);
            if($res) {
                $resonse = ['status' => 1, 'message' => 'Successfully update !'];
            } else {
                $resonse = ['status' => 0, 'message' => 'Failed'];
            }
        }
        echo json_encode($resonse);
        
    }
    
}