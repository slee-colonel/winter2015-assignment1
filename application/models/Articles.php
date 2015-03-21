<?php

/**
 * This is a "CMS" model for quotes, but with bogus hard-coded data.
 * This would be considered a "mock database" model.
 *
 * @author jim
 */
class Articles extends MY_Model {

    // Constructor
    public function __construct() {
       parent::__construct('articles', 'id');	
    }
    
    // Return all article records as an array of objects in reverse order
    function invert_all() {
        $this->db->order_by($this->_keyField, 'desc');
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }
    
    function article_count($who){
        $count = 0;
        $this->db->order_by($this->_keyField, 'desc');
        $query = $this->db->get($this->_tableName);
        foreach ($query->result() as $row)
        {
            if($row->who == $who)
                $count++;
        }
        return $count;
    }
    
    function total_owed($who){
        $owed = 0;
        $query = $this->db->get($this->_tableName);
        foreach ($query->result() as $row)
        {
            if($row->who == $who)
                $owed += $row->owed;
        }
        return $owed;
    }
}
