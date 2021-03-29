<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TopBarModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }

    /**
     * Get all the new application
     */
    public function getAllNewApplicationNotification() {
        $this->db->select('n.id,n.employee_fk,app.account_fk,n.application_fk,n.flag_1 ,n.date_created');
        $this->db->from('notification n');
        $this->db->join('application app','n.application_fk = app.id');
        $this->db->join('users u','n.employee_fk = u.employee_fk');
        $this->db->where('n.employee_fk', $this->session->userdata['user']['employee_fk']);
        $this->db->where('n.flag_2', 0);
        $this->db->group_by('n.application_fk');
        $this->db->order_by('n.date_created','desc');
        $result = $this->db->get();
        return $result->result_array();
    }
    
    public function employeeNotification() {
        $userId = $this->session->userdata['user']['employee_fk'];
        // Filter the current logged user
        $type = $this->UserModel->getUserDesignation($userId); 
        
        $this->db->select('n.user_fk as user_id, n.id,n.employee_fk,n.application_fk,'
                . 'n.comments_fk,n.flag_2,app.account_fk,n.date_created');
        $this->db->from('notification n ');
        $this->db->join('application app', 'n.application_fk = app.id');
        $this->db->where('n.receiver_id', $userId);
        // Flag
        if($type['user_id'] == 2) {
            $this->db->where('n.flag_2', 0);
        }
        // Flag
        if($type['user_id'] == 3) {
            $this->db->where('n.flag_3', 0);
        }
        // Flag
        if($type['user_id'] == 4) {
            $this->db->where('n.flag_4', 0);
        }
        // Flag
        if($type['user_id'] == 5) {
            $this->db->where('n.flag_5', 0);
        }
        $this->db->order_by('n.date_created','desc');
        $result = $this->db->get();
        return $result->result_array();
    }
    
    public function pcoNotification() {
        $this->db->select('n.user_fk as user_id, n.id,n.employee_fk,n.application_fk,'
                . 'n.comments_fk,n.flag_2,app.account_fk,n.date_created');
        $this->db->from('notification n ');
        $this->db->join('application app', 'n.application_fk = app.id');
        $this->db->where('n.receiver_id', $this->session->userdata['user']['account_fk']);
        $this->db->where('n.flag_1', 0);
        
        $this->db->order_by('n.date_created','desc');
        $result = $this->db->get();
        return $result->result_array();
    }


    /**
     * Get all the new comment notification application
     */
    public function getAllNewApplicationCommentsNotification() {
        $this->db->select('n.user_fk as user_id, n.id,n.employee_fk,n.application_fk,n.comments_fk,n.flag_2,app.account_fk,n.date_created');
        $this->db->from('notification n ');
        $this->db->join('application app', 'n.application_fk = app.id');
        $this->db->join('users u', 'n.employee_fk = u.employee_fk');
        
        $employeeFk = $this->session->userdata['user']['employee_fk'];
        if(isset($employeeFk)) {
            $this->db->where('n.employee_fk', $employeeFk);
            log_message('debug', 'Employee');
        } else { 
            $this->db->where('n.account_fk', $this->session->userdata['user']['account_fk']);
            log_message('debug', 'PCO');
        }
        $this->db->where('n.user_fk <>',$this->session->userdata['user']['id'] );
        $this->db->where('n.flag_2', 0);
        $this->db->order_by('n.date_created','desc');
        $result = $this->db->get();
        return $result->result_array();
    }
    
    /*
     * Update the notification flag_2.
     * 
     * Update comment notification
     */
    public function updateCNotification($data){
         $res = $this->db->update('notification', ['flag_2' => 1], 
                ['employee_fk' => $data['employee_fk'],'account_fk' => $data['account_fk'],'application_fk' => $data['application_fk']]);
        if ($res == 1) {
            return true;
        }else{
            return false;
        }
    }
    
     /**
     * Get user data
     */
    public function getUserInformation() {
        $this->db->select('*');
        $this->db->from('users u');
        $this->db->where("u.id", $this->session->userdata['user']['id']);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    
     /**
     * Get account data
     */
    public function getAccountInformation($id) {
        $this->db->select('*');
        $this->db->from('account a');
        $this->db->where("a.id", $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    /**
     * Get employee data
     */
    public function getEmployeeInformation($id) {
        $this->db->select('*');
        $this->db->from('employee e');
        $this->db->where("e.id", $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
}