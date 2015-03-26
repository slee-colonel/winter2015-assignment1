<?php

/* 
 * The editor controller for people, articles, and mugshot uploads.
 * 
 * controllers/Admin.php
 * 
 * @author Sanders Lee
 */

class Admin extends Application {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('formfields','form','url','file'));        
    }

    // The main page, '2nd level' of website.
    // Loads all people and articles in the database for display
    function index() {
        $this->data['title'] = 'The Rich People List Maintenance';
        $this->data['people'] = $this->people->all();
        $this->data['articles'] = $this->articles->all();
        $this->data['pagebody'] = 'admin_list';
        $this->render();
    }
    
    // Tells present_person() that we want to add a new person
    function add_person(){
        $person = $this->people->create();
        $this->present_person($person);
    }
    
    // Tells present_person() that we want to edit a person,
    // given their database ID
    function edit_person($id){
        $person = $this->people->get($id);
        $this->present_person($person);
    }
    
    // Works with person_edit.php, '3rd level' of website.
    // Loads in previously saved person data and puts them in the fields in
    // person_edit.php if in edit mode. Otherwise, shows empty fields in add
    // mode.
    function present_person($person){
        $this->data['pagebody'] = 'person_edit';
        $this->data['fid'] = makeTextField('ID#', 'id', $person->id, 
            "Unique quote identifier, system-assigned", 10, 10, true); 
        $this->data['fwho'] = makeTextField('Name', 'who', $person->who);
        
        //load dropdown mugshot options
        $filenames = get_filenames('data/');
        foreach ($filenames as $file){
            $record[$file] = $file;
        }
        $this->data['fmug'] = form_dropdown('mug', $record, $person->mug);
        
        // creates a submit button for form processing
        $this->data['fsubmit'] = makeSubmitButton('Process Person',
                "Click here to validate the person's data", 'btn-success');
        
        $this->render();
    }
    
    // Process a person add or person edit.
    // After validation, saves the data to the people database in either mode.
    function confirm_person(){
        // create a blank record
        $record = $this->people->create();
        
        // Extract submitted fields
        $record->id = $this->input->post('id');
        $record->who = $this->input->post('who');
        $record->mug = $this->input->post('mug');
        echo $record->mug;
        
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
    
    // Works with person_delete.php
    // Loads in previously saved data and puts them in the fields in
    // person_delete.php. This shows information about the person to be deleted.
    // The admin must press the confirm button to complete deletion.
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
    
    // Deletes the person after admin presses confirm button.
    function confirm_person_deletion(){
        $id = $this->input->post('id');
        $this->people->delete($id);        
        redirect('/admin');
    }
    
    // Tells present_article() that we want to add a new article
    function add_article(){
        $article = $this->articles->create();
        $this->present_article($article);
    }
    
    // Tells present_article() that we want to edit an article,
    // given its database ID
    function edit_article($id){
        $article = $this->articles->get($id);
        $this->present_article($article);
    }
    
    // Works with article_edit.php, '3rd level' of website.
    // Loads in previously saved article data and puts them in the fields in
    // article_edit.php if in edit mode. Otherwise, shows empty fields in add
    // mode.
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
    
    // Process an article add or article edit.
    // After validation, saves the data to the articles database in either mode.
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
    
    // Works with article_delete.php
    // Loads in previously saved data and puts them in the fields in
    // article_delete.php. This shows information about the person to be 
    // deleted. The admin must press the confirm button to complete deletion.
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
    
    // Deletes the article after admin presses confirm button.
    function confirm_article_deletion(){
        $id = $this->input->post('id');
        $this->articles->delete($id);        
        redirect('/admin');
    }
    
    // Works with picture_upload.php, '3rd level' of website.
    // Validates the picture file the user has selected before uploading to the
    // website's data folder.
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
    
    // Check that the file has an acceptable image type extension
    function allow_file_type($ext){
        if ($ext == '.jpg' || $ext == '.png' || $ext == '.gif')
            return true;
        else
            return false;
    }
}