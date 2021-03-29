<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Client model
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class ClientModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    /**
     * get client pco data
     */
    public function clientProfile($user_id) {
        $this->db->select('u.`id`,
                        CONCAT(a.`first_name`, " " ,a.`middle_name`," ",a.`last_name`," ",a.`name_extension`) AS fullname,
                        u.`email`,f.id,f.file_name');
        $this->db->from('users u');
        $this->db->join('account a','u.account_fk = a.id');
        $this->db->join('attachment f','u.id = f.user_fk');
        $this->db->where('u.id', $user_id);
        $this->db->where('f.used_to', PROFILE_PHOTO);
        $query = $this->db->get();
        return $query->row_array();
    }


    /**
     * @param {string} $param Description
     */
    public function count_all() {
        $this->db->from('users u');
        $this->db->join('account a', 'u.account_fk=a.id');
        return $this->db->count_all_results();
    }
    
    /**
     * User data for client table
     * For super user function
     * 
     * @param {array} $param Description
     */
    public function clientTable($param) {
        $this->db->select('u.`id`,
                    u.`date_created`,
                    u.`is_active`,
                    u.`is_email_verify`,
                    u.`notification`,
                    u.`email`,
                    CONCAT(a.first_name," ",a.middle_name," ", a.last_name," ",
                      a.name_extension) AS fullname ');
        $this->db->from('users u');
        $this->db->join('account a', 'u.account_fk=a.id');
        $this->db->join('userrole r', 'u.id = r.user_fk');
        if($param['search'] != '') {
            $this->db->like('CONCAT(a.first_name," ",a.middle_name," ", a.last_name," ",
                      a.name_extension)', $param['search'], 'both');
        }
        $this->db->limit($param['limit'], $param['offset']);
        $this->db->order_by('u.date_created', $param['sort']);
        $query = $this->db->get();
        return $query->result();
    }
}
