<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Numofarticles extends Application {
    function index() {
        $this->data['pagebody'] = 'article_count_view';
        $this->data['peoplelist'] = $this->people->by_article_count();
        
        foreach ($this->data['peoplelist'] as $row)
        {
            $row->totalowed = $this->articles->total_owed($row->who);
        }
        
        $this->render();
    }
}
