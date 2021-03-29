<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Utils
 * 
 * Utility class, is a class which contains methods that can 
 * be reused across the application.
 *
 * @author (c) 2021, Juanito C. Dela Cerna Jr. 
 */
class Utils {

    public function __construct() {
        // TODO:... Nothing
    }
    
    /**
     * Get region prifix
     * 
     * @param {string} $_key Description
     */
    public function getRegionPrifix($_key) {
        foreach (unserialize(REGION_PRIFIX) as $key => $value) {
            if ($_key == $key) {
                return $value;
            }
        }
        return null;
    }

    /**
     * User role
     * 
     * @param {int} $user Description
     * @param {array} $role The user
     * @param {array} $roles Description
     */
    public function is_authorized($role, $roles) {
        foreach ($roles as $value) {
            if($value->ROLE == $role && $value->ACTIVE == 1) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get name extension
     * 
     * @method static self get_name_extension()
     * @param {int} $_keye Description
     */
    public function get_name_extension($_key) {
        foreach (unserialize(NAME_EXTENSION) as $key => $value) {
            if ($_key == (int) $key) {
                return $value;
            }
        }
        return null;
    }

    /**
     * Format date Ex: January 01, 2021
     * 
     * @param {date} $date 
     */
    public function format_date($date) {
        return gmdate('F j, Y', strtotime($date) + date("Z"));
    }
    
}
