<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * 
 * @author JC Dela Cerna Jr. August 2019
 */
class ApplicationDispositionPageModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }

    /**
     * 
     * 
     * @param type $data
     */
    public function dispositionLog($data) {
        // Insert the data into database.
        $isInsert = $this->db->insert('disposition', $data);
       // var_dump($isInsert);
        //log_message('debug', '$isInsert: ' . $isInsert);
        if ($isInsert) {
            //log_message('debug', 'dispositionLog id: ' . $this->db->insert_id());
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function generateDocumentNo() {
        return null;
    }

    /**
     * 
     * @param type $id
     */
    public function getDispositionLog($id) {
        try {
            $this->db->select('*');
            $this->db->from('disposition d');
            $this->db->where('d.application_id', $id);
            $this->db->where('d.document_no IS NOT ', NULL);
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            log_message('error', $err->getMessage());
        }

        return null;
    }
    
     /**
     * 
     * @param type $id
     */
    public function getDispositionLogs($id) {
        try {
            $this->db->select('*');
            $this->db->from('disposition d');
            $this->db->where('d.id', $id);
            $result = $this->db->get();
            return $result->result_array();
        } catch (Exception $err) {
            log_message('error', $err->getMessage());
        }

        return null;
    }

}
