<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/**
 * 
 * User role types
 */
define('SUPER_USER', 1);
define('SYSTEM_ADMINISTRATOR', 2);
define('EMPLOYEE', 3);
define('PCO', 4);

/**
 * PCO user file category
 */
define('USER_SIGNATURE', 'USER_SIGNATURE');
define('PROFILE_PHOTO', 'PROFILE_PHOTO');
define('COLLEGE_DIPLOMA', 'COLLEGE_DIPLOMA');
define('COLLEGE_DEGREE', 'COLLEGE DEGREE');
define('VOCATIONAL_TECHNICAL', 'VOCATIONAL/TECHNICAL');
define('VOCATIONAL_CERTIFICATE', 'VOCATIONAL_CERTIFICATE');
define('PRC_LICENSE', 'PRC_LICENSE');
define('WORK_EXPERIENCE', 'WORK_EXPERIENCE');
define('TRAINING_AND_SEMINARS', 'TRAINING_AND_SEMINARS');

define('MANAGING_HEAD_CERTIFICATE', 'MANAGING_HEAD_CERTIFICATE');
define('CERTIFICATE_OF_ACCREDITATION', 'CERTIFICATE_OF_ACCREDITATION');
define('DULLY_SINED_APPOINTMENT_OR_DESIGNATION', 'DULLY_SINED_APPOINTMENT_OR_DESIGNATION');
define('CERTIFICATE_OF_EMPLOYMENT', 'CERTIFICATE_OF_EMPLOYMENT');
define('NOTARIZED_AFFIDAVIT_OF_JOINT_UNDERTAKING', 'NOTARIZED_AFFIDAVIT_OF_JOINT_UNDERTAKING');
define('JOINT_AFFIDAVIT_OF_COMMITMENT','JOINT_AFFIDAVIT_OF_COMMITMENT');
define('PROCESSING_FEE','PROCESSING_FEE');

define('TERMINATION_ATTACHMENT','TERMINATION_ATTACHMENT');

define('COA_HEADER','COA_HEADER');

/**
 * end points 
 */
define('SELECTED_PROFILE','selected-profile'); // This is the selected profile.
define('SELECTED_PCO_PROFILE','selected-pco-profile'); // The selected profile by the employee.. the profile to be evaluated
define('SELECTED_PCO_APPLICATION','selected-pco-application'); 


define('ACTIVE', 1); 
define('NOT_ACTIVE', 0); 

/**
 * User type applicant of employee.
 */
define('USER_EMPLOYEE', 1); 
define('USER_APPLICANT', 0); 


/**
 * Application status.
 */
define('SAVE', 1); 
define('SUBMIT', 2);
define('ONGOING', 3);
define('EVALUATED', 4);
define('APPROVED', 5);
define('DENIED', 6);
define('REVOKED', 7);
define('EXPIRED', 8);

/**
 * Application type
 */
define('_NEW', 1);
define('RENEWAL', 2);

/**
 * Employee designation
 */
define('REGIONAL_DIRECTOR', 1);
define('DIVISON_CHIEF', 2);
define('SECTION_CHIEF', 3);
define('UNIT_HEAD', 4);
define('EVALUATOR', 5);
define('WATCHER', 6);

// Free define name extension
define('NAME_EXTENSION', serialize(array(
    '1'=>'Sr.', 
    '2'=>'Jr.',
    '3'=>'II',
    '4'=>'III',
    '5'=>'IV',
    '6'=>'V',
    '7'=>'VI')));

// Free define region prifix
define('REGION_PRIFIX', serialize(array(
    'R1'=>'RI', 
    'R2'=>'RII',
    'R3'=>'RIII',
    'R4A'=>'RIVA',
    'R4B'=>'RIVB',
    'R5'=>'RV',
    'R6'=>'RVI',
    'R7'=>'RVII',
    'R8'=>'RVIII',
    'R9'=>'RIX',
    'R10'=>'RX',
    'R11'=>'RXI',
    'R12'=>'RXII',
    'R13'=>'RXIII',
    'NCR'=>'NCR',
    'CAR'=>'CAR',
    'ARMM'=>'ARMM')));
