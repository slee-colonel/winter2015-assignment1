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
	$this->render();
    }

    // method to display just a single article
    function article($id)
    {
        $this->data['pagebody'] = 'article';    // this is the view we want shown
        $this->data['article'] = $this->articles->single_article($id);
        
	$this->render();
    }    
}

/* End of file Welcome.php */
/* Location: application/controllers/Welcome.php */