<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application page model
 * 
 * @author Juanito C. Dela Cerna Jr. May 2019
 */
class ApplicationPageModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }
    
    /**
     * Get iso document code
     * 
     * SELECT 
        o.`reg_code`,
        i.`document_code` 
      FROM
        organization o 
        JOIN iso i 
          ON i.`organization_fk` = o.`id` 
      WHERE o.`reg_code` = 'R11'
     */
    public function documentCode($region) {
        $this->db->select('o.`reg_code`, i.`document_code`');
        $this->db->from('organization o');
        $this->db->join('iso i', 'i.`organization_fk` = o.`id`');
        $this->db->where('o.reg_code', $region);
        $result = $this->db->get();
        return $result->row_array();
    }


    /**
     * Certificate of accreditation data
     * 
     * @param {int} $id 
     */
    public function coaHeaderPerRegion($region) {
        try {
            $this->db->select('a.file_name, o.*');
            $this->db->from('organization o');
            $this->db->join('attachment a', 'a.id = o.attachment');
            $this->db->where('o.reg_code', $region);
            $result = $this->db->get();
        }  catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
        return $result->row_array();
    }
    
    /**
     * Check if pco has applied for COA application .
     * 
     * @return {int} id
     */
    public function checkIfPCOsubmittedApplication($id) {
        $this->db->select('a.id');
        $this->db->from('application a');
        $this->db->where('a.account_fk', $id);
        $result = $this->db->get();
        if ($result->num_rows() != 0) {
            return true;
        }
        return false;
    } 
    
    /**
     * Get pco employee
     * Get the list of employee where role id is 3  
     * 
     * SELECT u.id, ur.role_fk, u.employee_fk, u.designation_fk 
     * FROM users u
     * JOIN userrole ur ON  ur.user_fk = u.id
     * WHERE u.is_active = 1 AND u.employee_fk IS NOT NULL AND u.designation_fk IS NOT NULL AND ur.role_fk = 3
     * 
     * @return {string} List of employee
     */
    public function getListOfEmployee($region) {
        $this->db->select('u.id,u.employee_fk');
        $this->db->from('users u');
        $this->db->join('userrole ur', 'ur.user_fk = u.id');
        $this->db->join('employee e', 'e.id = u.employee_fk');
        $this->db->where('u.is_active',1);
        $this->db->where('u.employee_fk IS NOT ',NULL);
        $this->db->where('u.designation_fk IS NOT ',NULL);
        $this->db->where('e.region', $region);
        $this->db->where('ur.role_fk', EMPLOYEE);
        $result = $this->db->get();
        return $result->result_array();
    }

    /**
     * Get application status label
     * 
     * @return List of application status
     */
    public function getApplicationStatus() {
        $this->db->select('*');
        $this->db->from('application_status as');
        $this->db->where('as.is_active', 1);
        $result = $this->db->get();
        return $result->result_array();
    }
    
    /**
     * Get application status label
     * 
     * @param {int} $id
     */
    public function getApplicationStatusLabel($id) {
        $this->db->select('*');
        $this->db->from('application_status as');
        $this->db->where('as.id', $id);
        $result = $this->db->get();
        return $result->row_array();
    }

     /**
     * Get application type label
     * 
     * @param {int} $id
     */
    public function getApplicationTypeLabel($id) {
        $this->db->select('*');
        $this->db->from('application_type at');
        $this->db->where('at.id', $id);
        $result = $this->db->get();
        return $result->row_array();
    }
    
     /**
     * Certificate of accreditation data
     * 
     * @param {int} $id 
     */
    public function coaNo($id, $region) {
        try {
            $this->db->select('a.region, c.*');
            $this->db->from('cetificate_of_accreditation c');
            $this->db->join('application a','a.id=c.application_fk');
            $this->db->where('c.id',$id);
            $this->db->where('a.region',$region);
            $result = $this->db->get();
            return $result->row_array();
        }  catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
    }
    
    /**
     * Get account data.
     * 
     * @param type $id
     * @return type
     */
    public function getAccount($id) {
        try {
            $this->db->select('*');
            $this->db->from('account a');
            $this->db->where('a.id',$id);
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
    
     /**
      * Regional director's data
      * 
      * @param {int} $approved_by_user Description
      */
    public function regionalDirector($approved_by_user) {
        try {
            $this->db->select('u.id, e.id as employee_id, e.first_name,e.middle_name,e.last_name,e.name_extension');
            $this->db->from('users u');
            $this->db->join('employee e','e.id=u.employee_fk');
            //$this->db->where('u.designation_fk', 1);
            $this->db->where('u.id', $approved_by_user);
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
    
     /**
     * Get employee signature by id.
     * 
     * @param type $id
     */
    public function PCOProfilePic($id) {
        try {
            $this->db->select('a.id,a.file_name,a.user_fk');
            $this->db->from('attachment a');
            $this->db->join('users u','u.id=a.user_fk');
            $this->db->join('account acc','acc.id=u.account_fk');
            $this->db->where('a.used_to', PROFILE_PHOTO);
            $this->db->where('acc.id', $id);
            $result = $this->db->get();
            return $result->row_array();
        } catch (Excesption $err) {
            show_error($err->getMessage());
        }
        return false;
    }
    
     /**
     * Get employee signature by id.
     * 
     * @param type $id
     */
    public function employeeSignature($id) {
        try {
            $this->db->select('a.id,a.file_name,a.user_fk');
            $this->db->from('attachment a');
            $this->db->join('users u','u.id=a.user_fk');
            $this->db->join('employee e','e.id=u.employee_fk');
            $this->db->where('a.used_to', USER_SIGNATURE);
            $this->db->where('e.id', $id);
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
        return false;
    }
    
    /**
     * Get application data.
     * 
     * @param type $id
     * @return type
     */
    public function getApplication($id) {
        try {
            $this->db->select('*');
            $this->db->from('application a');
            $this->db->where('a.id',$id);
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
}
