<?php 

class Comment_Model{

	public $id_binh_luan;
	public $id_nguoi_dung;
	public $id_bai_dang;
	public $noi_dung;
	public $thoi_gian_binh_luan;

	public function getAllCommentFromIDPost($id_bai_dang){
		$conn = FT_Database::instance()->getConnection();
		$sql = "SELECT * FROM binh_luan WHERE id_bai_dang = $id_bai_dang";
		$result = mysqli_query($conn, $sql);
		$list_comment = array();

		if (!$result) {
			die('error');
		}

		while ($row = mysqli_fetch_assoc($result)) {
			$comment = new Comment_Model();
			$comment->id_binh_luan = $row['id_binh_luan'];
			$comment->id_nguoi_dung = $row['id_nguoi_dung'];
			$comment->id_bai_dang = $row['id_bai_dang'];
			$comment->noi_dung = $row['noi_dung'];
			$comment->thoi_gian_binh_luan = $row['thoi_gian_binh_luan'];

			array_push($list_comment, $comment);
		}

		return $list_comment;
	}

	public function insertComment($id_nguoi_dung, $id_bai_dang, $noi_dung, $thoi_gian_binh_luan){
		$conn = FT_Database::instance()->getConnection();
		$sql = "INSERT INTO binh_luan(id_nguoi_dung, id_bai_dang, noi_dung, thoi_gian_binh_luan) VALUES($id_nguoi_dung, $id_bai_dang, \"$noi_dung\", \"$thoi_gian_binh_luan\")";
		$result = mysqli_query($conn, $sql);

		if ($result) return true;
		else return false;
	}

	public function editComment($id_binh_luan, $noi_dung){
		$conn = FT_Database::instance()->getConnection();
		$sql = "UPDATE binh_luan SET noi_dung = \"$noi_dung\" WHERE id_binh_luan = $id_binh_luan";
		$result = mysqli_query($conn, $sql);

		if ($result) return true;
		else return false;
	}

	public function deleteComment($id_binh_luan){
		$conn = FT_Database::instance()->getConnection();
		$sql = "DELETE FROM binh_luan WHERE id_binh_luan = $id_binh_luan";
		$result = mysqli_query($conn, $sql);

		if ($result) return true;
		else return false;
	}
}

?>