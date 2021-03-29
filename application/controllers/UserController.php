<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

class UserController extends BaseController {

    public function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
    }

    public function index() {
        try {
            $userID = isset($this->session->userdata['user']['id']) ? $this->session->userdata['user']['id'] : 0;
            if ($this->authorizedUser($userID)) {
                $data['user_role'] = $this->UserModel->getUserRole();
                $data['designation'] = $this->UserModel->getEmployeeDesignationLabel();
                $data['iisuserlist'] = $this->UserModel->iisUserList($this->session->userdata['user']['region']);
                $this->parse('user/user_page', 'User page', $data);
            } else {
                show_404();
            }
        }catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
    }

    public function gotoAddUserPage() {
        $message = ['status' => 1,
            'message' => 'You are now redirected to add user page.',
            'redirectUrl' => base_url('application-details-page')
        ];
        echo json_encode($message);
    }

    public function userListDataGrid() {
        try {
            $this->OuthModel->CSRFVerify();
            $param['limit'] = $_REQUEST['length'];
            $param['offset'] = $_REQUEST['start'];
            $param['search'] = $_REQUEST['search']['value'];
            $draw = $_REQUEST['draw'];
            $param['sort'] = $_REQUEST['order'][0]['dir'];
            $param['region'] = $this->session->userdata['user']['region'];
            $result = $this->UserModel->UserTable($param);
            $data = array();
            foreach ($result as $row) {
                $data = array();
                $id = $row->id;
                $data[] = '<span id=' . $id . '">' . $row->id . '</span>';
                $name = $this->UserModel->getUserFullName($row->id);
                $data[] = '<span id=' . $id . '">' . $name . '</span>';
                $data[] = '<span id=' . $id . '">' . $this->getUserDesignation($row->designation_fk) . '</span>';
                $data[] = '<span id=' . $id . '">' . $this->utils->format_date($row->date_created) . '</span>';
                $action = '<a onclick="editUser(' . $id . ',' . $this->isPCO($id) . ')" href="javascript:void(0);"<i class="fa fa-pencil"></i></a> ';
                $data[] = '<span id=' . $id . '">' . $action . '</span>';
                $dataList[] = $data;
            }
            $recordCount = $this->UserModel->count_all($param);
            $json_data = array(
                "draw" => intval($draw['draw']),
                "recordsTotal" => intval($recordCount), // total number of records
                "recordsFiltered" => intval($recordCount), // total number of records after searching,  
                "data" => $dataList == null ? [] : $dataList   // total data array
            );
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
        echo json_encode($json_data);  // send data as json format	
    }

    /**
     * Get user designation label.
     * @param type $id
     */
    public function getUserDesignation($id) {
        $ret = $this->UserModel->getEmployeeDesignationLabelByID($id);
        if ($ret != null) {
            return $ret['label'];
        } else {
            return 'PCO';
        }
    }

    /**
     * Review March 2, 2021 
     * 
     */
    public function userlogin() {
        try {
            $this->OuthModel->CSRFVerify();
            $post = $this->input->post();
            $data = [
                'usertype' => $post['user_type'],
                'password' => $post['password'],
                'username' => $post['email'],
            ];
            // For Pollution Control Officer
            if ($data['usertype'] == "1") {
                $result = $this->PCOModel->Authentication_Check($data);
                if ($result != false) {
                    $login_user_id = $result['id'];
                    $user = $this->PCOModel->readUserInformation($login_user_id);

                    $hashed = $user['password'];
                    if ($this->OuthModel->VerifyPassword($post['password'], $hashed) == 1) {
                        // Check for user roles. 
                        // And get the user role of the current logged user.
                        $role = $this->PCOModel->check_user_roles($user['id']);
                        // Check if the email is verified.
                        if ($user['is_email_verify'] == 1) {
                            $userdata = [
                                'id' => $user['id'],
                                'account_fk' => $user['account_fk'],
                                'employee_fk' => $user['employee_fk'],
                                'designation_fk' => $user['designation_fk'],
                                'username' => $user['username'],
                                'email' => $user['email'],
                                'role_fk' => $role['role_fk'],
                                'is_active' => 'TRUE',
                                'date_created' => $user['date_created']
                            ];
                            $this->session->set_userdata('user', $userdata);
                            $this->session->set_userdata('account', ['account_fk' => (isset($user['account_fk']) == TRUE ? $user['account_fk'] : NULL)]);
                            $redirectUrl = null;
                            if (isset($userdata['account_fk'])) {
                                $redirectUrl = base_url('home'); // For pco user
                            }
                            $message = ['status' => 1,
                                'message' => 'You are now successfully Login !',
                                'userDataDB' => $userdata,
                                'redirectUrl' => $redirectUrl
                            ];
                        } else {
                            $message = ['status' => 0, 'message' => 'Unauthorized access !'];
                        }
                    } else {
                        $message = ['status' => 0, 'message' => 'Your password is Incorrect !'];
                    }
                } else {
                    $message = ['status' => 0, 'message' => 'Your username is Incorrect !'];
                }
            }
            // For EMB Personnel
            if ($data['usertype'] == "2") {
                $iisuser = $this->UserModel->AuthenticationCheck($data);
                if (count($iisuser) != 0) {
                    $loginuserid = $iisuser->userid; // iis user id
                    $user = $this->UserModel->userInformation($loginuserid);
                    // echo 'usr: '. var_dump($user); 
                    // Check for user roles. 
                    // And get the user role of the current logged user.
                    $role = $this->PCOModel->check_user_roles($user['id']);
                    // Check if the personnel is active.
                    if ($user['is_active'] == "1") {
                        $userdata = [
                            'id' => $user['id'],
                            'region' => $iisuser->region,
                            'account_fk' => $user['account_fk'],
                            'employee_fk' => $user['employee_fk'],
                            'designation_fk' => $user['designation_fk'],
                            'username' => $user['username'],
                            'email' => $user['email'],
                            'role_fk' => $role['role_fk'],
                            'is_active' => 'TRUE',
                            'date_created' => $user['date_created']
                        ];
                        $this->session->set_userdata('user', $userdata);
                        $this->session->set_userdata('account', ['account_fk' => (isset($user['account_fk']) == TRUE ? $user['account_fk'] : NULL)]);
                        $redirectUrl = null;
                        if (isset($userdata['employee_fk'])) {
                            $redirectUrl = base_url('home'); // For EMB personnel user
                        }
                        $message = ['status' => 1,
                            'message' => 'You are now successfully Login !',
                            'userDataDB' => $userdata,
                            'redirectUrl' => $redirectUrl
                        ];
                    } else {
                        $message = ['status' => 0, 'message' => 'Unauthorized access !'];
                    }
                } else {
                    $message = ['status' => 0, 'message' => 'Your username is Incorrect !'];
                }
            }
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
        echo json_encode($message);
    }

    /**
     * Register user.
     * 
     * @author JC Dela Cerna Jr. May 2019
     */
    public function registerUser() {
        $this->form_validation->set_rules('Email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('Password', 'password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $response = ['status' => 0, 'message' => '<span style="color:#900;">' . validation_errors() . '</span>'];
            echo json_encode($response);
            die;
        } else {
            $post = $this->input->post();
            // Check if the email is already registered.
            if ($this->UserModel->isEmailExist($post['Email'])) {
                $response = ['status' => 0, 'message' => '<span style="color:#900;">' . " Email has already been taken. " . '</span>'];
                echo json_encode($response);
                die;
            }
            // Check the password
            $Password = $post['Password'];
            $RetypePassword = $post['RetypePassword'];
            if ($Password != $RetypePassword) {
                $response = ['status' => 0, 'message' => '<span style="color:#900;">' . " Password not match. " . '</span>'];
                echo json_encode($response);
                die;
            } else {
                $user_data = [
                    'username' => $post['Email'],
                    'raw_password' => $post['Password'],
                    'password' => $this->OuthModel->HashPassword($post['Password']),
                    'email' => $post['Email'],
                    'date_created' => date('Y-m-d H:i:s'),
                ];
            }
            // Add the new user credentials.
            $userID = $this->UserModel->addPCOUser($this->OuthModel->xss_clean($user_data));
            if ($userID == true) {
                try {
                    // Read the user information.
                    $userInfo = $this->PCOModel->readUserInformation($userID);
                    $pcoID = $this->PCOModel->PCOID($userInfo['account_fk']);
                    $this->email->clear(TRUE);
                    $this->email->to($userInfo['email']);
                    $this->email->cc("emb.pco@gmail.com");
                    $this->email->reply_to(false);

                    $text = '&id=' . $this->OuthModel->Encryptor('encrypt', $userInfo['id']) . '&email=' . $this->OuthModel->Encryptor('encrypt', $userInfo['email']);
                    $verifyLink = base_url('verify-email?action=verify' . $text);

                    $email_body = "<br>***THIS IS AUTOMATICALLY GENERATED EMAIL, PLEASE DO NOT REPLY***<br><br><br><br>";
                    $email_body .= "Thank you for registering! <br><br>";
                    $email_body .= "ACCOUNT ID: {$pcoID['pco_id']} <br>";
                    $email_body .= "USERNAME: {$userInfo['email']} <br>";
                    $email_body .= "PASSWORD: {$userInfo['raw_password']} <br>";
                    $email_body .= "Click <a href='" . $verifyLink . "'> here </a> to activate your account. <br><br><br>";
                    $email_body .= "Thank you. <br><br>";
                    $email_body .= "DENR - ENVIRONMENTAL MANAGEMENT BUREAU, PCO. <br><br>";

                    $this->email->from("emb.pco@gmail.com", "EMB, PCO");
                    $this->email->subject("PCO Online Account verification");
                    $this->email->message($email_body);
                    $this->email->send();

                    $string = "<a href=" . base_url('login') . " class='text-center'>Click here to login</a>";
                    echo json_encode(['status' => 1, 'message' => "You are registered successfully! <br> We sent an email to activate your account <b>" . $post['Email'] . "." . ""
                        . "</b> <br> If you have not received the verification email, please check your Spam folder. <br><br>" . $string]);
                } catch (Exception $err) {
                    $this->load->library('custom_exception');
                    $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
                }
            } else {
                echo json_encode(['status' => 0, 'message' => "Faild to registerd, Please try again!"]);
            }
        }
    }

    public function isPCO($id) {
        $type = $this->UserModel->getUserType($id);
        $ret = null;
        switch ($type['role_fk']) {
            case SUPER_USER:
                $ret = 0;
                break;
            case SYSTEM_ADMINISTRATOR:
                $ret = 0;
                break;
            case EMPLOYEE:
                $ret = 0;
                break;
            case PCO:
                $ret = 1;
                break;
            default:
                $ret = 0;
                break;
        }
        return $ret;
    }

    public function verifyEmail() {
        $get = $this->input->get();
        $userID = $this->OuthModel->Encryptor('decrypt', $get['id']);
        $result = $this->UserModel->updateEmailVerificationStatus($userID);
        if ($result) {
            redirect(base_url('email-verify-successfully'));
        } else {
            redirect(base_url());
        }
    }

    public function editUserPage() {
        $post = $this->input->post();
        // Set user id.
        $this->session->set_userdata('user_credentials', ['id' => $post['user_id']]);
        // Response.
        $resonse = ['status' => 1, 'message' => '', 'redirectUrl' => base_url('redirect-to-edit-user-credentials')];
        // Return
        echo json_encode($resonse);
    }

    public function logout() {
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('account');
        //$this->session->unset_userdata('application_id');
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function userslist() {
        $this->parser->parse('admin/users/users_list_template', []);
    }

}
