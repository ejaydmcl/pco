<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('BaseController.php');

/**
 * Description of PCOSystemController
 *
 * @author Juanito C. Dela Cerna Jr. February 2021
 */
class PCOSystemController  extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['page_title'] = '';
        $this->parse('system/pco_system_page', 'PCO System', $data);
    }
    
    /**
     * System error logs
     * Data table
     */
    public function ErrorLogsDataGrid() {
        try {
            $this->OuthModel->CSRFVerify();
            $param['limit'] = $_REQUEST['length'];
            $param['offset'] = $_REQUEST['start'];
            $param['search'] = $_REQUEST['search']['value'];
            $draw = $_REQUEST['draw'];
            $param['sort'] = $_REQUEST['order'][0]['dir'];
            $result = $this->PCOSystemModel->errorLogs($param);
            $data = array();
            foreach ($result as $row) {
                $data = array();
                $id = $row->id;
                $data[] = '<span id=' . $id . '">' . $this->utils->format_date($row->created_time) . '</span>';
                $data[] = '<span id=' . $id . '">' . $row->file . '</span>';
                $data[] = '<span id=' . $id . '">' . $row->line . '</span>';
                $data[] = '<span id=' . $id . '">' . $row->message . '</span>';
                $dataList[] = $data;
            }
            $recordCount = $this->PCOSystemModel->count_all();
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
        echo json_encode($json_data);
    }
    
}
