<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * 
 * Add user controller
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class AddUserController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        try {
            $userID = isset($this->session->userdata['user']['id']) ? $this->session->userdata['user']['id'] : 0;
            if ($this->authorizedUser($userID)) {
                $data['user_role'] = $this->UserModel->getUserRoleLabel();
                $data['designation'] = $this->UserModel->getEmployeeDesignationLabel();
                $this->parse('user/add_user', 'Add user page', $data);
            } else {
                show_404();
            }
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
    }

    /**
     * Upload user photo.
     * @param type $name Description
     */
    public function uploadUserPhoto() {
        $this->OuthModel->CSRFVerify();
        // TODO
        echo json_encode($resonse);
    }

    /**
     * Add new personnel
     * 
     */
    public function addNewPersonnel() {
        try {
            $this->OuthModel->CSRFVerify();
            $post = $this->input->post();
            $user = $this->UserModel->embPersonnel($post['personnel']);
            
            // Check the user was already added.
            $isExist = $this->UserModel->isUserAlreadyAdded($user->userid);
            if($isExist) {
                $response = ['status' => 0, 'message' => 'User was already added!'];
                echo json_encode($response);
                die;
            }
            
            $data = [
                'role' => $post['role'],
                'designation' => $post['designation'],
                'userid'=> $user->userid, // iisuserid
                'region'=> $user->region,
                'prefix'=> $user->prefix,
                'first_name'=> $user->fname,
                'last_name'=> $user->sname,
                'middle_name'=> $user->mname,
                'name_extension'=> $user->suffix,
                'email'=> $user->email,
                'is_active'=> 1   
            ];
            
            // Add data.
            $response = $this->UserModel->grantIISUser($data);
            if($response['is_success']) {
                 $response = ['status' => 1];
            } else {
                 $response = ['status' => 0, 'message' => 'Internal Error!'];
            }
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
        echo json_encode($response);
    }

    /**
     * Create a new user credential.
     * 
     */
    public function createUser() {
        // Validate the input
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('is_active', 'Active', 'required');
        $this->form_validation->set_rules('is_email_verify', 'Verify', 'required');
        $this->form_validation->set_rules('notification', 'Notification', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $response = ['status' => 0, 'message' => '<span style="color:#ffffff;">' . validation_errors() . '</span>'];
            echo json_encode($response);
            die;
        } else {
            $post = $this->input->post();
            // Compare the two password
            if ($post['password'] != $post['retype_password']) {
                $response = ['status' => 0, 'message' => '<span style="color:#900;">Password not match...</span>'];
                echo json_encode($response);
                die;
            }

            // User data
            $data = [
                'email' => $post['email'],
                'username' => $post['email'],
                'raw_password' => $post['password'],
                'password' => $this->OuthModel->HashPassword($post['password']),
                'is_active' => $post['is_active'],
                'is_email_verify' => $post['is_email_verify'],
                'notification' => $post['notification'],
                'role_fk' => $post['role'],
                'designation_fk' => $post['designation'],
                'date_created' => date('Y-m-d H:i:s')
            ];

            // Add data.
            $res = $this->UserModel->createUserCredentials($data);
            if ($res) {
                $resonse = ['status' => 1, 'message' => 'Successfully save !'];
            } else {
                $resonse = ['status' => 0, 'message' => 'False'];
            }
        }
        echo json_encode($resonse);
    }

}
