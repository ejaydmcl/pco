<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('BaseController.php');

/**
 * Description of PCOOrganizationController
 *
 * @author Juanito C. Dela Cerna Jr. March 2021
 */
class PCOOrganizationController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        try {
            $data['page_title'] = '';
            $region = isset($this->session->userdata['user']['region']) ? $this->session->userdata['user']['region'] : null;
            $organization = $this->organization($region);
            $data['organization'] = $organization;
            $data['region'] = $this->region();
            $data['province'] = $this->province();
            $data['city'] = $this->city();
            $data['iso'] = $this->getIsoStandard($organization['id']);
            $data['coa_header_filename'] = $this->PCOOrganizationModel->getCoaHeader($data['organization']['attachment'])['file_name']; // TODO
            $this->parse('settings/pco_organization_page', 'PCO Organization', $data);
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
    }
    
    /**
     * contactDetails
     * 
     */
    public function contactDetails() {
        try {
            $this->OuthModel->CSRFVerify();
            $post = $this->input->post();
            $update = $this->PCOOrganizationModel->updateContactDetails($post);
            if (!$update['is_success']) {
                $response = ['status' => 0,'message' => 
                            '<div id="warning" class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                            Local error. Please try again... </div>'
                ];
            } else {
                $response = ['status' => 1, 
                        'message' => '<div id="success" class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i> Alert!</h4>
                       Contact details has been successfully updated. </div>'
                ];
            }
        }  catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
        
        echo json_encode($response);
    }


    /**
     * Get iso data
     * 
     */
    public function getIsoStandard($organization_id) {
        return $this->PCOOrganizationModel->isoStandard($organization_id);
    }


    /**
     * Record the iso data
     * 
     */
    public function isoStandard() {
        try {
            $this->OuthModel->CSRFVerify();
            $post = $this->input->post();
            $update = $this->PCOOrganizationModel->updateIsoStandard($post);
            if (!$update['is_success']) {
                $response = ['status' => 0,'message' => 
                            '<div id="warning" class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                            Local error. Please try again... </div>'
                ];
            } else {
                $response = ['status' => 1, 
                        'message' => '<div id="success" class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i> Alert!</h4>
                       Iso document number has been successfully updated. </div>'
                ];
            }
        }  catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
        
        echo json_encode($response);
    }


    /**
     * Update coa header. 
     * 
     * // TODO... Record the file data
     * 
     */
    public function coaHeader() {
        try {
            $this->OuthModel->CSRFVerify();
            if (isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])) {
                $timestamp = time();
               // $display_name = $_FILES[$param['file']]['name'];
                $base_filename = md5_file($_FILES['file']['tmp_name']);
                $config['file_name'] = strtolower($timestamp .'_'. $base_filename);
                $config['upload_path'] = './uploads/attachment';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] =  500; // 500KB
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('file')) {
                    $response = ['status' => 0,'message' => 
                                '<div id="warning" class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                '. $this->upload->display_errors() .'</div>'
                    ];
                    echo json_encode($response);
                    die;
                } else {
                    $file = $this->upload->data();
                    $post = $this->input->post();
                    $data = [
                        'office_id' => $post['office_id'], 
                        'used_to' => COA_HEADER,
                        'file_name' => $file['file_name'],
                        'user_fk' => $this->session->userdata['user']['id'],
                        'date_modified' => date('Y-m-d H:i:s')
                    ];
                    $update = $this->PCOOrganizationModel->updateCoaHeader($data);
                    if (!$update['is_success']) {
                        $response = ['status' => 0,'message' => 
                                    '<div id="warning" class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                    Local error. Please try again... </div>'
                        ];
                    } else {
                        $response = ['status' => 1, 
                                'message' => '<div id="success" class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-info"></i> Alert!</h4>
                                Coa header has been successfully updated. </div>'
                        ];
                    }
                }
            }
        }  catch (Exception $err) {
            // log_message('error', $err->getMessage() . ' in' . $err->getFile() . ':' . $err->getLine());
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
        echo json_encode($response);
    }

    /**
     * Organization
     */
    public function organization($region) {
        return $this->PCOOrganizationModel->getOrganization($region);
    }

    /**
     * Get office location
     * 
     * @param {int} $region 
     */
    public function region() {
        return $this->PCOOrganizationModel->getRegion();
    }
    
    public function province() {
        return $this->PCOOrganizationModel->_getProvince();
    }
    
    public function city() {
        return $this->PCOOrganizationModel->_getMunicipality();
    }
    
     /**
     * province list
     * * */
    public function provinceList() {
        $data = $this->input->get('data');
        echo json_encode($this->PCOOrganizationModel->getProvince($data));
    }
    
    /**
     * province list
     * * */
    public function cityList() {
        $data = $this->input->get('data');
        echo json_encode($this->PCOOrganizationModel->getMunicipality($data));
    }
    
    /**
     * Record Office Information
     * 
     */
    public function recordOfficeInformation() {
        try {
            $this->OuthModel->CSRFVerify();
            $post = $this->input->post();
            $response = ['status' => 0,'message' => 
                        '<div id="warning" class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                        Local error. Please try again... </div>'
            ];
            
            // Update office information
            $update = $this->PCOOrganizationModel->updateOfficeInformation($post);
            if($update['is_success']) {
                $response = ['status' => 1, 
                        'message' => '<div id="success" class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i> Alert!</h4>
                        Information has been successfully updated. </div>'
                ];
            }
        }  catch (Exception $err) {
             log_message('error', $err->getMessage() . ' in' . $err->getFile() . ':' . $err->getLine());
        }
        echo json_encode($response);
    }
}
