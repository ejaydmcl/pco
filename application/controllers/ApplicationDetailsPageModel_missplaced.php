<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application details page model
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class ApplicationDetailsPageModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }
    
	/**
     * Get the COA expiration date
     * 
     * @param {int} coa id.
     */
    public function getCOAExpirationDate($coa_id) {
        $this->db->select('c.valid_until');
        $this->db->from('cetificate_of_accreditation c');
        $this->db->where('c.id', $coa_id);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
           return $query->row_array();
           
        }
        return false;
    }
	
    /**
	
     * Get system user type PCO applicant or employee
     * @param {int} $id User id.
     * 
     * @return {boolean} Description
     */
    public function getSysTemUserType($id) {
        $result = null;
        $query = $this->UserModel->getUserInformation($id);
        if (isset($query['account_fk'])) {
            $result = USER_APPLICANT; // 0
        }
        if (isset($query['employee_fk'])) {
            $result = USER_EMPLOYEE; // 1
        }
        return $result;
    }
    
    /**
     * Get PCO user label by user id.
     * 
     * SELECT 
     *   u.id,
     *   ur.role_fk,
     *   ur.is_active,
     *   r.label 
     * FROM
     *   users u 
     *   JOIN userrole ur 
     *     ON ur.user_fk = u.id 
     *   JOIN role r 
     *     ON r.id = ur.role_fk 
     * WHERE ur.`role_fk` = 4 
     *   AND u.id = 374
     * 
     * @param {int} $id PCO user id.
     */
    public function getPCOUserLabelByID($id){
        $this->db->select('u.id,ur.role_fk,ur.is_active,r.label');
        $this->db->from('users u');
        $this->db->join('userrole ur','ur.user_fk=u.id');
        $this->db->join('role r','r.id=ur.role_fk');
        $this->db->where('ur.role_fk',PCO);
        $this->db->where('u.id',$id);
        $query = $this->db->get();
        return $query->row_array();   
    }


    /**
     * Create application coa number.
     * 
     * @param {int} $approvedByUserFk Description
     * @param {int} $applicationFk Description
     * @param {int} $statusFK Description
     * 
     * @return {boolean} True of false
     */
    public function createCOANo($approvedByUserFk,$applicationTypeFk,$applicationFk) {
        $dateApproved = date('Y-m-d H:i:s'); // The approved date of the application
        // date("Y-m-d H:i:s", strtotime("+1 years", strtotime('2014-05-22 10:35:10'))); //2015-05-22 10:35:10
        //  date("Y-m-d H:i:s", strtotime("+1 months", strtotime('2014-05-22 10:35:10')));//2014-06-22 10:35:10
        // date("Y-m-d H:i:s", strtotime("+1 days", strtotime('2014-05-22 10:35:10')));//2014-05-23 10:35:10
        // date("Y-m-d H:i:s", strtotime("+1 hours", strtotime('2014-05-22 10:35:10')));//2014-05-22 11:35:10
        // date("Y-m-d H:i:s", strtotime("+1 minutes", strtotime('2014-05-22 10:35:10')));//2014-05-22 10:36:10
        // date("Y-m-d H:i:s", strtotime("+1 seconds", strtotime('2014-05-22 10:35:10')));//2014-05-22 10:35:11
        // Certificcate of accreditation data.
        $data = [
            'application_fk' => $applicationFk,
            'application_type_fk' => $applicationTypeFk,
            'coa_no' => $this->getCOANo(),
            'date_approved' => $dateApproved,
            'valid_until' => date('Y-m-d H:i:s', strtotime("+3 years", strtotime($dateApproved))),
            'approved_by_user_fk' => $approvedByUserFk,
            'date_created' => date('Y-m-d H:i:s'),
        ];
        // Insert the data.
        $res = $this->db->insert('cetificate_of_accreditation', $data);
        if ($res == 1) {
            $id = $this->db->insert_id();
            return $id; // return true if the insert was succesfull.
        } 
        return false; // return false if the insert was not succesfull.
    }
    
     /**
     * Create application coa number for renewal application.
     * 
     * @param {int} $approvedByUserFk Description
     * @param {int} $applicationFk Description
     * @param {int} $statusFK Description
     * 
     * @return {boolean} True of false
     */
    public function createCOANoForRenewal($approvedByUserFk,$applicationOriginID) {
        $dateApproved = date('Y-m-d H:i:s'); // The approved date of the application
        // date("Y-m-d H:i:s", strtotime("+1 years", strtotime('2014-05-22 10:35:10'))); //2015-05-22 10:35:10
        //  date("Y-m-d H:i:s", strtotime("+1 months", strtotime('2014-05-22 10:35:10')));//2014-06-22 10:35:10
        // date("Y-m-d H:i:s", strtotime("+1 days", strtotime('2014-05-22 10:35:10')));//2014-05-23 10:35:10
        // date("Y-m-d H:i:s", strtotime("+1 hours", strtotime('2014-05-22 10:35:10')));//2014-05-22 11:35:10
        // date("Y-m-d H:i:s", strtotime("+1 minutes", strtotime('2014-05-22 10:35:10')));//2014-05-22 10:36:10
        // date("Y-m-d H:i:s", strtotime("+1 seconds", strtotime('2014-05-22 10:35:10')));//2014-05-22 10:35:11
        // Certificcate of accreditation data.
        $data = [
            'application_fk' => $applicationOriginID,
            'application_type_fk' => RENEWAL,
            'coa_no' => $this->getCOANoForRenewal($applicationOriginID),
            'date_approved' => $dateApproved,
            'valid_until' => date('Y-m-d H:i:s', strtotime("+3 years", strtotime($dateApproved))),
            'approved_by_user_fk' => $approvedByUserFk,
            'date_created' => date('Y-m-d H:i:s'),
        ];
        // Insert the data.
        $res = $this->db->insert('cetificate_of_accreditation', $data);
        if ($res == 1) {
            $id = $this->db->insert_id();
            return $id; // return true or id if the insert was succesfull. 
        } 
        return false; // return false if the insert was not succesfull.
    }
    
    /**
     * Get the coa number for the newly approved application.
     * 
     * @return {string} COA number.
     */
    public function getCOANo() {
        $this->db->select('c.coa_no');
        $this->db->from('cetificate_of_accreditation c');
        $this->db->where('c.coa_no IS NOT NULL');
        $this->db->order_by('c.coa_no','DESC');
        $query = $this->db->get();
        $res = $query->row_array();
        $dateTime = new DateTime();
        $year = $dateTime->format('Y');
        if(isset($res['coa_no'])) {
            $id = substr($res['coa_no'], 17); // Omit the string.
            $generatedID = $id + 1; // Increment the coa id number.
            return 'COA No. '. $year . '-RXI-'. str_pad($generatedID, 4, '0', STR_PAD_LEFT); // return the string.
        } else {
            return 'COA No. '. $year . '-RXI-'. str_pad(1, 4, '0', STR_PAD_LEFT); // return the string.
        }
    }
    
     /**
     * Get the coa number for the newly approved application.
     * 
     * @return {string} COA number.
     */
    public function getCOANoForRenewal($applicationOriginID) {
        $this->db->select('c.coa_no');
        $this->db->from('cetificate_of_accreditation c');
        $this->db->where('c.coa_no IS NOT NULL');
        $this->db->where('c.application_fk', $applicationOriginID);
        $this->db->where('c.application_type_fk', 1); // 1 is application type which is new application.
        $query = $this->db->get();
        $res = $query->row_array();
        // Return the coa.
        return $res['coa_no'];
    }

    /**
     * Update the submitted application...
     * 
     * @param {int} $id Application id
     * @param {array} $data application data.
     */
    public function updateApplicationByID($id, $data) {
        $result = $this->db->update('application', $data, ['id' => $id]);
        if ($result == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get pco employee
     * Get the list of employee where role id is 3  
     * 
     * SELECT u.id, ur.role_fk, u.employee_fk, u.designation_fk 
     * FROM users u
     * JOIN userrole ur ON  ur.user_fk = u.id
     * WHERE u.is_active = 1 AND u.employee_fk IS NOT NULL AND u.designation_fk IS NOT NULL AND ur.role_fk = 3
     * 
     * @return {string} List of employee
     */
    public function getListOfEmployee() {
        $this->db->select('u.id,u.employee_fk');
        $this->db->from('users u');
        $this->db->join('userrole ur', 'ur.user_fk = u.id');
        $this->db->where('u.is_active',1);
        $this->db->where('u.employee_fk IS NOT ',NULL);
        $this->db->where('u.designation_fk IS NOT ',NULL);
        $this->db->where('ur.role_fk', EMPLOYEE);
        $result = $this->db->get();
        return $result->result_array();
    }
    
    /**
     * Get list of specific employee. 
     * 
     * --- SECTION CHIEF: Query to get the evaluator and division chief
     * SELECT 
     *   u.id,
     *   ur.role_fk,
     *   u.employee_fk,
     *   u.designation_fk,
     *   u.is_active
     * FROM
     *   users u 
     *   JOIN userrole ur 
     *     ON ur.user_fk = u.id 
     * WHERE u.employee_fk IS NOT NULL 
     *   AND u.designation_fk IS NOT NULL 
     *   AND ur.role_fk = 3 
     *   AND u.`designation_fk` = 2
     *   OR u.`designation_fk` = 5
     *   AND u.is_active = 1 
     * ----------------------------------------------
     * 
     * --- EVALUATOR: Query to get the section chief and pco
     *  SELECT 
     *   u.id,
     *   ur.role_fk,
     *   u.employee_fk,
     *   u.designation_fk,
     *   u.is_active 
     * FROM
     *   users u 
     *   JOIN userrole ur 
     *     ON ur.user_fk = u.id 
     * WHERE u.`designation_fk` = 3 
     *   AND ur.role_fk = 3 
     *   OR ur.`role_fk` = 4 
     *   AND u.is_active = 1 
     * --------------------------------------------
     * 
     * ---- DIVISION CHIEF: Query to get the section chief and regional director
     * SELECT 
     *   u.id,
     *   ur.role_fk,
     *   u.employee_fk,
     *   u.designation_fk,
     *   u.is_active 
     * FROM
     *   users u 
     *   JOIN userrole ur 
     *     ON ur.user_fk = u.id 
     * WHERE u.employee_fk IS NOT NULL 
     *   AND u.designation_fk IS NOT NULL 
     *   AND ur.role_fk = 3 
     *   AND u.`designation_fk` = 1 
     *   OR u.`designation_fk` = 3 
     *   AND u.is_active = 1 
     * --------------------------------------------
     * 
     * --- REGIONAL DIRECTOR: Query to get the division chief 
     * SELECT 
     *   u.id,
     *   ur.role_fk,
     *   u.employee_fk,
     *   u.designation_fk,
     *   u.is_active 
     * FROM
     *   users u 
     *   JOIN userrole ur 
     *     ON ur.user_fk = u.id 
     * WHERE u.employee_fk IS NOT NULL 
     *   AND u.designation_fk IS NOT NULL 
     *   AND ur.role_fk = 3 
     *   AND u.`designation_fk` = 2
     *   AND u.is_active = 1 
     * -------------------------------------------
     * 
     * @param {string} $id Current logged user id.
     * @return {string} List of string
     */
    public function getListOfUsersByDesignation($user) {
        $result = null;
        // Determine the user type.
        $designation = $this->UserModel->getUserDesignation($user['user_id']);
        //log_message('debug', 'Designation => '. $designation['designation_id']);
        
        //var_dump($designation['designation_id']);
        
        /*if($user['account_id'] == $user['forwarded_to']) {
            //var_dump($user['account_id']);
            //return $this->UserModel->getForwardedToNameByID($user['forwarded_to']);
            $forwardedTo = PCO;
        } else {
            $forwardedTo = $designation['designation_id'];
        }*/
        
        // Execute the query base on the user designation.
        //var_dump($designation['designation_id']);
        switch ($designation['designation_id']) {
            case SECTION_CHIEF:
                    // Query
                    $this->db->select('u.id,ur.role_fk,u.employee_fk,u.designation_fk,d.label,u.is_active');
                    $this->db->from('users u');
                    $this->db->join('userrole ur', 'ur.user_fk = u.id');
                    $this->db->join('designation d', 'u.designation_fk = d.id');
                    $this->db->where('u.employee_fk IS NOT NULL');
                    $this->db->where('u.designation_fk IS NOT NULL');
                    $this->db->where('ur.role_fk',EMPLOYEE);
                    $this->db->where('u.designation_fk', DIVISON_CHIEF);
                    $this->db->or_where('u.designation_fk', EVALUATOR);
                    $this->db->where('u.is_active', ACTIVE);
                    $result = $this->db->get();
                    return $result->result_array();
            case EVALUATOR:
                /**
                 * SELECT 
                    u.id,
                    ur.role_fk,
                    u.`account_fk`,
                    r.`label`,
                    u.is_active 
                  FROM
                    users u 
                    JOIN userrole ur 
                      ON ur.user_fk = u.id 
                    JOIN role r 
                      ON ur.`role_fk` = r.`id` 
                  WHERE u.`account_fk` = 3 
                    AND u.is_active = 1 
                */
                
                $list = array();
                // For pco.
                $this->db->select('u.id,ur.role_fk,u.account_fk,r.label,u.is_active');
                $this->db->from('users u');
                $this->db->join('userrole ur', 'ur.user_fk = u.id');
                $this->db->join('role r', 'ur.role_fk = r.id');
                $this->db->where('u.account_fk', $user['account_id']);
                $this->db->where('u.is_active',ACTIVE);
                $pco = $this->db->get();
                
                // For employee.
                /**
                 * SELECT 
                    u.id,
                    ur.role_fk,
                    u.employee_fk,
                    u.designation_fk,
                    d.`label`,
                    u.is_active 
                  FROM
                    users u 
                    JOIN userrole ur 
                      ON ur.user_fk = u.id 
                    JOIN designation d 
                      ON u.`designation_fk` = d.`id` 
                  WHERE u.`designation_fk` = 3 
                    AND u.is_active = 1 
                 */
                
                $this->db->select('u.id,ur.role_fk,u.employee_fk,u.designation_fk,d.`label`,u.is_active');
                $this->db->from('users u');
                $this->db->join('userrole ur', 'ur.user_fk = u.id');
                $this->db->join('designation d', 'u.designation_fk = d.id');
                $this->db->where('u.designation_fk', EMPLOYEE);
                $this->db->or_where('u.designation_fk', EVALUATOR);
                $this->db->where('u.is_active',ACTIVE);
                $employee = $this->db->get();
                
                
                return array_merge($pco->result_array(),$employee->result_array());    
                
            case DIVISON_CHIEF:
                $this->db->select('u.id,ur.role_fk, u.employee_fk,u.designation_fk,d.label,u.is_active ');
                $this->db->from('users u');
                $this->db->join('userrole ur','ur.user_fk = u.id');
                $this->db->join('designation d','u.designation_fk = d.id');
                $this->db->where('u.employee_fk IS NOT NULL ');
                $this->db->where('u.designation_fk IS NOT NULL');
                $this->db->where('ur.role_fk',EMPLOYEE);
                $this->db->where('u.designation_fk',REGIONAL_DIRECTOR);
                $this->db->or_where('u.designation_fk',EMPLOYEE);
                $this->db->where('u.is_active',ACTIVE);
                $result = $this->db->get();
                return $result->result_array();
            case REGIONAL_DIRECTOR:
                $this->db->select('u.id,ur.role_fk, u.employee_fk,u.designation_fk,d.label,u.is_active ');
                $this->db->from('users u');
                $this->db->join('userrole ur','ur.user_fk = u.id');
                $this->db->join('designation d','u.designation_fk = d.id');
                $this->db->where('u.employee_fk IS NOT NULL ');
                $this->db->where('u.designation_fk IS NOT NULL');
                $this->db->where('ur.role_fk',EMPLOYEE);
                $this->db->where('u.designation_fk',DIVISON_CHIEF);
                $this->db->where('u.is_active',ACTIVE);
                $result = $this->db->get();
                return $result->result_array();
                
            case PCO:
                
            default:
                break;
        }
        return null;
    }

    /**
     * Get application status.
     */
    public function getApplicationStatus($id) {
        // Determine the user type.
        $designation = $this->UserModel->getUserDesignation($id);
        
        // Status list
        $statusList = array();
        
        // Query the application status
        $this->db->select('as.id,as.label');
        $this->db->from('application_status as');
        $this->db->where('as.is_active',1);
        $result = $this->db->get();
        $list = $result->result_array();
        
       // var_dump($list);
       // var_dump($statusList);
        
        switch ($designation['designation_id']) {
            case SECTION_CHIEF:
                foreach ($list as $key => $value) {
                    $arrayKey = array($value['id']);
                    if(count(array_intersect($arrayKey, array(3,4)))) { // Add Ongoing and evaluated into status list
                        $statusList[$key] = $value;
                    }
                }
                return $statusList;
            case EVALUATOR:
                foreach ($list as $key => $value) {
                    $arrayKey = array($value['id']);
                    if(count(array_intersect($arrayKey, array(3,4)))) { // Add Ongoing and evaluated into status list
                        $statusList[$key] = $value;
                    }
                }
                return $statusList;
            case DIVISON_CHIEF:
                foreach ($list as $key => $value) {
                    $arrayKey = array($value['id']);
                    if(count(array_intersect($arrayKey, array(3,4)))) { // Add Ongoing and evaluated into status list
                        $statusList[$key] = $value;
                    }
                }
                return $statusList;
            case REGIONAL_DIRECTOR:
                foreach ($list as $key => $value) {
                    $arrayKey = array($value['id']);
                    if(count(array_intersect($arrayKey, array(5,6)))) { // Add Approved and denied into status list
                        $statusList[$key] = $value;
                    }
                }
                return $statusList;
            default:
                break;
        }
        
        /*$this->db->select('as.id,as.label');
        $this->db->from('application_status as');
        $this->db->where('as.is_active',1);
        $result = $this->db->get();
        return $result->result_array();*/
        return null;
    }
    
     /**
     *  Get user id by account id
     *  @param {int} $id Account id.
     */
    public function getUserIDByAccountID($id) {
        $this->db->select('*');
        $this->db->from('users u');
        $this->db->where("u.account_fk", $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Get profile photo
     * 
     * @param {int} $id User id
     */
    public function getSelectedPCOProfilePhoto($id) {
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
    
    /**
     * Get application details
     * 
     * @param {int} $id Application id.
     */
    public function getApplicationDetails($id) {
        $this->db->select('*');
        $this->db->from('application a');
        $this->db->where('a.id', $id);
        $result = $this->db->get();
        return $result->row_array();
    }
    
    /**
     * Get PCO employment status label by id.
     */
    public function getEmploymentStatusLabelByID($id) {
        $this->db->select('es.id,es.label');
        $this->db->from('employment_status es');
        $this->db->where('es.id', $id);
        $this->db->where('es.is_active',1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /**
     * Comments count.
     * 
     * @param {int} $id Application id
     * @return 
     */
    public function getApplicationsCommentsCount($id) {
        $this->db->select('id');
        $this->db->from('comments c');
        $this->db->where('c.application_fk', $id);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    /**
     * Notification count.
     * 
     * @param {int} $id Application id
     * @return 
     */
    public function getUserNotificationCount() {
        /*
          SELECT u.account_fk, app.name_of_establishment,co.`comment`,co.`application_fk`,co.`user_fk`,co.`i_see`
          FROM users u
          JOIN application app ON u.`account_fk` = app.`account_fk`
          JOIN comments co ON app.`id`= co.`application_fk`
          WHERE u.id = 261 AND co.`i_see`=0 AND co.`user_fk` <> 261
         */
        $this->db->select('u.id');
        $this->db->from('users u');
        $this->db->join('application app', 'u.account_fk=app.account_fk');
        $this->db->join('comments co', 'app.id=co.application_fk');
        $this->db->where('u.id', $this->session->userdata['user']['id']);
        $role = $this->session->userdata['user']['role_fk'];
        switch ($role) {
            case 1:
                $this->db->where('co.i_see_1', 0);
                break;
            case 2:
                $this->db->where('co.i_see_2', 0);
                break;
            case 3:
                $this->db->where('co.i_see_3', 0);
                break;
            case 4:
                $this->db->where('co.i_see_4', 0);
                break;
            case 5:
                $this->db->where('co.i_see_5', 0);
                break;
            default :
                break;
        }
        $this->db->where('co.`user_fk` <>', $this->session->userdata['user']['id']);
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    /**
     * Notification count.
     * 
     * @param {int} $id Application id
     * @return 
     */
    public function getUserNotificationCountForEmployee() {
        /*
          SELECT *
          FROM comments co
          WHERE co.`i_see_3`=0 AND co.`user_fk` <> 198
         */
        $this->db->select('co.id');
        $this->db->from('comments co');
        $this->db->where('co.user_fk <>', $this->session->userdata['user']['id']);
        $role = $this->session->userdata['user']['role_fk'];
        switch ($role) {
            case 1:
                $this->db->where('co.i_see_1', 0);
                break;
            case 2:
                $this->db->where('co.i_see_2', 0);
                break;
            case 3:
                $this->db->where('co.i_see_3', 0);
                break;
            case 4:
                $this->db->where('co.i_see_4', 0);
                break;
            case 5:
                $this->db->where('co.i_see_5', 0);
                break;
            default :
                break;
        }
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    /**
     * Get application table comments count.
     * 
     * @param {int} $id Application id.
     */
    public function getApplicationTableCommentsCount($id) {
        
        /*  
        SELECT i.id,i.user_fk,i.account_fk,i.employee_fk,i.application_fk,i.comments_fk,app.account_fk,i.flag_2 ,i.date_created
        FROM i_see i 
        JOIN application app ON i.application_fk = app.id
        JOIN users u ON i.employee_fk = u.employee_fk
        WHERE i.account_fk = 1 AND i.flag_2 = 0 AND i.user_fk <> 261
         */
        
        $this->db->select('n.id,n.employee_fk,n.application_fk,n.comments_fk,app.account_fk,n.flag_2 ,n.date_created');
        $this->db->from('notification n ');
        $this->db->join('application app', 'n.application_fk = app.id');
        $this->db->join('users u', 'n.employee_fk = u.employee_fk');
        $employeeFk = $this->session->userdata['user']['employee_fk'];
        if(isset($employeeFk)) {
            $this->db->where('n.employee_fk', $employeeFk);
        } else {
            $this->db->where('n.application_fk', $id);
        }
        $this->db->where('n.user_fk <>', $this->session->userdata['user']['id']);
        $this->db->where('n.application_fk', $id);
        $this->db->where('n.flag_2', 0);
        
//        
//        $this->db->select('*');
//        $this->db->from('comments c');
//        if (isset($this->session->userdata['user']['employee_fk'])) {
//            $this->db->where('c.i_see_3', 0); // For employee
//        } else {
//            $this->db->where('c.i_see_5', 0); // For the client
//        }
//        $this->db->where('c.application_fk', $id);
//        $this->db->where('c.user_fk <>', $this->session->userdata['user']['id']);
        
        $result = $this->db->get();
        return $result->num_rows();
    }

    /**
     * Get application details
     * 
     * @param {int} $id Application id.
     */
    public function getApplicationComments($id) {
        $this->db->select('*');
        $this->db->from('comments c');
        $this->db->where('c.application_fk', $id);
        $this->db->order_by('c.date_created','DESC');
        $result = $this->db->get();
        return $result->result_array();
    }
    
    /**
     * Record the user's comment
     * 
     * @param {array} $data Comment data.
     */
    public function recordTheNotification($data) {
        // Result.
        $result = [];
        // Start the transactions.
        $this->db->trans_start();
        // Record the user's comment.
        $comment = ['comment'=>$data['comment'],'application_fk'=>$data['application_fk'],
            'user_fk'=>$data['user_fk'],'date_created'=>$data['date_created']];
        $this->db->insert('comments', $comment);
        $commentId = $this->db->insert_id();
        
        // Record the pco comment data. 1 is for PCO, 
        // it means the sender is the pco client .
        if($data['flag'] == 1) {
            $notification = ['user_fk'=>$data['user_fk'],'application_fk'=>$data['application_fk'],
                'sender_id'=>$data['sender_id'],'receiver_id'=>$data['receiver_id'],'comments_fk' => $commentId, 
                'flag_1' => 1,'flag_2' => 0,'flag_3' => 1,'flag_4' => 1,'flag_5' => 1,'date_created'=>$data['date_created']];
            // Record the data.
            $this->db->insert('notification', $notification);
            $result['updated_by_pco_client'] = TRUE;
        }
        
        // For the case handler.
        if($data['flag'] == 5) {
            // TODO...
            // Receiver id.
            $receiverId = $data['receiver_id'];
            $designationType = $this->UserModel->getUserDesignationByEmployeeId($receiverId);
            
            // Section chief.
            if($designationType['designation_id'] == SECTION_CHIEF){
                $notification = ['user_fk'=>$data['user_fk'],'application_fk'=>$data['application_fk'],
                    'sender_id'=>$data['sender_id'],'receiver_id'=>$receiverId,'comments_fk' => $commentId, 
                    'flag_1' => 1,'flag_2' => 1,'flag_3' => 0,'flag_4' => 1,'flag_5' => 1,'date_created'=>$data['date_created']];
            } else {
                // For PCO client.
                $notification = ['user_fk'=>$data['user_fk'],'application_fk'=>$data['application_fk'],
                    'sender_id'=>$data['sender_id'],'receiver_id'=>$receiverId,'comments_fk' => $commentId, 
                    'flag_1' => 0,'flag_2' => 1,'flag_3' => 1,'flag_4' => 1,'flag_5' => 1,'date_created'=>$data['date_created']];
            }
            
            // Record the data.
            $this->db->insert('notification', $notification);
            $result['application_updated'] = TRUE;
        }
        
        // For the section chief
        if($data['flag'] == 3) { // TODO...2
            // Receiver id.
            $receiverId = $data['receiver_id'];
            $designationType = $this->UserModel->getUserDesignationByEmployeeId($receiverId); 
            // Casehandler
            if($designationType['designation_id'] == EVALUATOR){
                $notification = ['user_fk'=>$data['user_fk'],'application_fk'=>$data['application_fk'],
                    'sender_id'=>$data['sender_id'],'receiver_id'=>$receiverId,'comments_fk' => $commentId, 
                    'flag_1' => 1,'flag_2' => 0,'flag_3' => 1,'flag_4' => 1,'flag_5' => 1,'date_created'=>$data['date_created']];
            }
            // Division cheif
            if($designationType['designation_id'] == DIVISON_CHIEF){
                $notification = ['user_fk'=>$data['user_fk'],'application_fk'=>$data['application_fk'],
                    'sender_id'=>$data['sender_id'],'receiver_id'=>$receiverId,'comments_fk' => $commentId, 
                    'flag_1' => 1,'flag_2' => 1,'flag_3' => 1,'flag_4' => 0,'flag_5' => 1,'date_created'=>$data['date_created']];
            }
            // Record the data.
            $this->db->insert('notification', $notification);
            $result['application_updated'] = TRUE;
        }
        
        // Complete the transactions.
        $this->db->trans_complete();
        if($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            $result['status'] = FALSE; // Rollback.
        } else {
            $this->db->trans_commit();
            $result['status'] = TRUE; // Commited.
        }
        
        return $result;
    }

    /**
     * Add comment to the application.
     * 
     * @param {array} $dataTable The table data.
     * @param {array} $data The user data.
     */
    public function addComment($dataTable,$data) {
        //log_message('debug', 'addComment');
        
        // Return data.
        $return[] = null;
        
        // ------------------------Comments table -------------------
        $assigneeID = $data['application_assignee_id'];
        $commentID = null;
        $res = $this->db->insert('comments', $dataTable);
         if ($res == 1) {
            $return['comment_save'] = TRUE; 
            $commentID = $this->db->insert_id();
        } 
        
        // Check if the current logged user is a employee.
        $userType = null;
        if(isset($this->session->userdata['user']['id'])) {
            $currentUserLoggedID = $this->session->userdata['user']['id'];
            $userType = $this->UserModel->getUserType($currentUserLoggedID)['role_fk'];
        }
        // Send by the Employee to pco or to employee.
        $array = array($userType);
        if(count(array_intersect($array, array(SUPER_USER,SYSTEM_ADMINISTRATOR,EMPLOYEE)))) {
            //log_message('debug', 'userType');
            // Notification for regional director.
            // Check if the assignee is poc or employee.
            $isPCO = $this->UserModel->isPCO($assigneeID);
            if($isPCO) {
                //log_message('debug', 'PCO');
                $return['application_forwarded_to_pco'] = TRUE; 
                // This function is for pco only. If the application was forwarded to pco client.
                $notiData = [
                    'user_fk' => $this->session->userdata['user']['id'], // The sender user id.
                    'account_fk' => $this->session->userdata('account_fk'), // The account who is in the application.
                    'employee_fk' => $assigneeID, // employee_fk or account fk
                    'application_fk' => $dataTable['application_fk'], // The selected application id
                    'flag_1' => 0, // Set to default value
                    'flag_2' => 1, // Set to default value
                    'comments_fk' => $commentID, // The new comment id
                    'date_created' => $dataTable['date_created'],
                ];
                // ------------------------Application table -------------------
                // Update the evaluator_fk on the table application.
                $evaluatorUserId = $this->session->userdata['user']['id'];
                $evaluator = $this->UserModel->getUserInformation($evaluatorUserId);
                // Application data to update.               
                $data = [
                        'date_modified'=>date('Y-m-d H:i:s'),
                        'evaluator_fk'=> $evaluator['employee_fk']
                    ]; // Date modified...
                // Update...
                $this->ApplicationDetailsPageModel->updateApplicationByID($notiData['application_fk'],$data);
            } else {
                //log_message('debug', 'EMPLOOYEE');
                // Employee
                $employee = $this->UserModel->getEmployeeByID($assigneeID);
                // User designation type.
                $designationID = $this->UserModel->getUserDesignation($employee['id'])['designation_id'];
               // log_message('debug', 'DESIGNATION '. $designationID);
            }
            
            // User role.
            $id = array($designationID);
            if(count(array_intersect($id, array(REGIONAL_DIRECTOR))) && $data['application_status_id'] == APPROVED) {
                //log_message('debug', 'REGIONAL_DIRECTOR '. $id);
                $return['application_approved'] = TRUE; 
                $notiData = [
                    'user_fk' => $this->session->userdata['user']['id'], // The sender user id.
                    'account_fk' => $this->session->userdata('account_fk'), // The account who is in the application.
                    'employee_fk' => $assigneeID, // employee_fk
                    'application_fk' => $dataTable['application_fk'], // The selected application id
                    'flag_1' => 1, // Set to default value
                    'comments_fk' => $commentID, // The new comment id
                    'date_created' => $dataTable['date_created'],
                ];
            } 
            
            // Division to Regional Director.
            if(count(array_intersect($id, array(REGIONAL_DIRECTOR))) && $data['application_status_id'] == EVALUATED) {
               // log_message('debug', 'REGIONAL_DIRECTOR AND APPLICATION STATUS ID '. $id);
                $return['application_evaluated'] = TRUE;  
                $notiData = [
                    'user_fk' => $this->session->userdata['user']['id'], // The sender user id.
                    'account_fk' => $this->session->userdata('account_fk'), // The account who is in the application.
                    'employee_fk' => $assigneeID, // employee_fk
                    'application_fk' => $dataTable['application_fk'], // The selected application id
                    'flag_1' => 1, // Set to default value
                    'comments_fk' => $commentID, // The new comment id
                    'date_created' => $dataTable['date_created'],
                ];
            } 
            // 
            if(count(array_intersect($id, array(DIVISON_CHIEF,SECTION_CHIEF,UNIT_HEAD,EVALUATOR)))) {
                //log_message('debug', 'ASSIGN ID: '. $assigneeID);
                $return['application_updated'] = TRUE;  
                // The user id of pco and employee, the two user will be notify.
                $accountID = $this->session->userdata('account_fk');
                $employeeID = $assigneeID; // The user id who's assigned to the application.
                
                $notiData = [
                    'user_fk' => $this->session->userdata['user']['id'], // The sender user id.
                    'account_fk' => $accountID, // The account who is in the application.
                    'employee_fk' => $employeeID, // employee_fk
                    'application_fk' => $dataTable['application_fk'], // The selected application id
                    'flag_1' => 1, // Set to default value
                    'comments_fk' => $commentID, // The new comment id
                    'date_created' => $dataTable['date_created'],
                ];
            }
            
            // ------------------------Disposition table -------------------
            // Application details.
            // Disposition log
            $date = date('Y-m-d H:i:s');
            $dispositionLog = [
                'application_id' => $dataTable['application_fk'], // Application id.
                'subject' => null, // User Remarks.
                'from' => $this->session->userdata['user']['id'],// Current logged user id.
                'forwarded_to' => $assigneeID, // User who is assigned to the application.
                'document_no' => $this->ApplicationDispositionPageModel->generateDocumentNo(),
                'document_date' => $date, // Current date.
                'date_time' => $date, // Current date.
                'remarks' => $this->getCommentById($commentID)['comment'], // User remarks
            ];
            $isSucces = $this->ApplicationDispositionPageModel->dispositionLog($dispositionLog);
            if($isSucces) {
                // DO NOTHING...
            }
            // ------------------------------------------------------------
            
           // Insert the notification data.
           $this->db->insert('notification', $notiData);
        } else {
            // For submited application by the pco
            $status = array($data['application_status_id']);
            //array_push($status, $data['application_status_id']);
            if(count(array_intersect($status, array(SAVE,SUBMIT)))) {
                // Check the status.
                if($status == SAVE) {
                    // TODO
                } else {
                    // TODO
                }
                
                // Get all the employee to notify.
                $userList = $this->UserModel->getAllUsers();
                if(isset($userList)) {
                    foreach ($userList as $key => $value) {
                        if(isset($value['employee_fk'])) {
                            
                            $userType = $this->UserModel->getUserDesignation($value['id'])['designation_id'];
                            // User role.
                            $userRole = array($userType);
                            if(count(array_intersect($userRole, array(REGIONAL_DIRECTOR,DIVISON_CHIEF,EVALUATOR,WATCHER)))) {
                                // DO NOTHING....
                            } else {
                                // Notify section chief.
                                $notiData = [
                                     'user_fk' => $this->session->userdata['user']['id'], // The sender user id.
                                     'account_fk' => $this->session->userdata('account_fk'), // The account who is in the application.
                                     'employee_fk' => $value['employee_fk'], // 
                                     'application_fk' => $dataTable['application_fk'], // The selected application id
                                     'flag_1' => 1, // Set to default value. For the pco
                                     'comments_fk' => $commentID, // The new comment id
                                     'date_created' => $dataTable['date_created'],
                                ];
                                $this->db->insert('notification', $notiData);
                            }
                        }
                    }
                }
            }
            
            // For ongoing, evaluated and approved application.
            if(count(array_intersect($status, array(ONGOING,EVALUATED,APPROVED,DENIED)))) {
                $notiData = [
                    'user_fk' => $this->session->userdata['user']['id'], // The sender user id.
                    'account_fk' => $this->session->userdata('account_fk'), // The account who is in the application.
                    'employee_fk' => $data['application_assignee_id'], // employee_fk
                    'application_fk' => $data['application_id'], // The selected application id
                    'flag_1' => 1, // Set to default value
                    'comments_fk' => $commentID, // The new comment id
                    'date_created' => $dataTable['date_created'],
                ];
                
                // ------------------------Disposition table -------------------
                // Application details.
                // Disposition log
                $date = date('Y-m-d H:i:s');
                $dispositionLog = [
                    'application_id' => $dataTable['application_fk'], // Application id.
                    'subject' => null, // User Remarks.
                    'from' => $this->session->userdata['user']['id'],// Current logged user id.
                    'forwarded_to' => $assigneeID, // User who is assigned to the application.
                    'document_no' => $this->ApplicationDispositionPageModel->generateDocumentNo(),
                    'document_date' => $date, // Current date.
                    'date_time' => $date, // Current date.
                    'remarks' => $this->getCommentById($commentID)['comment'], // User remarks
                ];
                $isSucces = $this->ApplicationDispositionPageModel->dispositionLog($dispositionLog);
                if($isSucces) {
                    // DO NOTHING...
                }
                // ------------------------------------------------------------
                
                $this->db->insert('notification', $notiData);
            }
        }
        return $return;
    }
    
    public function getCommentById($id){
        $this->db->select('c.comment');
        $this->db->from('comments c');
        $this->db->where('c.id',$id);
        $result = $this->db->get();
        return $result->row_array();
    }

    /**
     * I see the comments
     */
    public function iSeeTheComments($application_id) {
        if (isset($application_id)) {
            if (isset($this->session->userdata['user']['employee_fk'])) {
                $data = ['i_see_3' => 1,]; // For employee
            } else {
                $data = ['i_see_5' => 1,]; // For the client
            }
            $this->db->update('comments', $data, ['application_fk' => $application_id]);
        }
    }
    
    /**
     * Check if the comment is from the PCO client
     * @param int $id PCO account user id
     */
    public function isPCOComment($id) {
        // Get the current logge user type
        $userType = $this->UserModel->getUserType($id);
        $type = NULL;
        switch ($userType['role_fk']) {
            case SUPER_USER:
                $type = SUPER_USER;
                break;
            case SYSTEM_ADMINISTRATOR:
                $type = SYSTEM_ADMINISTRATOR;
                break;
            case EMPLOYEE:
                $type = EMPLOYEE;
                break;
            case PCO:
                $type = PCO;
                break;
            default:
                break;
        }
        return $type;
    }

    

    /**
     * Check if the comment is from the evaluator.
     * @param int $id Evaluator user id
     */
    public function isEvaluatorComment($id) {
        // Get the current logge user type
        $user_designation = $this->UserModel->getUserDesignation($id);
        $designation = NULL;
        switch ($user_designation['designation_id']) {
            case REGIONAL_DIRECTOR:
                $designation = REGIONAL_DIRECTOR;
                break;
            case DIVISON_CHIEF:
                $designation = DIVISON_CHIEF;
                break;
            case SECTION_CHIEF:
                $designation = SECTION_CHIEF;
                break;
            case UNIT_HEAD:
                $designation = UNIT_HEAD;
                break;
             case EVALUATOR:
                $designation = EVALUATOR;
                break;
            case WATCHER:
                $designation = WATCHER;
                break;
            default:
                break;
        }
        return $designation;
    }

}
