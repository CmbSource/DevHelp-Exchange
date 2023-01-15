<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Restapi extends REST_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('PostManager_Model');
        // $this->load->model('studentmodel');
        // $this->load->model('parentmodel');
    }

    public function index_get()
    {
        $this->load->helper('url');
       // $this->load->view('modulesview'); // load initial interface
    }

    public function post_get()
    {
        $postId = $this->uri->segment(3);
        if ($postId == null) {
            // get all modules
            $postList = $this->PostManager_Model->getAllPosts();
            print json_encode($postList);
        }
        else {
            // get one module
            $post = $this->PostManager_Model->getPostById($postId);
            //$students = $this->studentmodel->getStudentsForModule($mcode);
            //$data = array('module' => $module, 'students' => $students);
            print json_encode($post);
        }
    }

    public function posts_post()
    {
        
        $sid = $this->uri->segment(3);
        echo $sid;
        $student = $this->studentmodel->getStudent($sid);
        print json_encode($student);
    }


}
