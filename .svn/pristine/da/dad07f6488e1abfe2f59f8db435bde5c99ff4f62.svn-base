<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Email verify controller
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class ForgotPasswordController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['page_title'] = 'Forgot password page';
        $this->parser->parse('login/forgot_password', $data);
    }
    
    public function forgotPassword() {
        $post = $this->input->post();
        $data['email'] = $post['email'];
        $data['pco_id'] = $post['pco_id'];
        $isExist = $this->PCOModel->ifEmailPCOIDExist($data);
        
        if(isset($isExist)) {
            try {
                $this->email->clear(TRUE);
                $this->email->to($isExist['email']);
                //$this->email->cc("no-reply@embr11.com"); 
                $this->email->cc("emb.pco@gmail.com"); 
                $this->email->reply_to(false);

                $email_body = "<br>***THIS IS AUTOMATICALLY GENERATED EMAIL, PLEASE DO NOT REPLY***<br><br><br><br>";
		$email_body .= "Below are your current account details:<br><br>";
		$email_body .= "USERNAME: {$isExist['username']}<br>";
		$email_body .= "PASSWORD: {$isExist['raw_password']}<br><br><br>";
                $email_body .= "Thank you <br><br>";
                $email_body .= "DENR - ENVIRONMENTAL MANAGEMENT BUREAU, PCO. <br><br>";
                
                //$this->email->from("no-reply@embr11.com", "PCO Online Forgot password"); 
                $this->email->from("emb.pco@gmail.com", "EMB, PCO"); 
                $this->email->subject("PCO Online Forgot password");
                $this->email->message($email_body);
                $this->email->send();
                
                $response = ['status' => 1, 'message' => 'Your account details on EMB, PCO Online System has been sent to your email, kindly check your email.'];
            } catch (Exception $er) {
                show_error($er->getMessage());
                $response = ['status' => 0, 'message' => 'Failed.'];
            }
        } else {
            $response = ['status' => 0, 'message' => 'Email not found. Please try again.'];
        }
        echo json_encode($response);
    }

}
