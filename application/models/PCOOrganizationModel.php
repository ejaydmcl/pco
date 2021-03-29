<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of PCOOrganizationmModel
 *
 * @author Juanito C. Dela Cerna Jr. MArch 2021
 */
class PCOOrganizationModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }
    
    /**
     * updateContactDetails
     * 
     */
     public function updateContactDetails($post) {
        $this->db->trans_start();
        $organization = [
            'phone' => $post['telephone'],
            'email' => $post['email'], 
            'notes' => $post['notes'], 
            'date_modified' => date('Y-m-d H:i:s')
        ];
        $this->db->update('organization', $organization, ['reg_code' => $post['cd_region']]);
        
        $this->db->trans_complete();
        if($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            $response = array('is_success' => 0);
        } else {
            $this->db->trans_commit();
            $response = array('is_success' => 1);
        }
        return $response;
    }
    
    /**
     * updateIsoStandard
     * 
     * @param {post} $name Description
     */
    public function updateIsoStandard($post) {
        $this->db->trans_start();
        $iso = [
                'document_code' => $post['iso_document_code'], // iso document code
                'modified_by' => $this->session->userdata['user']['id'], // Current logged user id
                'date_modified' => date('Y-m-d H:i:s')
            ];
        $this->db->update('iso', $iso, ['id' => $post['iso_id']]);
        
        $this->db->trans_complete();
        if($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            $response = array('is_success' => 0);
        } else {
            $this->db->trans_commit();
            $response = array('is_success' => 1);
        }
        return $response;
    }


    /**
     * isoStandard
     */
    public function isoStandard($organization_id) {
        $this->db->select('*');
        $this->db->from('iso i');
        $this->db->where('i.organization_fk', $organization_id);
        $query = $this->db->get();
        return $query->row_array();
    }


    /**
     * Get coa header
     * 
     */
    public function getCoaHeader($attachment) {
        $this->db->select('*');
        $this->db->from('attachment a');
        $this->db->where('a.id', $attachment);
        $query = $this->db->get();
        return $query->row_array();
    }


    /**
     * Update certificate of accreditation header
     * 
     */
    public function updateCoaHeader($param) {
        $this->db->trans_start();
        $now_date_time = new DateTime();
        $now = $now_date_time->format('Y-m-d H:i:s');
        
        $attachment = [
            'used_to' => COA_HEADER,
            'file_name' => $param['file_name'],
            'user_fk'=> $param['user_fk'],
            'is_active' => 1,
            'date_modified'=> $now
        ];
        $this->db->insert('attachment', $attachment);
        $attachmentId =  $this->db->insert_id();
        
        $organization = [
                'user_fk'=> $param['user_fk'],
                'attachment'=> $attachmentId,
                'date_modified'=> $now
            ];
        $this->db->update('organization', $organization, ['id' => $param['office_id']]);
        
        $this->db->trans_complete();
        if($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            $response = array('is_success' => 0);
        } else {
            $this->db->trans_commit();
            $response = array('is_success' => 1);
        }
        return $response;
    }


    /**
     * Update office information
     * 
     * @param {int} $office organization id
     */
    public function updateOfficeInformation($param) {
        $this->db->trans_start();
        $now_date_time = new DateTime();
        $now = $now_date_time->format('Y-m-d H:i:s');
        $organization = [
                'regional_director'=> $param['regional_director'],
                'name'=> $param['office_name'],
                'country_code'=> 1,
                'reg_code'=> $param['region'],
                'prov_code'=> $param['province'],
                'city_mun_code'=> $param['city'],
                //'phone'=> $param['telephone'],
                //'email'=> $param['email'],
                'address'=> $param['address'],
                'is_active'=> 1,
                'user_fk'=> $this->session->userdata['user']['id'],
                'date_modified'=> $now
            ];
        $this->db->update('organization', $organization, ['id' => $param['office_id']]);
        
        $this->db->trans_complete();
        if($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            $response = array('is_success' => 0);
        } else {
            $this->db->trans_commit();
            $response = array('is_success' => 1);
        }
        return $response;
    }

        /**
     * Organization data
     * 
     * @param {int} $region 
     */
    public function getOrganization($region) {
        $this->db->select('*');
        $this->db->from('organization o');
        $this->db->where('o.reg_code', $region);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    /**
     * Get region
     * 
     * @param type $name Description
     */
    public function getRegion() {
        $this->db->select('*');
        $this->db->from('region r');
        $query = $this->db->get();
        return $query->result();
    }
    
     /**
     * Get province
     * 
     * @param type $name Description
     */
    public function _getProvince() {
        $this->db->select('p.prov_code, p.prov_desc');
        $this->db->from('province p');
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * Get province
     * 
     * @param type $name Description
     */
    public function getProvince($region) {
        $this->db->select('p.prov_code, p.prov_desc');
        $this->db->from('province p');
        $this->db->where('p.reg_code', $region);
        $query = $this->db->get();
        return $query->result();
    }
    
     /**
     * Get municipality
     * 
     * @param type $name Description
     */
    public function _getMunicipality() {
        $this->db->select('c.city_mun_code, c.city_mun_desc');
        $this->db->from('city c');
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * Get municipality
     * 
     * @param type $name Description
     */
    public function getMunicipality($province) {
        $this->db->select('c.city_mun_code, c.city_mun_desc');
        $this->db->from('city c');
        $this->db->where('c.prov_code', $province);
        $query = $this->db->get();
        return $query->result();
    }
    
}
