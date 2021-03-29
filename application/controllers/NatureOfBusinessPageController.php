<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * Nature business page controller
 * @author JC Dela Cerna Jr. August 2019
 */
class NatureOfBusinessPageController extends BaseController {

    public function index() {
        $this->parse('settings/nature_of_business_page', 'Nature of Business Page', []);
    }

    public function natureOfBusinessDataGridList() {
        $this->OuthModel->CSRFVerify();
        $requestData = $_REQUEST;
        $table = "nature_of_business";
        $fields = "*";
        $id = '';
        $where = " WHERE `is_active` = 1 OR `is_active` = 0 ";
        $sql = "SELECT " . $fields;
        $sql .= " FROM " . $table . $where;
        $query = $this->db->query($sql);
        //$queryqResults = $query->result();
        $totalRecords = $query->num_rows();
        $totalFiltered = $totalRecords;
        $where = " WHERE `is_active` = 1 OR `is_active` = 0 ";
        $sql = "SELECT " . $fields;
        $sql .= " FROM " . $table . $where;
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $sql .= " AND `category` LIKE '%" . $searchValue . "%' ";
            $sql .= " AND `category` LIKE '%" . $searchValue . "%' ";
            $sql .= " OR `category` LIKE '%" . $searchValue . "%' ";
            $sql .= " OR `category` LIKE '%" . $searchValue . "%' ";
        }
        $query = $this->db->query($sql);
        $totalFiltered = $query->num_rows();
        //ORDER BY id DESC	
        $sql .= " ORDER BY date_created  " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
        $query = $this->db->query($sql);
        $SearchResults = $query->result();
        $data = array();
        foreach ($SearchResults as $row) {
            $data = array();
            $id = $row->id;
            $data[] = '<span id=' . $id . '">' . $row->id . '</span>';
            $data[] = '<span id=' . $id . '">' . $row->psic_code . '</span>';
            $data[] = '<span id=' . $id . '">' . $row->category . '</span>';
            $data[] = '<span id=' . $id . '">' . $row->significant_parameters . '</span>';
            $active = 'No';
            if($row->is_active) {
                $active = 'Yes';
            }
            $data[] = '<span id=' . $id . '">' . $active . '</span>';
            //$data[] = '<span id=' . $id . '">' . gmdate('F j, Y', strtotime($row->date_created) + date('Z')) . '</span>';
            $action = '<a onclick="editCategory(' . $id . ')" href="javascript:void(0);" <button type="button" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a> ';
            $data[] = '<span id=' . $id . '">' . $action . '</span>';
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

    public function addNatureOfBusiness() {
        // Validate the input
        $this->form_validation->set_rules('industry_category', 'Industry Category', 'required');
        $this->form_validation->set_rules('is_active', 'Active', 'required');
        if ($this->form_validation->run() == FALSE) {
            $response = ['status' => 0, 'message' => '<span style="color:#900;">' . validation_errors() . '</span>'];
            echo json_encode($response);
            die;
        } else {
            $post = $this->input->post();
            // Add industry category data
            $data = [
                'psic_code' => $post['psic_code'],
                'category' => $post['industry_category'],
                'significant_parameters' => $post['significant_parameters'],
                'is_active' => $post['is_active'],
                'date_created' => date('Y-m-d H:i:s')
            ];

            // Add data.
            $res = $this->NatureOfBusinessModel->createNatureOfBusiness($data);
            if ($res) {
                $resonse = ['status' => 1, 'message' => 'Successfully save !'];
            } else {
                $resonse = ['status' => 0, 'message' => 'False'];
            }
            echo json_encode($resonse);
        }
    }

}
