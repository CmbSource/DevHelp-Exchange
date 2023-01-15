<?php
class QuestionController extends CI_Controller {

    function  __construct(){
        parent::__construct();
        $this->load->model('PostManager_Model');
    }

    public function index()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if(func_num_args() && is_numeric(func_get_arg(0))) {
                    $this->getQuestionById(func_get_arg(0));
                }
                else {
                    $this->getAllQuestions();
                }
                break;
            case 'POST':
                $this->createQuestion();
                break; 
            case 'DELETE':
                if(func_num_args() && is_numeric(func_get_arg(0))) {
                    $this->deleteQuestion(func_get_arg(0));
                }
                break;

        }
    }

    public function parent()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if(func_num_args() && is_numeric(func_get_arg(0))) {
                    $this->getPostIdById(func_get_arg(0));
                }
                break;

        }
    }

    public function getQuestionById($id)
    {
        $data['posts']=$this->PostManager_Model->getQuestionById($id);
        $this->load->view('pages/posts', $data);
    }

    public function getAllQuestions()
    {
        $data['posts']=$this->PostManager_Model->getAllQuestions();
        $this->load->view('pages/posts', $data);
    }

    public function createQuestion()
    {       
        $payload=file_get_contents("php://input");
        $post=json_decode($payload,true);

        $data['result']=$this->PostManager_Model->createQuestion($post);
        $this->load->view('pages/add.php',$data);
    }

    public function deleteQuestion($id) 
    {
        $data['result']=$this->PostManager_Model->deleteQuestion($id);
        $this->load->view('pages/delete.php', $data);
    }

    public function getPostIdById($id)
    {
        $data['posts']=$this->PostManager_Model->getPostIdById($id);
        $this->load->view('pages/posts', $data);
    }

}

?>