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
    function alphabetical() {
        $query = $this->db->from($this->_tableName);
        $this->db->order_by('who','asc');
        $query = $this->db->get();
        return $query->result();
    }
    
    function by_amount_owed() {
        $query = $this->db->from($this->_tableName);
        $query = $this->db->get();
        $x = 0;
        
        foreach ($query->result() as $row)
        {               
            $row->totalowed = $this->articles->total_owed($row->who);
            $result[$x] = $row;
            $x++;
        }
        
        for ($i = 0; $i < $x; $i++)
        {
            for ($j = 0; $j < $x; $j++)
            {
                if ($result[$i]->totalowed > $result[$j]->totalowed)
                {
                    $temp = $result[$i];
                    $result[$i] = $result[$j];
                    $result[$j] = $temp;
                }
            }
        }
        
        return $result;
    }
    
    function by_article_count() {
        $query = $this->db->from($this->_tableName);
        $query = $this->db->get();
        $x = 0;
        
        foreach ($query->result() as $row)
        {               
            $row->numofarticles = $this->articles->article_count($row->who);
            $result[$x] = $row;
            $x++;
        }
        
        for ($i = 0; $i < $x; $i++)
        {
            for ($j = 0; $j < $x; $j++)
            {
                if ($result[$i]->numofarticles > $result[$j]->numofarticles)
                {
                    $temp = $result[$i];
                    $result[$i] = $result[$j];
                    $result[$j] = $temp;
                }
            }
        }
        
        return $result;
    }
}
