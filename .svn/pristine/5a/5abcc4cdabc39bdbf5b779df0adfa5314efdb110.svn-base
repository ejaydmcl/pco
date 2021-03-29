<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application renewal page model
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class OrderOfPaymentPageModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }
    
    /**
     * Organization data
     */
    public function organization($region) {
        try {
            $this->db->select('*');
            $this->db->from('organization o');
            $this->db->where('o.reg_code', $region);
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
    }
    
     /**
      * Regional director's data
      * 
      * @param {int} $id Description
      */
    public function regionalDirector() {
        try {
            $this->db->select('u.id,e.id as employee_id,e.first_name,e.middle_name,e.last_name,e.name_extension');
            $this->db->from('users u');
            $this->db->join('employee e','e.id=u.employee_fk');
            $this->db->where('u.designation_fk', 1);
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
    
     /**
      * Organization data
      * 
      * @param {int} $id Description
      */
    public function loggedUser($id) {
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
     * Invoice data
     * 
     * @param {int} $id Description
     */
    public function invoice($id) {
        try {
            $this->db->select('*');
            $this->db->from('invoice i');
            $this->db->where('i.application_fk',$id);
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
    
    /**
     * Invoice by id data
     * 
     * @param {int} $id Description
     */
    public function invoiceByID($id) {
        try {
            $this->db->select('*');
            $this->db->from('invoice i');
            $this->db->where('i.id',$id);
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
    
    public function getSerialNo() {
        try {
            $this->db->select('i.serial_no');
            $this->db->from('invoice i');
            $this->db->where('i.serial_no IS NOT NULL');
            $this->db->order_by('i.id','DESC');
            $query = $this->db->get();
            $res = $query->row_array();
            // Date time.
            $dateTime = new DateTime();
            // Year and month.
            $yearM = $dateTime->format('Y-m');
            if(isset($res['serial_no'])) {
                $id = substr($res['serial_no'], 11); // Omit the string.
                $generatedID = $id + 1; // Increment the serial number.
                return $yearM . '-SN-'. $generatedID; // return the string.
            } else {
                return $yearM . '-SN-'. 0; // return the string.
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
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
    
    /**
     * Get account data.
     * 
     * @param type $id
     * @return type
     */
    public function getEmployee($id) {
        try {
            $this->db->select('*');
            $this->db->from('employee e');
            $this->db->where('e.id',$id);
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            show_error($err->getMessage());
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
     * Get application type label
     * 
     * @param {int} $id
     */
    public function getApplicationTypeLabel($id) {
        try {
            $this->db->select('*');
            $this->db->from('application_type at');
            $this->db->where('at.id', $id);
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
    
     /**
     * Get application price
     * 
     * @param {int} $id
     */
    public function getCertifacationPayment($id) {
        try {
            $this->db->select('*');
            $this->db->from('payment p');
            $this->db->where('p.id', $id);
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
    
    /**
     * Create invoice for the application.
     * 
     * @param type $data
     * @return boolean or invoice id.
     */
    public function createInvoice($data) {
        try {
            $invoiceID = $this->invoice($data['application_fk'])['id'];
            if($invoiceID != null) {
                return $invoiceID;
            } else {
                $isCreated = $this->db->insert('invoice', $data);
                if($isCreated) {
                    $id = $this->db->insert_id();
                    return $id;
                }
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
        return false;
    }
    
    /**
     * Get pco signature by id.
     * 
     * SELECT a.id,a.`used_to`, a.file_name,a.user_fk FROM attachment a 
     * JOIN users u ON u.id = a.`user_fk`
     * JOIN account acc ON acc.id = u.`account_fk`
     * WHERE acc.`id` = 1 AND a.`used_to` = 'USER_SIGNATURE'
     * 
     * @param type $id
     */
    public function PCOSignature($id) {
        try {
            $this->db->select('a.id,a.file_name,a.user_fk');
            $this->db->from('attachment a');
            $this->db->join('users u','u.id=a.user_fk');
            $this->db->join('account acc','acc.id=u.account_fk');
            $this->db->where('a.used_to', USER_SIGNATURE);
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
    public function rdSignature($id) {
        try {
            $this->db->select('a.id,a.file_name,a.user_fk');
            $this->db->from('attachment a');
            $this->db->join('users u','u.id=a.user_fk');
            $this->db->join('employee e','e.id=u.employee_fk');
            $this->db->where('a.used_to', USER_SIGNATURE);
            $this->db->where('u.id', $id);
            $result = $this->db->get();
            return $result->row_array();
        } catch (Excesption $err) {
            show_error($err->getMessage());
        }
        return false;
    }
}