<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Renewal page controller
 * @author JC Dela Cerna Jr. May 2019
 */
class RenewalController extends CI_Controller {

    public function index() {
        $this->parser->parse('home/pages/renewal_page', []);
    }

}
