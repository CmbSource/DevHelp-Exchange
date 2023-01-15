<?php

include 'Post.php';

class PostManager_Model extends CI_Model
{
    private $table_post = 'post';
    private $table_question = 'question';
    private $table_reply = 'reply';
    private $table_user = 'user';

    public function __construct()
    {
        $this->load->database();
    }

    /**
     * Post Model
     */

    //Get Post by id
    public function  getPostById($id)
    {
        if(is_numeric($id)) {
            $this->db->where('postId', $id);
            $query = $this->db->get($this->table_post);
            return $query->row(0);
        }
        else
            return null;
    }

    //Get All Posts
    public function getAllPosts()
    {
        $this->db->select("postId,createdDate,userEmail,likeCount,disLikesCount");
        $this->db->order_by("createdDate DESC");
        $this->db->limit(10);
        $query = $this->db->get($this->table_post);

        // $postFound = array();
		// foreach ($query->result() as $row) {
        //     //echo $row->createdDate;
		// 	$post = new Post($row->postId, $row->createdDate, $row->userEmail, $row->likeCount, $row->disLikesCount);
        //     $postFound[] = $post;
		// }

        // return $postFound;

     
        return $query->result();
    }

    //Create Post
    public function createPost($post)
    {
        $tab = 'post';

        date_default_timezone_set('Asia/Colombo');
        $createdDate = date('Y-m-d h:i:s');

        $userEmail = $post['userEmail'];
        
        
        $data = array(
			'createdDate' => $createdDate,
            'userEmail' => $userEmail,
			'likeCount' => 0,
            'disLikesCount' => 0
		);
        $insertQuery=$this->db->insert($tab, $data);
        return $this->db->insert_id();
    }

    //Delete Post
    public function deletePost($id)
    {
        $this->db->where('postId', $id);
        $query = $this->db->delete($this->table_post);
        return $query;
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
    public function createQuestion($question)
    {
        $tab = 'question';

        $postId = $this->createPost($question);

        $userEmail = $question['userEmail'];
        $questionTitle = $question['questionTitle'];
        $content = $question['content'];

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

    //Delete Post
    public function DeleteQuestion($id)
    {
        $this->db->where('questionId', $id);
        $query = $this->db->delete($this->table_question);
        return $query;
    }

    /**
     * Reply Model
     */

    //Get Reply by id
    public function  getReplyById($id)
    {
        if(is_numeric($id)) {
            $this->db->where('replyId', $id);
            $query = $this->db->get($this->table_reply);
            return $query->row(0);
        }
        else
            return null;
    }

    //Get All Replies
    public function getAllReplies()
    {
        $this->db->select("questionId,replyId,userEmail,content,replyState");
        $this->db->order_by("replyId");
        $this->db->limit(10);
        $query = $this->db->get($this->table_reply);
        return $query->result();
    }

    //Create Reply
    public function createReply($reply)
    {
        $tab = 'reply';

        $postId = $this->createPost($reply);
        $questionId = $reply['questionId'];
        $userEmail = $reply['userEmail'];
        $content = $reply['content'];

        $data = array(
            'postId' => $postId,
            'questionId' => $questionId,
			'userEmail' => $userEmail,
			'content' => $content,
            'replyState' => 'Not Answered'
		);

        $insertQuery=$this->db->insert($tab, $data);
        return $this->db->insert_id();
    }

    //Delete Reply
    public function DeleteReply($id)
    {
        $this->db->where('replyId', $id);
        $query = $this->db->delete($this->table_reply);
        return $query;
    }


}
?>