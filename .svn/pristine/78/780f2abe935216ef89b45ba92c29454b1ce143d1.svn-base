<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * Application page controller
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class ApplicationPageController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {        
        try {
            //echo $this->ApplicationDetailsPageModel->getCOANo(); // For testing.
            // Page title.
            $data['page_title'] = 'Account';
            // Profile picture of the current logged user.
            $data['picture_file_name'] = $this->ProfileModel->getProfilePhoto();
            // Signature of the current logged user
            $data['signature_file_name'] = $this->ProfileModel->getUserSignature();
            // List of status
            $data['application_status'] = $this->ApplicationPageModel->getApplicationStatus(); 
            // Employee list
            $region = isset($this->session->userdata['user']['region']) ? $this->session->userdata['user']['region']:null;
            $data['employee_list'] = $this->ApplicationPageModel->getListOfEmployee($region);

            // Get user information.
            $userID = isset($this->session->userdata['user']['id'])?$this->session->userdata['user']['id']:0;
            $userRole = array($this->PCOModel->getUserRole($userID)['role_fk']);
            $data['is_add'] = null;
            if(count(array_intersect($userRole, array(SUPER_USER,SYSTEM_ADMINISTRATOR,EMPLOYEE)))) { 
                // For the employee
                $data['is_pco'] = false;
                $data['is_add'] = TRUE; // Flag to add new application.
                $data['isAssignee'] = TRUE;
            } else {
                // For pco user client.
				//$account_id = isset($this->session->userdata['user']['account_fk'])?$this->session->userdata['user']['account_fk']:0;
                $data['is_pco'] = true;
                $data['is_add'] = false; //$this->isPCOHasAlreadyApplied($account_id); // Flag to add new application.
                $data['isAssignee'] = FALSE;
            }
            $this->parse('application/application_page_table', 'Application Page Table', $data);
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
    }
	
	/**
     * Check if the pco has already applied a COA
     * 
     * 
     **/
    public function isPCOHasAlreadyApplied($account_id) {
        return $this->ApplicationPageModel->checkIfPCOsubmittedApplication($account_id);
    }

    public function applicationDataGrid() {
        $this->OuthModel->CSRFVerify();

        $requestData = $_REQUEST;
        $table = "application";
        $fields = "*";
        $id = '';
        
        $region = $this->session->userdata['user']['region'];
        $userType = $this->session->userdata['account']['account_fk'];
        $employeeFk = null;
        // For pco
        if(isset($userType)) {
            $where = ' WHERE `is_active` = 1 AND `account_fk` = '. $userType;
        } else {  
            // For employee
            //$employeeFk = $this->session->userdata['user']['employee_fk'];
            $where = ' WHERE `is_active` = 1 ';
            //$where = ' WHERE `is_active` = 1 AND `employee_fk`='. $employeeFk; 
        }
        
        $sql = "SELECT " . $fields;
        $sql .= " FROM " . $table . $where;
        
        $queryInfo = $this->db->query($sql);
        //$queryqResults = $query->result();
        $totalRecords = $queryInfo->num_rows(); 
        $totalFiltered = $totalRecords; 
        
        // For pco
        if(isset($userType)) {
            $where = ' WHERE `is_active` = 1 AND `account_fk` = '. $userType;
        } else {  
            // For employee
            $where = ' WHERE `is_active` = 1 ';
            //$where = ' WHERE `is_active` = 1 AND `employee_fk`='. $employeeFk; 
        }

        $sql = "SELECT " . $fields;
        $sql .= " FROM " . $table . $where;
        
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $sql .= " AND `name_of_establishment` LIKE '%" . $searchValue . "%' ";
            $sql .= " AND `address` LIKE '%" . $searchValue . "%' ";
            $sql .= " OR `name_of_establishment` LIKE '%" . $searchValue . "%' ";
            $sql .= " OR `address` LIKE '%" . $searchValue . "%' ";
        }
        
        if(isset($region)) {
            $sql .= " AND `region` = '" . $region . "' ";
        }
        // Sort the table.
        $post = $this->input->post();
        
        // Get user type based on the current logged user
        if(isset($userType)) {
            // For pco
            if(isset($post['application_status']) AND isset($post['employee_assignee'])) {
                if($post['application_status'] == 0 AND $post['employee_assignee'] == 0) {
                    //$sql .=" AND status_fk =". $post['application_status']; // . " AND employee_fk =". $post['employee_assignee'];
                    $sql .=" AND status_fk >= 0";
                } else {
                    $sql .=" AND status_fk = ". $post['application_status'];
                }
            }
        } else {
            // For employee
            if(isset($post['application_status']) AND isset($post['employee_assignee'])) {
                if($post['application_status'] == 0 AND $post['employee_assignee'] == 0) {
                    // Get user disignation
                    $disignation = $this->UserModel->getUserDesignation($this->session->userdata['user']['id'])['designation_id'];
                    if($disignation == REGIONAL_DIRECTOR) {
                        $sql .=" AND status_fk = 4 AND employee_fk =". $this->session->userdata['user']['employee_fk'];
                    } else {
                        $sql .=" AND status_fk >= 0 AND employee_fk =". $this->session->userdata['user']['employee_fk'];
                    }
                    // $sql .=" AND status_fk >= 0 AND employee_fk =". $this->session->userdata['user']['employee_fk'];
                    // $sql .=" AND status_fk >= 0";
                } else if($post['application_status'] == 0 AND $post['employee_assignee'] != 0) {
                    $sql .=" AND employee_fk = ". $post['employee_assignee'];
                } else if($post['application_status'] != 0 AND $post['employee_assignee'] == 0) {
                    $sql .=" AND status_fk = ". $post['application_status'];
                } else {
                   // $sql .=" AND status_fk = ". $post['application_status'] . " AND employee_fk =". $post['employee_assignee'];
                    $sql .=" AND status_fk = ". $post['application_status'] . " AND employee_fk =". $post['employee_assignee'];
                   // log_message('debug', 'Application table => '. $sql);
                }
            }
        }
        
        $queryInfo = $this->db->query($sql);
        $totalFiltered = $queryInfo->num_rows(); 
        
        //ORDER BY id DESC	
        $sql .= " ORDER BY date_modified desc"; //. $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . " "; 
        
        if(isset($post['application_status']) AND isset($post['employee_assignee'])) {
            $sql .=" LIMIT 500";
        } else {
            $sql .= $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
        }
        
        $queryResult = $this->db->query($sql);
        $SearchResults = $queryResult->result();
        
        //log_message('debug', 'Application table => '. $sql);
        
        $data = array();
        foreach ($SearchResults as $row) {
            $data = array(); 
            $id = $row->id;
            $coa_id = $row->coa_fk;
            $data[] = '<span id='. $id . '">'. str_pad($row->id, 4, '0', STR_PAD_LEFT) .'</span>';
            $data[] = '<span id='. $id . '">'. $row->region .'</span>';
            $data[] = '<span id=' . $id . '">' . $this->UserModel->getAccountUserFullName($row->account_fk) . '</span>';
            // Application column
            $count = $this->ApplicationDetailsPageModel->getApplicationTableCommentsCount($id,$row->account_fk);
            if($count != 0) {
                $data[] = '<span id=' . $id . '"><a onclick="application(' . $id . "," .$row->account_fk . ')" href="javascript:void(0);"><u>' . $row->name_of_establishment . '</u></a>';
                   // . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                   // . '<span class="label label-danger">' . $count . ' New comment(s)</span></span>';
            } else {
                $data[] = '<span id=' . $id . '"><a onclick="application(' . $id . "," .$row->account_fk . ')" href="javascript:void(0);"><u>' . $row->name_of_establishment . '</u></a></span>';
            }
            
            // Date submitted column
            
            // Forwarded name
            // var_dump($this->UserModel->getForwardedToNameByID($row->employee_fk));
            
            $data[] = '<span id=' . $id . '">' . $this->UserModel->getForwardedToNameByID($row->employee_fk) . '</span>'; 
            
            // Check if the date modified is null.
            $DCreated = null;
            if($row->date_modified == null) {
                $DCreated = $row->date_created;
            } else {
                $DCreated = $row->date_modified;
            }
            //$data[] = '<span id=' . $id . '">' . gmdate('F j, Y H:i:s A', strtotime($DCreated) + date("Z")) . '</span>';
            $data[] = '<span id=' . $id . '">' .$this->utils->format_date($DCreated). '</span>';
            
            // Type column
            $type = $this->ApplicationPageModel->getApplicationTypeLabel($row->type_fk)['label'];
             switch ($row->type_fk) {
                case 1:
                    $type = '<span id=' . $id . ' class="label label-info">' . $type . '</span>';
                    break;
                case 2:
                    $type = '<span id=' . $id . ' class="label label-primary">' . $type . '</span>';
                    break;
                default:
                    break;
            }
            
            // Status column
            $status = $this->ApplicationPageModel->getApplicationStatusLabel($row->status_fk)['label'];
            switch ($row->status_fk) {
                case 1:
                    $status = '<span id=' . $id . ' class="label label-info">' . $status . '</span>';
                    break;
                case 2:
                    $status = '<span id=' . $id . ' class="label label-warning">' . $status . '</span>';
                    break;
                case 3:
                    $status = '<span id=' . $id . ' class="label label-warning">' . $status . '</span>';
                    break;
                case 4:
                    $status = '<span id=' . $id . ' class="label label-danger">' . $status . '</span>';
                    break;
                case 5:
                    $status = '<span id=' . $id . ' class="label label-success">' . $status . '</span>';
                    break;
                case 6:
                    $status = '<span id=' . $id . ' class="label label-danger">' . $status . '</span>';
                    break;
                case 7:
                    $status = '<span id=' . $id . ' class="label label-danger">' . $status . '</span>';
                    break;
                case 8:
                    $status = '<span id=' . $id . ' class="label label-danger">' . $status . '</span>';
                    break;
                default:
                    break;
            }
            $data[] = $type;
            $data[] = $status;
            
            /** History, Renew, Details, Details for evaluator, Terminate, Print and View buttons */
            $history = '<span class="label label-info" style="margin-right: 3px;"><a onclick="onClickHistory(' . $id . ')" href="javascript:void(0);" style="color: #ffffff;"> <i class="fa fa-history"></i> History </a></span>';
            $renew = '<span class="label label-info" style="margin-right: 3px;"> <a onclick="onClickRenewal(' . $id . ',' . $row->status_fk . ')" href="javascript:void(0);" style="color: #ffffff;"> <i class="fa fa-file-text-o"></i> Renew </a></span>';
            $details = '<span class="label label-info" style="margin-right: 3px;"><a onclick="onClickDetails(' . $id . ')" href="javascript:void(0);" style="color: #ffffff;"> <i class="fa fa-info-circle"></i> Details </a></span>';
            $terminate = '<span class="label label-info" style="margin-right: 3px;"><a onclick="onClickTerminate('.$id.','.$row->status_fk.')" href="javascript:void(0);" style="color: #ffffff;"> <i class="fa fa-remove"></i> Terminate </a></span>';
            $print = '<span class="label label-info" style="margin-right: 3px;"><a onclick="onClickPrint(' . $id . ',' . $row->status_fk . ')" href="javascript:void(0);" style="color: #ffffff;"> <i class="fa fa-print"></i> Print </a></span>';
            $print_for_evaluator = '<span class="label label-info" style="margin-right: 3px;"><a onclick="onClickPrintEMB(' . $id . ',' . $row->status_fk . ')" href="javascript:void(0);" style="color: #ffffff;"> <i class="fa fa-print"></i> Print </a></span>';
            $details_for_renewal = '<span class="label label-info" style="margin-right: 3px;"><a onclick="onClickRenewalDetails(' . $id . ')" href="javascript:void(0);" style="color: #ffffff;"> <i class="fa fa-info-circle"></i> Details </a></span>';
            $view = '<span class="label label-info" style="margin-right: 3px;"><a onclick="onClickView(' . $id . ')" href="javascript:void(0);" style="color: #ffffff;"> <i class="fa fa-info-circle"></i> View </a></span>';
            $checkList = '<span class="label label-info" style="margin-right: 3px;"><a onclick="onClickCheckList(' . $id . ')" href="javascript:void(0);" style="color: #ffffff;"> <i class="fa fa-fw fa-list-alt"></i> Checklist </a></span>';
            $button = null;
            
            // Application type
            $application_type = $row->type_fk;
            // Application status.
            $application_status = $row->status_fk;
            switch ($application_type) {
                case _NEW: // New application
                    if($this->isPCO()==PCO) {
                        if(count(array_intersect(array($application_status), 
                                array(SAVE,SUBMIT,ONGOING,EVALUATED)))) {
                            $button = $details.''.$print;
                        }
                        if(count(array_intersect(array($application_status), 
                                array(APPROVED)))){
                            $button = $details . $print;
                            if($row->flag==0) { // Flag 0 this means the application has never been renewed.
                                if($this->showRenewButton($coa_id)) {
                                        $button .= $renew;
                                }
                            }
                        }
                        if(count(array_intersect(array($application_status), 
                                array(REVOKED)))){
                            $button = $view;
                        }
                        if(count(array_intersect(array($application_status), 
                                array(EXPIRED)))){
                            $button = $print;
                            if($row->flag==0) { // Flag 0 this means the application has never been renewed.
                                if($this->showRenewButton($coa_id)) {
                                        $button .= $renew;
                                }
                            }
                        }
                    } else { // For the evaluator
                        if(count(array_intersect(array($application_status), 
                                array(SAVE,SUBMIT,ONGOING,EVALUATED)))) {
                            $button = $checkList .  $history . $details . $print_for_evaluator;
                        }
                        if(count(array_intersect(array($application_status), 
                                array(APPROVED)))){
                            $button = $checkList .  $history . $terminate . $details . $print_for_evaluator;
                            if($row->flag==0) { // Flag 0 this means the application has never been renewed.
                                if($this->showRenewButton($coa_id)) {
                                        $button .= $renew;
                                }
                            }
                        }
                        if(count(array_intersect(array($application_status), 
                                array(REVOKED)))){
                            $button = $view . $history;
                        }
                        if(count(array_intersect(array($application_status), 
                                array(EXPIRED)))){
                            $button = $history . $print_for_evaluator;
                        }
                    }
                    break;
                case RENEWAL: // Renewal application
                    if($this->isPCO()==PCO) {
                        if(count(array_intersect(array($application_status), 
                                array(SAVE,SUBMIT,ONGOING,EVALUATED)))) {
                            $button = $details_for_renewal.''.$print;
                        }
                        if(count(array_intersect(array($application_status), 
                                array(APPROVED)))){
                            $button = $details_for_renewal . $print;
                            if($row->flag==0) { // Flag 0 this means the application has never been renewed.
                                if($this->showRenewButton($coa_id)) {
                                   $button .= $renew;
                                }
                            }
                        }
                        if(count(array_intersect(array($application_status), 
                                array(REVOKED)))){
                            $button = $view;
                        }
                        if(count(array_intersect(array($application_status), 
                                array(EXPIRED)))){
                            $button = $print;
                        }
                    } else { // For the evaluator
                        if(count(array_intersect(array($application_status), 
                                array(SAVE,SUBMIT,ONGOING,EVALUATED)))) {
                            $button = $checkList .  $history . $details_for_renewal.''.$print_for_evaluator;
                        }
                        if(count(array_intersect(array($application_status), 
                                array(APPROVED)))){
                            $button = $checkList .  $history . $terminate . $details_for_renewal . $print_for_evaluator;
                            if($row->flag==0) { // Flag 0 this means the application has never been renewed.
                                if($this->showRenewButton($coa_id)) {
                                        $button .= $renew;
                                }
                            }
                        }
                        if(count(array_intersect(array($application_status), 
                                array(REVOKED)))){
                            $button = $view . $history;
                        }
                         if(count(array_intersect(array($application_status), 
                                array(EXPIRED)))){
                            $button = $history . $print_for_evaluator;
                        }
                    }
                    break;
                default:
                    break;
            }
            
            // Add data on the data list.
            $data[] = '<span class="label label-info" style="margin-right: 3px;"></span>' . $button;
            $dataList[] = $data;
        }
        
        // Draw
        $draw = sizeof($dataList) / 10;
        
        $json_data = array(
            "status" => 1,
            "draw" => intval($draw),//$requestData['draw']),
            "recordsTotal" => intval($totalRecords), //$totalRecords), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching,  
            "data" => $dataList==null?[]:$dataList   // total data array
        );
        
        echo json_encode($json_data);  // send data as json format					
    }
	
    /**
     * The renew button will appear
     * 6 month before the expiration of COA
     * 
     *  $data['expiration_minus'] = date('Y-m-d H:i:s', strtotime("-6 months", strtotime('2023-05-04 11:32:18')));
     *  $data['expiration_orig'] = '2023-05-04 11:32:18';
     * 
     * @param {int} Selected application id
     * */
    public function showRenewButton($coaId) {
        // Get the current date.
        $currentDate = new DateTime();
        $now = $currentDate->format('Y-m-d H:i:s');
        
        //$now = '2023-04-01 11:32:18'; // for debug
        
        // Get the COA expiration date.
        $result = $this->ApplicationDetailsPageModel->getCOAExpirationDate($coaId);
        if($result) {
            // Get the date 6 month before the expiration date.
            $monthBeforeExpirationDate = date('Y-m-d H:i:s', strtotime("-6 months", strtotime($result['valid_until'])));
            if($now >= $monthBeforeExpirationDate) {
                return true;
            }
        }
        return false;
    }

    /**
     * Selected application
     */
    public function selectedApplication() {
        $post = $this->input->post();
        if (isset($post['application_id'])) {
            $this->session->set_userdata('application_id', $post['application_id']);
            $this->session->set_userdata('account_fk', $post['account_fk']);
            $message = ['status' => 1,
                'message' => 'You are now redirected to application details.',
                'redirectUrl' => base_url('application-details-page')
            ];
        } else {
            $message = ['status' => 0,
                'message' => 'No data found.'
            ];
        }
        echo json_encode($message);
    }
    
    /**
     * Selected revoked application
     */
    public function viewSelectedRevokedCoa() {
        $post = $this->input->post();
        if (isset($post['application_id'])) {
            $this->session->set_userdata('revoked_application_id', $post['application_id']);
            $message = ['status' => 1,
                'message' => 'You are now redirected to view the revoked COA.',
                'redirectUrl' => base_url('terminated-coa-page')
            ];
        } else {
            $message = ['status' => 0,
                'message' => 'No data found.'
            ];
        }
        echo json_encode($message);
    }
    
    /**
     * Show application checklist page.
     */
    public function showApplicationChecklist() {
        $post = $this->input->post();
        if (isset($post['application_id'])) {
            $this->session->set_userdata('application_id', $post['application_id']);
            $message = ['status' => 1,
                'message' => 'You are now redirected to application checklist page.',
                'redirectUrl' => base_url('new-application-checklist-page')
            ];
        } else {
            $message = ['status' => 0,
                'message' => 'No data found.'
            ];
        }
        echo json_encode($message);
    }
    
    /**
     * Show application history page.
     */
    public function showApplicationTerminationPage() {
        $post = $this->input->post();
        if (isset($post['application_id'])) {
            $this->session->set_userdata('application_id_for_termination', $post['application_id']);
            $message = ['status' => 1,
                'message' => 'You are now redirected to application termination page.',
                'redirectUrl' => base_url('application-termination-page')
            ];
        } else {
            $message = ['status' => 0,
                'message' => 'No data found.'
            ];
        }
        echo json_encode($message);
    } 
    
    /**
     * Show application history page.
     */
    public function showApplicationHistory() {
        $post = $this->input->post();
        if (isset($post['application_id'])) {
            $this->session->set_userdata('application_id', $post['application_id']);
            $message = ['status' => 1,
                'message' => 'You are now redirected to application history page.',
                'redirectUrl' => base_url('application-disposition-page')
            ];
        } else {
            $message = ['status' => 0,
                'message' => 'No data found.'
            ];
        }
        echo json_encode($message);
    } 
    
    public function isPCO(){
        // Get the current logge user type
        $userType = $this->UserModel->getUserType($this->session->userdata['user']['id']);
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
     * Redirect the selected application to renewal
     * application page.  
     */
    public function renewApplication() {
        try {
            $post = $this->input->post();
            if(isset($post['application_id'])) {
                // Get the current logge user type
                $userType = $this->UserModel->getUserType($this->session->userdata['user']['id']);
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
                // Save the user type data.
                $this->session->set_userdata('renew_selected_application', ['id' => $post['application_id'], 'selected_by' => $type] );
                $response = ['status' => 1, 'message' => 'Renew the selected application!', 'redirectUrl' => base_url('view-selected-renewal-application')];
            } else {
                $response = ['status' => 0,'message' => 'No data found.'];
            }
        } catch (ErrorException $err) {
            show_error($err->getMessage());
        }
        echo json_encode($response);
    }
    
    /**
     * Redirect to view the selected renewed application
     * details.
     */
    public function viewRenewedApplicationDetails() {
        try {
            $post = $this->input->post();
            if(isset($post['application_id'])) {
                // Get the current logge user type
                $userType = $this->UserModel->getUserType($this->session->userdata['user']['id']);
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
                // Save the user type data.
                $this->session->set_userdata('view_renewed_selected_application', ['id' => $post['application_id'], 'selected_by' => $type] );
                $response = ['status' => 1, 'message' => 'View selected renewed application details!', 'redirectUrl' => base_url('view-selected-application-renewal-details')];
            } else {
                $response = ['status' => 0,'message' => 'No data found.'];
            }
        } catch (ErrorException $err) {
            show_error($err->getMessage());
        }
        echo json_encode($response);
    }
    
     /**
     * View selected application pco bio-data.
     * 
     */
    public function viewSelectedApplicationPCOBioData() { 
        try {
            $post = $this->input->post();
            if(isset($post['application_id'])) {
                // Get the current logge user type
                $userType = $this->UserModel->getUserType($this->session->userdata['user']['id']);
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
                // Save the user type data.
                $this->session->set_userdata('view_selected_application_pco_bio_data', ['id' => $post['application_id'], 'selected_by' => $type] );
                $response = ['status' => 1, 'message' => 'View selected application PCO BIO-DATA !', 'redirectUrl' => base_url('application-pco-bio-data-page')];
            } else {
                $response = ['status' => 0,'message' => 'No data found.'];
            }
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
        }
        echo json_encode($response);
    }
    
    /**
     * View selected application 
     * 
     */
    public function viewSelectedApplicationDetails() { 
        try {
            $post = $this->input->post();
            if(isset($post['application_id'])) {
                // Get the current logge user type
                $userType = $this->UserModel->getUserType($this->session->userdata['user']['id']);
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
                // Save the user type data.
                $this->session->set_userdata('view_selected_application_details', ['id' => $post['application_id'], 'selected_by' => $type] );
                $response = ['status' => 1, 'message' => 'View selected application details !', 'redirectUrl' => base_url('application-full-details-page')];
            } else {
                $response = ['status' => 0,'message' => 'No data found.'];
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
        echo json_encode($response);
    }

    /**
     * Get the selected application data.
     */
    public function selectedApplicationCOA() {
        try {
            $post = $this->input->post();
            // Save the data to session.
            $this->session->set_userdata('certificate_of_accreditation', ['application_id' => $post['application_id']]);
            // Response
            $response = ['status' => 1, 'message' => 'Redirect to Certificate of accreditation !', 'redirectUrl' => base_url('print-certificate-of-accreditation')];
        } catch (Exception $err) {
            show_error($err->getMessage());
            $response = ['status' => 0, 'message' => $err->getMessage()];
        }
        echo json_encode($response);
    }

    /**
     * Render the selected application to print the 
     * Certificate of accreditation.
     */
    public function printSelectedApplication() {
        try {
            // Application data.
            $id = $this->session->userdata['certificate_of_accreditation']['application_id'];
            $application = $this->getApplicationData($id);
            // Certification of accreditation data...
            $region = $application['region'];
            $data['coa_header'] = $this->getCOAHeader($region);
            $data['document_code'] = $this->getDocumentCode($region);
            $data['coa_no'] = $this->getCOANo($application['coa_fk'], $region);
            $data['type'] = $this->getApplicationType($application['type_fk']);
            $data['category'] = $application['establishment_category_base_on'];
            $data['pco_name'] = $this->getAccountName($application['account_fk']);
            $data['pco_picture'] = $this->getPCOProfilePicByID($application['account_fk'])['file_name'];
            $data['establishment_name'] = $application['name_of_establishment'];
            $data['establishment_address'] = $application['address'];
            $data['category'] = $application['establishment_category_base_on'];
            $data['valid_until'] = $this->getCertificateValidationDate($application['coa_fk'], $region);
            // Date approved.
            $dateApproved = $this->getCertificateValidationApprovedDate($application['coa_fk'],$region);
            $year = date('Y', strtotime($dateApproved)); // Year
            $month = gmdate('F', strtotime($dateApproved)); // Month
            $day = gmdate('j', strtotime($dateApproved) + date("Z")); // Day
            $toWords = new NumberFormatter("en", NumberFormatter::SPELLOUT);
            // Add the correct ordinal number suffix.
            $nFormatter = new NumberFormatter("en", NumberFormatter::ORDINAL);
            $data['day_suffix'] = $nFormatter->format($day);
            $data['date_approved_to_words'] = $month. ", ". ucwords($toWords->format($year));
            // Regional Director.
            $approved_by_user = $this->getCOAApproveBy($application['coa_fk'],$region);
            $rd = $this->getRegionalDirectorName($approved_by_user);
            $data['regional_director_name'] = $rd['name'];
            $rdSignature = $this->getEmployeeSignatureByID($rd['id'])['file_name'];
            $data['rd_signature'] = $rdSignature == null ? 'sample.png': $rdSignature; // Error if no image file or no uploaded signature.
            $data['is_managing_head'] = strval($this->checkIfPCOIsTheManagingHead($application['account_fk']));
            // Render the view.
            $html = $this->load->view('application/certificate_of_accreditation', $data, true);
            require_once(realpath(dirname(__FILE__)) . ("../../helpers/dompdf/dompdf_config.inc.php"));
            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream($data['coa_no'] . ".pdf", array("Attachment" => false));
            exit(0);
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
     }
     
    /**
     * Document code
     * 
     */
    public function getDocumentCode($region) {
        return $this->ApplicationPageModel->documentCode($region)['document_code'];
    }


    /**
      * Get Coa header base on the user region
      * 
      */
     public function getCOAHeader($region) {
         return $this->ApplicationPageModel->coaHeaderPerRegion($region)['file_name'];
     }


     /**
      * Get the application certificate of accreditation approve by.
      * 
      * @param type $id
      */
     public function getCOAApproveBy($id,$region) {
         return $this->ApplicationPageModel->coaNo($id,$region)['approved_by_user_fk'];
     }
     
     /**
      * Get the application certificate of accreditation number.
      * 
      * @param type $id
      */
     public function getCOANo($id,$region) {
         return $this->ApplicationPageModel->coaNo($id,$region)['coa_no'];
     }
     
     /**
      * Get the PCO account name.
      * @param type $id
      */
     public function getAccountName($id) {
        $data = $this->ApplicationPageModel->getAccount($id);
        if($data['middle_name'] != null) {
            $m_name = $data['middle_name'].".";
        } else {
            $m_name = "";
        }
        return $data['first_name']." ".$m_name." ".$data['last_name']." ".$data['name_extension'];
     }
     
     /**
      * Check if the PCO is the Managing head.
      * @param {int} $id 
      * $return boolean
      */
     public function checkIfPCOIsTheManagingHead($id) {
         $data = $this->ApplicationPageModel->getAccount($id);
         if($data['managing_head'] == 1) {
             return 1;
         }
         return 0;
     }

          /**
      * Get the application Certificate of accreditation expiry data.
      * @param type $id
      */
     public function getCertificateValidationDate($id,$region) {
         return $this->ApplicationPageModel->coaNo($id,$region)['valid_until'];
     }
     
     /**
      * Get the application Certificate of accreditation year.
      * @param type $id
      */
     public function getCertificateValidationApprovedDate($id,$region) {
         return $this->ApplicationPageModel->coaNo($id,$region)['date_created'];
     }
     
     /**
      * Regional director name.
      * @return type
      */
     public function getRegionalDirectorName($approved_by_user) {
         $data = $this->ApplicationPageModel->regionalDirector($approved_by_user);
         $name = $data['first_name']." ".$data['middle_name'].". ".$data['last_name']." ".$data['name_extension']."";
         $data['name'] = $name;
         $data['id'] = isset($data['employee_id']) ? $data['employee_id']: null;
         return $data;
     }
     
     /**
     * Get employee signature by id.
     * @param type $id
     * @return type
     */
    public function getPCOProfilePicByID($id) {
        return $this->ApplicationPageModel->PCOProfilePic($id);
    } 
     
     /**
     * Get employee signature by id.
     * @param type $id
     * @return type
     */
    public function getEmployeeSignatureByID($id) {
        return $this->ApplicationPageModel->employeeSignature($id);
    }
    
    /**
     * Get application data.
     * @param type $id
     */
    public function getApplicationData($id) {
        return $this->ApplicationPageModel->getApplication($id);
    }
	
	/**
     * Get application type.
     * @param type $id
     */
    public function getApplicationType($id) {
        return $this->ApplicationPageModel->getApplicationTypeLabel($id)['label'];
    }

}
