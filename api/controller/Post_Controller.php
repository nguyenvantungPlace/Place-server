<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Post_Controller extends Base_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	}


	public function Upload(){
		//save to database
		$this->model->load('Post');
		$result = $this->model->Post->Upload($_POST['id_nguoi_dung'],
				$_POST['id_dia_diem'], $_POST['image_name'], $_POST['noi_dung'], $_POST['ngay_gio_dang']);
		if ($result) echo "{\"status\":\"true\"}";
	 	else echo "{\"status\":\"false\"}";
	}

	public function getPost(){
		$list_post = array();
		$this->model->load('Post');
		$result = $this->model->Post->getPost($_POST['limit']);
		echo json_encode($result);
	}

	public function getPostFromIDUser(){
		$this->model->load('Post');
		$result = $this->model->Post->getPostFromIDUser($_POST['id_nguoi_dung'], $_POST['limit']);
		echo json_encode($result);
	}

	public function editPost(){
		$this->model->load('post');
		$result = $this->model->post->editPost($_POST["id_post"], $_POST['id_dia_diem'], $_POST['image_name'], $_POST['noi_dung']);

		if ($result) echo "{\"status\":\"true\"}";
	 	else echo "{\"status\":\"false\"}";
	}

	public function getPostFromID(){
		$this->model->load('Post');
		$result = $this->model->Post->getPostFromID($_POST['id_post']);

		echo json_encode($result);
	}

	public function getPostFromIDPlace(){
		$this->model->load('Post');
		$result = $this->model->Post->getPostFromIDPlace($_POST['id_dia_diem'], $_POST['id_nguoi_dung']);

		echo json_encode($result);
	}
}

?>