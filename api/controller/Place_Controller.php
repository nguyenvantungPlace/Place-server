<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

/**
 * 
 */
class Place_Controller extends Base_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	}

	public function checkPlaceInIDUser(){
		$this->model->load('Place');
		$result = $this->model->Place->checkPlaceInIDUser($_POST['id_nguoi_dung']);

		if ($result) echo "{\"status\":\"true\"}";
	 	else echo "{\"status\":\"false\"}";
	}

	public function getAllPlace(){
		$this->model->load('Place');
		$result = $this->model->Place->getAllPlace($_POST['id_nguoi_dung'], $_POST['limit']);

		echo json_encode($result);	
	}

	public function insertPlace(){
		$this->model->load('Place');
		$result = $this->model->Place->insertPlace(
			$_POST['id_nguoi_dung'],
			$_POST['ten_dia_diem'],
			$_POST['avatar'],
			$_POST['thanh_pho'],
			$_POST['phuong'],
			$_POST['xa'],
			$_POST['latitude'],
			$_POST['longitude'],
			$_POST['thoi_gian_mo_cua'],
			$_POST['thoi_gian_dong_cua'],
			$_POST['gia_thap_nhat'],
			$_POST['gia_cao_nhat']);

		if ($result) echo "{\"status\":\"true\"}";
	 	else echo "{\"status\":\"false\"}";
	}

	public function getPlaceFromIDUserCheckIn(){
		$this->model->load('Place');
		$result = $this->model->Place->getPlaceFromIDUserCheckIn($_POST['id_nguoi_dung']);

		echo json_encode($result);
	}

	public function getPlaceFromID(){
		$this->model->load('Place');
		$result = $this->model->Place->getPlaceFromID($_POST['id_dia_diem']);

		echo json_encode($result);
	}

	public function getPlaceFromLocation(){
		$this->model->load('Place');
		$result = $this->model->Place->getPlaceFromLocation($_POST['latitude'], $_POST['longitude']);

		echo json_encode($result);
	}

	public function getPlaceFromLocationGuess(){
		$this->model->load('Place');
		$result = $this->model->Place->getPlaceFromLocationGuess($_POST['latitude'], $_POST['longitude']);
		echo json_encode($result);
	}
}
?>