<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class ApplicationTerminationPageModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }
    
    /**
     * Get the application for termination.
     * 
     * @param it $id Selected application id.
     */
    public function getApplicationForTermination($id) {
        try {
            $this->db->select('a.id, a.account_fk, a.evaluator_fk,a.name_of_establishment, '
                    . 'a.address, a.nature_of_business_establishment, a.telephone_no, a.website, '
                    . 'a.type_fk, a.status_fk, a.evaluator_fk,a.date_created, a.coa_fk');
            $this->db->from('application a');
            $this->db->where('a.id',$id);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                return $query->row_array();
            }
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
        }
        return null;
    }
    
    /**
     * Get selected COA data.
     * @param int $id 
     */
    public function getApplicationCOA($id) {
        try {
            $this->db->select('c.id, c.coa_no, c.approved_by_user_fk, c.date_approved, c.valid_until');
            $this->db->from('cetificate_of_accreditation c');
            $this->db->where('c.id',$id);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                return $query->row_array();
            }
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
        }
    }
    
    /**
     * Terminate the selected Certificate of Accreditation.
     * 
     * @param array $data COA data array.
     */
    public function terminateCOA($data) {
        try {
            $this->db->trans_start(); // Start the sql transaction.
            // For attachment table
            $attachment_data = [
                'used_to' => TERMINATION_ATTACHMENT,
                'file_name' => $data['file_name'],
                'user_fk' => $data['user_id'],
                'date_created' => $data['date_created'] 
            ];
            // Save the attachment
            $is_attachment = $this->db->insert('attachment',$attachment_data);
            if($is_attachment) {
                $attachment_id = $this->db->insert_id();
                // Application termination table.
                $coa = [
                    'account_fk' => $data['account_id'],
                    'application_fk' => $data['application_id'],
                    'coa_fk' => $data['coa_id'],
                    'attachment_fk' => $attachment_id,
                    'terminated_by_user_fk' => $data['user_id'],
                    'date_terminated' => $data['date_terminated'],
                    'remarks' => $data['remarks'],
                    'date_created' => $data['date_created'],
                ];

                // Save the data.
                $this->db->insert('application_terminated', $coa);
                
                // attachment data.
                $application_status = [
                    'status_fk' => REVOKED,
                    'date_modified' => date('Y-m-d H:i:s') // Current date.
                ];
                // Update attachment table.
                $this->db->update('application', $application_status, ['id' => $data['application_id']]);
            }
            
            $this->db->trans_complete(); // Complete sql transactions.
            if($this->db->trans_status() == false) { // Check if the sql transactions has no error.
                $this->db->trans_rollback(); // Roll back all the sql transactions.
                return false; // return false to the controller.
            }
            $this->db->trans_commit(); // This will commit all the changes made by the sql transactions above.
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
        }
        return true;
    }
    
    /**
     * Get selected revoked COA data.
     * @param int $id 
     */
    public function getApplicationRevokedCOA($id) {
        try {
            $this->db->select('a.attachment_fk, a.remarks, a.date_terminated');
            $this->db->from('application_terminated a');
            $this->db->where('a.application_fk',$id);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                return $query->row_array();
            }
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
        }
    }
}