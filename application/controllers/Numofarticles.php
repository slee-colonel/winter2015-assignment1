<?php

/* 
 * Displays the list of people sorted by number of articles about them.
 * 
 * controllers/Numofarticles.php
 * 
 * @author Sanders Lee
 */

class Numofarticles extends Application {
    
    function __construct()
    {
	parent::__construct();
    }
    
    // The '2nd level' function of the website.
    // Shows the list of people sorted by descending number of articles about 
    // them.
    function index() {
        $this->data['pagebody'] = 'article_count_view';
        $this->data['peoplelist'] = $this->people->by_article_count();
        
        foreach ($this->data['peoplelist'] as $row)
        {
            $row->totalowed = $this->articles->total_owed($row->who);
        }
        
        $this->render();
    }
    
    // The '3rd level' function of the website.
    // Shows the list of articles about a person sorted by most recently added.
    function articles($who) {        
        $this->data['pagebody'] = 'article_list';
        $this->data['who'] = $who;
        $this->data['mug'] = $this->people->get_mug($who);
        $this->data['sortedby'] = "Sorted By Most Recent Articles";
        $this->data['articlelist'] = $this->articles->by_most_recent($who);
                
        $this->render();
    }
}
