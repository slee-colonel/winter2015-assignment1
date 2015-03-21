<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Courtfees extends Application {
    function index() {
        $this->data['pagebody'] = 'fee_view';
        $this->data['peoplelist'] = $this->people->by_amount_owed();
        foreach ($this->data['peoplelist'] as $row)
        {
            $row->numofarticles = $this->articles->article_count($row->who);
        }
        $this->render();
    }
    
    function articles($who) {
        $this->data['pagebody'] = 'article_list';
        $this->data['who'] = $who;
        $this->data['mug'] = $this->people->get_mug($who);
        $this->data['sortedby'] = "Sorted By Most Court Fees Owed";        
        $this->data['articlelist'] = $this->articles->by_court_fees($who);
                
        $this->render();
    }
}
