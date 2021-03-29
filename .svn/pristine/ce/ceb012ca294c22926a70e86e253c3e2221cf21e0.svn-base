<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application model
 * 
 * Application data
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class ApplicationModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }
	
	
 /**
     * Get the renewal application by account id.
     * 
     * @param {int} $id PCO Account id.
     */
    public function checkifPCOhasfileRenewalApplication($id) {
        $this->db->select('a.id,,a.type_fk,a.status_fk, a.employee_fk');
        $this->db->from('application a');
        $this->db->where('a.employee_fk', $id);
        $this->db->where('a.coa_fk', null);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            $data = $query->row_array();
            //echo 'status: '. $data['status_fk'] . ' employee: ' .$data['employee_fk'];
            if($data['type_fk'] == '2' && $data['employee_fk'] == $id ) {
                return true; // return true to unlock the pco profile.
            }
            return false; // return false to lock the pco profile.
        } else {
            return false; // return false to lock the pco profile.
        }
    }
    
    /**
     * Get the application by account id.
     * 
     * @param {int} $id PCO Account id.
     */
    public function getApplication($id) {
        $this->db->select('a.id, a.status_fk');
        $this->db->from('application a');
        $this->db->where('a.employee_fk', $id);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
			$data = $query->row_array();
			if($data['status_fk'] == '5'){
				return false;
			}
            return true;
        } else {
            return false;
        }
    }
	
	/**
     * Check account by account id.
     * 
     * @param {int} $id PCO Account id.
     */
    public function checkAccount($id) {
        $this->db->select('a.id');
        $this->db->from('application a');
        $this->db->where('a.account_fk', $id);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the user id of the selected application.
     * 
     * 
     * @param {int} $id 
     * @return 
     */
    public function getUserID($id) {
        try {
            // PCO
            $ret1 = $this->getUserIdByAccountId($id);
            if($ret1['id'] != 0 && $ret1['designation_fk'] == null) {
                return $ret1['id'];
            } 
            
            // Employee
            $ret2 = $this->getUserIdByEmployeeId($id);
            if($ret2['id'] != 0) {
                return $ret2['id'];
            }
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
        }
    }
    
    public function getUserIdByAccountId($id) {
        $this->db->select('u.id,u.account_fk,u.designation_fk');
        $this->db->from('users u');
        $this->db->where('u.account_fk', $id);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            $result = $query->row_array();
            return $result;
        } else {
            return 0;
        }
    }
    
    public function getUserIdByEmployeeId($id) {
        $this->db->select('u.id,u.employee_fk,u.designation_fk');
        $this->db->from('users u');
        $this->db->where('u.employee_fk', $id);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            $result = $query->row_array();
            return $result;
        } else {
            return 0;
        }
    }
    
    public function getTheEvaluatorId($id) {
        $this->db->select('a.evaluator_fk,a.account_fk');
        $this->db->from('application a');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->row_array();
        } else {
            return 0;
        }
    }
    
}