<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
   'protocol'      => 'smtp',
   'smtp_host'     => 'ssl://smtp.googlemail.com',
   'smtp_port'     => 465,
   'smtp_timeout'  => 30,
   'smtp_user'     => 'emb.pco@gmail.com',
   'smtp_pass'     => '1emb.pcojc!',
   'mailtype'      => 'html',
   'charset'       => 'utf-8',
   'newline'       => "\r\n"
);


/* Configuration for office 365
$config = array(
    'protocol'      => 'smtp',
    'smtp_host'     => 'smtp.office365.com',// 'ssl://smtp.googlemail.com',
    'smtp_port'     => 587,
    'smtp_timeout'  => 30,
    'smtp_user'     => 'no-reply@embr11.com', // 'denrembr11@gmail.com',
    'smtp_pass'     => 'pco1234!',  //'denrembr11!11',
    'smtp_crypto'   => 'tls',    
    'mailtype'      => 'html',
    'charset'       => 'iso-8859-1',
    'newline'       => "\r\n" //REQUIRED! Notice the double quotes!
); */

/*$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;
$config['mailtype'] = 'html';*/

/* End of file email.php */
/* Location: ./application/config/email.php */



/*
Minimun test code for successful email sending over SMTP with Office 365
Things to double-check: 
- openssl php extension must be enabled in the server
- host set to smtp.office365.com, not the old aliases
- Port 587
- newline configuration: explicit to "\r\n"
*/

//In your Controller code:
/*$config = [        
    'protocol' => 'smtp',
    'smtp_host' => 'smtp.office365.com',
    'smtp_user' => 'YOUR_EMAIL',
    'smtp_pass' => 'YOUR_PASSWORD',
    'smtp_crypto' => 'tls',    
    'newline' => "\r\n", //REQUIRED! Notice the double quotes!
    'smtp_port' => 587,
    'mailtype' => 'html'    
];*/