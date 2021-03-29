<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * Order of payment page controller
 * 
 * @author JC Dela Cerna Jr. June 2019
 */
class OrderOfPaymentPageController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        try {
            if(isset($this->session->userdata['order_of_payment']['selected_application_id'])) {
                $data = null;
                $applicationID = $this->session->userdata['order_of_payment']['selected_application_id'];
                $accountID = $this->session->userdata['order_of_payment']['selected_account_id'];
                
                // Logged user.
                $data['user'] = $this->getLoggedUser($accountID); 
                // Application data.
                $appDetails = $this->getApplicationDetails($applicationID);
                // Organization data.
                $data['organization'] = $this->getOrganization($appDetails['region']);
                $data['account_id'] = $accountID;
                $data['application_id'] = $appDetails['id'];
                $data['application_name'] = $appDetails['name_of_establishment'];
                $data['application_type'] = $this->getApplicationTypeLabel($appDetails['type_fk'])['label'];
                // Order of payment.
                $oP['application_id'] = $applicationID;
                $oP['account_id'] = $accountID;
                $data['serial_no'] = $this->getInvoice($oP); 
                // Price. 1 is the default of fk of price.
                $data['price'] = $this->getCertificatePrice(1)['price'];
                // Load the view.
                $this->parse('application/order_of_payment_page', 'Order of payment', $data);
            } else {
                show_404();
            }
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
    }
    
    /**
     * Create invoice data.
     */
    public function orderPayment() {
        try {
            $post = $this->input->post();
            $data['account_fk'] = $post['account_id'];
            $data['application_fk'] = $post['application_id'];
            $data['serial_no'] = $post['serial_no'];
            $data['price_fk'] = 1; // 1 is the default value.
            $data['date_created'] = date('Y-m-d H:i:s');
            $invoice = $this->OrderOfPaymentPageModel->createInvoice($data);
            if($invoice) {
                $this->session->set_userdata('invoice',['id' => $invoice ]);
                // Response
                $response = ['status' => 1, 'message' => 'Redirect to order of payment preview!', 'redirectUrl' => base_url('print-order-of-payment')];
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
            $response = ['status' => 0, 'message' => $err->getMessage()];
        }
        echo json_encode($response);
    }

        /**
     * Print order of payment
     */
    public function printOrderPayment() {
        try {
            $data = null;
            // Invoice data.
            $invoiceID = $this->session->userdata['invoice']['id'];
            $invoice = $this->getInvoiceData($invoiceID);
            // Account and application data.
            $application = $this->getApplicationDetails($invoice['application_fk']);
            $employee = $this->getEmployeeDetails($application['evaluator_fk']);
            $account = $this->getAccountDetails($invoice['account_fk']);
            
            // Data.
            $region = $application['region'];
            $data['entity_name'] = $this->getOrganization($region);
            $data['serial_no'] = $invoice['serial_no'];
            $data['date'] = $invoice['date_created'];
            $data['name_of_payor'] = $application['name_of_establishment'];
            $data['office_address_of_payor'] = $application['address'];
            $data['permit_fee'] = $this->getCertificatePrice(1)['price'];
            $data['application_type'] = $this->getApplicationTypeLabel($application['type_fk'])['label'];
            $data['pco_name'] = $account['first_name']." ".$account['middle_name']." ".$account['last_name']." ".$account['name_extension'];
            //$data['pco_signature'] = $this->getPCOSignatureByID($invoice['account_fk'])['file_name'];
            $data['evaluator_name'] = $employee['first_name']." ".$employee['middle_name']." ".$employee['last_name']." ".$employee['name_extension'];
            $data['evaluator_signature'] = $this->getEmployeeSignatureByID($employee['id'])['file_name'];
            // Regional director's data.
            $rd = $this->getRegionalDirectorDetails();
            $data['regional_director_name'] = $rd['first_name']." ".$rd['middle_name'].". ".$rd['last_name'].", ".$rd['name_extension'];
            $rdSignature = $this->getRDSignatureByID($rd['id'])['file_name'];
            $data['rd_signature'] = $rdSignature == null ? 'sample.png': $rdSignature;
            // HTML to PDF renderer 
            $html = $this->load->view('application/print_order_of_payment', $data, true);
            require_once(realpath(dirname(__FILE__)) . ("../../helpers/dompdf/dompdf_config.inc.php"));
            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper('legal', 'portrait');
            $dompdf->render();
            $dompdf->stream($data['serial_no'] . ".pdf", array("Attachment" => false));
            exit(0);
            
//            if ($dompdf) {
//                $dompdf->stream($data['serial_no'] . ".pdf");
//            } else {
//                $dompdf->stream($data['serial_no'] . ".pdf", array("Attachment" => false));
//                exit(0);
//            }
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
    }
    
    /**
     * Get organization data.
     * 
     * @return array
     */
    public function getOrganization($region){
        return $this->OrderOfPaymentPageModel->organization($region);
    }
    
    /**
     * Get regional director's data
     * @param type $id
     * @return type
     */
    public function getRegionalDirectorDetails(){
        return $this->OrderOfPaymentPageModel->regionalDirector();
    }
    
    /**
     * 
     * @param type $accountID
     * @return type
     */
    public function getLoggedUser($accountID){
        return $this->OrderOfPaymentPageModel->loggedUser($accountID);
    }
    
    /**
     * Get invoice data.
     * @param type $id
     * @return type
     */
    public function getInvoiceData($id) {
        return $this->OrderOfPaymentPageModel->invoiceByID($id);
    }

        /**
     * Get invoice data.
     * @param type $data
     */
    public function getInvoice($data) {
        try {
            // Query the existing invoice number.
            $serialNo = $this->OrderOfPaymentPageModel->invoice($data['application_id'])['serial_no'];
            if($serialNo != null) {
                // Existing serial number.
                return $serialNo;
            }
            // Generate invoice number.
            return $this->getSerialNo();
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
        return false;
    }
    
     /**
     * Get employee details.
     * @param type $id
     * @return type
     */
    public function getEmployeeDetails($id) {
        return $this->OrderOfPaymentPageModel->getEmployee($id);
    }
    
     /**
     * Get application details.
     * @param type $id
     * @return type
     */
    public function getAccountDetails($id) {
        return $this->OrderOfPaymentPageModel->getAccount($id);
    }
    
    /**
     * Get application details.
     * @param type $id
     * @return type
     */
    public function getApplicationDetails($id) {
        return $this->OrderOfPaymentPageModel->getApplication($id);
    }
    
    /**
     * Get application type label.
     * @param type $id
     * @return type
     */
    public function getApplicationTypeLabel($id) {
        return $this->OrderOfPaymentPageModel->getApplicationTypeLabel($id);
    }
    
    /**
     * Get serial number
     * @return type
     */
    public function getSerialNo() {
        return $this->OrderOfPaymentPageModel->getSerialNo();
    }
    
    /**
     * Get order of payment price
     * @param type $id
     * @return type
     */
    public function getCertificatePrice($id) {
        return $this->OrderOfPaymentPageModel->getCertifacationPayment($id);
    }
    
    /**
     * Get PCO signature by id.
     * @param type $id
     * @return type
     */
    public function getPCOSignatureByID($id) {
        return $this->OrderOfPaymentPageModel->PCOSignature($id);
    }
    
    /**
     * Get employee signature by id.
     * @param type $id
     * @return type
     */
    public function getEmployeeSignatureByID($id) {
        return $this->OrderOfPaymentPageModel->employeeSignature($id);
    }
    
     /**
     * Get employee signature by id.
     * @param type $id
     * @return type
     */
    public function getRDSignatureByID($id) {
        return $this->OrderOfPaymentPageModel->rdSignature($id);
    }
    
    
}