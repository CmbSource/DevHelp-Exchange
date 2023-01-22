<?php

class ReplyManager_Model extends CI_Model
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

    public function getAllRepliesToQ($id)
    {
        $this->db->select("questionId,userEmail,replyId,content,replyState");
        
        $this->db->where('questionId', $id);
        $this->db->limit(20);
        $query = $this->db->get($this->table_reply);
        return $query->result();
    }

    public function createReply($userEmail, $content, $questionId)
    {
        $tab = 'reply';

        $postId = $this->PostManager_Model->createPost($userEmail);

        $data = array(
            'postId' => $postId,
            'questionId' => $questionId,
			'userEmail' => $userEmail,
			'content' => $content,
            'replyState' => 'Non-Answer'
		);

        $insertQuery=$this->db->insert($tab, $data);
        return $this->db->insert_id();
    }

}

?>