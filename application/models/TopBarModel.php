<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TopBarModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }

    /**
     * Get the name of application
     * **/
    public function application($id) {
        $this->db->select('*');
        $this->db->from('application a');
        $this->db->where("a.id", $id);
        $query = $this->db->get();
        return $query->row_array();
   }

   /**
     * Get the comments of application.
     * **/
    public function comment($id) {
        $this->db->select('*');
        $this->db->from('comments a');
        $this->db->where("a.id", $id);
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->row_array();
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
        $employeeId = $this->session->userdata['user']['employee_fk'];
        $userId = $this->session->userdata['user']['id'];
        // Filter the current logged user
        $type = $this->UserModel->getUserDesignation($userId); 
        
        $this->db->select('n.user_fk as user_id, n.id,n.employee_fk,n.application_fk,'
                . 'n.comments_fk,n.flag_2, n.receiver_id, app.account_fk,n.date_created');
        $this->db->from('notification n ');
        $this->db->join('application app', 'n.application_fk = app.id');
        $this->db->where('n.receiver_id', $employeeId);
        $this->db->limit(10);
        
        // Flag
        if($type['designation_id'] == EVALUATOR) {
            $this->db->where('n.flag_2', 0);
        }
        // Flag
        if($type['designation_id'] == SECTION_CHIEF) {
            $this->db->where('n.flag_3', 0);
        }
        // Flag
        if($type['designation_id'] == DIVISON_CHIEF) {
            $this->db->where('n.flag_4', 0);
        }
        // Flag
        if($type['designation_id'] == REGIONAL_DIRECTOR) {
            $this->db->where('n.flag_5', 0);
        }
        
        $this->db->order_by('n.date_created','desc');
        $result = $this->db->get();
        return $result->result_array();
    }
    
    public function pcoNotification() {
        $this->db->select('n.user_fk as user_id, n.id, n.application_fk,'
                . 'n.receiver_id, n.comments_fk, n.flag_2, n.date_created');
        $this->db->from('notification n ');
        $this->db->join('application app', 'n.application_fk = app.id');
        $this->db->where('n.receiver_id', $this->session->userdata['user']['account_fk']);
        $this->db->where('n.flag_1', 0);
        $this->db->limit(10);
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
        $res = false;
        $employeeId = $this->session->userdata['user']['account_fk'] == NULL ? $this->session->userdata['user']['employee_fk'] : $this->session->userdata['user']['account_fk'];
        $type = $this->UserModel->isPCO($employeeId);
        log_message('debug', 'data::: '. $type);
        if($type) {
            // PCO
            $res = $this->db->update('notification', ['flag_1' => 1], ['id' => $data['notification_id']]);
        } else {
            // Employee.
            $userId = $this->session->userdata['user']['id'];
            $type = $this->UserModel->getUserDesignation($userId); 
            if($type['designation_id'] == EVALUATOR) {
                $res = $this->db->update('notification', ['flag_2' => 1], ['id' => $data['notification_id']]);
            }
            if($type['designation_id'] == SECTION_CHIEF) {
                $res = $this->db->update('notification', ['flag_3' => 1], ['id' => $data['notification_id']]);
            }
            if($type['designation_id'] == DIVISON_CHIEF) {
                $res = $this->db->update('notification', ['flag_4' => 1], ['id' => $data['notification_id']]);
            }
            if($type['designation_id'] == REGIONAL_DIRECTOR) {
                $res = $this->db->update('notification', ['flag_5' => 1], ['id' => $data['notification_id']]);
            }
        }
        
        if ($res) {
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