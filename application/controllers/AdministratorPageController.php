<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once('BaseController.php');

/**
 * 
 * Add user controller
 * 
 * @author JC Dela Cerna Jr. March 2021
 */
class AdministratorPageController extends BaseController {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        try {
            $userID = isset($this->session->userdata['user']['id']) ? $this->session->userdata['user']['id'] : 0;
            if ($this->authorizedUser($userID)) {
                $data['user_role'] = $this->UserModel->getUserRoleLabel();
                $data['designation'] = $this->UserModel->getEmployeeDesignationLabel();
                $data['iisuserlist'] = $this->UserModel->iisUserListForSuperUser();
                $this->parse('system/administrator_page', 'Administrator page', $data);
            } else {
                show_404();
            }
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
    }
    
    /**
     * Add new personnel
     * This function is for super user
     */
    public function addNewPersonnel() {
        try {
            $this->OuthModel->CSRFVerify();
            $post = $this->input->post();
            $user = $this->UserModel->embPersonnel($post['personnel']);
            // Check the user was already added.
            $isExist = $this->UserModel->isUserAlreadyAdded($user->userid);
            if($isExist) {
                $response = ['status' => 0, 'message' => 'User was already added!'];
                echo json_encode($response);
                die;
            }
            $data = [
                'role' => $post['role'],
                'designation' => $post['designation'],
                'userid'=> $user->userid, // iisuserid
                'region'=> $user->region,
                'prefix'=> $user->prefix,
                'first_name'=> $user->fname,
                'last_name'=> $user->sname,
                'middle_name'=> $user->mname,
                'name_extension'=> $user->suffix,
                'email'=> $user->email,
                'is_active'=> 1   
            ];
            // Add data.
            $response = $this->UserModel->grantIISUser($data);
            if($response['is_success']) {
                 $response = ['status' => 1];
            } else {
                 $response = ['status' => 0, 'message' => 'Internal Error!'];
            }
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
        echo json_encode($response);
    }
    
    public function userListDataGrid() {
        try {
            $this->OuthModel->CSRFVerify();
            $param['limit'] = $_REQUEST['length'];
            $param['offset'] = $_REQUEST['start'];
            $param['search'] = $_REQUEST['search']['value'];
            $draw = $_REQUEST['draw'];
            $param['sort'] = $_REQUEST['order'][0]['dir'];
            //$param['region'] = $this->session->userdata['user']['region'];
            $result = $this->UserModel->UserTableForSuperUser($param);
            $data = array();
            foreach ($result as $row) {
                $data = array();
                $id = $row->id;
                $data[] = '<span id=' . $id . '">' . $row->id . '</span>';
                $data[] = '<span id=' . $id . '">' . $row->region . '</span>';
                $name = $this->UserModel->getUserFullName($row->id);
                $data[] = '<span id=' . $id . '">' . $name . '</span>';
                $data[] = '<span id=' . $id . '">' . $this->UserModel->getUserType($row->id)['label'] . '</span>';
                $data[] = '<span id=' . $id . '">' . $this->getUserDesignation($row->designation_fk) . '</span>';
                $data[] = '<span id=' . $id . '">' . $this->utils->format_date($row->date_created) . '</span>';
                $action = '<a onclick="editUser(' . $id . ',' . $this->isPCO($id) . ')" href="javascript:void(0);" <i class="fa fa-pencil"></i></a> ';
                $data[] = $action;
                $dataList[] = $data;
            }
            $recordCount = $this->UserModel->count_all_admin_page($param);
            $json_data = array(
                "draw" => intval($draw['draw']),
                "recordsTotal" => intval($recordCount), // total number of records
                "recordsFiltered" => intval($recordCount), // total number of records after searching,  
                "data" => $dataList == null ? [] : $dataList   // total data array
            );
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
        echo json_encode($json_data);  // send data as json format	
    }
    
    /**
     * Get user designation label.
     * @param type $id
     */
    public function getUserDesignation($id) {
        $ret = $this->UserModel->getEmployeeDesignationLabelByID($id);
        if ($ret != null) {
            return $ret['label'];
        } else {
            return 'PCO';
        }
    }
    
    public function isPCO($id) {
        $type = $this->UserModel->getUserType($id);
        $ret = null;
        switch ($type['role_fk']) {
            case SUPER_USER:
                $ret = 0;
                break;
            case SYSTEM_ADMINISTRATOR:
                $ret = 0;
                break;
            case EMPLOYEE:
                $ret = 0;
                break;
            case PCO:
                $ret = 1;
                break;
            default:
                $ret = 0;
                break;
        }
        return $ret;
    }
}
