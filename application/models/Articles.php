<?php

/**
 * This is a model for articles about rich people.
 * Article sorting functions are implemented here.
 * 
 * @author Sanders Lee
 */
class Articles extends MY_Model {

    // Constructor
    public function __construct() {
       parent::__construct('articles', 'id');	
    }
    
    // Return all articles in the database sorted by reverse ID order
    function invert_all() {
        $this->db->order_by($this->_keyField, 'desc');
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }
    
    // Return all articles about a person in alphabetical order by title
    function by_title_alphabetical($who){
        $this->db->from($this->_tableName);
        $this->db->where('who',$who);
        $this->db->order_by('title', 'asc');
        $query = $this->db->get();
                
        return $query->result();
    }
    
    // Return all articles about a person sorted by descending court fees
    function by_court_fees($who){
        $this->db->from($this->_tableName);
        $this->db->where('who',$who);
        $this->db->order_by('owed', 'desc');
        $query = $this->db->get();
                
        return $query->result();
    }
    
    // Return all articles about a person sorted by most recent first
    function by_most_recent($who){
        $this->db->from($this->_tableName);
        $this->db->where('who',$who);
        $this->db->order_by($this->_keyField, 'desc');
        $query = $this->db->get();

        return $query->result();
    }
    
    // Return the number of articles about a person
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
    
    // Return the total court fees owed by a person
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
    
    // Return a single article, given the article ID
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
