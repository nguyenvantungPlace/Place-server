<?php 
/**
 * 
 */
class Image_Place_Controller extends Base_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	}

	public function getImagePlaceFromIDPlace(){
		$this->model->load('Image_Place');
		$result = $this->model->Image_Place->getImagePlaceFromIDPlace($_POST['id_dia_diem']);

		echo json_encode($result);
	}

	public function getImagePlaceFromIDImage(){
		$this->model->load('Image_Place');
		$result = $this->model->Image_Place->getImagePlaceFromIDImage($_POST['id_anh_dia_diem']);

		echo json_encode($result);
	}

	public function uploadImagePlace(){
		$this->model->load('Image_Place');
		$result = $this->model->Image_Place->uploadImage($_POST['id_dia_diem'], $_POST['noi_dung'], $_POST['image_name'], $_POST['ngay_gio_dang']);

		if ($result) echo "{\"status\":\"true\"}";
	 	else echo "{\"status\":\"false\"}";
	}
}

?>