<?php 

class Like_Model{

	public function insertLike($id_nguoi_dung, $id_bai_dang){
		$conn = FT_Database::instance()->getConnection();
		$sql = "INSERT INTO thich_bai_dang(id_nguoi_dung, id_bai_dang) VALUES( " . $id_nguoi_dung . "," . $id_bai_dang . ")";

		$result = mysqli_query($conn, $sql);

		if($result) return true;
		else return false;
	}

	public function unLike($id_nguoi_dung, $id_bai_dang){
		$conn = FT_Database::instance()->getConnection();
		$sql = "DELETE FROM thich_bai_dang WHERE thich_bai_dang.id_nguoi_dung = " . $id_nguoi_dung . " AND thich_bai_dang.id_bai_dang = " . $id_bai_dang;
		$result = mysqli_query($conn, $sql);

		if($result) return true;
		else return false;
	}

	public function checkLike($id_nguoi_dung, $id_bai_dang){
		$conn = FT_Database::instance()->getConnection();
		$sql = "SELECT * FROM thich_bai_dang WHERE id_nguoi_dung = $id_nguoi_dung && id_bai_dang = $id_bai_dang";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result)) return true;
		else return false;
	}

	public function countLike($id_bai_dang){
		$conn = FT_Database::instance()->getConnection();
		$sql = "SELECT COUNT(thich_bai_dang.id_bai_dang) as 'count' FROM thich_bai_dang WHERE thich_bai_dang.id_bai_dang = " . $id_bai_dang;
		$result = mysqli_query($conn, $sql);

		if ($result) {
			$row = mysqli_fetch_assoc($result);
			return $row['count'];	
		}else return null;
	}
}

?>