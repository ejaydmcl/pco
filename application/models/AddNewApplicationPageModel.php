<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Add new application page model
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class AddNewApplicationPageModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }

    /**
     * Get municipality
     * 
     * @param type $name Description
     */
    public function getEstablishmentList($region) {
        $this->embisdb->select('d.region_name, d.`company_name`');
        $this->embisdb->from('dms_company d');
        $this->embisdb->where('d.region_name', $region);
        $query = $this->embisdb->get();
        return $query->result();
    }

    /*     * *
     * Get section chief
     */

    public function getSectionChief($region) {
        $this->db->select('u.id,u.employee_fk,u.designation_fk');
        $this->db->from('users u');
        $this->db->join('employee e', 'e.id=u.employee_fk');
        $this->db->where('e.region', $region);
        $this->db->where('u.designation_fk', SECTION_CHIEF);
        $this->db->where('u.is_active', ACTIVE);
        $result = $this->db->get();
        return $result->row_array();
    }

    /*     * *
     * Get industry category list.
     * Nature Of Business of The Establishment.
     */

    public function getNatureBusinessList() {
        $this->db->select('n.psic_code, n.category, n.significant_parameters, '
                . 'n.is_active, n.date_created, n.date_modified');
        $this->db->from('nature_of_business n');
        $this->db->where('n.is_active', ACTIVE);
        $result = $this->db->get();
        return $result->result_array();
    }

    /**
     * Get PCO employment status label.
     */
    public function getEmploymentStatusLabel() {
        $this->db->select('es.id,es.label');
        $this->db->from('employment_status es');
        $this->db->where('es.is_active', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /**
     * Insert the attachment data into the database.
     * 
     * @param {array} $data Description
     * @return {int} Attachment id
     */
    public function insertAttachmentData($data) {
        $isAttachment = $this->db->insert('attachment', $data);
        if ($isAttachment) {
            return $this->db->insert_id();
        }
        return null;
    }
    
     /**
     * update the new renewal existing coa application // TODO
     * Type new application with existing coa file
     */
    public function updateRenewalExistingCoa($oldExistingCoaData, $data, $appID) {
        try {
            $this->db->trans_start();
           // old coa data
            $oldExistingCoa = [
                    'coa_no' => $oldExistingCoaData['coa_no'],
                    'date_approved' => $oldExistingCoaData['date_approved'],
                    'valid_until' => $oldExistingCoaData['valid_until'],
                    'date_modified' => $oldExistingCoaData['date_modified'],
                    'attachment' => $oldExistingCoaData['attachment']
               ];
          
            // old coa table
            $this->db->update('old_certificate_of_accreditation', $oldExistingCoa, ['id' => $oldExistingCoaData['id']]);
            
            // application table
            $data += ['old_coa_attachment' => $oldExistingCoaData['id']];
            $this->db->update('application', $data, ['id' => $appID]);

            $this->db->trans_complete();
            if ($this->db->trans_status() == FALSE) {
                $this->db->trans_rollback();
                $response = array('is_success' => 0);
            } else {
                $this->db->trans_commit();
                $response = array('is_success' => 1);
            }
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
        return $response;
    }

    /**
     * Insert the new renewal existing coa application // TODO
     * Type new application with existing coa file
     */
    public function insertRenewalExistingCoa($appData, $oldCoaData) {
        try {
            $this->db->trans_start();
            $now_date_time = new DateTime();
            $now = $now_date_time->format('Y-m-d H:i:s');
            // old coa table
            $oldCoa = [
                'coa_no' => $oldCoaData['coa_no'],
                'date_approved' => $oldCoaData['date_approved'],
                'valid_until' => $oldCoaData['date_expired'],
                'date_created' => $now,
                'attachment' => $oldCoaData['attachment']
            ];

            $this->db->insert('old_certificate_of_accreditation', $oldCoa);
            $oldCoaId = $this->db->insert_id();
            // Add the old coa id
            $appData += ['old_coa_attachment' => $oldCoaId];
            // application table
            $this->db->insert('application', $appData);
            $application_id = $this->db->insert_id();

            $this->db->trans_complete();
            if ($this->db->trans_status() == FALSE) {
                $this->db->trans_rollback();
                $response = array('is_success' => 0);
            } else {
                $this->db->trans_commit();
                $response = array('is_success' => 1, 'id' => $application_id);
            }
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
        return $response;
    }

    /**
     * Insert the new filed application data into the database.
     * Type new
     * @param {array} $data Description
     */
    public function insertApplicationData($data) {
        try {
            $isApplication = $this->db->insert('application', $data);
            if ($isApplication) {
                return $this->db->insert_id();
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
        return false;
    }

    /**
     * Update the application data.
     * 
     * @param type $data
     * @param {int} $appID
     * @return boolean
     */
    public function updateApplicationData($data, $appID) {
        try {
            $isUpdate = $this->db->update('application', $data, ['id' => $appID]);
            if ($isUpdate) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }

    /**
     * Get application details.
     */
    public function getApplicationDetails($data) {
        try {
            $this->db->select('*');
            $this->db->from('application a');
            $this->db->where('a.is_active', 1);
            $result = $this->db->get();
            return $result->result_array();
        } catch (ErrorException $err) {
            show_error($err->getMessage());
        }
    }

}
