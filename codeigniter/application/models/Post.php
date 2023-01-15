<?php


class Post
{
	private $postId;
	private $createdDate;
	private $userEmail;
	private $likeCount;
	private $disLikesCount;

	public function __construct($postId, $createdDate, $userEmail, $likeCount, $disLikesCount)
	{
		$this->postId = $postId;
		$this->createdDate = $createdDate;
		$this->userEmail = $userEmail;
		$this->likeCount = $likeCount;
		$this->disLikesCount = $disLikesCount;
	}

    public function getUserEmail()
    {
        return $this->userEmail;
    }


}

?>