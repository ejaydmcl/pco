<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * Add new application with existing coa form page controller
 * @author JC Dela Cerna Jr. May 2019
 */
class AddNewApplicationExistingCoaFormController extends BaseController {

    public function index() {
        try {
            $data['application_status'] = '';
            $data['yes'] = $this->input->get('yes');
            $data['pco_employment_status'] = $this->AddNewApplicationPageModel->getEmploymentStatusLabel();
            $data['account_fk'] = isset($this->session->userdata['account']['account_fk']) == FALSE ? NULL : $this->session->userdata['account']['account_fk'];
            $data['region'] = $this->getRegion();
            // Nature of business list.
            $data['nature_of_business'] = $this->getNatureBusinessList();
            if ($this->input->get('yes') == '1') {
                $this->parse('application/add_new_application_with_existing_coa_form', 'Add New Application with exiting old coa Form', $data);
            } else {
                $this->parse('application/add_new_application_form', 'Add New Application Form', $data);
            }
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
    }

    /**
     * establishmentList
     * 
     */
    public function establishmentList() {
        $region = $this->input->post('region');
        echo json_encode($this->AddNewApplicationPageModel->getEstablishmentList($region));
    }

    /**
     * Get region
     * 
     */
    public function getRegion() {
        return $this->PCOOrganizationModel->getRegion();
    }

    public function getNatureBusinessList() {
        return $this->AddNewApplicationPageModel->getNatureBusinessList();
    }

    /**
     * Add new application data
     */
    public function addNewApplicationData() {
        try {
            $this->OuthModel->CSRFVerify();
            $post = $this->input->post(); // Get the inputs...
            
            //echo var_dump($post); die;

            if ($post['region'] == '0') {
                $response = ['status' => 0, 'message' => 'Please select a region.'];
                echo json_encode($response);
                die;
            }
            if ($post['establishment_name'] == '-SELECT-') {
                $response = ['status' => 0, 'message' => 'Please select a establishment name.'];
                echo json_encode($response);
                die;
            }
            if ($post['nature_of_business'] == '0') {
                $response = ['status' => 0, 'message' => 'Please select a nature of business.'];
                echo json_encode($response);
                die;
            }
            if ($post['establishment_category'] == '0') {
                $response = ['status' => 0, 'message' => 'Please select a establishment category.'];
                echo json_encode($response);
                die;
            }
            if ($post['pco_employment_status'] == '0') {
                $response = ['status' => 0, 'message' => 'Please select a employment status.'];
                echo json_encode($response);
                die;
            }
            // Validate the inputs.
            $this->form_validation->set_rules('region', 'Region', 'required');
            $this->form_validation->set_rules('establishment_name', 'Establishment name', 'required');
            $this->form_validation->set_rules('nature_of_business', 'Nature of usiness', 'required');
            $this->form_validation->set_rules('establishment_category', 'Establishment category', 'required');
            $this->form_validation->set_rules('pco_employment_status', 'Pco employment status', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('telephone_no', 'Telephone no', 'required');
            $this->form_validation->set_rules('website', 'website', 'required');
            $this->form_validation->set_rules('current_position', 'Current position', 'required');
            $this->form_validation->set_rules('no_of_years_in_current_position', 'No of years in current position', 'required');
            $this->form_validation->set_rules('administrative_case', 'Administrative case', 'required');
            $this->form_validation->set_rules('criminal_case', 'Criminal case', 'required');
            $this->form_validation->set_rules('coa', 'Coa No.', 'required');
            $this->form_validation->set_rules('datepicker_coa_date_approved', 'Coa date approved', 'required');
            $this->form_validation->set_rules('datepicker_coa_date_expired', 'Coa date expired', 'required');
            if ($this->form_validation->run() == FALSE) {
                $response = ['status' => 0, 'message' => validation_errors()];
                echo json_encode($response);
                die;
            } else {
                // Submit the new application
                if (isset($_FILES['dully_sined_appointment_or_designation']['name']) &&
                        isset($_FILES['certificate_of_employment']['name']) &&
                        isset($_FILES['notarized_affidavit_of_joint_undertaking']['name']) &&
                        isset($_FILES['certificate_of_accreditation']['name'])) {
                    // Upload cnfguration...
                    $config['upload_path'] = './uploads/attachment';
                    $config['allowed_types'] = 'pdf|jpg|png';
                    $config['max_size'] = 104858;
                    $this->load->library('upload', $config);
                    // Upload the file first...
                    if (!$this->upload->do_upload('certificate_of_accreditation')) {
                        echo json_encode(['status' => 0, 'message' => 'Certificate of accreditation ' . $this->upload->display_errors()]);
                        die;
                    }
                    // 
                    $coaFile = $this->upload->data();
                    if (!$this->upload->do_upload('dully_sined_appointment_or_designation')) {
                        echo json_encode(['status' => 0, 'message' => 'Dully sined appointment or designation ' . $this->upload->display_errors()]);
                        die;
                    }
                    // dully_sined_appointment_or_designation
                    $dsadFile = $this->upload->data();
                    if (!$this->upload->do_upload('certificate_of_employment')) {
                        echo json_encode(['status' => 0, 'message' => 'Certificate of employment ' . $this->upload->display_errors()]);
                        die;
                    }
                    // certificate_of_employment
                    $coeFile = $this->upload->data();
                    if (!$this->upload->do_upload('notarized_affidavit_of_joint_undertaking')) {
                        echo json_encode(['status' => 0, 'message' => 'Notarized affidavit of joint undertaking ' . $this->upload->display_errors()]);
                        die;
                    }
                    // notarized_affidavit_of_joint_undertaking
                    $nafjuFile = $this->upload->data();
                    // New application file data...
                    $userId = $this->session->userdata['user']['id'];
                    $coaData = [
                        // managing_head_certificate
                        'used_to' => CERTIFICATE_OF_ACCREDITATION,
                        'file_name' => $coaFile['file_name'],
                        'file_ext' => $coaFile['file_size'],
                        'file_size' => $coaFile['file_ext'],
                        'user_fk' => $userId,
                        'date_created' => date('Y-m-d H:i:s')
                    ];

                    // dully_sined_appointment_or_designation
                    $dsadData = [
                        'used_to' => DULLY_SINED_APPOINTMENT_OR_DESIGNATION,
                        'file_name' => $dsadFile['file_name'],
                        'file_size' => $dsadFile['file_size'],
                        'file_ext' => $dsadFile['file_ext'],
                        'user_fk' => $userId,
                        'date_created' => date('Y-m-d H:i:s')
                    ];

                    // certificate_of_employment
                    $coeData = [
                        'used_to' => CERTIFICATE_OF_EMPLOYMENT,
                        'file_name' => $coeFile['file_name'],
                        'file_size' => $coeFile['file_size'],
                        'file_ext' => $coeFile['file_ext'],
                        'user_fk' => $userId,
                        'date_created' => date('Y-m-d H:i:s')
                    ];
                    // notarized_affidavit_of_joint_undertaking
                    $nadjuData = [
                        'used_to' => NOTARIZED_AFFIDAVIT_OF_JOINT_UNDERTAKING,
                        'file_name' => $nafjuFile['file_name'],
                        'file_size' => $nafjuFile['file_size'],
                        'file_ext' => $nafjuFile['file_ext'],
                        'user_fk' => $userId,
                        'date_created' => date('Y-m-d H:i:s')
                    ];

                    // This will do the logic to save and submit the application.
                    $forwardedTo = null;
                    if ($post['submit'] == SAVE) {
                        // If the application is save the application is not forwarded to Section chief.
                        $forwardedTo = $post['account_fk'];
                    } else {
                        // ID the application is submitted the app. is forwarded to section chief.
                        $forwardedTo = $this->getCurrentSectionChief($post['region'])['employee_fk'];
                    }

                    // New application data...
                    $appData = [
                        'sys_gen' => $post['sys_gen'],
                        'account_fk' => $post['account_fk'],
                        'employee_fk' => $forwardedTo, // By default the application will be submitted to the section chief.
                        'type_fk' => $post['type'], // 1 is new and 2 is renewal
                        'status_fk' => $post['submit'], // 1 or Save by default.
                        'region' => $post['region'],
                        'name_of_establishment' => strtoupper($post['establishment_name']),
                        'address' => ucwords($post['address']),
                        'nature_of_business_establishment' => ucfirst($post['nature_of_business']),
                        'establishment_category_base_on' => ucfirst($post['establishment_category']),
                        'telephone_no' => $post['telephone_no'],
                        'website' => $post['website'],
                        'pco_e_status_fk' => $post['pco_employment_status'],
                        'pco_current_position' => strtoupper($post['current_position']),
                        'no_of_years_current_position' => $post['no_of_years_in_current_position'],
                        'name_of_managing_head' => ucfirst($post['name_of_managing_head']),
                        'administrative_case' => $post['administrative_case'],
                        'ac_details' => ucfirst($post['administrative_case_details']),
                        'criminal_case' => $post['criminal_case'],
                        'cc_details' => ucfirst($post['criminal_case_details']),
                        'dsad_fk' => $this->AddNewApplicationPageModel->insertAttachmentData($dsadData),
                        'coe_fk' => $this->AddNewApplicationPageModel->insertAttachmentData($coeData),
                        'nafju_fk' => $this->AddNewApplicationPageModel->insertAttachmentData($nadjuData),
                        'date_created' => date('Y-m-d H:i:s')
                    ];

                    // Existing old coa for renewal // TODO...
                    $oldCoa = [
                        'attachment' => $this->AddNewApplicationPageModel->insertAttachmentData($coaData),
                        'coa_no' => $post['coa'],
                        'date_approved' => $post['datepicker_coa_date_approved'],
                        'date_expired' => $post['datepicker_coa_date_expired']
                    ];

                    // Save the appliaction data...
                    $isSave = $this->AddNewApplicationPageModel->insertRenewalExistingCoa($appData, $oldCoa);
                    if ($isSave['is_success']) {
                        // Add a comment to notify the pco...
                        $id = $isSave['id']; // Application id.
                        $comment = null;
                        $this->session->set_userdata('account_fk', $post['account_fk']);
                        if ($post['submit'] == SAVE) {
                            $comment = 'Application saved.';
                        } else {
                            $comment = 'Application submitted.';
                        }
                        $userFk = $this->session->userdata['user']['id'];
                        $data = [
                            'user_fk' => $userFk,
                            'comment' => ucfirst($comment), // The sender's comment. 
                            'application_fk' => $id, // The selected application
                            'sender_id' => $userFk,
                            'receiver_id' => $forwardedTo, // The receiver id.
                            'flag' => PCO, // For the section chief.
                            'date_created' => date('Y-m-d H:i:s'), // Current date.
                        ];

                        // Add a comment
                        $isSubmitted = $this->ApplicationDetailsPageModel->recordTheNotification($data);
                        if ($isSubmitted) {
                            // Application details.
                            // Disposition log
                            $date = date('Y-m-d H:i:s');
                            $documentNo = gmdate('Y-m-j', strtotime($date) + DATE("Z"));
                            $dispositionLog = [
                                'application_id' => $id,
                                'subject' => $comment,
                                'from' => $userFk,
                                'forwarded_to' => $forwardedTo, // $this->getCurrentSectionChief()['employee_fk'], 
                                'document_no' => 'PCO-' . $documentNo . '-ID-' . $id, //$this->ApplicationDispositionPageModel->generateDocumentNo(),
                                'document_date' => $date,
                                'date_time' => $date,
                                'remarks' => $comment,
                            ];

                            $isSucces = $this->ApplicationDispositionPageModel->dispositionLog($dispositionLog);
                            if ($isSucces) {
                                // DO NOTHING...
                            }

                            if ($post['submit'] == SAVE) {
                                $response = ['status' => 1,
                                    'message' => 'Successfully save !'
                                ];
                            } else {
                                $response = ['status' => 2,
                                    'message' => 'Successfully submitted!'
                                ];
                            }
                        }
                    } else {
                        $response = ['status' => '0', 'message' => 'STATUS ERROR CODE: 409 Confict'];
                    }
                }
            }
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
        echo json_encode($response);
    }

    public function getCurrentSectionChief($region) {
        return $this->AddNewApplicationPageModel->getSectionChief($region);
    }

    public function temp() {
        $this->OuthModel->CSRFVerify();
        //$resonse = ['status' => 0, 'message' => $_FILES['work_experience_certificate']['name']];
        if (isset($_FILES['work_experience_certificate']['name']) && !empty($_FILES['work_experience_certificate']['name'])) {
            $config['upload_path'] = './uploads/attachment';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 2048;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('work_experience_certificate')) {
                echo json_encode(['status' => 0, 'message' => $this->upload->display_errors()]);
                die;
            } else {
                $file = $this->upload->data();
                $post = $this->input->post();
                $data = [
                    'work_experience_id' => $post['work_experience_id'],
                    'attachment_id' => $post['attachment_id'],
                    'used_to' => WORK_EXPERIENCE,
                    'file_name' => $file['file_name'],
                    'user_fk' => $this->session->userdata['user']['id'],
                    'company' => $post['company'],
                    'position' => $post['position'],
                    'employment_status' => $post['employment_status'],
                    'from_date' => $post['from_date'],
                    'to_date' => $post['to_date']
                ];
                $query = $this->UserModel->UpdatePCOWorkExperienceByUserID($data);
                if ($query == true) {
                    $resonse = ['status' => 1, 'message' => 'Successfully save !'];
                } else {
                    $resonse = ['status' => 0, 'message' => 'STATUS ERROR CODE: 500'];
                }
            }
        }
    }

}
