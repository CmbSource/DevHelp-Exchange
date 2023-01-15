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
    }

    /**
     * Question Model
     */

    //Get Question by id
    public function  getQuestionById($id)
    {
        if(is_numeric($id)) {
            $this->db->where('questionId', $id);
            $query = $this->db->get($this->table_question);
            return $query->row(0);
        }
        else
            return null;
    }

    //Get Post Id by id
    public function  getPostIdById($id)
    {
        if(is_numeric($id)) {
            $this->db->select("postId");
            $this->db->where('questionId', $id);
            $query = $this->db->get($this->table_question);
            return $query->row(0);
        }
        else
            return null;
    }

    //Get All Questions
    public function getAllQuestions()
    {
        $this->db->select("questionId,userEmail,questionTitle,content,questionState");
        $this->db->order_by("questionId");
        $this->db->limit(10);
        $query = $this->db->get($this->table_question);
        return $query->result();
    }

    //Create Post
    public function createQuestion($userEmail, $questionTitle, $content)
    {
        $tab = 'question';

        $postId = $this->PostManager_Model->createPost($userEmail);

        $data = array(
            'postId' => $postId,
			'userEmail' => $userEmail,
            'questionTitle' => $questionTitle,
			'content' => $content,
            'questionState' => 'Not Answered'
		);

        $insertQuery=$this->db->insert($tab, $data);
        return $this->db->insert_id();
    }

    //Delete Question
    public function DeleteQuestion($id)
    {
        $this->db->where('questionId', $id);
        $query = $this->db->delete($this->table_question);
        return $query;
    }


}
?>