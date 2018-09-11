<?php 

class Post_Model{

	public $id_bai_dang;
	public $id_nguoi_dung;
	public $id_dia_diem;
	public $anh;
	public $noi_dung;
	public $ngay_gio_dang;

	public function Upload($id_nguoi_dung, $id_dia_diem, $anh, $noi_dung, $ngay_gio_dang){
		$conn = FT_Database::instance()->getConnection();
		$sql = "INSERT INTO bai_dang(id_nguoi_dung, id_dia_diem, anh, noi_dung, ngay_gio_dang) VALUES(".$id_nguoi_dung.",".$id_dia_diem.",'".$anh."','".$noi_dung."','".$ngay_gio_dang."')";
		$result = mysqli_query($conn, $sql);

		if($result) return true;
			// die('Error: '.mysqli_query_error());
		else return false;
	}

	public function getPost($limit){
		$conn = FT_Database::instance()->getConnection();
		$sql = "SELECT * FROM bai_dang ORDER BY bai_dang.id_bai_dang DESC LIMIT ". $limit ."," . 5;
		$result = mysqli_query($conn, $sql);

		if(!$result)
			die('Error: ');

		$list_post = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$post = new Post_Model();
			$post->id_bai_dang = $row['id_bai_dang'];
			$post->id_nguoi_dung = $row['id_nguoi_dung'];
			$post->id_dia_diem = $row['id_dia_diem'];
			$post->noi_dung = $row['noi_dung'];
			$post->anh = $row['anh'];
			$post->ngay_gio_dang = $row['ngay_gio_dang'];
			array_push($list_post, $post);
		}

		return $list_post;
	}

	public function getPostFromIDUser($id_nguoi_dung, $limit){
		$conn = FT_Database::instance()->getConnection();
		$sql = "SELECT nguoi_dung.avartar, bai_dang.id_bai_dang, nguoi_dung.ten_nguoi_dung, dia_diem.ten_dia_diem, bai_dang.noi_dung, bai_dang.anh, bai_dang.ngay_gio_dang FROM bai_dang, nguoi_dung, dia_diem WHERE bai_dang.id_nguoi_dung = $id_nguoi_dung and bai_dang.id_nguoi_dung = nguoi_dung.id_nguoi_dung and bai_dang.id_dia_diem = dia_diem.id_dia_diem ORDER BY bai_dang.id_bai_dang DESC LIMIT $limit,15";
		$result = mysqli_query($conn, $sql);

		if(!$result)
			die('Error: ');

		$list_post = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$post = new Post_Model();
			$post->id_bai_dang = $row['id_bai_dang'];
			$post->id_nguoi_dung = $row['ten_nguoi_dung'];
			$post->id_dia_diem = $row['ten_dia_diem'];
			$post->noi_dung = $row['noi_dung'];
			$post->anh = $row['anh'];
			$post->anh_nguoi_dung = $row['avartar'];
			$post->ngay_gio_dang = $row['ngay_gio_dang'];
			array_push($list_post, $post);
		}

		return $list_post;
	}

	public function editPost($id_bai_dang, $id_dia_diem, $anh, $noi_dung){
		$conn = FT_Database::instance()->getConnection();
		$sql = "UPDATE bai_dang SET noi_dung = \"$noi_dung\" , id_dia_diem = $id_dia_diem , anh = \"$anh\" WHERE id_bai_dang = $id_bai_dang";

		$result = mysqli_query($conn, $sql);
		
		if ($result) {
			return true;
		}else{ 			
			die($sql);
			return false;
		}
	}

	public function getPostFromID($id_bai_dang){
		$conn = FT_Database::instance()->getConnection();
		$sql = "SELECT * FROM bai_dang WHERE id_bai_dang = $id_bai_dang";
		$result = mysqli_query($conn, $sql);

		$post = new Post_Model();
		$row = mysqli_fetch_assoc($result);

		$post->id_bai_dang = $row['id_bai_dang'];
		$post->id_nguoi_dung = $row['id_nguoi_dung'];
		$post->id_dia_diem = $row['id_dia_diem'];
		$post->anh = $row['anh'];
		$post->noi_dung = $row['noi_dung'];
		$post->ngay_gio_dang = $row['ngay_gio_dang'];

		return $post;
	}

	public function getPostFromIDPlace($id_dia_diem, $id_nguoi_dung){
		$conn = FT_Database::instance()->getConnection();
		$sql = "SELECT * FROM bai_dang WHERE id_dia_diem = $id_dia_diem AND id_nguoi_dung = $id_nguoi_dung ORDER BY id_bai_dang DESC";
		$result = mysqli_query($conn, $sql);

		if(!$result) die("error");

		$list_post = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$post = new Post_Model();
			$post->id_bai_dang = $row['id_bai_dang'];
			$post->id_nguoi_dung = $row['id_nguoi_dung'];
			$post->id_dia_diem = $row['id_dia_diem'];
			$post->noi_dung = $row['noi_dung'];
			$post->anh = $row['anh'];
			$post->ngay_gio_dang = $row['ngay_gio_dang'];
			array_push($list_post, $post);
		}

		return $list_post;
	}

}

?>