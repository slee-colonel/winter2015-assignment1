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
	$this->data['pagebody'] = 'homepage';
        
        // list all articles by most recent first
	$this->data['articlelist'] = $this->articles->invertall();  // added invertall function to MY_Model
        for ($x=1; $x <= $this->articles->highest(); $x++)
        {    
            $this->data['articlelist'][$x-1]->mug = 
                $this->people->some('who', $this->data['articlelist'][$x-1]->who)[0]->mug;
        }
        
        // get the choice of homepage person, by most recent article
        // (last ID in articles table)
        $choice = $this->people->highest();
        $this->data['id'] = $choice;
        $this->data['mug'] = $this->people->get($choice)->mug;
        $this->data['who'] = $this->people->get($choice)->who;
        $this->data['articletitle'] = $this->articles->get($choice)->title;
        $this->data['articletext'] = $this->articles->get($choice)->text;         
        
	$this->render();
    }
    /*
    function generateList()
    {
        for($x=0; $x <= $this->people->highest(); $x++)
            $this->data['articlelist']->add
    }//*/
}

/* End of file Welcome.php */
/* Location: application/controllers/Welcome.php */