<?php
/**
 * Description of COAModel
 *
 * @author Juanito C. Dela Cerna Jr. March 2021
 */
class COAModel extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }
    
    /**
     * SELECT 
     *  a.id,
     *  a.`status_fk`,
     *  c.coa_no,
     *  c.`date_approved`,
     *  c.`valid_until`,
     *  c.`date_created` 
     * FROM
     *  application a 
     *  JOIN `cetificate_of_accreditation` c 
     *    ON c.`application_fk` = a.`id` 
     * WHERE a.region = 'R11'
     * 
     * Get all approved coa
     * The coa per region
     */
    public function coaApprovedPerRegion($region) {
        $this->db->select('a.id,
                           a.`status_fk`,
                           a.`region`,
                           c.coa_no,
                           c.`date_approved`,
                           c.`valid_until`,
                           c.`date_created`');
        $this->db->from('application a');
        $this->db->join('cetificate_of_accreditation c', 'c.`application_fk` = a.`id`');
        $this->db->where('a.region', $region);
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * Set the application to expired
     * 
     * @param {int} $application id 
     */
    public function setTheCoaToExpired($applicationId){
        $this->db->update('application', ['status_fk' => 8], ['id' => $applicationId]);
    }
    
}
