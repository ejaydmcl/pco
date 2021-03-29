<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class ApplicationChecklistModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }

    public function getApplicationData($applicationId) {
        $this->db->select('*');
        $this->db->from('application a');
        $this->db->where('a.id', $applicationId);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            $result = $query->row_array();
            return $result;
        } else {
            return NULL;
        }
    }
    
    public function getCheckListData($applicationId) {
        $this->db->select('*');
        $this->db->from('checklist c');
        $this->db->where('c.application_fk', $applicationId);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            $result = $query->row_array();
            return $result;
        } else {
            return NULL;
        }
    }
    
    public function authorizedToEdit($data) {
        $this->db->select('a.id');
        $this->db->from('application a');
        $this->db->where('a.id', $data['id']);
        $this->db->where('a.evaluator_fk', $data['evaluator_fk']);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            $user = $this->session->userdata['user']['employee_fk'];
            if(count(array_intersect(array($user), 
                                array($data['evaluator_fk'],$data['employee_fk'])))) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function recordChecklist($data) {
        $this->db->select('c.id');
        $this->db->from('checklist c');
        $this->db->where('c.application_fk', $data['application_fk']);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            $this->db->update('checklist', array_merge($data,array("date_modified"=>date('Y-m-d H:i:s'))), ['application_fk' => $data['application_fk']]);
            return true;
        } else {
            $this->db->insert('checklist', array_merge($data,array("date_created"=>date('Y-m-d H:i:s'))));
            return true;
        }
        
        return false;
    }
}
