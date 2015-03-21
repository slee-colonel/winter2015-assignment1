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
        $this->db->from($this->_tableName);
        $this->db->where('who',$who);
        $this->db->order_by('title', 'asc');
        $query = $this->db->get();
                
        return $query->result();
    }
    
    function by_court_fees($who){
        $this->db->from($this->_tableName);
        $this->db->where('who',$who);
        $this->db->order_by('owed', 'desc');
        $query = $this->db->get();
                
        return $query->result();
    }
    
    function by_most_recent($who){
        $this->db->from($this->_tableName);
        $this->db->where('who',$who);
        $this->db->order_by($this->_keyField, 'desc');
        $query = $this->db->get();

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
    
    function single_article($id){
        
        $this->db->from($this->_tableName);
        $this->db->where('id',$id);
        $query = $this->db->get();
        
        $result = $query->result();
        
        if ($result != NULL )
            $result[0]->mug = $this->people->get_mug($result[0]->who);
        
        return $result;
    }
}
