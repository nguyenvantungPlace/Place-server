<?php 

/**
 * 
 */
class LikeComment_Model
{
	public $id_binh_luan;
	public $id_nguoi_dung;
	
	public function likeComment($id_binh_luan, $id_nguoi_dung){
		$conn = FT_Database::instance()->getConnection();
		$sql = "INSERT INTO thich_binh_luan(id_binh_luan, id_nguoi_dung) VALUES($id_binh_luan, $id_nguoi_dung)";
		$result = mysqli_query($conn, $sql);

		if($result) return true;
		else return false;
	}

	public function checkLike($id_binh_luan, $id_nguoi_dung){
		$conn = FT_Database::instance()->getConnection();
		$sql = "SELECT * FROM thich_binh_luan WHERE id_binh_luan = $id_binh_luan AND id_nguoi_dung = $id_nguoi_dung";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) return true;
		else return false;
	}

	public function unLikeComment($id_binh_luan, $id_nguoi_dung){
		$conn = FT_Database::instance()->getConnection();
		$sql = "DELETE FROM thich_binh_luan WHERE id_binh_luan = $id_binh_luan AND id_nguoi_dung = $id_nguoi_dung";
		$result = mysqli_query($conn, $sql);

		if($result) return true;
		else return false;
	}
}

?>