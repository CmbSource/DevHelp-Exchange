<?php
class ReplyController extends CI_Controller {

    function  __construct(){
        parent::__construct();
        $this->load->model('PostManager_Model');
    }

    public function index()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if(func_num_args() && is_numeric(func_get_arg(0))) {
                    $this->getReplyById(func_get_arg(0));
                }
                else {
                    $this->getAllReplies();
                }
                break;
            case 'POST':
                $this->createReply();
                break; 
            case 'DELETE':
                if(func_num_args() && is_numeric(func_get_arg(0))) {
                    $this->deleteReply(func_get_arg(0));
                }
                break;

        }
    }

    public function getReplyById($id)
    {
        $data['posts']=$this->PostManager_Model->getReplyById($id);
        $this->load->view('pages/posts', $data);
    }

    public function getAllReplies()
    {
        $data['posts']=$this->PostManager_Model->getAllReplies();
        $this->load->view('pages/posts', $data);
    }

    public function createReply()
    {       
        $payload=file_get_contents("php://input");
        $post=json_decode($payload,true);

        $data['result']=$this->PostManager_Model->createReply($post);
        $this->load->view('pages/add.php',$data);
    }

    public function deleteReply($id) 
    {
        $data['result']=$this->PostManager_Model->deleteReply($id);
        $this->load->view('pages/delete.php', $data);
    }

}

?>