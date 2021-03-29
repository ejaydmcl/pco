<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of PCOSystemModel
 *
 * @author User
 */
class PCOSystemModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }
    
     /*
     * Sytem error logs
     */
    public function errorLogs($param) {
        $this->embisdb->select('*');
        $this->db->from('ci_exceptions c');
        $this->db->like('created_time', $param['search'], 'both');
        $this->db->limit($param['limit'], $param['offset']);
        $this->db->order_by('c.created_time', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function count_all() {
        $this->db->from('ci_exceptions');
        return $this->db->count_all_results();
    }
}