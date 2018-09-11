<?php 

/**
 * 
 */
class Image_Place_Model
{
	public $id_anh_dia_diem;
	public $id_dia_diem;
	public $title;
	public $anh;
	public $ngay_dang;

	public function getImagePlaceFromIDPlace($id_dia_diem){
		$conn = FT_Database::instance()->getConnection();
		$sql = "SELECT * FROM anh_dia_diem WHERE id_dia_diem = $id_dia_diem";
		$result = mysqli_query($conn, $sql);

		if(!$result) die('Error');

		$list = array();
		while ($row = mysqli_fetch_assoc($result)){
			$imagePlace = new Image_Place_Model();
			$imagePlace->id_anh_dia_diem = $row['id_anh_dia_diem'];
			$imagePlace->id_dia_diem = $row['id_dia_diem'];
			$imagePlace->title = $row['title'];
			$imagePlace->anh = $row['anh'];
			$imagePlace->ngay_dang = $row['ngay_dang'];

			array_push($list, $imagePlace);
		}

		return $list;
	}

	public function getImagePlaceFromIDImage($id_anh_dia_diem){
		$conn = FT_Database::instance()->getConnection();
		$sql = "SELECT * FROM anh_dia_diem WHERE id_anh_dia_diem = $id_anh_dia_diem";
		$result = mysqli_query($conn, $sql);
		if(!$result) die('Error');

		$row = mysqli_fetch_assoc($result);
		$imagePlace = new Image_Place_Model();
		$imagePlace = new Image_Place_Model();
		$imagePlace->id_anh_dia_diem = $row['id_anh_dia_diem'];
		$imagePlace->id_dia_diem = $row['id_dia_diem'];
		$imagePlace->title = $row['title'];
		$imagePlace->anh = $row['anh'];
		$imagePlace->ngay_dang = $row['ngay_dang'];

		return $imagePlace;
	}

	public function uploadImage($id_dia_diem, $title, $anh, $ngay_dang){
		$conn = FT_Database::instance()->getConnection();
		$sql = "INSERT INTO anh_dia_diem(id_dia_diem, title, anh, ngay_dang) VALUES($id_dia_diem, \"$title\", \"$anh\", \"$ngay_dang\")";
		$result = mysqli_query($conn, $sql);
		
		if($result) return true;
		else return false;
	}

}

?>