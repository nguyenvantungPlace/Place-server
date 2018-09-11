<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

/**
 * 
 */
class LikeComment_Controller extends Base_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
	}

	public function likeComment(){
		$this->model->load("LikeComment");
		$result = $this->model->LikeComment->likeComment($_POST['id_comment'], $_POST['id_nguoi_dung']);

		if ($result) echo "{\"status\":\"true\"}";
	 	else echo "{\"status\":\"false\"}";
	}

	public function checkLike(){
		$this->model->load("LikeComment");
		$result = $this->model->LikeComment->checkLike($_POST['id_comment'], $_POST['id_nguoi_dung']);

		if ($result) echo "{\"status\":\"true\"}";
	 	else echo "{\"status\":\"false\"}";
	}

	public function unLikeComment(){
		$this->model->load('LikeComment');
		$result = $this->model->LikeComment->unLikeComment($_POST['id_comment'], $_POST['id_nguoi_dung']);

		if ($result) echo "{\"status\":\"true\"}";
	 	else echo "{\"status\":\"false\"}";
	}
}

?>