<?php

/**
 * Our homepage. Show the most recently added quote.
 * 
 * controllers/Welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Welcome extends Application {

    function __construct()
    {
	parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index()
    {
	$this->data['pagebody'] = 'justone';    // this is the view we want shown
	
        // randomize the choice of homepage person
        $choice = rand(1,$this->people->size());
        $this->data = array_merge($this->data, (array) $this->people->get($choice));
        
	$this->render();
    }

}

/* End of file Welcome.php */
/* Location: application/controllers/Welcome.php */