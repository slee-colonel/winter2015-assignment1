<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Alphabetical extends Application {
    function index() {
        $this->data['pagebody'] = 'alpha_view';
        $this->data['peoplelist'] = $this->people->alphabetical();
        foreach ($this->data['peoplelist'] as $row)
        {
            $row->totalowed = $this->articles->total_owed($row->who);
            $row->numofarticles = $this->articles->article_count($row->who);
        }
        $this->render();
    }
}