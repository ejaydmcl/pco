<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');
/**
 * Description of ClientPageController
 *
 * @author User March 22, 2021
 */
class ClientPageController extends BaseController {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        try {
            $userID = isset($this->session->userdata['user']['id']) ? $this->session->userdata['user']['id'] : 0;
            if ($this->authorizedUser($userID)) {
                $data[''] = null;
                $this->parse('system/client_page', 'Client page', $data);
            } else {
                show_404();
            }
        }catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
    }
    
    /**
     * clientList
     * 
     */
    public function clientList() {
        try {
            $this->OuthModel->CSRFVerify();
            $param['limit'] = $_REQUEST['length'];
            $param['offset'] = $_REQUEST['start'];
            $param['search'] = $_REQUEST['search']['value'];
            $draw = $_REQUEST['draw'];
            $param['sort'] = $_REQUEST['order'][0]['dir'];
            $result = $this->ClientModel->clientTable($param);
            $data = array();
            foreach ($result as $row) {
                $data = array();
                $id = $row->id;
                $data[] = $row->id;
                $data[] = $this->UserModel->getUserFullName($row->id);
                $data[] = $row->email;
                $data[] = $this->utils->format_date($row->date_created);
                $data[] = '<input type="checkbox" ' . ($row->is_email_verify == 1 ? 'checked' : 'unchecked') .'>';
                $data[] = '<input type="checkbox" ' . ($row->is_active == 1 ? 'checked' : 'unchecked') .'>';
                $data[] = '<input type="checkbox" ' . ($row->notification == 1 ? 'checked' : 'unchecked') .'>';
                $action = '<a target="_blank" href="'. base_url().'client-profile?id='.$id.'"> <i class="fa fa-user-circle"></i></a>'; 
                $data[] = $action;
                $dataList[] = $data;
            }
            $recordCount = $this->ClientModel->count_all();
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
    
}
