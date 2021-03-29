<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class PCOSignatureRequirementsPageModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
      /**
     * @param type $data
     * @return boolean
     */
    public function addDescriptionEntryPCOTable($data) {
        try {
            $isInsert = $this->db->insert('pco_signature_requirements_page', $data);
            if ($isInsert) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        } catch (Exception $err) {
            // TODO
        }
    }
    
     /**
      * 
      * @param {int} $id Description
      */
    public function getDescriptionEntry() {
        try {
            $this->db->select('*');
            $this->db->from('pco_signature_requirements_page p');
            $this->db->where('p.column','DESCRIPTION_ENTRY');
            $result = $this->db->get();
            return $result->result_array();
        } catch (Exception $err) {
            // TODO
        }
    }
    
     /**
     * @param type $data
     * @return boolean
     */
    public function removeDescriptionEntryPCOTable($data) {
        try {
            $isDelete = $this->db->delete('pco_signature_requirements_page', $data);
            if ($isDelete) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $err) {
            // TODO
        }
    }
}