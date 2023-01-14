<?php
class Book_model extends CI_Model
{
    private $table_book = 'book';
    private $table_post = 'post';
    private $table_question = 'question';
    //private $db1;

    public function __construct()
    {
        $this->load->database();
    }

    //getPost by id
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

    //getAllPosts
    public function getAllPosts()
    {
        $this->db->select("postId,userEmail,createdDate");
        $this->db->order_by("createdDate");
        $this->db->limit(10);
        $query = $this->db->get($this->table_post);
        return $query->result();
    }

    //getQuestion by id
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

    //getAllQuestions
    public function getAllQuestions()
    {
        $this->db->select("postId,userEmail,questionId,questionTitle,questionState");
        $this->db->order_by("rand()");
        $this->db->limit(10);
        $query = $this->db->get($this->table_question);
        return $query->result();
    }



    //getbook by id
    public function  getBookById($id)
    {
        if(is_numeric($id)) {
            $this->db->where('id', $id);
            $query = $this->db->get($this->table_book);
            return $query->row(0);
        }
        else
            return null;
    }
        // return random books for home view
    public function getRandomBooks()
    {
        $this->db->select("id,book_name");
        $this->db->order_by("rand()");
        $this->db->limit(10);
        $query = $this->db->get($this->table_book);
        return $query->result();
    }

        //add a new book
    public function saveBook($book)
    {
        $status = $book["status"];
        if(!(is_numeric($status) && $status>=0 && $status <=2)) {  //checking status instead of using a trigger
            return ;
        }
        else {
            $this->db->where("book_name",$book["book_name"]);
            $checkBook = $this->db->get($this->table_book);  //check if book already exists
            if ($checkBook->num_rows == 0) {
                $insertQuery=$this->db->insert('book',$book);
                return $this->db->insert_id();
            }
            else return 0; // return 0 if book already exists
            }
    }

        //search for books
    public function getByName($bookName)
    {
        $this->db->select("book_name,id");
        $this->db->like('book_name', $bookName,'after');
        $query = $this->db->get($this->table_book);
        return $query->result();
    }


        //updatbook
    public function updateBook($id,$book)
    {
        $this->db->where('id', $id);
        $query = $this->db->update($this->table_book, $book);
        return $query;
    }

        //deletebook
    public function delete($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete($this->table_book);
        return $query;
    }
}

?>