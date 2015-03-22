<?php

class Admin extends Application {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('formfields','form','url'));        
    }

    function index() {
        $this->data['title'] = 'The Rich People List Maintenance';
        $this->data['people'] = $this->people->all();
        $this->data['articles'] = $this->articles->all();
        $this->data['pagebody'] = 'admin_list';
        $this->render();
    }
    
    function add_person(){
        $person = $this->people->create();
        $this->present_person($person);
    }
    
    function edit_person($id){
        $person = $this->people->get($id);
        $this->present_person($person);
    }
    
    // works with person_edit.php
    function present_person($person){
        $this->data['pagebody'] = 'person_edit';
        $this->data['fid'] = makeTextField('ID#', 'id', $person->id, 
            "Unique quote identifier, system-assigned", 10, 10, true); 
        $this->data['fwho'] = makeTextField('Name', 'who', $person->who);
        $this->data['fmug'] = makeTextField('Picture', 'mug', $person->mug);

        // creates a submit button for form processing
        $this->data['fsubmit'] = makeSubmitButton('Process Person',
                "Click here to validate the person's data", 'btn-success');
        
        $this->render();
    }
    
    // process a person add or edit edit
    function confirm_person(){
        // create a blank record
        $record = $this->people->create();
        
        // Extract submitted fields
        $record->id = $this->input->post('id');
        $record->who = $this->input->post('who');
        $record->mug = $this->input->post('mug');
        
        // validation
        if (empty($record->who))
            $this->errors[] = 'You must specify a name.';
        if (empty($record->mug))
            $this->errors[] = 'You must specify a picture.';
        
        // redisplay if any errors
        if (count($this->errors) > 0) {
            $this->present_person($record);
            return; // make sure we don't try to save anything
        }

        // Save stuff
        if (empty($record->id)) 
            $this->people->add($record);
        else
            $this->people->update($record);
        
        redirect('/admin');
    }
    
    function delete_person($id){
        $this->data['pagebody'] = 'person_delete';
        
        $person = $this->people->get($id);
        $this->data['fid'] = makeTextField('ID#', 'id', $person->id, 
            "", 10, 10, true); 
        $this->data['fwho'] = makeTextField('Name', 'who', $person->who,
                "", 40, 25, true);
        $this->data['fmug'] = makeTextField('Picture', 'mug', $person->mug,
                "", 40, 25, true);
        
        // creates a submit button for form processing
        $this->data['fsubmit'] = makeSubmitButton('Confirm Deletion',
                "Click here to delete the person's data", 'btn-success');
        
        $this->render();
    }
    
    function confirm_person_deletion(){
        $id = $this->input->post('id');
        $this->people->delete($id);        
        redirect('/admin');
    }
    
    function add_article(){
        $article = $this->articles->create();
        $this->present_article($article);
    }
    
    function edit_article($id){
        $article = $this->articles->get($id);
        $this->present_article($article);
    }
    
    function present_article($article){
        $this->data['pagebody'] = 'article_edit';
        $this->data['fid'] = makeTextField('ID#', 'id', $article->id, 
            "Unique quote identifier, system-assigned", 10, 10, true); 
        $this->data['fwho'] = makeTextField('Name', 'who', $article->who);
        $this->data['ftitle'] = makeTextField('Article Title', 'title', $article->title);
        $this->data['fowed'] = makeTextField('Court Costs ($)', 'owed', $article->owed);
        $this->data['ftext'] = makeTextArea('Article Text', 'text', $article->text,
                "", 4096, 66, 8, false);

        // creates a submit button for form processing
        $this->data['fsubmit'] = makeSubmitButton('Process Article',
                "Click here to validate the person's data", 'btn-success');
        
        $this->render();
    }
    
    function confirm_article(){
        // create a blank record
        $record = $this->articles->create();
        
        // Extract submitted fields
        $record->id = $this->input->post('id');
        $record->who = $this->input->post('who');
        $record->title = $this->input->post('title');
        $record->owed = $this->input->post('owed');
        $record->text = $this->input->post('text');
        
        // validation
        if (empty($record->who))
            $this->errors[] = 'You must specify a name.';
        if (empty($record->title))
            $this->errors[] = 'You must specify a title.';
        if (empty($record->owed))
            $this->errors[] = 'You must specify the court costs.';
        if (empty($record->text))
            $this->errors[] = 'You must specify the article text.';
        
        // redisplay if any errors
        if (count($this->errors) > 0) {
            $this->present_article($record);
            return; // make sure we don't try to save anything
        }

        // Save stuff
        if (empty($record->id)) 
            $this->articles->add($record);
        else 
            $this->articles->update($record);
        
        redirect('/admin');
    }
    
    function delete_article($id){
        $this->data['pagebody'] = 'article_delete';
        
        $article = $this->articles->get($id);
        $this->data['fid'] = makeTextField('ID#', 'id', $article->id, 
            "", 10, 10, true); 
        $this->data['fwho'] = makeTextField('Name', 'who', $article->who,
                "", 40, 25, true);
        $this->data['ftitle'] = makeTextField('Article Title', 'title', $article->title,
                "", 40, 25, true);
        $this->data['fowed'] = makeTextField('Court Costs ($)', 'owed', $article->owed,
                "", 40, 25, true);
        $this->data['ftext'] = makeTextArea('Article Text', 'text', $article->text,
                "", 4096, 66, 8, true);
        
        // creates a submit button for form processing
        $this->data['fsubmit'] = makeSubmitButton('Confirm Deletion',
                "Click here to delete the article data", 'btn-success');
        
        $this->render();
    }
    
    function confirm_article_deletion(){
        $id = $this->input->post('id');
        $this->articles->delete($id);        
        redirect('/admin');
    }
    
    function upload_picture($first_attempt){
        $config['upload_path'] = './data/';
        $config['allowed_types'] = '*'; //file type detection doesn't work in CI
        $config['max_size'] = 100;
        $config['max_width'] = 800; 
        $config['max_height'] = 800;
        $this->load->library('upload', $config);
        
        if (!$first_attempt){
            $file_type_ok = false;
            
            // manually check file types because CI can't do it
            if ($_FILES['userfile']['type'] == 'image/jpeg' ||
                $_FILES['userfile']['type'] == 'image/gif' || 
                $_FILES['userfile']['type'] == 'image/png')
                $file_type_ok = true;
                        
            if (!$file_type_ok){
                if($_FILES['userfile']['name'] == NULL)
                    $this->data['errors'] = "No file selected for upload.";
                else
                    $this->data['errors'] = "File type not allowed.";
                
                $this->data['pagebody'] = 'picture_upload';
            }
            else{
                if(!$this->upload->do_upload()){
                    $this->data['errors'] = $this->upload->display_errors();
                    $this->data['pagebody'] = 'picture_upload';
                }
                else{
                    redirect('/admin');
                }
            }
        }
        else{
            $this->data['errors'] = "";
            $this->data['pagebody'] = 'picture_upload';
        }
        $this->render();
    }
    
    function allow_file_type($ext){
        if ($ext == '.jpg' || $ext == '.png' || $ext == '.gif')
            return true;
        else
            return false;
    }
}