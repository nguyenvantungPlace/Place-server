<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Like_Controller extends Base_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	}

	public function insertLike(){
		$this->model->load("Like");
		$result = $this->model->Like->insertLike($_POST['id_nguoi_dung'], $_POST['id_post']);

		if ($result) echo "{\"status\":\"true\"}";
	 	else echo "{\"status\":\"false\"}";
	}

	public function checkLike(){
		$this->model->load("Like");
		$result = $this->model->Like->checkLike($_POST['id_nguoi_dung'], $_POST['id_post']);

		if ($result) echo "{\"status\":\"true\"}";
	 	else echo "{\"status\":\"false\"}";
	}

	public function unLike(){
		$this->model->load("Like");
		$result = $this->model->Like->unLike($_POST['id_nguoi_dung'], $_POST['id_post']);

		if ($result) echo "{\"status\":\"true\"}";
	 	else echo "{\"status\":\"false\"}";
	}

	public function countLike(){
		$this->model->load('Like');
		$result = $this->model->Like->countLike($_POST['id_post']);

		if ($result != null) {
			echo "{\"count\": $result}";
		}else{
			echo "{\"count\":\"false\"}";
		}
	}
}
?>