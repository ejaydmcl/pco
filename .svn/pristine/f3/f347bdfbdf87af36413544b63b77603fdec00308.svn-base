<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once('BaseController.php');

/**
 * Application page controller
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class ApplicationDetailsPageController extends BaseController {

    public function __construct() {
        parent::__construct();
        // $this->output->enable_profiler(TRUE);
    }

    public function index() {
        try {
            // Page title.
            $data['page_title'] = '';
            // Application id.
            $ID = $this->session->userdata('application_id');
            // Application details.
            $applicationDetails = $this->ApplicationDetailsPageModel->getApplicationDetails($ID);    
            $data['account_id'] = $applicationDetails['account_fk'];
            // Get the profile picture name.
            $data['picture_file_name'] = $this->ApplicationDetailsPageModel->getSelectedPCOProfilePhoto(
                    $this->ApplicationDetailsPageModel->getUserIDByAccountID($applicationDetails['account_fk'])['id']);
            // User full name
            $data['user_full_name'] = $this->UserModel->getAccountUserFullName($applicationDetails['account_fk']);
            // Date submitted
            $data['date_submitted'] = $applicationDetails['date_created'];
            // Application comments
            $comment = $this->ApplicationDetailsPageModel->getApplicationComments($ID);
            $data['application_id'] = $applicationDetails['id'];
            $data['origin'] = $applicationDetails['origin'];
            $data['establishment'] = $applicationDetails['name_of_establishment'];
            $data['nature'] = $applicationDetails['nature_of_business_establishment'];
            $data['address'] = $applicationDetails['address'];
            $data['telephone_no'] = $applicationDetails['telephone_no'];
            //$data['fax_no'] = $applicationDetails['fax_no'];
            $data['website'] = $applicationDetails['website'];
            $data['type_fk'] = $applicationDetails['type_fk'];
            $data['status_fk'] = $applicationDetails['status_fk'];
            $data['comments_count'] = $this->ApplicationDetailsPageModel->getApplicationsCommentsCount($ID);
            $data['comments'] = $comment;
            // Get current logged user information.
            $userID = isset($this->session->userdata['user']['id']) ? $this->session->userdata['user']['id'] : 0;
            $data['application_status'] = $this->ApplicationDetailsPageModel->getApplicationStatus($userID);
            $data['assignee'] = $applicationDetails['employee_fk'];
            // List of user. This will display on field Forwarded to. 
            $user['forwarded_to'] = $applicationDetails['employee_fk']; // User who currently assign to the selected application.
            $user['account_id'] = $applicationDetails['account_fk']; // Account id of the seleted application.
            $user['user_id'] = $userID; // user id of the current logged user.
            $user['region'] = $applicationDetails['region'];
            $data['list_of_employee'] = $this->ApplicationDetailsPageModel->getListOfUsersByDesignation($user);
            $userRole = array($this->PCOModel->getUserRole($userID)['role_fk']);
            if (count(array_intersect($userRole, array(SUPER_USER, SYSTEM_ADMINISTRATOR, EMPLOYEE)))) {
                $data['is_pco'] = FALSE;
                $data['is_edit'] = TRUE; // Flag to edit the data for the employee.
                $data['is_order_of_payment'] = FALSE;
            } else {
                $data['is_pco'] = TRUE;
                $data['is_edit'] = FALSE; // Flag to edit the data for the pco.
                $data['is_order_of_payment'] = TRUE;
            }
            // Enable or disable the comment box
            $data['is_comment_enable'] = $this->isCommentEnable($applicationDetails['employee_fk']);
            // Load the view.
            $this->parse('application/application_details_page', 'Application Details', $data);
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
    }

    /**
     * PCO comment restriction.
     * The comment box will enable if the 
     * application was already routed to the 
     * PCO client.
     * 
     * Get the status of the application
     * This function will check the application if
     * the application is locked.
     * 
     * @param {int} $id
     */
    public function isCommentEnable($id) {
        try {
            // Current logged user id.
            $user_id = $this->session->userdata['user']['id'];
            $evaluator_user_id = $this->ApplicationModel->getUserID($id);
            if ($user_id == $evaluator_user_id) {
                return true;
            }
        } catch (Exception $err) {
            log_message('ERROR', $err->getMessage());
        }
        return false;
    }

    /**
     * Edit the application status and assignee.
     */
    public function editStatusAndAssignee() {
        try {
            $this->OuthModel->CSRFVerify();
            $post = $this->input->post();

            if ($post['application_assignee'] == 0) {
                $response = ['status' => 0, 'message' => 'Assignee is empty !'];
                echo json_encode($response);
                die;
            }

            // Check if the logged user is Regional director.
            $userId = $this->session->userdata['user']['id'];
            $type = $this->UserModel->getUserDesignation($userId);
            // Check the assigned user for the application.
            // Notify the user if the application was already assigned to her/him.
            $emloyeeFk = $this->session->userdata['user']['employee_fk'];
            if ($emloyeeFk == $post['application_assignee'] && $type['designation_id'] != REGIONAL_DIRECTOR) {
                $message = ['status' => 0, 'message' => 'The application was already assigned to you.'];
                echo json_encode($message);
                die;
            }

            // For the approved application
            if (isset($post['application_status']) AND $post['application_status'] == APPROVED AND $post['application_type_id'] == _NEW) {
                // Application data.
                $approvedByUserFk = $this->session->userdata['user']['id'];
                $applicationTypeFk = $post['application_type_fk'];
                $applicationFk = $post['application_id'];
                // Generate a coa number.
                $coaFk = $this->generateCOANo($approvedByUserFk, $applicationTypeFk, $applicationFk);
            }

            // For renewal application.
            if (isset($post['application_type_id']) AND $post['application_type_id'] == RENEWAL AND $post['application_status'] == APPROVED) {
                // Application data.
                $applicationOriginID = $post['application_origin'];
                $approvedByUserFk = $this->session->userdata['user']['id'];
                //$applicationTypeFk = $post['application_type_fk'];
                $applicationFk = $post['application_id'];
                // Generate a coa number.
                $coaFk = $this->generateCOANoForRenewal($approvedByUserFk, $applicationOriginID, $applicationFk);
            }

            // Application data 
            $data = [
                'employee_fk' => $post['application_assignee'],
                'status_fk' => $post['application_status'],
                'coa_fk' => $coaFk,
                'date_modified' => date('Y-m-d H:i:s')
            ];

            // Update the application table.
            $isUpdate = $this->ApplicationDetailsPageModel->updateApplicationByID($post['application_id'], $data);
            if ($isUpdate) {
                // Add a comment to notify the pco...
                $name = $this->UserModel->getForwardedToNameByID($post['application_assignee']); // Name of the user account or employee.
                $status = $this->ApplicationPageModel->getApplicationStatusLabel($post['application_status'])['label'];
                $userId = $this->session->userdata['user']['id'];
                $recieverId = $post['application_assignee'];
                $dataTable = [
                    'comment' => ' Forwarded to ' . $name . ' and status set to ' . $status . '.',
                    'application_fk' => $post['application_id'],
                    'user_fk' => $this->session->userdata['user']['id'],
                    'date_created' => date('Y-m-d H:i:s'),
                ];

                // Filter the current logged user
                $flag = $this->UserModel->getUserDesignation($userId);
                $data = [
                    'status' => $post['application_status'],
                    'user_fk' => $userId,
                    'comment' => ' Forwarded to ' . $name . ' and status set to ' . $status . '.', // The sender's comment. 
                    'application_fk' => $post['application_id'], // The selected application
                    'sender_id' => $userId,
                    'receiver_id' => $recieverId,
                    'flag' => $flag['designation_id'],
                    'date_created' => date('Y-m-d H:i:s'), // Current date.
                ];

                // Record the notification.
                $isRecorded = $this->ApplicationDetailsPageModel->recordTheNotification($data);
                $message = null;
                // Updated
                if ($isRecorded['application_updated'] && $isRecorded['status']) {
                    $message = 'Application has been forwarded!';
                }
                // Approved. Forwarded to regional director
                if ($isRecorded['application_approved'] && $isRecorded['status']) {
                    $message = 'Application has been approved!';
                }

                $response = ['status' => 1,
                    'message' => $message,
                    'assignee_label' => $name,
                    'status_label' => $status,
                    'comment' => $dataTable['comment'],
                    'application_fk' => $dataTable['application_fk'],
                    'name' => $this->UserModel->getCommentUserFullName($dataTable['user_fk']),
                    'date_created' => gmdate('F j, Y', strtotime($dataTable['date_created']) + date('Z'))
                ];
            } else {
                $response = ['status' => 0, 'message' => 'Failed!'];
            }
        } catch (Exception $err) {
            $this->load->library('custom_exception');
            $this->custom_exception->handle_exception($err->getFile(), $err->getLine(), $err->getMessage());
        }
        echo json_encode($response);
    }

    /**
     * Submit the application back to evaluator
     * 
     */
    public function submitBackToEvaluator() {
        $post = $this->input->post();
        $application = $this->ApplicationDetailsPageModel->getApplicationDetails($post['application_id']);
        // Application data 
        $applicationData = [
            'employee_fk' => $application['evaluator_fk'],
            'date_modified' => date('Y-m-d H:i:s')
        ];

        // Update the application table.
        $isUpdate = $this->ApplicationDetailsPageModel->updateApplicationByID($post['application_id'], $applicationData);
        if ($isUpdate) {
            // Add a comment to notify the pco...
            $name = $this->UserModel->getForwardedToNameByID($application['evaluator_fk']); // Name of the user account or employee.
            $status = $this->ApplicationPageModel->getApplicationStatusLabel($application['status_fk'])['label'];
            // This is the default receiver for comment.
            $recieverId = $this->getTheEvaluator($post['application_id'])['evaluator_fk'];
            $userId = $this->session->userdata['user']['id']; // The user's id sender.
            $data = [
                'user_fk' => $userId,
                'comment' => 'Forwarded to ' . $name . ' and status set to ' . $status . '.', // The default sender's comment. 
                'application_fk' => $post['application_id'], // The selected application
                'sender_id' => $userId,
                'receiver_id' => $recieverId,
                'flag' => PCO,
                'date_created' => date('Y-m-d H:i:s'), // Current date.
            ];

            // Record the notification.
            $isRecorded = $this->ApplicationDetailsPageModel->recordTheNotification($data);
            if ($isRecorded['updated_by_pco_client'] && $isRecorded['status']) {
                $message = 'Application has been forwarded to evaluator!';
            }
            $response = [
                'status' => 1,
                'message' => $message,
                'assignee_label' => $name,
                'status_label' => $status,
                'comment' => 'Forwarded to ' . $name . ' and status set to ' . $status . '.',
                'application_fk' => $post['application_id'],
                'name' => $this->UserModel->getCommentUserFullName($userId),
                'date_created' => gmdate('F j, Y', strtotime($data['date_created']) + date('Z'))
            ];
        } else {
            $response = ['status' => 0, 'message' => 'Failed !'];
        }
        echo json_encode($response);
    }

    /**
     * Approved the application
     * 
     * @param {int} $approvedByUserFk Description
     * @param {int} $applicationTypeFk Description
     * @param {int} $applicationFk Description
     * 
     * @return {string} Certificate of accreditation number.
     */
    public function generateCOANo($approvedByUserFk, $applicationTypeFk, $applicationFk) {
        return $this->ApplicationDetailsPageModel->createCOANo($approvedByUserFk, $applicationTypeFk, $applicationFk);
        ;
    }

    /**
     * Renewal application
     * 
     * @param {int} $approvedByUserFk Description
     * @param {int} $applicationOriginID Description
     * 
     * @return {string} Certificate of accreditation number.
     */
    public function generateCOANoForRenewal($approvedByUserFk, $applicationOriginID, $applicationFk) {
        return $this->ApplicationDetailsPageModel->createCOANoForRenewal($approvedByUserFk, $applicationOriginID, $applicationFk);
        ;
    }

    public function isPCO($id) {
        $type = $this->UserModel->getUserType($id); // getUserDesignation
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

    public function getTheEvaluator($applicationId) {
        $id = $this->ApplicationModel->getTheEvaluatorId($applicationId);
        return $id;
    }

    /**
     * User notification.
     * 
     * Sender and the receiver.
     * 
     */
    public function comment() {
        $this->OuthModel->CSRFVerify();
        // User data.
        $post = $this->input->post();
        $userId = $this->session->userdata['user']['id']; // The user's id sender.
        $emloyeeFk = $this->session->userdata['user']['employee_fk'];
        if (!empty($post['comment'])) {
            // If the sender is the PCO 
            $recieverId = NULL;
            $flag = 0;
            if ($this->isPCO($userId)) {
                // If the current logged user is pco the receiver is the case handler. 
                // This is the default receiver for comment.
                $recieverId = $this->getTheEvaluator($post['application_id'])['evaluator_fk'];
                // Flag
                $flag = PCO;
            } else {
                // Filter the current logged user
                // The receiver here is base on the current user assigned.
                $recieverId = $post['application_assignee_id'];
                $type = $this->UserModel->getUserDesignation($userId);
                switch ($type['designation_id']) {
                    case EVALUATOR:
                        // Flag for the case handler
                        if ($emloyeeFk == $recieverId) {
                            $message = ['status' => 0, 'message' => 'Forward the application first.'];
                            echo json_encode($message);
                            die;
                        } else {
                            // TODO
                        }
                        $flag = 5;
                        break;
                    case SECTION_CHIEF:
                        // Flag for the section chief.
                        if ($emloyeeFk == $recieverId) {
                            $message = ['status' => 0, 'message' => 'Forward the application first.'];
                            echo json_encode($message);
                            die;
                        } else {
                            // TODO
                        }
                        $flag = 3;
                        break;
                    case DIVISON_CHIEF:
                        // Flag for the section chief.
                        if ($emloyeeFk == $recieverId) {
                            $message = ['status' => 0, 'message' => 'Forward the application first.'];
                            echo json_encode($message);
                            die;
                        } else {
                            // TODO
                        }
                        // Flag
                        $flag = 2;
                        break;
                    case REGIONAL_DIRECTOR:
                        // Flag for the section chief.
                        if ($emloyeeFk == $recieverId) {
                            $message = ['status' => 0, 'message' => 'Forward the application first.'];
                            echo json_encode($message);
                            die;
                        } else {
                            // TODO
                        }
                        // Flag
                        $flag = 1;
                        break;
                    default:
                        break;
                }
            }
            $data = [
                'user_fk' => $userId,
                'comment' => ucfirst($post['comment']), // The sender's comment. 
                'application_fk' => $post['application_id'], // The selected application
                'sender_id' => $userId,
                'receiver_id' => $recieverId,
                'flag' => $flag,
                'date_created' => date('Y-m-d H:i:s'), // Current date.
            ];

            // Record the notification.
            $isRecorded = $this->ApplicationDetailsPageModel->recordTheNotification($data);
            // Updated
            if ($isRecorded['updated_by_pco_client'] && $isRecorded['status']) {
                $message = 'Comment has been successfully submitted';
            }
            // Comment by case handler, section chief, division chief and regional director.
            if ($isRecorded['application_updated'] && $isRecorded['status']) {
                $message = 'Comment has been successfully submitted';
            }

            $date = ['date_modified' => date('Y-m-d H:i:s')]; // Date modified...
            $this->ApplicationDetailsPageModel->updateApplicationByID($post['application_id'], $date);
            // Response the comment message data.
            $message = ['status' => 1,
                'message' => $message,
                'comment' => ucfirst($post['comment']),
                'application_fk' => $post['application_id'],
                'name' => $this->UserModel->getCommentUserFullName($userId),
                'date_created' => gmdate('F j, Y', strtotime($data['date_created']) + date('Z'))];
        } else {
            $message = ['status' => 0, 'message' => 'Comment box is empty!'];
        }
        echo json_encode($message);
    }

    /**
     * Add or send a comment to the application.
     */
    public function comment1() {
        $this->OuthModel->CSRFVerify();
        $post = $this->input->post();
        if (!empty($post['comment'])) {
            $userId = $this->session->userdata['user']['id']; // The user's id sender.
            $dataTable = [
                'comment' => ucfirst($post['comment']), // The sender's comment. 
                'application_fk' => $post['application_id'], // The selected application
                'user_fk' => $userId,
                'date_created' => date('Y-m-d H:i:s'), // Current date.
            ];

            // If the sender is the PCO 
            $recieverId = NULL;
            if ($this->isPCO($userId)) {
                // Get the recieve id to notify the evaluator.
                // The recieve is the evaluator.
                $recieverId = $this->getTheEvaluator($post['application_id'])['evaluator_fk'];
            }

            $data = [
                'application_id' => $post['application_id'], // The seleceted application id.
                'application_status_id' => $post['application_status_id'], // The selected application status id.
                'application_assignee_id' => $recieverId != NULL ? $recieverId : $post['application_assignee_id'], // The selected application assignee id.
            ];

            $isSubmitted = $this->ApplicationDetailsPageModel->addComment($dataTable, $data);
            if ($isSubmitted) {
                $date = ['date_modified' => date('Y-m-d H:i:s')]; // Date modified...
                $this->ApplicationDetailsPageModel->updateApplicationByID($post['application_id'], $date);
                // Response the comment message data.
                $message = ['status' => 1,
                    'message' => 'Comment has been successfully submitted!',
                    'comment' => $dataTable['comment'],
                    'application_fk' => $dataTable['application_fk'],
                    'name' => $this->UserModel->getCommentUserFullName($dataTable['user_fk']),
                    'date_created' => gmdate('F j, Y', strtotime($dataTable['date_created']) + date('Z'))];
            } else {
                $message = ['status' => 0, 'message' => 'Failed to submitted!'];
            }
        } else {
            $message = ['status' => 0, 'message' => 'Comment box is empty!'];
        }
        echo json_encode($message);
    }

    public function redirectToOrderOfPayment() {
        try {
            $post = $this->input->post();
            // $selectedID = $this->session->userdata['order_of_payment']['selected_id'];
            // Selected application and account.
            $this->session->set_userdata('order_of_payment', ['selected_application_id' => $post['application_id'],
                'selected_account_id' => $post['account_id']]
            );
            // Response
            $response = ['status' => 1, 'message' => 'Redirect to order of payment!', 'redirectUrl' => base_url('order-of-payment-page')];
        } catch (Exception $err) {
            //show_error($err->getMessage());
            $response = ['status' => 0, 'message' => $err->getMessage()];
        }
        echo json_encode($response);
    }

}
