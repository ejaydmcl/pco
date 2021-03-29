<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * Description of ClientProfileController
 *
 * @author User March 22, 2021
 */
class ClientProfileController extends BaseController {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        try {
            $userID = isset($this->session->userdata['user']['id']) ? $this->session->userdata['user']['id'] : 0;
            if ($this->authorizedUser($userID)) {
                $client_id = $this->input->get('id');
                $profile = $this->ClientModel->clientProfile($client_id);
                $data['user_id'] = $client_id;
                $data['photo'] = $profile['file_name']==null?'no-image.png':$profile['file_name'];
                $data['name'] = $profile['fullname'];
                $data['email'] = $profile['email'];
                $this->parse('system/client_profile_page', 'Client profile page', $data);
            } else {
                show_404();
            }
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
    }
    
    /**
     * Send a verification email to pco client
     * 
     */
    public function sendVerificationLink() {
        try {
            $this->OuthModel->CSRFVerify();
            $post = $this->input->post();
            // user information
            $user_info = $this->PCOModel->readUserInformation($post['user_id']);
            $pco = $this->PCOModel->PCOID($user_info['account_fk']);
            $this->email->clear(TRUE);
            $this->email->to($user_info['email']);
            $this->email->cc("emb.pco@gmail.com");
            $this->email->reply_to(false);
            $text = '&id=' . $this->OuthModel->Encryptor('encrypt', $user_info['id']) . '&email=' . $this->OuthModel->Encryptor('encrypt', $user_info['email']);
            $verify_link = base_url('verify-email?action=verify' . $text);
            $email_body = "<br>***THIS IS AUTOMATICALLY GENERATED EMAIL, PLEASE DO NOT REPLY***<br><br><br>";
            $email_body .= "Thank you for registering! <br><br>";
            $email_body .= "Account id: {$pco['pco_id']} <br>";
            $email_body .= "Username: {$user_info['email']} <br>";
            $email_body .= "Password: {$user_info['raw_password']} <br>";
            $email_body .= "Click <a href='" . $verify_link . "'> here </a> to activate your account. <br><br><br>";
            $email_body .= "Thank you. <br><br>";
            $email_body .= "DENR - ENVIRONMENTAL MANAGEMENT BUREAU, PCO. <br><br>";
            $this->email->from("emb.pco@gmail.com", "EMB, PCO");
            $this->email->subject("PCO Online Account verification");
            $this->email->message($email_body);
            $this->email->send();
            echo json_encode(['status' => 1, 'message' => "Verification link successfully sent!"]);
        } catch (Exception $err) {
            echo json_encode(['status' => 0, 'message' => "Faild, Please try again!"]);
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
    }
    
}
