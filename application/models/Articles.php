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
    
    function by_title_alphabetical($who){
        $this->db->order_by('title', 'asc');
        $query = $this->db->from($this->_tableName);
        $query = $this->db->get();
        $x = 0;
        $result = NULL;
        
        foreach ($query->result() as $row)
        {
            if($row->who == $who)
                $result[$x] = $row;
            $x++;
        }
        
        return $result;
    }
    
    function by_court_fees($who){
        $this->db->order_by('owed', 'desc');
        $query = $this->db->from($this->_tableName);
        $query = $this->db->get();
        $x = 0;
        $result = NULL;
        
        foreach ($query->result() as $row)
        {
            if($row->who == $who)
                $result[$x] = $row;
            $x++;
        }
        
        return $result;
    }
    
    function by_most_recent($who){
        $this->db->order_by($this->_keyField, 'desc');
        $query = $this->db->from($this->_tableName);
        $query = $this->db->get();
        $x = 0;
        $result = NULL;
        
        foreach ($query->result() as $row)
        {
            if($row->who == $who)
                $result[$x] = $row;
            $x++;
        }
        
        return $result;
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
