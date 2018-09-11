<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

/**
 * 
 */
class Comment_Controller extends Base_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	}

	public function getAllCommentFromIDPost(){
		$this->model->load('Comment');
		$result = $this->model->Comment->getAllCommentFromIDPost($_POST['id_post']);

		echo json_encode($result);
	}

	public function insertComment(){
		$this->model->load('Comment');
		$result = $this->model->Comment->insertComment($_POST['id_nguoi_dung'], $_POST['id_post'], $_POST['noi_dung'], $_POST['thoi_gian_binh_luan']);

		if ($result) echo "{\"status\":\"true\"}";
	 	else echo "{\"status\":\"false\"}";
	}

	public function editComment(){
		$this->model->load('Comment');
		$result = $this->model->Comment->editComment($_POST['id_comment'], $_POST['noi_dung']);

		if ($result) echo "{\"status\":\"true\"}";
	 	else echo "{\"status\":\"false\"}";
	}

	public function deleteComment(){
		$this->model->load('Comment');
		$result = $this->model->Comment->deleteComment($_POST['id_comment']);

		if ($result) echo "{\"status\":\"true\"}";
	 	else echo "{\"status\":\"false\"}";
	}
}

?>