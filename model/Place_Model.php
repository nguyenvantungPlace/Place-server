<?php 
class Place_Model{
	public $id_dia_diem;
	public $id_nguoi_dung;
	public $ten_dia_diem;
	public $avatar;
	public $thanh_pho;
	public $phuong;
	public $xa;
	public $latitude;
	public $longitude;
	public $thoi_gian_mo_cua;
	public $thoi_gian_dong_cua;
	public $gia_cao_nhat;
	public $gia_thap_nhat;

	public function checkPlaceInIDUser($id_nguoi_dung){
		$conn = FT_Database::instance()->getConnection();
		$sql = "SELECT * FROM dia_diem WHERE id_nguoi_dung = $id_nguoi_dung LIMIT 0,1";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) return true;
		else return false;
	}

	public function getAllPlace($id_nguoi_dung, $limit){
		$conn = FT_Database::instance()->getConnection();
		$sql = "SELECT * FROM dia_diem WHERE id_nguoi_dung = $id_nguoi_dung LIMIT $limit , 5";

		$result = mysqli_query($conn, $sql);

		if(!$result)
			die('Error: ');

		$list_place = array();
		while ($row = mysqli_fetch_assoc($result)){
			$place = new Place_Model();
			$place->id_dia_diem = $row['id_dia_diem'];
			$place->id_nguoi_dung = $row['id_nguoi_dung'];
			$place->ten_dia_diem = $row['ten_dia_diem'];
			$place->avatar = $row['avatar'];
			$place->thanh_pho = $row['thanh_pho'];
			$place->phuong = $row['phuong'];
			$place->xa = $row['xa'];
			$place->latitude = $row['latitude'];
			$place->longitude = $row['longitude'];
			$place->thoi_gian_mo_cua = $row['thoi_gian_mo_cua'];
			$place->thoi_gian_dong_cua = $row['thoi_gian_dong_cua'];
			$place->gia_cao_nhat = $row['gia_cao_nhat'];
			$place->gia_thap_nhat = $row['gia_thap_nhat'];

			array_push($list_place, $place);
		}

		return $list_place;
	}

	public function insertPlace($id_nguoi_dung, $ten_dia_diem, $avatar, $thanh_pho, $phuong, $xa, $latitude, $longitude, $thoi_gian_mo_cua, $thoi_gian_dong_cua, $gia_thap_nhat, $gia_cao_nhat){
		$conn = FT_Database::instance()->getConnection();
		$sql = "INSERT INTO dia_diem(id_nguoi_dung, ten_dia_diem, avatar, thanh_pho, phuong, xa, latitude, longitude, thoi_gian_mo_cua, thoi_gian_dong_cua, gia_thap_nhat, gia_cao_nhat) VALUES($id_nguoi_dung, $ten_dia_diem, $avatar, $thanh_pho, $phuong, $xa, $latitude, $longitude, $thoi_gian_mo_cua, $thoi_gian_dong_cua, $gia_thap_nhat, $gia_cao_nhat)";

		$result = mysqli_query($conn, $sql);

		if ($result) return true;
		else return false;
	}

	public function getPlaceFromIDUserCheckIn($id_nguoi_dung){
		$conn = FT_Database::instance()->getConnection();
		$sql = "SELECT dia_diem.id_dia_diem, dia_diem.id_nguoi_dung, dia_diem.ten_dia_diem, dia_diem.avatar, dia_diem.thanh_pho, dia_diem.phuong, dia_diem.xa, dia_diem.latitude, dia_diem.longitude, dia_diem.thoi_gian_mo_cua, dia_diem.thoi_gian_dong_cua, dia_diem.gia_cao_nhat, dia_diem.gia_thap_nhat FROM dia_diem, bai_dang WHERE dia_diem.id_dia_diem = bai_dang.id_dia_diem AND bai_dang.id_nguoi_dung = $id_nguoi_dung GROUP BY dia_diem.id_dia_diem";
		$result = mysqli_query($conn, $sql);

		if (!$result) {
			die("error");
		}

		$list_place = array();
		while ($row = mysqli_fetch_assoc($result)){
			$place = new Place_Model();
			$place->id_dia_diem = $row['id_dia_diem'];
			$place->ten_dia_diem = $row['ten_dia_diem'];
			$place->avatar = $row['avatar'];

			array_push($list_place, $place);
		}
		return $list_place;
	}

	public function getPlaceFromID($id_dia_diem){
		$conn = FT_Database::instance()->getConnection();
		$sql = "SELECT * FROM dia_diem WHERE id_dia_diem = $id_dia_diem";
		$result = mysqli_query($conn, $sql);

		if (!$result) die('ERROR');

		$place = new Place_Model();
		$row = mysqli_fetch_assoc($result);

		$place->id_dia_diem = $row['id_dia_diem'];
		$place->id_nguoi_dung = $row['id_nguoi_dung'];
		$place->ten_dia_diem = $row['ten_dia_diem'];
		$place->avatar = $row['avatar'];
		$place->thanh_pho = $row['thanh_pho'];
		$place->phuong = $row['phuong'];
		$place->xa = $row['xa'];
		$place->latitude = $row['latitude'];
		$place->longitude = $row['longitude'];
		$place->thoi_gian_mo_cua = $row['thoi_gian_mo_cua'];
		$place->thoi_gian_dong_cua = $row['thoi_gian_dong_cua'];
		$place->gia_cao_nhat = $row['gia_cao_nhat'];
		$place->gia_thap_nhat = $row['gia_thap_nhat'];

		return $place;
	}

	public function getPlaceFromLocation($latitude, $longitude){
		$conn = FT_Database::instance()->getConnection();
		$sql = "SELECT * FROM dia_diem WHERE dia_diem.latitude = \"$latitude\" AND dia_diem.longitude = \"$longitude\"";
		$result = mysqli_query($conn, $sql);

		if (!$result) die('ERROR');

		$list_place = array();
		while ($row = mysqli_fetch_assoc($result)){
			$place = new Place_Model();
			$place->id_dia_diem = $row['id_dia_diem'];
			$place->id_nguoi_dung = $row['id_nguoi_dung'];
			$place->ten_dia_diem = $row['ten_dia_diem'];
			$place->avatar = $row['avatar'];
			$place->thanh_pho = $row['thanh_pho'];
			$place->phuong = $row['phuong'];
			$place->xa = $row['xa'];
			$place->latitude = $row['latitude'];
			$place->longitude = $row['longitude'];
			$place->thoi_gian_mo_cua = $row['thoi_gian_mo_cua'];
			$place->thoi_gian_dong_cua = $row['thoi_gian_dong_cua'];
			$place->gia_cao_nhat = $row['gia_cao_nhat'];
			$place->gia_thap_nhat = $row['gia_thap_nhat'];

			array_push($list_place, $place);
		}

		return $list_place;
	}

	public function getPlaceFromLocationGuess($latitude, $longitude){
		$arr_latitude = str_split($latitude);
		$latitude = "";
		for ($i=0; $i < count($arr_latitude) - 5; $i++) { 
			$latitude = $latitude . $arr_latitude[$i];
		}

		$arr_longtitude = str_split($longitude);
		$longitude = "";
		for ($i=0; $i < count($arr_longtitude) - 5; $i++) { 
			$longitude = $longitude . $arr_longtitude[$i];
		}

		$conn = FT_Database::instance()->getConnection();
		$sql = "SELECT * FROM dia_diem WHERE dia_diem.latitude LIKE \"$latitude%\" AND dia_diem.longitude LIKE \"$longitude%\"";
		$result = mysqli_query($conn, $sql);

		if (!$result) die('ERROR');

		$list_place = array();
		while ($row = mysqli_fetch_assoc($result)){
			$place = new Place_Model();
			$place->id_dia_diem = $row['id_dia_diem'];
			$place->id_nguoi_dung = $row['id_nguoi_dung'];
			$place->ten_dia_diem = $row['ten_dia_diem'];
			$place->avatar = $row['avatar'];
			$place->thanh_pho = $row['thanh_pho'];
			$place->phuong = $row['phuong'];
			$place->xa = $row['xa'];
			$place->latitude = $row['latitude'];
			$place->longitude = $row['longitude'];
			$place->thoi_gian_mo_cua = $row['thoi_gian_mo_cua'];
			$place->thoi_gian_dong_cua = $row['thoi_gian_dong_cua'];
			$place->gia_cao_nhat = $row['gia_cao_nhat'];
			$place->gia_thap_nhat = $row['gia_thap_nhat'];

			array_push($list_place, $place);
		}

		return $list_place;
	}
}

?>