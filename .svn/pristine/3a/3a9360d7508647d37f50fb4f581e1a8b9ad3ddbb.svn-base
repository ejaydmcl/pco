<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Profile model.
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class ProfileModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }
    
    /**
     * Get the user data by account id
     * 
     *  SELECT u.id AS user_id, a.id AS account_id, ur.role_fk AS user_role, r.label, ur.is_active
     *  FROM users u
     *  JOIN userrole ur ON  ur.user_fk = u.id
     *  JOIN role r ON r.id = ur.role_fk
     *  JOIN account a ON a.id = u.account_fk
     *  WHERE a.id = account_id
     * 
     * @param {int} $id Account id
     */
    public function getUserDataByAccountID($id) {
        $this->db->select('u.id AS user_id, a.id AS account_id, ur.role_fk AS user_role, r.label,'
                . ' u.designation_fk AS designation_id, ur.is_active');
        $this->db->from('users u');
        $this->db->join('userrole ur','ur.user_fk = u.id');
        $this->db->join('role r','r.id = ur.role_fk');
        $this->db->join('account a','a.id = u.account_fk');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    /**
     * Get profile photo
     */
    public function getProfilePhoto() {
        try {
            $userId = isset($this->session->userdata['user']['id'])==FALSE ? 0: $this->session->userdata['user']['id'];
            $this->db->select('a.id,a.used_to,a.file_name');
            $this->db->from('attachment a');
            $this->db->where('a.user_fk', $userId);
            $this->db->where('a.used_to', 'PROFILE_PHOTO');
            $query = $this->db->get();
            $res = $query->row_array();
            if (isset($res)) {
                return $res['file_name'];
            } else {
                return false;
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
    
    /**
     * Get profile photo
     * @param {int} $id User id.
     */
    public function getProfilePhotoByUserID($id) {
        try {
            $this->db->select('a.id,a.used_to,a.file_name');
            $this->db->from('attachment a');
            $this->db->where('a.user_fk', $id);
            $this->db->where('a.used_to', 'PROFILE_PHOTO');
            $query = $this->db->get();
            $res = $query->row_array();
            if (isset($res)) {
                return $res['file_name'];
            } else {
                return false;
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }

    /**
     * Get user signature
     * @param 
     */
    public function getUserSignature() {
        try {
            $userId = isset($this->session->userdata['user']['id'])==FALSE ? 0: $this->session->userdata['user']['id'];
            $this->db->select('a.id,a.used_to,a.file_name');
            $this->db->from('attachment a');
            $this->db->where('a.user_fk', $userId);
            $this->db->where('a.used_to', 'USER_SIGNATURE');
            $query = $this->db->get();
            $res = $query->row_array();
            if (isset($res)) {
                return $res['file_name'];
            } else {
                return false;
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
    
     /**
      * Get user signature
      * @param {int} $id User id
      * @return 
     */
    public function getUserSignatureByUserID($id) {
        try {
            $this->db->select('a.id,a.used_to,a.file_name');
            $this->db->from('attachment a');
            $this->db->where('a.user_fk', $id);
            $this->db->where('a.used_to', 'USER_SIGNATURE');
            $query = $this->db->get();
            $res = $query->row_array();
            if (isset($res)) {
                return $res['file_name'];
            } else {
                return false;
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }

    /**
     * Get employee data
     */
    public function getUserInformation($id) {
        try {
            $this->db->select('*');
            $this->db->from('users u');
            $this->db->where("u.id", $id);
            $this->db->limit(1);
            $query = $this->db->get();
            return $query->row_array();
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }

    /**
     * Get account data
     */
    public function getAccountInformation($id) {
        try {
            $this->db->select('*');
            $this->db->from('account a');
            $this->db->where("a.id", $id);
            $this->db->limit(1);
            $query = $this->db->get();
            return $query->row_array();
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }

    /**
     * Get employee data
     */
    public function getEmployeeInformation($id) {
        try {
            $this->db->select('*');
            $this->db->from('employee e');
            $this->db->where("e.id", $id);
            $this->db->limit(1);
            $query = $this->db->get();
            return $query->row_array();
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
    
    /**
     * Get the managing head data and attached pdf file
     * SELECT
     *      h.account_fk,h.name_of_managing_head,h.attachment_fk,a.used_to,a.file_name
     * FROM
     *      pco_managing_head h
     * JOIN attachment a
     *      ON a.id = h.attachment_fk
     * WHERE 
     *      h.account_fk = @account_id
     * 
     * @param int $account_id PCO Account id.
     * @return list
     */
    public function getPCOManagingHead($account_id) {
        try {
            $this->db->select('h.account_fk,h.name_of_managing_head,h.attachment_fk,a.used_to,a.file_name');
            $this->db->from('pco_managing_head h');
            $this->db->join('attachment a', 'a.id = h.attachment_fk');
            $this->db->where('h.account_fk', $account_id);
            $query = $this->db->get();
            return $query->row_array();
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
        }
    }

    /**
     * Update PCO account data.
     * Functions for update account table,
     * insert the new managing head data and
     * update the existing managing head data.
     * The PCO account will have only one managing head data record
     * and the database per PCO account. 
     * 
     * @param {array} $data PCO user account data.
     */
    public function updatePCOAccountData($data) {
        // Account data.
        $account = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'middle_name' => $data['middle_name'],
            'name_extension' => $data['extension_name'],
            'sex' => $data['sex'],
            'citizenship' => $data['citizenship'],
            'address' => $data['address'],
            'telephone_no' => $data['telephone_no'],
            'cellular_phone_no' => $data['cellular_phone_no'],
            'managing_head' => $data['is_managing_head'],
            'date_modified' => date('Y-m-d H:i:s')
        ];
        
        // Insert attachment file and data.
        $attachment = [
            'date_created' => $data['date_created'],
            'file_name' => $data['file_name'],
            'user_fk' => $data['user_id'],
            'used_to' => MANAGING_HEAD_CERTIFICATE
        ];
        
        // Start the transactions.
        $this->db->trans_start();
        // Update account data.
        $this->db->update('account', $account, ['id' => $data['account_fk']]);
        
        // Check if the managing head data is in the database. If not
        // We will insert the managing head data.
        // And if is present we will only update the data.
        if(isset($data['update_personal_data_attachment']) && $data['update_personal_data_attachment'] == true) {
            $this->db->select('a.id');
            $this->db->from('attachment a');
            $this->db->where('a.id', $data['attachment_id']);
            $query = $this->db->get();
            $res = $query->row_array();
            if(isset($res['id'])) { 
                // Update the attachment data.
                $update_attachment_data = [
                    'file_name' => $data['file_name'],
                    'date_modified' => date('Y-m-d H:i:s')
                ];
                $this->db->update('attachment', $update_attachment_data, ['id' => $data['attachment_id']]);

                // Update the pco_managing_head table.
                $update_managing_head_data = [
                    'name_of_managing_head' => $data['managing_head'],
                    'attachment_fk' => $data['attachment_id'],
                    'date_modified' => date('Y-m-d H:i:s')
                ];
                $this->db->update('pco_managing_head', $update_managing_head_data, ['account_fk' => $data['account_fk']]);

            } else {
                // This section will insert the new managing head data.
                // Insert attachment data...
                $is_attachment = $this->db->insert('attachment', $attachment);
                if($is_attachment) {
                        $attachment_id = $this->db->insert_id();
                }
                // Managing head data.
                $pco_managing_head = [
                    'account_fk' => $data['account_fk'],
                    'name_of_managing_head' => $data['managing_head'],
                    'attachment_fk' => $attachment_id,
                    'date_created' => $data['date_created']
                ];

                // Insert attachment data...
                $this->db->insert('pco_managing_head', $pco_managing_head);
            } 
        }
        
        // Update the pco managing head table.
        if(isset($data['update_personal_data']) && $data['update_personal_data'] == true) {
            // Update the pco managing head table only.
            $update_managing_head_data = [
                'name_of_managing_head' => $data['managing_head'],
                'date_modified' => date('Y-m-d H:i:s')
            ];
            $this->db->update('pco_managing_head', $update_managing_head_data, ['account_fk' => $data['account_fk']]);
        }
        
        // Update user data.
        $user_data = [
            'email' => $data['email_address'], // update pco user email
            'date_modified' => date('Y-m-d H:i:s')
        ];
        $this->db->update('users', $user_data, ['id' => $data['user_id']]); // Update users table.
        
        $this->db->trans_complete(); // Complete sql transactions.
        if($this->db->trans_status() == false) { // Check if the sql transactions has no error.
            $this->db->trans_rollback(); // Roll back all the sql transactions.
            return false; // return false to the controller.
        }
        $this->db->trans_commit(); // This will commit all the changes made by the sql transactions above. 
        return true; // return
    }

    /**
     * Update account table
     * 
     * @param {array} $data PCO user account data.
     * 
     * @deprecated 
     */
    public function updateAccountData($data) {
        // Account data.
        $account = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'middle_name' => $data['middle_name'],
            'name_extension' => $data['extension_name'],
            'sex' => $data['sex'],
            'citizenship' => $data['citizenship'],
            'address' => $data['address'],
            'telephone_no' => $data['telephone_no'],
            'cellular_phone_no' => $data['cellular_phone_no'],
            'date_modified' => date('Y-m-d H:i:s')
        ];
        // Update account data.
        $this->db->update('account', $account, ['id' => $data['account_fk']]);
        
        $userData = [
            'email' => $data['email_address'], // update pco user email
            'date_modified' => date('Y-m-d H:i:s')
        ];

        // Update user data.
        $this->db->update('users', $userData, ['id' => $data['user_id']]);
        
        // return
        return true;
    }

    /**
     * Update employee table
     * 
     * @param {array} $data Employee data.
     */
    public function updateEmployeeData($data) {
        // Employee data.
        $employee = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'middle_name' => $data['middle_name'],
            'name_extension' => $data['extension_name'],
            'sex' => $data['sex'],
            'citizenship' => $data['citizenship'],
            'address' => $data['address'],
            'mobile_no' => $data['cellular_phone_no'],
            'telephone_no' => $data['telephone_no'],
            'date_created' => $data['date_created'],
            'date_modified' => date('Y-m-d H:i:s')
        ];
        // Update employee data.
        $this->db->update('employee', $employee, ['id' => $data['employee_fk']]);

        $userRole = [
            'role_fk' => $data['role_fk'], // update user role
            'date_modified' => date('Y-m-d H:i:s')
        ];

        // Update userrole data.
        $this->db->update('userrole', $userRole, ['user_fk' => $data['user_id']]);

        $userData = [
            'designation_fk' => $data['designation_fk'], // update designation fk
            'email' => $data['email_address'], // update user email
            'date_modified' => date('Y-m-d H:i:s')
        ];

        // Update user data.
        $this->db->update('users', $userData, ['id' => $data['user_id']]);

        // return
        return true;
    }

    /**
     * Add license data table
     * 
     * @param {array} $data License data.
     */
    public function addLiscenseData($data) {
        $data['date_created'] = date('Y-m-d H:i:s');
        // Insert the data on the table.
        $result = $this->db->insert('license', $data);
        if($result) {
            // Return true.
            return true;
        }
        return false;
    }
   
     /**
     * Update license data table
     * 
     * @param {array} $data License data.
     */
    public function editLiscenseData($data) {
        $id = $data['license_fk'];
        unset($data['license_fk']);
        $data['date_modified'] = date('Y-m-d H:i:s');
        // Update the table.
        $result = $this->db->update('license', $data, ['id' => $id]);
        if($result) {
            // Return true.
            return true;
        }
        return false;
    }
    
    /**
     * Add vocational or technical
     */
    public function addPCOVocationalOrTechnical($data) {
        try {
            $this->db->trans_start(); // Start the sql transaction.
            // Check for flag.
            if(isset($data['add_pco_educational_attainment_vocational_or_technical']) 
                    && $data['add_pco_educational_attainment_vocational_or_technical']) {
                // For attachment table
                $attachment_data = [
                    'used_to' => VOCATIONAL_CERTIFICATE,
                    'file_name' => $data['file_name'],
                    'user_fk' => $data['user_fk'],
                    'date_created' => $data['date_created'] 
                ];
                // Save the attachment
                $is_attachment = $this->db->insert('attachment',$attachment_data);
                if($is_attachment) {
                    $attachment_id = $this->db->insert_id();
                }
                // For educational attainment table
                $educational_attainment_data = [
                    'account_fk' => $data['account_fk'],
                    'type' => VOCATIONAL_TECHNICAL,
                    'school' => $data['school'],
                    'address' => $data['school_address'],
                    'course' => $data['course'],
                    'degree_or_units_earned' => $data['degree_or_units_earned'],
                    'from_date' => $data['from_date'],
                    'to_date' => $data['to_date'],
                    'graduated' => $data['graduated'],
                    'attachment_fk' => $attachment_id, // attachment id
                    'date_created' => $data['date_created'] 
                ];
                // insert the educational attainment table.
                $this->db->insert('educational_attainment',$educational_attainment_data);
            }
            $this->db->trans_complete(); // Complete sql transactions.
            if($this->db->trans_status() == false) { // Check if the sql transactions has no error.
                $this->db->trans_rollback(); // Roll back all the sql transactions.
                return false; // return false to the controller.
            }
            $this->db->trans_commit(); // This will commit all the changes made by the sql transactions above. 
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
            return false;
        }
        return true; // return
    }

        /**
     * Add PCO college degree for new record.
     * 
     */
    public function addPCOEducationalAttainment($data) {
        try {
            $this->db->trans_start(); // Start the sql transaction.
            // Check for flag.
            if(isset($data['add_pco_educational_attainment_college_degree']) 
                    && $data['add_pco_educational_attainment_college_degree']) {
                // For attachment table
                $attachment_data = [
                    'used_to' => COLLEGE_DIPLOMA,
                    'file_name' => $data['file_name'],
                    'user_fk' => $data['user_fk'],
                    'date_created' => $data['date_created'] 
                ];
                // Save the attachment
                $is_attachment = $this->db->insert('attachment',$attachment_data);
                if($is_attachment) {
                    $attachment_id = $this->db->insert_id();
                }
                // For educational attainment table
                $educational_attainment_data = [
                    'account_fk' => $data['account_fk'],
                    'type' => COLLEGE_DEGREE,
                    'school' => $data['school'],
                    'address' => $data['college_school_address'],
                    'course' => $data['course'],
                    'degree_or_units_earned' => $data['degree_or_units_earned'],
                    'from_date' => $data['from_date'],
                    'to_date' => $data['to_date'],
                    'graduated' => $data['graduated'],
                    'attachment_fk' => $attachment_id, // attachment id
                    'date_created' => $data['date_created'] 
                ];
                // insert the educational attainment table.
                $this->db->insert('educational_attainment',$educational_attainment_data);
            }
            $this->db->trans_complete(); // Complete sql transactions.
            if($this->db->trans_status() == false) { // Check if the sql transactions has no error.
                $this->db->trans_rollback(); // Roll back all the sql transactions.
                return false; // return false to the controller.
            }
            $this->db->trans_commit(); // This will commit all the changes made by the sql transactions above. 
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
            return false;
        }
        return true; // return
    }
    
    /**
     * Edit PCO College Diploma.
     * 
     * @param {array} $data 
     */
    public function editPCOEducationalAttainment($data) {
       // var_dump($data);
        try {
            $this->db->trans_start(); // Start the sql transaction.
            // Check for flag. data and files
            if(isset($data['edit_pco_educational_attainment_college_degree']) 
                    && $data['edit_pco_educational_attainment_college_degree']) {
                // Data and file
                // Select the attachment data first if the data is in the table...
                $this->db->select('a.id');
                $this->db->from('attachment a');
                $this->db->where('a.id', $data['attachment_id']);
                $query = $this->db->get();
                $res = $query->row_array();
                // Update the attachment
                if(isset($res['id'])) {
                    // attachment data.
                    $update_attachment_data = [
                        'file_name' => $data['file_name'],
                        'date_modified' => date('Y-m-d H:i:s') // Current date.
                    ];
                    // Update attachment table.
                    $this->db->update('attachment', $update_attachment_data, ['id' => $data['attachment_id']]);
                    
                    // Update educational table.
                    $update_educational_attainment_data = [
                        'school' => $data['school'],
                        'address' => $data['address'],
                        'course' => $data['course'],
                        'degree_or_units_earned' => $data['degree_or_units_earned'],
                        'from_date' => $data['from_date'],
                        'to_date' => $data['to_date'],
                        'graduated' => $data['graduated'],
                        'date_modified' => date('Y-m-d H:i:s') // Current date.
                    ];
                    // Update
                    $this->db->update('educational_attainment', $update_educational_attainment_data, ['id' => $data['educational_id']]);
                }
            }
            
            // Check for flag. data and only
            if(isset($data['edit_pco_educational_attainment_college_degree_data']) 
                    && $data['edit_pco_educational_attainment_college_degree_data']) {
                // Data
                // Select the educational data first if the data is in the table...
                $this->db->select('e.id');
                $this->db->from('educational_attainment e');
                $this->db->where('e.id', $data['educational_id']);
                $query = $this->db->get();
                $res = $query->row_array();
                // Update the attachment
                if(isset($res['id'])) {
                    // Update educational table.
                    $update_educational_attainment_data = [
                        'school' => $data['school'],
                        'address' => $data['address'],
                        'course' => $data['course'],
                        'degree_or_units_earned' => $data['degree_or_units_earned'],
                        'from_date' => $data['from_date'],
                        'to_date' => $data['to_date'],
                        'graduated' => $data['graduated'],
                        'date_modified' => date('Y-m-d H:i:s') // Current date.
                    ];
                    // Update
                    $this->db->update('educational_attainment', $update_educational_attainment_data, ['id' => $data['educational_id']]);
                }
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
     * Add educational attainment data table
     * 
     * @param {array} $data Educational attainment data.
     */
    public function addEducationalData($data) {
        $data['date_created'] = date('Y-m-d H:i:s');
        // Insert the data on the table.
        $result = $this->db->insert('educational_attainment', $data);
        if($result) {
            // Return true.
            return true;
        }
        return false;
    }
    
    
    /**
     * Edit educational attainment data table
     * 
     * @param {array} $data Educational attainment data.
     */
    public function editEducationalData($data) {
        $id = $data['educational_id'];
        unset($data['educational_id']);
        $data['date_modified'] = date('Y-m-d H:i:s');
        // Update the table.
        $result = $this->db->update('educational_attainment', $data, ['id' => $id]);
        if($result) {
            // Return true.
            return true;
        }
        return false;
    }
    
    /**
     * Get attachment file name
     * @param {int} $id User file attachment id.
     */
    public function getAttachmentFileName($id) {
        $this->db->select('*');
        $this->db->from('attachment a');
        $this->db->where("a.id", $id);
        $this->db->limit(1);
        $query = $this->db->get();
        $res = $query->row_array();
        return $res['file_name'];
    }
    
}
