<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class PCOPhotoRequirementsPageModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    /**
     * @param type $data
     * @return boolean
     */
    public function updatePageHeaderPCOTable($data) {
        try {
            $isUpdate = $this->db->update('pco_photo_requirements_page', $data, ['column' => 'PAGE_HEADER']);
            if ($isUpdate) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $err) {
            // TODO
        }
    }
    
     /**
     * @param type $data
     * @return boolean
     */
    public function updateMalePhotoHeaderPCOTable($data) {
        try {
            $isUpdate = $this->db->update('pco_photo_requirements_page', $data, ['column' => 'MALE_PHOTO_HEADER']);
            if ($isUpdate) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $err) {
            // TODO
        }
    }
    
     /**
     * @param type $data
     * @return boolean
     */
    public function updateFemalePhotoHeaderPCOTable($data) {
        try {
            $isUpdate = $this->db->update('pco_photo_requirements_page', $data, ['column' => 'FEMALE_PHOTO_HEADER']);
            if ($isUpdate) {
                return true;
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
    public function getPageHeader() {
        try {
            $this->db->select('*');
            $this->db->from('pco_photo_requirements_page p');
            $this->db->where('p.column','PAGE_HEADER');
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            // TODO
        }
    }
    
     /**
      * 
      * @param {int} $id Description
      */
    public function getMalePhotoHeader() {
        try {
            $this->db->select('*');
            $this->db->from('pco_photo_requirements_page p');
            $this->db->where('p.column','MALE_PHOTO_HEADER');
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            // TODO
        }
    }
    
    /**
      * 
      * @param {int} $id Description
      */
    public function getFemalePhotoHeader() {
        try {
            $this->db->select('*');
            $this->db->from('pco_photo_requirements_page p');
            $this->db->where('p.column','FEMALE_PHOTO_HEADER');
            $result = $this->db->get();
            return $result->row_array();
        } catch (Exception $err) {
            // TODO
        }
    }
    
     /**
     * @param type $data
     * @return boolean
     */
    public function addDescriptionEntryPCOTable($data) {
        try {
            $isInsert = $this->db->insert('pco_photo_requirements_page', $data);
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
            $this->db->from('pco_photo_requirements_page p');
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
            $isDelete = $this->db->delete('pco_photo_requirements_page', $data);
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