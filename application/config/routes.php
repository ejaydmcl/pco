<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'PagesController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'PagesController/index';
$route['user-login-f'] = 'UserController/userlogin';
$route['register-page'] = 'RegisterPageController/index';
$route['register'] = 'UserController/registerUser';
$route['verify-email'] = 'UserController/verifyEmail';
$route['forgot-password-page'] = 'ForgotPasswordController/index';
$route['email-verify-successfully'] = 'EmailVerifyController/index';
$route['logout'] = 'UserController/logout';
$route['home'] = 'HomeController/index';
$route['downloadable-forms'] = 'DownloadablePageController/index';
//$route['profile'] = 'AccountPageController/index';

// Application page.
$route['application-page'] = 'ApplicationPageController/index';
$route['selected-application'] = 'ApplicationPageController/selectedApplication';
$route['application-details-page'] = 'ApplicationDetailsPageController/index';
$route['application-full-details-page'] = 'ApplicationFullDetailsPageController/index';
$route['view-selected-application-details'] = 'ApplicationPageController/viewSelectedApplicationDetails';
$route['application-page-data-table-init'] = 'ApplicationPageController/applicationDataGrid';
$route['application-page-data'] = 'ApplicationPageController/applicationDataGrid';
$route['send-new-comment'] = 'ApplicationDetailsPageController/comment';
$route['notification-click'] = 'TopBarController/iSeeTheNoti';
$route['edit-status-assignee'] = 'ApplicationDetailsPageController/editStatusAndAssignee';
$route['submit-back-to-evaluator'] = 'ApplicationDetailsPageController/submitBackToEvaluator';
$route['application-disposition-page'] = 'ApplicationDispositionPageController/index';
$route['application-history'] = 'ApplicationPageController/showApplicationHistory';
$route['application-termination'] = 'ApplicationPageController/showApplicationTerminationPage';
$route['application-termination-page'] = 'ApplicationTerminationPageController/index';
$route['coa-temination-form-data'] = 'ApplicationTerminationPageController/terminateSelectedCOA';
$route['view-selected-revoked-coa'] = 'ApplicationPageController/viewSelectedRevokedCoa';
$route['terminated-coa-page'] = 'ApplicationTerminatedPageController/index';

// Checklist page
$route['application-checklist'] = 'ApplicationPageController/showApplicationChecklist';
$route['new-application-checklist-page'] = 'ApplicationChecklistController/index';
$route['save-checklist-data'] = 'ApplicationChecklistController/saveChecklistData';


$route['view-selected-pco-bio-data'] = 'ApplicationPageController/viewSelectedApplicationPCOBioData';
$route['application-pco-bio-data-page'] = 'ApplicationPCOBioDaTaPageController/index'; // TODO
//application-pco-bio-data-page

// Settings
// Nature of business
$route['nature-of-business-page'] = 'NatureOfBusinessPageController/index';
$route['industry-category-list'] = 'NatureOfBusinessPageController/natureOfBusinessDataGridList';
$route['add-nature-of-business'] = 'NatureOfBusinessPageController/addNatureOfBusiness';

// PCO photo requirements
$route['pco-photo-requirements'] = 'PCOPhotoRequirementsController/index';
$route['update-pco-req-page-header'] = 'PCOPhotoRequirementsController/updatePageHeader';
$route['update-male-photo-header'] = 'PCOPhotoRequirementsController/updateMalePhotoHeader';
$route['update-female-photo-header'] = 'PCOPhotoRequirementsController/updateFemalePhotoHeader';
$route['add-description-entry'] = 'PCOPhotoRequirementsController/addDescriptionEntry';
$route['remove-description-entry'] = 'PCOPhotoRequirementsController/removeDescriptionEntry';

// PCO Signature requirements
$route['pco-signature-requirements'] = 'PCOSignatureRequirementsController/index';
$route['add-pco-signature-description-entry'] = 'PCOSignatureRequirementsController/addDescriptionEntry';
$route['remove-pco-signature-description-entry'] = 'PCOSignatureRequirementsController/removeDescriptionEntry';


// Disposition table
$route['disposition-table'] = 'ApplicationDispositionPageController/dispositionTable';

// Order of payment
$route['redirect-to-order-of-payment'] = 'ApplicationDetailsPageController/redirectToOrderOfPayment';
$route['order-of-payment'] = 'OrderOfPaymentPageController/orderPayment';
$route['print-order-of-payment'] = 'OrderOfPaymentPageController/printOrderPayment';
$route['order-of-payment-page'] = 'OrderOfPaymentPageController/index';

// Application renewal
$route['view-selected-renewal-application'] = 'ApplicationRenewalPageController/index';
$route['renew-selected-application'] = 'ApplicationPageController/renewApplication';
$route['select-the-renewed-application'] = 'ApplicationPageController/viewRenewedApplicationDetails';
$route['view-selected-application-renewal-details'] = 'ApplicationRenewedPageController/index';
$route['update-renewed-application-details'] = 'ApplicationRenewedPageController/updateRenewedApplicationDetails';
// update-renewed-application-for-existing-old-coa-details
$route['update-renewed-application-for-existing-old-coa-details'] = 'ApplicationRenewedForExistingOldCoaPageController/updateRenewedApplicationDetails';

// Add new application data
$route['add-new-application-data'] = 'AddNewApplicationFormController/addNewApplicationData';
$route['add-new-application-with-existing-coa-data'] = 'AddNewApplicationExistingCoaFormController/addNewApplicationData';
$route['selected-application-coa'] = 'ApplicationPageController/selectedApplicationCOA';
$route['print-certificate-of-accreditation'] = 'ApplicationPageController/printSelectedApplication';

// Edit application
$route['edit-application-data'] = 'ApplicationFullDetailsPageController/editApplication';

// Renew the application
$route['renew-application-data'] = 'ApplicationRenewalPageController/renewApplication';

// Profile page.
$route['profile'] = 'ProfileController/index';
$route['selected-pco-profile'] = 'ApplicationFullDetailsPageController/selectedPCOProfile';
$route['upload-profile-photo'] = 'ProfileController/uploadPhoto';
$route['upload-user-siganture'] = 'ProfileController/uploadUserSignature';
$route['update-personal-profile'] = 'ProfileController/updatePCOPersonalProfile';
$route['update-password'] = 'ProfileController/updatePassword';
$route['picture-requirements'] = 'ProfilePictureReqController/index';
$route['redirect-user-to-picture-requirements'] = 'ProfileController/redirectUserToPictureReq';
$route['signature-requirements'] = 'ProfileSignatureReqController/index';
$route['redirect-user-to-signature-requirements'] = 'ProfileController/redirectUserToSignatureReq';
$route['add-license'] = 'ProfileController/addLicense';
$route['license-data-table'] = 'ProfileController/licenseDataTable';
$route['edit-license'] = 'ProfileController/editLicense';
//$route['add-educational-attainment'] = 'ProfileController/addEducational';
$route['add-educational-attainment-college-degree'] = 'ProfileController/addPCOCollegeDegree';
$route['add-educational-attainment-vocational-or-technical'] = 'ProfileController/addPCOVocationalOrTechnicalAttainment';
$route['educational-data-table'] = 'ProfileController/educationalDataTable';

//$route['edit-educational-attainment'] = 'ProfileController/editEducational';
$route['edit-educational-attainment'] = 'ProfileController/editPCOCollegeDegree';
$route['add-wrok-experience'] = 'ProfileController/addWorkExperience';
$route['work-experience-data-table'] = 'ProfileController/workExperienceDataTable';
$route['edit-wrok-experience'] = 'ProfileController/editWorkExperience';
$route['add-training-and-seminars'] = 'ProfileController/addTrainingAndSeminars';
$route['training-and-seminars-data-table'] = 'ProfileController/trainingAndSeminarsDataTable';
$route['edit-training-and-seminars'] = 'ProfileController/editTrainingAndSeminars';

// User page.
$route['user-page'] = 'UserController/index';
$route['user-list-data-grid'] = 'UserController/userListDataGrid';
$route['edit-user-page'] = 'UserController/editUserPage';
$route['redirect-to-edit-user-credentials'] = 'editUserCredentialsController/index';
$route['edit-user-credentials'] = 'editUserCredentialsController/editUserCredentials';
$route['add-user-page'] = 'AddUserController/index';
$route['create-user'] = 'AddUserController/createUser';
$route['add-new-personnel'] = 'AddUserController/addNewPersonnel';
$route['profile-password-update'] = 'ProfileController/change_user_profile_password_update';
$route['profile-details-update'] = 'ProfileController/user_update_profile_data';
$route['i-forgot-my-password'] = 'ProfileController/forgot_password';
$route['forgot-password'] = 'ForgotPasswordController/forgotPassword';
$route['new-page'] = 'NewController/index';
$route['renewal-page'] = 'RenewalController/index';
$route['add-new-application-form'] = 'AddNewApplicationFormController/index';
$route['renewal-application-form'] = 'RenewalApplicationFormController/index';
$route['print-application-form']= 'PrintApplicationController/index';
// user
$route['user']= 'UserController/index'; // TODO...
// PCO System
$route['pco-system']= 'PCOSystemController/index';
//administrator-page
$route['administrator-page']= 'AdministratorPageController/index';
// userListDataGrid
$route['administrator-page-user-list']= 'AdministratorPageController/userListDataGrid';
// add new personnel for super user;
$route['add-new-user'] = 'AdministratorPageController/addNewPersonnel';
// system error logs
$route['error-logs-data-grid']= 'PCOSystemController/ErrorLogsDataGrid';
// pco-organization
$route['pco-organization']= 'PCOOrganizationController/index';
$route['province-list']= 'PCOOrganizationController/provinceList';
// municipality-list
$route['municipality-list']= 'PCOOrganizationController/cityList';
// office-tab-form
$route['submit-office-form']= 'PCOOrganizationController/recordOfficeInformation';
//submit-coa-form
$route['submit-coa-form']= 'PCOOrganizationController/coaHeader';
// list-of-establishment
$route['list-of-establishment']= 'AddNewApplicationFormController/establishmentList';
// submit-iso-standard-form
$route['submit-iso-standard-form']= 'PCOOrganizationController/isoStandard';
// Client page
$route['client-page']= 'ClientPageController/index';
// client list
$route['client-list']= 'ClientPageController/clientList';
// client-profile
$route['client-profile']= 'ClientProfileController/index';
// send-verification-link
$route['send-verification-link']= 'ClientProfileController/sendVerificationLink';
// submit-contact-details-form
$route['submit-contact-details-form']= 'PCOOrganizationController/contactDetails';
