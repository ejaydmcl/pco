<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * OApplication disposition page controller
 * 
 * @author JC Dela Cerna Jr. July 2019
 */
class ApplicationDispositionPageController extends BaseController {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        // ID
        $applicationID = $this->session->userdata['application_id'];
        
        $dispositionLog = $this->ApplicationDispositionPageModel->getDispositionLog($applicationID);
        $application = $this->getApplicationData($applicationID);
        
        // Disposition log data...
        $data['appication_id'] = $applicationID;
        $data['application_type'] = $this->ApplicationPageModel->getApplicationTypeLabel($application['type_fk'])['label']; 
        $data['subject'] = $dispositionLog['subject'];
        $data['document_date'] = $dispositionLog['document_date'];
        $data['document_no'] = $dispositionLog['document_no'];
        $data['pco_name'] = $this->UserModel->getUserFullName($dispositionLog['from']);
        $data['disposition_log'] = '';
        
        $this->parse('application/application_disposition_page', 'Application Disposition Page', $data);
    }
    
     /**
     * Get application data.
     * @param type $id
     */
    public function getApplicationData($id) {
        return $this->ApplicationPageModel->getApplication($id);
    }
    
    public function dispositionTable() {
        $this->OuthModel->CSRFVerify();
        
        $applicationID = $this->session->userdata['application_id'];
        
        $requestData = $_REQUEST;
        $table = "disposition";
        $fields = "*";
        $id = '';
        $where = " WHERE application_id = ". $applicationID;
        $sql = "SELECT " . $fields;
        $sql .= " FROM " . $table . $where; 
        $query = $this->db->query($sql);
        //$queryqResults = $query->result();
        $totalRecords = $query->num_rows();
        $totalFiltered = $totalRecords;
        $where = " WHERE application_id = ". $applicationID;
        $sql = "SELECT " . $fields;
        $sql .= " FROM " . $table . $where;
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $sql .= " AND `subject` LIKE '%" . $searchValue . "%' ";
            $sql .= " AND `remarks LIKE '%" . $searchValue . "%' ";
            $sql .= " OR `application_id` LIKE '%" . $searchValue . "%' ";
            $sql .= " OR `document_no` LIKE '%" . $searchValue . "%' ";
        }
        $query = $this->db->query($sql);
        $totalFiltered = $query->num_rows();
        //ORDER BY id DESC	
        $sql .= " ORDER BY document_date  " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
        $query = $this->db->query($sql);
        
        //log_message('debug', 'dispositionTable: '. $query);
        
        $SearchResults = $query->result();
        $data = array();
        foreach ($SearchResults as $row) {
            $data = array();
            $id = $row->id;
            $data[] = '<span id=' . $id . '">' . $row->id . '</span>';
            $data[] = '<span id=' . $id . '">' . $this->UserModel->getUserFullName($row->from) . '</span>';
            $data[] = '<span id=' . $id . '">' . gmdate('Y/m/j H:i:s A', strtotime($row->document_date) + date("Z")) . '</span>';
            $data[] = '<span id=' . $id . '">' . $this->UserModel->getForwardedToNameByID($row->forwarded_to) . '</span>';
            $data[] = '<span id=' . $id . '">' . $row->remarks . '</span>';
            $dataList[] = $data;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalRecords), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching,  
            "data" => $dataList == null ? [] : $dataList   // total data array
        );

        echo json_encode($json_data);  // send data as json format	
    }
}