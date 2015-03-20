<?php

/**
 * Display one or all of the quotes on file.
 * 
 * controllers/Viewer.php
 *
 * ------------------------------------------------------------------------
 */
class Viewer extends Application {

    function __construct()
    {
	parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index()
    {
	$this->data['pagebody'] = 'homepage';    // this is the view we want shown
	$this->data['authors'] = $this->quotes->all();
	$this->render();
    }

    // method to display just a single article
    function article($id)
    {
	$this->data['pagebody'] = 'justone';    // this is the view we want shown
        $this->data['id'] = $id;
        $this->data['who'] = $this->articles->get($id)->who;
        $this->data['articletitle'] = $this->articles->get($id)->title;
        $this->data['articletext'] = $this->articles->get($id)->text;
        
        $this->data['mug'] = 
            $this->people->some('who', $this->data['who'])[0]->mug;
	$this->render();
    }    
}

/* End of file Welcome.php */
/* Location: application/controllers/Welcome.php */