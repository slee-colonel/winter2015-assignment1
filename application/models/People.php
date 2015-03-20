<?php

/**
 * This is a "CMS" model for quotes, but with bogus hard-coded data.
 * This would be considered a "mock database" model.
 *
 * @author jim
 */
class People extends MY_Model {

    // Constructor
    public function __construct() {
       parent::__construct('people', 'id');	
    }
    
    // Return all rich people in alphabetical order
    function invertall() {
        $this->db->order_by($this->_keyField, 'desc');
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }
}
