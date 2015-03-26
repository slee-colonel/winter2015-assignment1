<?php

/* 
 * Displays the list of people sorted by alphabetical order.
 * 
 * controllers/Alphabetical.php
 * 
 * @author Sanders Lee
 */

class Alphabetical extends Application {
        
    function __construct()
    {
	parent::__construct();
    }
    
    // The '2nd level' function of the website.
    // Shows the list of people sorted by alphabetical order.
    function index() {
        $this->data['pagebody'] = 'alpha_view';
        $this->data['peoplelist'] = $this->people->alphabetical();
        
        foreach ($this->data['peoplelist'] as $row)
        {
            $row->totalowed = $this->articles->total_owed($row->who);
            $row->numofarticles = $this->articles->article_count($row->who);
        }
        
        $this->render();
    }
    
    // The '3rd level' function of the website.
    // Shows the list of articles about a person sorted by alphabetical order
    // of the article titles.
    function articles($who) {
        $this->data['pagebody'] = 'article_list';
        $this->data['who'] = $who;
        $this->data['mug'] = $this->people->get_mug($who);
        $this->data['sortedby'] = "Sorted By Title Alphabetically";
        $this->data['articlelist'] = $this->articles->by_title_alphabetical($who);
        
        $this->render();
    }
}