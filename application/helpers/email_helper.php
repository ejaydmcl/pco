<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * Email Helpers
 *
 * Customized email helpers.
 *
 * @package	CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author	Juanito C. Dela Cerna Jr. June 2019
 */
// --------------------------------------------------------------------


// --------------------------------------------------------------------

/**
 * Email container
 * 
 * @access	public
 * @param	string
 * @return	str
 */
if(!function_exists('email_container')) {
    
    /**
     * Used as a template email container.
     * @param {string} $strt Description
     */
    function email_container($data) {
        $content = '<!DOCTYPE html> 
        <html> 
        <head> 
            <style> 
                body 
                { 
                    font-family:Arial, Helvetica, sans-serif; font-size:12px;
                } 
            </style> 
        </head> 
        <body> 
            <table cellspacing="0" cellpadding="0" border="0"> 
                <tr> 
                    <td> 
                        <img src="'. base_url('public') .'/images/header.jpg" width="260" height="64"> 
                    </td> 
            </table> 
            <br><br><br><br>
            <table> 
                <tr> 
                    <td style="font-family:Tahoma; font-size:12px; font-weight:bold"> 
                        <span> ***THIS IS AUTOMATICALLY GENERATED EMAIL, PLEASE DO NOT REPLY*** </span>
                    </td> 
                </tr> 
            </table> 
                <div style="margin-top: 20px;">
                    <b> Thank you for registering! </b> 
                    <ul style="list-style: none; margin: 0px; padding: 0px;">
                        <li style="margin-bottom: 5px; margin-top: 20px;" >Username: hohoho@gmail.com</li>
                        <li>Password: hohoho@gmail.com</li>
                    </ul>
                </div>
                <div style="margin-top: 40px;">
                    <p>Click <a href="#">here</a> to activate your account.</p> <br>
                </div>
        </body>
        </html>';
        return $content;
    }
    
}

// --------------------------------------------------------------------
