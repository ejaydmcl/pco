<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PCO Model
 * 
 * @author JC Dela Cerna Jr. May 2019
 */
class PCOModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
    }

    private $User = 'users';
    private $UserRole = 'userrole';
    private $Account = 'account';
    
    /**
     * Get user data
     * Get the user role by user id 
     * SELECT u.id, ur.role_fk, u.employee_fk, u.designation_fk 
     * FROM users u
     * JOIN userrole ur ON  ur.user_fk = u.id
     * WHERE u.id = user id
     * 
     * @param {int} $id User id
     */
    public function getUserRole($id) {
        try {
            $this->db->select('u.id, ur.role_fk, u.employee_fk, u.designation_fk');
            $this->db->from('users u');
            $this->db->join('userrole ur', 'ur.user_fk = u.id');
            $this->db->where("u.id", $id);
            $query = $this->db->get();
            return $query->row_array();
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }

    /**
     * Check if username is exist.
     * 
     * @param {string} $username Description
     */
    public function IfExistUsername($username) {
        try {
            $this->db->select('id, email');
            $this->db->from($this->User);
            $this->db->where('email', $username);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }

    public function Authentication_Check($data) {
        try {
            //$condition = "role =" . "'Admin' AND " . "username =" . "'" . $data['username'] . "'";
            $condition = "username =" . "'" . $data['username'] . "'";
            $this->db->select('id');
            $this->db->from($this->User);
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                return $query->row_array();
            } else {
                return false;
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }

    /**
     *  Read data from database to show data in admin page
     * 
     * @param type $id
     * @return boolean
     */
    public function readUserInformation($id) {
        try {
            $condition = "id =" . "'" . $id . "'";
            $this->db->select('*');
            $this->db->from($this->User);
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                return $query->row_array();
            } else {
                return false;
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
    
    /**
     *  User PCO id
     * 
     * @param type $id
     * @return boolean
     */
    public function PCOID($id) {
        try {
            $condition = "id =" . "'" . $id . "'";
            $this->db->select('pco_id');
            $this->db->from($this->Account);
            $this->db->where($condition);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                return $query->row_array();
            } else {
                return false;
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }
    
    /**
     *  User PCO id
     * SELECT 
     *   u.`account_fk`,
     *   u.`email`,
     *   a.`pco_id` 
     * FROM
     *   users u 
     *   JOIN account a 
     *     ON u.`account_fk` = a.`id` 
     * WHERE u.email = 'denrembr11@gmail.com' 
     *   AND a.`pco_id` = 'PCO#-8' 
     * 
     * @param type $data
     * @return boolean
     */
    public function ifEmailPCOIDExist($data) {
        try {
            $this->db->select('u.account_fk,u.username,u.raw_password,u.email,a.pco_id');
            $this->db->from('users u');
            $this->db->join('account a','u.account_fk = a.id');
            $this->db->where('u.email',$data['email']);
            $this->db->where('a.pco_id',$data['pco_id']);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                return $query->row_array();
            } 
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
        return null;
    }

    /**
     * Check user role by id.
     * @param {int} $id user id
     * @author JC Dela Cerna Jr. May 2019
     */
    public function check_user_roles($id) {
        try {
            $condition = "user_fk =" . "'" . $id . "'";
            $this->db->select('*');
            $this->db->from($this->UserRole);
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                return $query->row_array();
            } else {
                return false;
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }

    /**
     * User last logged
     * 
     * @param {int} $user_id User id 
     */
    public function lastLogged($user_id) {
        try {
            $this->db->update($this->User, ['lastlogged' => date('d-m-Y H:i A')], ['id' => $user_id]);
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }

    /**
     * Check old password
     */
    public function checkOldPassword() {
        try {
            $where = ['id' => $this->session->userdata['user']['id']];
            $this->db->select('id,password');
            $this->db->from($this->User);
            $this->db->where($where);
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                return $query->row_array();
            } else {
                return false;
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }

    /**
     * Update user password.
     * 
     * @param {int} $user_id User id
     * @param {string} $rawpassword 
     * @param {string} $newpassword
     */
    public function updatePassword($user_id, $rawpassword, $newpassword) {
        try {
            $res = $this->db->update($this->User, ['raw_password' => $rawpassword, 'password' => $newpassword], ['id' => $user_id]);
            if ($res == 1) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $err) {
            show_error($err->getMessage());
        }
    }

}
