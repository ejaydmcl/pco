<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once('BaseController.php');
/**
 * Application page model
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class TopBarController extends BaseController {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }

    /*
     * Set the notification to already seen
     */
    public function iSeeTheNoti() {
        $post = $this->input->post();
        $message = ['status' => 0,
                'message' => 'Error. Please try again...',
                'redirectUrl' => base_url('#')
            ];
        $data = [
            'notification_id' => $post['notification'],
            'receiver_id' => $post['receiver'],
            'application_fk' => $post['application_fk']
            ];
        $result = $this->TopBarModel->updateCNotification($data);
        if($result) {
            $this->session->set_userdata('application_id', $post['application_fk']);
           // $this->session->set_userdata('account_fk', $post['account_fk']);
            $message = ['status' => 1,
                'message' => 'You are now redirected to application details.',
                'redirectUrl' => base_url('application-details-page')
            ];
        }
        echo json_encode($message);
    }
}
