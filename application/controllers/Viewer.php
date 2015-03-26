<?php

/**
 * Displays one article, including the related mugshot.
 * 
 * controllers/Viewer.php
 *
 * @author Sanders Lee
 */
class Viewer extends Application {

    function __construct()
    {
	parent::__construct();
    }

    // You don't really want to see this page since no article was selected
    function index()
    {
	$this->data['pagebody'] = 'homepage';
	$this->render();
    }

    // This displays a single article by ID in database, mugshot
    // also included from single_article();
    function article($id)
    {
        $this->data['pagebody'] = 'article';
        $this->data['article'] = $this->articles->single_article($id);
        
	$this->render();
    }    
}

/* End of file Welcome.php */
/* Location: application/controllers/Welcome.php */