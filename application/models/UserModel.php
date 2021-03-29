<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User model
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class UserModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }

    private $User = 'users';
    private $Employee = 'employee';
    
    /**
     * For administrator page
     * @param {string} $param Description
     */
    public function count_all_admin_page($param) {
        $this->db->from('users u');
        $this->db->join('employee e', 'u.employee_fk=e.id');
        $this->db->where('u.iisuserid !=', null);
        return $this->db->count_all_results();
    }

    /**
     * iis user list for administrator
     */
    public function iisUserListForSuperUser() {
        $this->embisdb->select('a.`userid`,
                            v.`region`,
                            v.`email`,
                            v.`pco_access`,
                            CONCAT(v.`fname`," ",v.`mname`," ",v.`sname`," ",v.`suffix`) AS fullname,
                            v.`prefix`,
                            v.`fname`,
                            v.`mname`,
                            v.`sname`,
                            v.`suffix` ');
        $this->embisdb->from('acc a');
        $this->embisdb->join('view_userinfo v', 'a.userid=v.userid');
        $this->embisdb->where('v.pco_access', 'yes');
        $query = $this->embisdb->get();
        return $query->result();
    }
    
     /**
     * Check user id 
     * 
     * @return {boolean} 
     */
    public function isUserAlreadyAdded($userid) {
        $this->db->from('users u');
        $this->db->where('u.iisuserid', $userid);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * iis user list
     */
    public function iisUserList($region) {
        $this->embisdb->select('a.`userid`,
                            v.`region`,
                            v.`email`,
                            v.`pco_access`,
                            CONCAT(v.`fname`," ",v.`mname`," ",v.`sname`," ",v.`suffix`) AS fullname,
                            v.`prefix`,
                            v.`fname`,
                            v.`mname`,
                            v.`sname`,
                            v.`suffix` ');
        $this->embisdb->from('acc a');
        $this->embisdb->join('view_userinfo v', 'a.userid=v.userid');
        $this->embisdb->where('v.region', $region); 
        $this->embisdb->where('v.pco_access', 'yes');
        $query = $this->embisdb->get();
        return $query->result();
    }

    public function count_all($param) {
        $this->db->from('users u');
        $this->db->join('employee e', 'u.employee_fk=e.id');
        $this->db->where('e.region', $param['region']);
        $this->db->where('u.iisuserid !=', null);
        return $this->db->count_all_results();
    }
    
    /**
     * User data for user table
     * For super user function
     * 
     * @param {array} $param Description
     */
    public function UserTableForSuperUser($param) {
        $this->db->select(' u.`id`,e.region,
                    u.`iisuserid`,
                    u.`employee_fk`,
                    u.`designation_fk`,
                    u.`date_created`,
                    e.region,
                    CONCAT(e.first_name," ",e.middle_name," ", e.last_name," ",
                      e.name_extension) AS fullname ');
        $this->db->from('users u');
        $this->db->join('employee e', 'u.employee_fk=e.id');
        $this->db->join('userrole r', 'u.id = r.user_fk');
        //$this->db->where('e.region', $param['region']);
        $this->db->where('u.iisuserid !=', null);
       // $this->db->where('r.role_fk !=', 1); // This will excludee the super user
        $this->db->like('CONCAT(e.first_name," ",e.middle_name," ", e.last_name," ",
                      e.name_extension)', $param['search'], 'both');
        $this->db->limit($param['limit'], $param['offset']);
        $this->db->order_by('e.date_created', $param['sort']);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * User data for user table
     * 
     * @param {array} $param Description
     */
    public function UserTable($param) {
        $this->db->select(' u.`id`,e.region,
                    u.`iisuserid`,
                    u.`employee_fk`,
                    u.`designation_fk`,
                    u.`date_created`,
                    e.region,
                    CONCAT(e.first_name," ",e.middle_name," ", e.last_name," ",
                      e.name_extension) AS fullname ');
        $this->db->from('users u');
        $this->db->join('employee e', 'u.employee_fk=e.id');
        $this->db->join('userrole r', 'u.id = r.user_fk');
        $this->db->where('e.region', $param['region']);
        $this->db->where('u.iisuserid !=', null);
       // $this->db->where('r.role_fk !=', 1); // This will excludee the super user
        $this->db->like('CONCAT(e.first_name," ",e.middle_name," ", e.last_name," ",
                      e.name_extension)', $param['search'], 'both');
        $this->db->limit($param['limit'], $param['offset']);
        $this->db->order_by('e.date_created', $param['sort']);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     *  Read data from database to show data in admin page
     * 
     * @param type $id
     * @return boolean or array
     */
    public function userInformation($iisuserid) {
        $this->db->select('*');
        $this->db->from('users u');
        $this->db->where('u.iisuserid', $iisuserid);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
        return false;
    }
    
    /**
     * Get emb personnel data
     * 
     * @param {array} $param
     * @return {array} Login 
     */
    public function embPersonnel($userid) {
        $this->embisdb->select('a.`userid`,
                        v.`region`,
                        a.`username`,
                        a.`en_password`,
                        v.`email`,
                        v.`pco_access`,
                        v.`prefix`,
                        v.`fname`,
                        v.`mname`,
                        v.`sname`,
                        v.`suffix`');
        $this->embisdb->from('acc a');
        $this->embisdb->join('view_userinfo v', 'a.userid = v.userid ');
        $this->embisdb->where('v.pco_access', 'yes');
        $this->embisdb->where('v.userid', $userid);
        $query = $this->embisdb->get();
        return $query->row();
    }

    /**
     * Authentication check for emb personnel
     * 
     * @param {array} $param Login form data
     * @return {array} Login data result.
     */
    public function AuthenticationCheck($param) {
        $this->embisdb->select('a.`userid`,
                        v.`region`,
                        a.`username`,
                        a.`en_password`,
                        v.`email`,
                        v.`pco_access`,
                        v.`prefix`,
                        v.`fname`,
                        v.`mname`,
                        v.`sname`,
                        v.`suffix`');
        $this->embisdb->from('acc a');
        $this->embisdb->join('view_userinfo v', 'a.userid = v.userid ');
        $this->embisdb->where('a.username', $param['username']);
        $this->embisdb->where('v.pco_access', 'yes');
        $query = $this->embisdb->get();
        if ($query->num_rows() != 0) {
            $row = $query->row();
            if (password_verify($param['password'], $row->en_password)) {
                return $query->row();
            }
        }
        return false;
    }

    /**
     * Get user type
     */
    public function getUserType($id) {
        /*
          SELECT u.id, ur.role_fk, ur.is_active,r.label
          FROM users u
          JOIN userrole ur ON  ur.user_fk = u.id
          JOIN role r ON r.id = ur.role_fk
          WHERE u.id = 198
         */
        $this->db->select('u.id, ur.role_fk, ur.is_active,r.label');
        $this->db->from('users u');
        $this->db->join('userrole ur', 'ur.user_fk = u.id', 'left');
        $this->db->join('role r', 'r.id = ur.role_fk', 'left');
        $this->db->where('u.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getUserDesignationByEmployeeId($employeeId) {
        $this->db->select('u.id AS user_id, d.id AS designation_id, d.label');
        $this->db->from('users u');
        $this->db->join('designation d', 'd.id = u.designation_fk', 'left');
        $this->db->where('u.employee_fk', $employeeId);
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Get user employee designation.
     */
    public function getUserDesignation($id) {
        /**
          SELECT u.id, d.id, d.label
          FROM users u
          JOIN designation d ON d.id = u.designation_fk
          WHERE u.id = 299
         */
        $this->db->select('u.id AS user_id, d.id AS designation_id, d.label');
        $this->db->from('users u');
        $this->db->join('designation d', 'd.id = u.designation_fk', 'left');
        $this->db->where('u.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Get employee id by user id.
     * 
     * @param type $id
     * @return boolean
     */
    public function getEmployeeByID($id) {
        try {
            $this->db->select('*');
            $this->db->from('users e');
            $this->db->where('e.employee_fk', $id);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                return $query->row_array();
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
        return false;
    }

    /*
     * Gat all user 
     */

    public function getAllUsers() {
        $this->db->select('*');
        $this->db->from('users u');
        $this->db->where('u.id <>', $this->session->userdata['user']['id']);
        $this->db->where('u.is_active', 1);
        $this->db->where('u.is_email_verify', 1);
        $this->db->where('u.notification', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /**
     * Check the if PCO by id
     * 
     * @param {int} $id accnount fk or employee fk 
     */
    public function isPCO($id) {
        log_message('debug', 'id::: ' . $id);
        // User id
        $userId = $this->getUserID($id);
        log_message('debug', 'user id::: ' . $userId['id']);
        // User type
        $userType = $this->getUserType($userId['id']);
        log_message('debug', 'user type::: ' . $userType['role_fk']);
        if ($userType['role_fk'] == EMPLOYEE) {
            return 0;
        }
        if ($userType['role_fk'] == PCO) {
            return 1;
        }

        return 0;
    }

    /**
     * Get (forwarded to)  user full name.
     * 
     * @param {int} $id accnount fk or employee fk 
     */
    public function getForwardedToNameByID($id) {
        // User id
        $userId = $this->getUserID($id);

        //var_dump($userId);
        // User type
        $userType = $this->getUserType($userId['id']);

        //var_dump($userType['role_fk']);

        switch ($userType['role_fk']) {
            case EMPLOYEE:
                $employeeName = $this->getEmployeeUserFullName($id);
                //var_dump($employeeName);
                return $employeeName;
            case PCO:
                $pcoName = $this->getAccountUserFullName($id);
                //var_dump($pcoName);
                return $pcoName;
            default:
                break;
        }
        return null;
    }

    /**
     * Get user id by employee fk
     * 
     * @param {int} $fk account fk or employee fk
     * 
     * @return {int} User id
     */
    public function getUserID($fk) {

        $this->db->select('u.id');
        $this->db->from('users u');
        $this->db->where('u.account_fk', $fk);
        $query = $this->db->get();
        $res = $query->row_array();
        if ($res['id'] != null) {
            return $res; // Accout user id
        } else {
            $this->db->select('u.id');
            $this->db->from('users u');
            $this->db->where('u.employee_fk', $fk);
            $query = $this->db->get();
            $res = $query->row_array();
            return $res; // Employee user id
        }

        return;
    }

    /**
     * Get account user full name by id
     */
    public function getAccountUserFullName($id) {
        $this->db->select('id,first_name,middle_name,last_name,name_extension');
        $this->db->from('account a');
        $this->db->where("a.id", $id);
        $query = $this->db->get();
        $res = $query->row_array();
        return $res['first_name'] . " " . $res['middle_name'] . ". " . $res['last_name'] . " " . $res['name_extension'];
    }

    /**
     * Get employee user full name by id
     */
    public function getEmployeeUserFullName($id) {
        $this->db->select('id,first_name,middle_name,last_name,name_extension');
        $this->db->from('employee e');
        $this->db->where("e.id", $id);
        $query = $this->db->get();
        $res = $query->row_array();
        return $res['first_name'] . " " . $res['middle_name'] . ". " . $res['last_name'] . " " . $res['name_extension'];
    }

    /**
     * Get user information by id
     */
    public function getUserInformation($id) {
        $this->db->select('*');
        $this->db->from('users u');
        $this->db->where("u.id", $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Get employee user full name by id
     * 
     * @return {array} Account or employee full name.
     */
    public function getUserFullName($id) {
        $query = $this->getUserInformation($id);
        if (isset($query['account_fk'])) {
            return $this->getAccountUserFullName($query['account_fk']);
        }
        if (isset($query['employee_fk'])) {
            return $this->getEmployeeUserFullName($query['employee_fk']);
        }
    }

    /**
     * Get employee user full name by id
     * 
     * @return {array} Account or employee full name.
     */
    public function getCommentUserFullName($id) {
        $query = $this->getUserInformation($id);
        if (isset($query['account_fk'])) {
            return $this->getAccountUserFullName($query['account_fk']);
        }
        if (isset($query['employee_fk'])) {
            return $this->getEmployeeUserFullName($query['employee_fk']);
        }
    }

    public function GetUserData() {
        $id = $this->session->userdata['user']['id'];
        $query = $this->getUserInformation($id);
        if (isset($query['account_fk'])) {
            $this->db->select('a.id, a.first_name, a.last_name, a.middle_name, a.name_extension,
            a.sex, a.citizenship,a.address');
            $this->db->from('account a');
            $this->db->join('users u', 'u.account_fk = a.id', 'left');
            $this->db->where("a.id", $this->session->userdata['user']['account_fk']);
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query) {
                return $query->row_array();
            } else {
                return false;
            }
        }
        if (isset($query['employee_fk'])) {
            $this->db->select('e.id, e.first_name, e.last_name, e.middle_name, e.name_extension, e.date_of_birth, e.place_of_birth,
            e.sex, e.civil_status_fk,e.citizenship,e.mobile_no,e.address,
            e.is_active, e.date_created, u.email');
            $this->db->from('employee e');
            $this->db->join('users u', 'u.employee_fk = e.id', 'left');
            $this->db->where("e.id", $this->session->userdata['user']['employee_fk']);
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query) {
                return $query->row_array();
            } else {
                return false;
            }
        }
    }

    /**
     * Check the email add.
     * 
     * @param {String} $Email Description
     * @return 
     */
    public function isEmailExist($email) {
        $this->db->select('id, email');
        $this->db->from($this->User);
        $this->db->where('email', $email);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    /**
     * Generate PCO id
     */
    public function generatePCOID() {
        $this->db->select('a.id, a.pco_id');
        $this->db->from('account a');
        $this->db->where('a.pco_id IS NOT NULL');
        $this->db->order_by('a.id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $res = $query->row_array();
        if (isset($res['pco_id'])) {
            $id = substr($res['pco_id'], 5);
            $generatedID = $id + 1;
            return 'PCO#-' . $generatedID;
        } else {
            return 'PCO#-1';
        }
    }

    /**
     * Generate PCO user emp_id
     */
    public function generatePCOEmployeeID() {
        $this->db->select('e.id, e.emp_id');
        $this->db->from('employee e');
        $this->db->where('e.emp_id IS NOT NULL');
        $this->db->order_by('e.id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $res = $query->row_array();
        if (isset($res['emp_id'])) {
            $id = substr($res['emp_id'], 8);
            $generatedID = $id + 1;
            return 'EMBR11#-' . $generatedID;
        } else {
            return 'EMBR11#-1';
        }
    }

    /**
     * Update email status by id
     * 
     * @param {int} $userID Description
     * @return {Boolean} Description
     */
    public function updateEmailVerificationStatus($userID) {
        // Update email status.
        $result = $this->db->update('users', ['is_email_verify' => 1], ['id' => $userID]);
        if ($result == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function PictureUrl() {
        $this->db->select('id,employee_photo_fk');
        $this->db->from($this->Employee);
        $this->db->where("id", $this->session->userdata['user']['id']);
        $this->db->limit(1);
        $query = $this->db->get();
        $res = $query->row_array();
        if (!empty($res['employee_photo_fk'])) {
            return base_url('uploads/profiles/' . $res['picture_url']);
        } else {
            return base_url('public/images/user-icon.jpg');
        }
    }
    
    /**
     * Grant the user for pco system access 
     * 
     */
    public function grantIISUser($param) {
        $this->db->trans_start();
        $employee = [
            'region'=>$param['region'],
            //'prefix'=> $param['suffix'],
            'first_name'=> $param['first_name'],
            'last_name'=> $param['last_name'],
            'middle_name'=> $param['middle_name'],
            'name_extension'=> $param['name_extension'],
            'is_active'=> 1,     
            'date_created'=> date('Y-m-d H:i:s')
        ];
        $this->db->insert('employee', $employee);
        $employeeId = $this->db->insert_id();
        
        $users = [
            'iisuserid'=> intval($param['userid']),
            'employee_fk'=> $employeeId,
            'designation_fk'=> $param['designation'],
            'is_active'=> 1,     
            'is_email_verify'=> 1,
            'notification'=> 1,
            'email'=> $param['email'],
            'date_created'=> date('Y-m-d H:i:s')
        ];
        $this->db->insert('users', $users);
        $userId = $this->db->insert_id();
        $userrole = [
            'user_fk' => $userId,
            'role_fk' => intval($param['role']),
            'is_active' => 1,
            'date_created' => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('userrole', $userrole);
        
        $this->db->trans_complete();
        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            $response = array('is_success'=>0);
        } else {
            $this->db->trans_commit();
            $response = array('is_success'=>1);
        }
        
        return $response;
    }

    /**
     * Create user credentials
     * @param {array} $data Description
     */
    public function createUserCredentials($data) {
        $this->db->trans_start();
        
        $id = NULL;
        // For PCO user employee.
        $userRole = array();
        array_push($userRole, $data['role_fk']);
        if (count(array_intersect($userRole, [SUPER_USER, SYSTEM_ADMINISTRATOR, EMPLOYEE]))) {
            $userData = [
                'emp_id' => $this->generatePCOEmployeeID(), // Insert initial data to employee table.
                'date_created' => date('Y-m-d H:i:s')
            ];
            $res = $this->db->insert('employee', $userData);
            $id = $this->db->insert_id(); // Employee id
            $data['employee_fk'] = $id; // Insert employee fk to user table.
        }

        // For PCO user
        if ($data['role_fk'] == PCO) {
            $userData = [
                'pco_id' => $this->generatePCOID(), // Insert initial data to account table.             
                'date_created' => date('Y-m-d H:i:s')
            ];
            $res = $this->db->insert('account', $userData);
            $id = $this->db->insert_id(); // PCO id
            $data['account_fk'] = $id; // Insert account fk to user table.
            $data['designation_fk'] = NULL;
        }

        // Create user and userrole credentials
        $role = $data['role_fk'];
        unset($data['role_fk']); // Remove role_fk element.
        $res = $this->db->insert($this->User, $data);
        if ($res == 1) {
            $id = $this->db->insert_id();
            $userrole = [
                'user_fk' => $id,
                'role_fk' => $role,
                'is_active' => 1,
                'date_created' => $data['date_created'],
            ];
            $this->db->insert('userrole', $userrole);
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    /**
     * Edit user credentials.
     * @param type $data
     */
    public function editUserCredentials($data) {
        // Check user type.
        $userRole = array($data['role_fk']);
        if (count(array_intersect($userRole, [SUPER_USER, SYSTEM_ADMINISTRATOR, EMPLOYEE]))) {
            $userID = $data['id'];
            $role['role_fk'] = $data['role_fk'];
            // Remove the element that no included on the table.
            unset($data['id']);
            unset($data['role_fk']);

            // Update user table.
            $isUpdate = $this->db->update('users', $data, ['id' => $userID]);
            if ($isUpdate == 1) {
                // Update the userrole table.
                $this->db->update('userrole', $role, ['user_fk' => $userID]);
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Update user profile image.
     * 
     * @param {array} $data Description
     */
    public function UpdateProfileImageByUserID($data) {
        $this->db->select('a.id,a.used_to');
        $this->db->from('attachment a');
        $this->db->where('a.user_fk', $this->session->userdata['user']['id']);
        $this->db->where('a.used_to', 'PROFILE_PHOTO');
        $query = $this->db->get();
        $res = $query->row_array();
        // Update the attachment
        if (isset($res['used_to'])) {
            $isUpdate = $this->db->update('attachment', ['file_name' => $data['file_name']], ['id' => $res['id']]);
            if ($isUpdate == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            $isInsert = $this->db->insert('attachment', $data);
            if ($isInsert == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Update user signature image
     * 
     * @param {array} $data Description
     */
    public function UpdateUserSignatureImageByUserID($data) {
        $this->db->select('a.id,a.used_to');
        $this->db->from('attachment a');
        $this->db->where('a.user_fk', $this->session->userdata['user']['id']);
        $this->db->where('a.used_to', 'USER_SIGNATURE');
        $query = $this->db->get();
        $res = $query->row_array();
        // Update the attachment
        if (isset($res['used_to'])) {
            $isUpdate = $this->db->update('attachment', ['file_name' => $data['file_name']], ['id' => $res['id']]);
            if ($isUpdate == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            $isInsert = $this->db->insert('attachment', $data);
            if ($isInsert == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Update PCO PRC License data.
     */
    public function UpdatePCOPRCLicenseByUserID($data) {
        // We need to separate the data array into two table.
        // License data.. 
        $license_data = [
            'account_fk' => $data['account_fk'],
            'license_no' => $data['license_no'],
            'date_issued' => $data['date_issued'],
            'validity' => $data['validity'],
            'date_created' => $data['date_created']
        ];
        // Attachment data...
        $attachment_data = [
            'used_to' => $data['used_to'],
            'file_name' => $data['file_name'],
            'user_fk' => $data['user_fk'],
            'date_created' => $data['date_created']
        ];

        // License data for update...
        $update_license_data = [
            'license_no' => $data['license_no'],
            'date_issued' => $data['date_issued'],
            'validity' => $data['validity'],
            'date_modified' => $data['date_modified']
        ];

        // This is for new or add new license.
        if (isset($data['add_license_data']) && $data['add_license_data'] == true) {
            // Remove the license data so can record the attachment data only.
            unset($data['account_fk']);
            unset($data['license_no']);
            unset($data['date_issued']);
            unset($data['validity']);
            // Insert attachment data...
            $is_attachment = $this->db->insert('attachment', $attachment_data);
            if ($is_attachment) {
                $attachment_fk = $this->db->insert_id();
                // Add attachmen_fk element into the array...
                $license = [
                    'account_fk' => $license_data['account_fk'],
                    'attachment_fk' => $attachment_fk,
                    'license_no' => $license_data['license_no'],
                    'date_issued' => $license_data['date_issued'],
                    'validity' => $license_data['validity'],
                    'date_created' => $license_data['date_created']
                ];
                $is_recorded = $this->db->insert('license', $license);
                if ($is_recorded) {
                    return true;
                }
                return false;
            } else {
                return false;
            }
        }

        // Attachment and license table...
        if (isset($data['update_attachment_data']) && $data['update_attachment_data'] == true) {
            // Select the attachment data first if the data is in the table...
            $this->db->select('a.id');
            $this->db->from('attachment a');
            $this->db->where('a.id', $data['attachment_id']);
            $query = $this->db->get();
            $res = $query->row_array();
            // Update the attachment
            if (isset($res['id'])) {
                // update attachment file name.
                $is_update_att = $this->db->update('attachment', ['file_name' => $data['file_name']], ['id' => $res['id']]);
                if ($is_update_att) {
                    // Update the license data...
                    $is_update_work_ex = $this->db->update('license', $update_license_data, ['id' => $data['license_id']]);
                    if ($is_update_work_ex) {
                        return true;
                    }
                    return false;
                } else {
                    return false;
                }
            }
        }

        // License data
        if (isset($data['update_license_data']) && $data['update_license_data'] == true) {
            // Update the license table. Data only
            $is_update_license = $this->db->update('license', $update_license_data, ['id' => $data['license_id']]);
            if ($is_update_license) {
                return true;
            }
            return false;
        }
    }

    /**
     * Update PCO work experience data.
     * 
     * @param {array} $data Description
     */
    public function UpdatePCOWorkExperienceByUserID($data) {

        // Array data. Get the data first so we can use the data later...
        $workExperienceId = $data['work_experience_id'];
        $upWorkExData = [
            'company' => $data['company'],
            'position' => $data['position'],
            'employment_status' => $data['employment_status'],
            'from_date' => $data['from_date'],
            'to_date' => $data['to_date'],
            'present' => $data['present'],
            'attachment_fk' => $data['attachment_id'],
            'date_modified' => date('Y-m-d H:i:s')
        ];

        // Update work experience data only...
        if (isset($data['is_work_ex_data']) && $data['is_work_ex_data'] == 'true') {
            $isUpdateWorkEx = $this->db->update('work_experience', $upWorkExData, ['id' => $workExperienceId]);
            if ($isUpdateWorkEx) {
                return true;
            }
            return false;
        }

        // Select the attachment data first if the data is in the table...
        $this->db->select('a.id');
        $this->db->from('attachment a');
        $this->db->where('a.id', $data['attachment_id']);
        $query = $this->db->get();
        $res = $query->row_array();
        // Update the attachment
        if (isset($res['id'])) {
            // Remove the data that not included in the attachment table...
            unset($data['is_work_ex_data']);
            unset($data['work_experience_id']);
            unset($data['used_to']);
            unset($data['user_fk']);
            unset($data['company']);
            unset($data['position']);
            unset($data['employment_status']);
            unset($data['from_date']);
            unset($data['to_date']);
            unset($data['present']);

            // update attachment file name.
            $isUpdateAtt = $this->db->update('attachment', ['file_name' => $data['file_name']], ['id' => $res['id']]);
            if ($isUpdateAtt) {
                $isUpdateWorkEx = $this->db->update('work_experience', $upWorkExData, ['id' => $workExperienceId]);
                if ($isUpdateWorkEx) {
                    return true;
                }
                return false;
            } else {
                return false;
            }
        } else {

            // Array data
            $workExData = [
                'account_fk' => $data['account_fk'],
                'company' => $data['company'],
                'position' => $data['position'],
                'employment_status' => $data['employment_status'],
                'from_date' => $data['from_date'],
                'to_date' => $data['to_date'],
                'present' => $data['present'],
            ];

            // Remove the data...
            unset($data['account_fk']);
            unset($data['company']);
            unset($data['position']);
            unset($data['employment_status']);
            unset($data['from_date']);
            unset($data['to_date']);
            unset($data['present']);
            // Insert attachment data...
            $isAttachment = $this->db->insert('attachment', $data);
            if ($isAttachment) {
                $attachmentFk = $this->db->insert_id();
                // Add attachmen_fk element into the array...
                $wEData = [
                    'account_fk' => $workExData['account_fk'],
                    'company' => $workExData['company'],
                    'position' => $workExData['position'],
                    'employment_status' => $workExData['employment_status'],
                    'from_date' => $workExData['from_date'],
                    'to_date' => $workExData['to_date'],
                    'present' => $workExData['present'],
                    'attachment_fk' => $attachmentFk,
                    'date_created' => date('Y-m-d H:i:s')
                ];
                $isInsertWE = $this->db->insert('work_experience', $wEData);
                if ($isInsertWE) {
                    return true;
                }
                return false;
            } else {
                return false;
            }
        }
    }

    //UpdatePCOTrainingAndSeminarsByUserID

    /**
     * Update PCO training and seminars table data.
     * 
     * @param {array} $data Description
     */
    public function updatePCOTrainingAndSeminarsByUserID($data) {

        // Array data. Get the data first so we can use the data later...
        $trainingAndSeminarsId = $data['training_and_seminars_id'];
        $trainingAndSeminarsData = [
            'title' => $data['edit_title'],
            'no_of_hours' => $data['edit_no_of_hours'],
            'attachment_fk' => $data['attachment_id'],
            'date_modified' => date('Y-m-d H:i:s')
        ];

        // Update training and seminars table data only...
        if (isset($data['is_training_seminars_data']) && $data['is_training_seminars_data'] == 'true') {
            $isUpdateTrainingSeminars = $this->db->update('training_and_seminars', $trainingAndSeminarsData, ['id' => $trainingAndSeminarsId]);
            if ($isUpdateTrainingSeminars) {
                return true;
            }
            return false;
        }

        // Select the attachment data first if the data is in the table...
        $this->db->select('a.id');
        $this->db->from('attachment a');
        $this->db->where('a.id', $data['attachment_id']);
        $query = $this->db->get();
        $res = $query->row_array();
        // Update the attachment
        if (isset($res['id'])) {
            // Remove the data that not included in the attachment table...
            unset($data['user_fk']);
            unset($data['training_and_seminars_id']);
            unset($data['attachment_id']);
            unset($data['used_to']);
            unset($data['edit_title']);
            unset($data['edit_no_of_hours']);
            // update attachment file name.
            $isUpdateAtt = $this->db->update('attachment', ['file_name' => $data['file_name']], ['id' => $res['id']]);
            if ($isUpdateAtt) {
                $isUpdateTrainingSeminars = $this->db->update('training_and_seminars', $trainingAndSeminarsData, ['id' => $trainingAndSeminarsId]);
                if ($isUpdateTrainingSeminars) {
                    return true;
                }
                return false;
            } else {
                return false;
            }
        } else {

            // Array data
            $trainingAndSeminarsData = [
                'account_fk' => $data['account_fk'],
                'title' => $data['title'],
                'no_of_hours' => $data['no_of_hours'],
                'date_modified' => date('Y-m-d H:i:s')
            ];

            // Remove the data...
            unset($data['account_fk']);
            unset($data['title']);
            unset($data['no_of_hours']);
            // Insert attachment data...
            $isAttachment = $this->db->insert('attachment', $data);
            if ($isAttachment) {
                $attachmentFk = $this->db->insert_id();
                // Add attachmen_fk element into the array...
                $tSData = [
                    'account_fk' => $trainingAndSeminarsData['account_fk'],
                    'title' => $trainingAndSeminarsData['title'],
                    'no_of_hours' => $trainingAndSeminarsData['no_of_hours'],
                    'attachment_fk' => $attachmentFk,
                    'date_created' => date('Y-m-d H:i:s')
                ];

                $isInsertWE = $this->db->insert('training_and_seminars', $tSData);
                if ($isInsertWE) {
                    return true;
                }
                return false;
            } else {
                return false;
            }
        }
    }

    /**
     * Get all the user role id and label
     */
    public function getUserRole() {
        $this->db->select('r.id,r.label');
        $this->db->from('role r');
        $this->db->where('r.is_active', 1);
        $this->db->where('r.label !=', "PCO");
        $this->db->where('r.label !=', "Super User");
        $result = $this->db->get();
        return $result->result_array();
    }

    /**
     * Get all the user role id and label
     */
    public function getUserRoleLabel() {
        $this->db->select('r.id,r.label');
        $this->db->from('role r');
        $this->db->where('r.is_active', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /**
     * Get all the user role id and label
     * 
     * Get user role label by id 
     * SELECT ur.user_fk, ur.role_fk, r.label
     * FROM userrole ur
     * JOIN role r ON  r.id = ur.role_fk
     * WHERE ur.user_fk = 198
     */
    public function getUserRoleLabelByID($id) {
        $this->db->select('ur.user_fk, ur.role_fk, r.label');
        $this->db->from('userrole ur');
        $this->db->join('role r', 'r.id = ur.role_fk ');
        $this->db->where('ur.user_fk', $id);
        $this->db->where('ur.is_active', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /**
     * Get all the employee position id and label
     */
    public function getEmployeeDesignationLabelByID($id) {
        $this->db->select('d.id,d.label');
        $this->db->from('designation d');
        $this->db->where('d.id', $id);
        $this->db->where('d.is_active', 1);
        $result = $this->db->get();
        return $result->row_array();
    }

    /**
     * Get all the employee position id and label
     */
    public function getEmployeeDesignationLabel() {
        $this->db->select('d.id,d.label');
        $this->db->from('designation d');
        $this->db->where('d.is_active', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function UpdateCustomerProfileImageByID($data) {

        $res = $this->db->update($this->User, $data, ['id' => $this->session->userdata['User']['id']]);

        if ($res == 1)
            return true;
        else
            return false;
    }

    /**
     * Add PCO user online registration
     * 
     * @param {array} $data user data.
     */
    public function addPCOUser($data) {
        // PCO user data 
        $pcoUserData = [
            'pco_id' => $this->generatePCOID(), // Insert initial data to account table.             
            'date_created' => date('Y-m-d H:i:s')
        ];
        // Create account
        $this->db->insert('account', $pcoUserData);
        $id = $this->db->insert_id(); // PCO id
        $data['account_fk'] = $id;

        // Create user  
        $res = $this->db->insert($this->User, $data);
        if ($res == 1) {
            $id = $this->db->insert_id();
            $userrole = [
                'user_fk' => $id,
                'role_fk' => 4,
                'is_active' => 1,
                'date_created' => date('Y-m-d H:i:s'),
            ];
            // Create user role.
            $this->db->insert('userrole', $userrole);
            // return
            return $id;
        } else {
            return false;
        }
    }

}
