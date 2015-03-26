<?php

/* 
 * Displays the list of people sorted by descending amount of court fees owed.
 * 
 * controllers/Courtfees.php
 * 
 * @author Sanders Lee
 */

class Courtfees extends Application {
    
    function __construct()
    {
	parent::__construct();
    }
    
    // The '2nd level' function of the website.
    // Shows the list of people sorted by descending amount of court fees owed.
    function index() {
        $this->data['pagebody'] = 'fee_view';
        $this->data['peoplelist'] = $this->people->by_amount_owed();
        foreach ($this->data['peoplelist'] as $row)
        {
            $row->numofarticles = $this->articles->article_count($row->who);
        }
        $this->render();
    }
    
    // The '3rd level' function of the website.
    // Shows the list of articles about a person sorted by descending amount
    // of court fees owed in each case.
    function articles($who) {
        $this->data['pagebody'] = 'article_list';
        $this->data['who'] = $who;
        $this->data['mug'] = $this->people->get_mug($who);
        $this->data['sortedby'] = "Sorted By Most Court Fees Owed";        
        $this->data['articlelist'] = $this->articles->by_court_fees($who);
                
        $this->render();
    }
}
