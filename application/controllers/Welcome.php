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
	$this->data['articlelist'] = $this->articles->invert_all();  // added invertall function to MY_Model
        foreach ($this->data['articlelist'] as $row)
        {
            $row->mug = $this->people->some('who', $row->who)[0]->mug;
        }
        
        // get the choice of homepage person, by most recent article
        // (last ID in articles table)
        $choice = $this->articles->highest();
        $this->data['id'] = $choice;
        $this->data['who'] = $this->articles->get($choice)->who;        
        $this->data['articletitle'] = $this->articles->get($choice)->title;
        $this->data['owed'] = $this->articles->get($choice)->owed;
        $this->data['articletext'] = $this->articles->get($choice)->text;
        
        $this->data['mug'] = 
            $this->people->some('who', $this->data['who'])[0]->mug;
        
	$this->render();
    }
}

/* End of file Welcome.php */
/* Location: application/controllers/Welcome.php */