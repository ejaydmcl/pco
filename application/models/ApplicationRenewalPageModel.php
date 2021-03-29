<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application renewal page model
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class ApplicationRenewalPageModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }
	
	/** #1
     * Get application by origin id.
     * 
     * @param {int} $id
     */
    public function getRenewedApplicationById($id) {
        try {
            $this->db->select('a. origin, a.coa_fk, old_coa_attachment');
            $this->db->from('application a');
            $this->db->where('a.id', $id);
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
    
     /**
     * Get Certificate of Accreditation No by old_coa_fk.
     * The data here was recorded outside on this system
     * The coa data recorded was 2019 below 
     * @param {int} $id
     */
    public function getOldExistingCOANoByID($id) {
        try {
            $this->db->select('*');
            $this->db->from('old_certificate_of_accreditation c');
            $this->db->where('c.id', $id);
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
    
     /**
     * Get Certificate of Accreditation No by coa_fk.
     * 
     * @param {int} $id application fk
     */
    public function getCOANoByID($id) {
        try {
            $this->db->select('*');
            $this->db->from('cetificate_of_accreditation c');
            $this->db->where('c.application_fk', $id);
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
    
    /**
     * 
     * @param type $data
     */
    public function renewalApplicationData($data) {
        try {
            $isApplication = $this->db->insert('application', $data);
            if($isApplication) {
                $id = $this->db->insert_id();
                return $id;
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
        return false;
    }
    
    /**
     * Add comment
     * 
     * @param type $data1
     * @param type $data2
     */
    public function addComment($data1,$data2) {
        try {
            
            // TODO...
            
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
}