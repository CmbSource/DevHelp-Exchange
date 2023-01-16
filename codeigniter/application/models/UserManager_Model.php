<?php

include 'User.php';

class UserManager_Model extends CI_Model {


	public function ConfirmUser($userEmail, $password) {
        $this->db->where('userEmail', $userEmail);
        $res = $this->db->get('user');

        $data = array();
        if ($res->num_rows() == 1) {
			
            $row = $res->row();
			if (password_verify($password, $row->password)) {
                $data = array(
                    'userName' => $row->userName,
                    'points' => $row->points,
                    'numberOfQuestion' => $row->numberOfQuestion,
                    'numberOfReplies' => $row->numberOfReplies);
				
				$message = [
					'status' => 200,
					'userEmail' => $userEmail,
					'message' => 'Success user confirmation!'
				];
				$finalMsg = [
					'data' => $data,
					'retMsg' => $message
				];
				
                return $finalMsg;
            } else {
				$data = array();
				$message = [
					'status' => 401,
					'userEmail' => $userEmail,
					'message' => 'Incorrect Passowrd!'
				];

				$finalMsg = [
					'data' => $data,
					'retMsg' => $message
				];

                return $finalMsg;
            }
        } else {
			$data = array();
			$message = [
				'status' => 401,
				'userEmail' => $userEmail,
				'message' => 'Invalid User Email or Password!'
			];

			$finalMsg = [
				'data' => $data,
				'retMsg' => $message
			];

            return $finalMsg;
        }
    }

	public function RegisterUser($userName, $userEmail, $password) {

		$points = 0;
		$numberOfQuestion = 0;
		$numberOfReplies = 0;

		$user_tab = 'user';

		$hash = password_hash($password, PASSWORD_DEFAULT);
        $data = array(
            'userName' => $userName,
            'password' => $hash,
            'userEmail' => $userEmail,
            'points' => $points,
            'numberOfQuestion' => $numberOfQuestion,
			'numberOfReplies' => $numberOfReplies
        );

        $this->db->insert('user', $data);

        $this->db->where('userEmail', $userEmail);
        $res = $this->db->get($user_tab);
        $user = $res->row();
		return $res->result();

    }

	public function GetUserByEmail($userEmail) {
		$this->db->select('u.userEmail, u.userName, u.points, u.numberOfQuestion, u.numberOfReplies' );
		$this->db->from('user u');
        $this->db->where('u.userEmail', $userEmail);
        $res = $this->db->get();
        //$row = $res->row();
        //$user = new User($row->userEmail, $row->userName, $row->points, $row->numberOfQuestion, $row->numberOfReplies, 0);
        return $res->result();
    }

	public function GetUsers() {
		$this->db->select('u.userEmail, u.userName, u.points, u.numberOfQuestion, u.numberOfReplies' );
		$this->db->from('user u');
        $res = $this->db->get();
        //$row = $res->row();
        //$user = new User($row->userEmail, $row->userName, $row->points, $row->numberOfQuestion, $row->numberOfReplies, 0);
		//$res->result();
        return $res->result();
    }
	
	public function UpdateUser($userEmail, $password)
	{
		$data = $this->ConfirmUser($userEmail, $password);
	}





	
	/**
	 * gets the list of favourite genres of a specific user
	 * @param $userToken user token of the user
	 * @return array list of genres
	 */
	public function GetUserfavgenres($userToken) {

        $this->db->select('mg.Genre');
        $this->db->from('userfavgenres fg');
        $this->db->join('musicgenres mg','mg.GenreId = fg.GenreId');
        $this->db->where('fg.UserToken', $userToken);
        $res = $this->db->get();
        $FavGenres = array();
        foreach ($res->result() as $row) {
            $FavGenres[] = $row->Genre;
        }

        return $FavGenres;
    }

	/**
	 * Fetches a list of users according to their favorite genre
	 * @param $genre favourite genre that needs to be searched for
	 * @param $userToken user token of the logged in user
	 * @return array list  of users
	 */
	public function SearchUsersByGenre($genre, $userToken) {

		$this->db->where('Genre', $genre);
		$res = $this->db->get('musicgenres');
		$row = $res->row();

		$genreId = $row->GenreId;

		$this->db->select('u.UserToken, u.FirstName, u.LastName, u.Avatar , CASE WHEN f.FollowerId  IS NULL THEN \'false\' ELSE \'true\' END AS IsFollowing');
		$this->db->from('userfavgenres fg');
		$this->db->join('users u','u.UserToken = fg.UserToken');
		$this->db->join("followers f","u.UserToken = f.FolloweeUserToken AND f.UserToken = '".$userToken."'" , "left");
		$this->db->where('fg.GenreId', $genreId);
		$this->db->where("fg.UserToken !='" . $userToken . "'");
		$res = $this->db->get();

		$this->load->model('FollowManager', 'followM');
		$users = array();
		foreach ($res->result() as $row) {
			$user = new User($row->UserToken, $row->FirstName, $row->LastName, $row->Avatar);
			$user->setFollowing($row->IsFollowing);
			$users[] = $user;
		}
		return $users;
	}

	


	/**
	 * checks if the user name is already existing
	 * @param $userName username that needs to be checked
	 * @return bool returns true if username is available and false if it is already used
	 */
	public function checkUserName($userName){

		$this->db->where('UserName', $userName);
		$res = $this->db->get('users');

		if ($res->num_rows() > 0) {
			return false;
		}
		return true;
	}

}
