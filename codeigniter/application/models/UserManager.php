<?php

include 'User.php';

class UserManager extends CI_Model {

	/**
	 * checks if the user login credentials are correct
	 * @param $userName  username entered by the user in the login
	 * @param $password password entered by the user in login
	 * @return array list of user data if the user login credentials are correct
	 */
	public function ConfirmUser($userName, $password) {
        $this->db->where('userEmail', $userEmail);
        $res = $this->db->get('user');
        $data = array();
        if ($res->num_rows() == 1) {

            $row = $res->row();

            if (password_verify($password, $row->Password)) {
                $data = array(
                    'userName' => $row->userName,
                    'points' => $row->points,
                    'numberOfQuestions' => $row->numberOfQuestions,
                    'numberOfReplies' => $row->numberOfReplies);

                return $data;
            } else {
                return $data;
            }
        } else {
            return $data;
        }
    }

	/**
	 * adds a new user to database
	 * @param $userName desired user name of the user
	 * @param $password desired password of the usur
	 * @param $firstName first name of the user
 	 * @param $lastName last name of the user
	 * @param $avatar avatar url that is displayed in the profile
	 * @param $favGenreList favorite genres of the user
	 */
	public function RegisterUser($userName, $userEmail, $password) {

		$points = 0;
		$numberOfQuestions = 0;
		$numberOfReplies = 0;

		$user_tab = 'user';

        $data = array(
            'userName' => $userName,
            'Password' => password_hash($password, PASSWORD_DEFAULT),
            'userEmail' => $userEmail,
            'points' => $points,
            'numberOfQuestions' => $numberOfQuestions,
			'numberOfReplies' => $numberOfReplies
        );

        $this->db->insert('user', $data);

        $this->db->where('userEmail', $userEmail);
        $res = $this->db->get($user_tab);
        $user = $res->row();

		//For the leader board
        // foreach ($leaderBoardist as $leaderBoard) {
        //     $data = array(
        //         'UserToken' => $user->UserToken,
        //         'GenreId' => $favgenre
        //     );

        //     $this->db->insert('userfavgenres', $data);
        // }
    }

	/**
	 * gets the user data and  checks if the user is followed or not
	 * @param $userToken user token of the user which the data is required
	 * @param $myUserToken user token of the logged in user
	 * @return User returns an user object with user data
	 */

	public function GetUser($userEmail, $myUserEmail) {
		$this->db->select('u.userEmail, u.userName, u.points, u.numberOfQuestions, u.numberOfReplies' );
		$this->db->from('user u');
        $this->db->where('u.userEmail', $userEmail);
        $res = $this->db->get();
        $row = $res->row();
        $user = new User($row->userEmail, $row->userName, $row->points, $row->numberOfQuestions, $row->numberOfReplies, 0);
        return $user;
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
