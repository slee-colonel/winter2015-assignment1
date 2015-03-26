<?php

/**
 * My homepage. Shows the entirety of the most recently added article.
 * The other articles are listed on the side, sorted by reverse order 
 * of when each was added.
 * 
 * controllers/Welcome.php
 *
 * @author Sanders Lee
 */
class Welcome extends Application {

    function __construct()
    {
	parent::__construct();
    }

    // Main page function
    function index()
    {
	$this->data['pagebody'] = 'homepage';
        
        // get all articles by most recent first
	$this->data['articlelist'] = $this->articles->invert_all();
        foreach ($this->data['articlelist'] as $row)
        {
            // get a mugshot for each article from the people model
            $row->mug = $this->people->some('who', $row->who)[0]->mug;
        }
        
        // get the choice of homepage person, by most recently added article
        // (last ID in articles table)
        $choice = $this->articles->highest();
        $this->data['id'] = $choice;
        $this->data['who'] = $this->articles->get($choice)->who;        
        $this->data['articletitle'] = $this->articles->get($choice)->title;
        $this->data['owed'] = $this->articles->get($choice)->owed;
        $this->data['articletext'] = $this->articles->get($choice)->text;
        
        // get the mugshot of the starring person from the people model
        $this->data['mug'] = 
            $this->people->some('who', $this->data['who'])[0]->mug;
        
	$this->render();
    }
}

/* End of file Welcome.php */
/* Location: application/controllers/Welcome.php */