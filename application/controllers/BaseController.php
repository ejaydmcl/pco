<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base controller
 * 
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class BaseController extends CI_Controller {

    function __construct() {
        parent::__construct();
        // embis database
        $CI = &get_instance();
        $this->embisdb = $CI->load->database('embisdb', TRUE);
        // Check all the coa for expired
        // This function will trigger only if the user 
        // is emb personel.
        if(isset($this->session->userdata['user']['region'])) {
            $region = $this->session->userdata['user']['region'];
            $this->checkCoaExpired($region);
        }
    }
    
    /**
     * This will check all the coa base on the region
     * This will update all the coa to expire if the coa 
     * expiration expire
     * 
     * @param {int} $region Organization region
     */
    public function checkCoaExpired($region) {
        try {
            $coa = $this->COAModel->coaApprovedPerRegion($region);
            if(sizeof($coa) != 0) {
                foreach ($coa as $value) {
                    $currentDate = new DateTime();
                    $now = $currentDate->format('Y-m-d H:i:s');
                    $expiryDate = date('Y-m-d H:i:s', strtotime($value->valid_until));
                    if($now >= $expiryDate) {
                        if($value->status_fk != 8){
                            // For debug
                            // echo 'date: '. $expiryDate. ' id: '. $value->id. '<br>';
                            // Set the coa to expire
                            $this->COAModel->setTheCoaToExpired($value->id);
                        }
                    }
                }
            }
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
    }



    /**
     * Check if the user already logged.
     * 
     * @return {Boolean}
     */
    public function isUserLogged() {
        if (isset($this->session->userdata['user']['is_active'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Parse the view.
     * 
     * @param {String} $url URL
     * @param {String} $pageTitle Page title
     * @param {array} $data Data array.
     * @return void
     */
    public function parse($url, $pageTitle = null, $data = null) {
        if ($this->isUserLogged()) {
            if (strtolower($url) == 'login/login') {
                if ($this->session->userdata['user']['role_fk'] == EMPLOYEE) {
                    $url = 'home/home';
                } else {
                    $url = 'application/application_page_table';
                }
            }
            $data['page_title'] = $pageTitle;
            $this->parser->parse($url, $data);
        } else {
           $this->parser->parse('login/login', []);
        }
    }
    
    /**
     * Check if the logged user is authorized.
     * 
     * @param type $id
     */
    public function authorizedUser($id) {
        try {
            $user = $this->UserModel->getUserType($id);
            $data = array($user['role_fk']);
            if(count(array_intersect($data, array(SUPER_USER))) ) {
                return true;
            }
        } catch (Exception $err) {
            show_error($err);
        }
        return false;
    }

}
