<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Users extends \Restserver\Libraries\REST_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('UserManager_Model');
        $this->load->model('QuestionManager_Model');
    }

    public function user_get($userEmail)
    {
        if (strlen($userEmail) > 0 && $this->isUserFound($userEmail)) {
            $user=$this->UserManager_Model->GetUserByEmail($userEmail);

            $this->response($user, \Restserver\Libraries\REST_Controller::HTTP_OK);
        } else {
            $message = [
                'status' => 404,
                'message' => 'User Not Found.'
            ];
            $this->response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
        }
        
    }


    public function users_get()
    {
        $userEmail = $this->get('userEmail');
        echo $userEmail;
        // If the id parameter doesn't exist return all the users
        $userList = $this->UserManager_Model->GetUsers();
        $users = json_encode($userList, true);
        if ($userEmail === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($userList)
            {
                $this->response($userList, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.
        else {
            
            $user = NULL;

            if (!empty($userList))
            {
                for ($i=0; $i < sizeof($userList); $i++) { 
                    if ($userList[$i]->userEmail == $userEmail) {
                        $user = $userList[$i];
                    }
                }
            }

            if (!empty($user))
            {
                $this->set_response($user, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Question could not be found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }

    function user_post()
    {
        $userName = $this->post('userName');
        $userEmail = $this->post('userEmail');
        $password = $this->post('password');

        $user=$this->UserManager_Model->RegisterUser($userName, $userEmail, $password);
        $message = [
            'status' => 200,
            'userEmail' => $userEmail,
            'message' => 'User Created Successfully!'
        ];

        $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
        
    }

    function confirm_post()
    {
        $userEmail = $this->post('userEmail');
        $password = $this->post('password');
        $user = $this->UserManager_Model->ConfirmUser($userEmail, $password);
        $this->set_response($user["retMsg"], \Restserver\Libraries\REST_Controller::HTTP_OK);

    }


    function isUserFound($userEmail)
    {
        $userList = $this->UserManager_Model->GetUsers();
        $count = 0;
        if (!empty($userList))
        {
            for ($i=0; $i < sizeof($userList); $i++) { 
                if ($userList[$i]->userEmail == $userEmail) {
                    return true;
                }
            }
        }
        return false;
    } 

    


}

?>