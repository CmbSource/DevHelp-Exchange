<?php

class QuestionManager_Model extends CI_Model
{
    private $table_post = 'post';
    private $table_question = 'question';
    private $table_reply = 'reply';
    private $table_user = 'user';

    public function __construct()
    {
        $this->load->database();
        $this->load->model('PostManager_Model');
        $this->load->model('QuestionManager_Model');
    }

}

?>