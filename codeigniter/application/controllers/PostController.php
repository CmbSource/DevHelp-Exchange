<?php
class PostController extends CI_Controller {

    function  __construct(){
        parent::__construct();
        $this->load->model('PostManager_Model');
    }

    public function index()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if(func_num_args() && is_numeric(func_get_arg(0))) {
                    $this->getPostById(func_get_arg(0));
                }
                else {
                    $this->getAllPosts();
                }
                break;
            case 'POST':
                $this->createPost();
                break; 
            case 'DELETE':
                if(func_num_args() && is_numeric(func_get_arg(0))) {
                    $this->deletePost(func_get_arg(0));
                }
                break;

        }
    }

    public function getPostById($id)
    {
        $data['posts']=$this->PostManager_Model->getPostById($id);
        $this->load->view('pages/posts', $data);
    }

    public function getAllPosts()
    {
        $data['posts']=$this->PostManager_Model->getAllPosts();
        $this->load->view('pages/posts', $data);
    }

    public function createPost()
    {
        //$userEmail= "test@outlook.com";
        
        $payload=file_get_contents("php://input");
        $post=json_decode($payload,true);

        $data['result']=$this->PostManager_Model->createPost($post);
        $this->load->view('pages/add.php',$data);
    }

    public function deletePost($id) 
    {
        $data['result']=$this->PostManager_Model->deletePost($id);
        $this->load->view('pages/delete.php', $data);
    }

}

?>