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
        $this->data['id'] = $id;
        
        if ($id != -1)
        {
            $this->data['who'] = $this->articles->get($id)->who;
            $this->data['articletitle'] = $this->articles->get($id)->title;        
            $this->data['owed'] = $this->articles->get($id)->owed;
            $this->data['articletext'] = $this->articles->get($id)->text;

            $this->data['mug'] = 
                $this->people->some('who', $this->data['who'])[0]->mug;
        }
        else
        {
            $this->data['who'] = "Nobody";
            $this->data['articletitle'] = "No article title";
            $this->data['owed'] = 0;
            $this->data['articletext'] = "No article text";
            $this->data['mug'] = NULL;
        }
        
	$this->render();
    }    
}

/* End of file Welcome.php */
/* Location: application/controllers/Welcome.php */