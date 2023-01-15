<?php


class User
{
	private $userEmail;
	private $userName;
	private $points;
	private $noOfQuestion;
	private $noOfReplies;
	private $noOfAnswers;

	function __construct($userEmail, $userName, $points, $noOfQuestion, $noOfReplies, $noOfAnswers)
	{
		$this->userEmail = $userEmail;
		$this->userName = $userName;
		$this->points = $points;
		$this->noOfQuestion = $noOfQuestion;
		$this->noOfReplies = $noOfReplies;
		$this->noOfAnswers = $noOfAnswers;
	}

	public function getUserEmail()
	{
		return $this->userEmail;
	}

	function getUserName()
	{
		return $this->userToken;
	}

	function getPoints()
	{
		return $this->points;
	}

	function getNoOfQuestion()
	{
		return $this->noOfQuestion;
	}

	function getNoOfReplies()
	{
		return $this->noOfReplies;
	}

	function getNoOfAnswers()
	{
		return $this->noOfAnswers;
	}
}
