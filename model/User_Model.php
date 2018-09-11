<?php
class User_Model{
	public $id_nguoi_dung;
	public $ten_dang_nhap;
	public $mat_khau;
	public $ten_nguoi_dung;
	public $ngay_sinh;
	public $nam_nu;
	public $avartar;
	public $token_facebook;

	public function all(){
		$conn = FT_Database::instance()->getConnection();
		$sql = 'select * from nguoi_dung';
		$result = mysqli_query($conn, $sql);
		$list_user = array();

		if(!$result)
			die('Error: '.mysqli_query_error());

		while ($row = mysqli_fetch_assoc($result)){
            $user = new User_Model();
            $user->id_nguoi_dung = $row['id_nguoi_dung'];
            $user->ten_dang_nhap = $row['ten_dang_nhap'];
            $user->mat_khau = $row['mat_khau'];
            $user->ten_nguoi_dung = $row['ten_nguoi_dung'];
            $user->ngay_sinh = $row['ngay_sinh'];
            $user->nam_nu = $row['nam_nu'];
            $user->avartar = $row['avartar'];
            $user->token_facebook = $row['token_facebook'];
            $list_user[] = $user;            
        }

        return $list_user;
	}

	public function save(){
		$conn = FT_Database::instance()->getConnection();
		$stmt = $conn->prepare("INSERT INTO users (email, password, role, status, token) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param("sssss", $this->email, $this->password, $this->role, $this->status, $this->token);
		$rs = $stmt->execute();
		$this->id = $stmt->insert_id;		
		$stmt->close();
		return $rs;
	}

	public function findById($id){
		$conn = FT_Database::instance()->getConnection();
		$sql = 'select * from users where id='.$id;
		$result = mysqli_query($conn, $sql);

		if(!$result)
			die('Error: ');

		$row = mysqli_fetch_assoc($result);
        $user = new User_Model();
        $user->id = $row['id'];
        $user->email = $row['email'];
        $user->password = $row['password'];
        $user->role = $row['role'];
        $user->status = $row['status'];

        return $user;
	}

	public function delete(){
		$conn = FT_Database::instance()->getConnection();
		$sql = 'delete from users where id='.$this->id;
		$result = mysqli_query($conn, $sql);

		return $result;
	}

	public function update(){
		$conn = FT_Database::instance()->getConnection();
		$stmt = $conn->prepare("UPDATE users SET email=?, password=?, role=?, status=? WHERE id=?");
		$stmt->bind_param("ssssi", $this->email, $this->password, $this->role, $this->status, $_POST['id']);
		$stmt->execute();
		$stmt->close();
	}

	public function findByUserName($user_name){
		$conn = FT_Database::instance()->getConnection();
		$query = "SELECT * FROM nguoi_dung WHERE ten_dang_nhap = '".$user_name."'";
		$result = mysqli_query($conn, $query);
		if(!$result)
			die('Error: ');
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			return $row['ten_dang_nhap'];
		}
	}

	public function register($name, $user_name, $password, $name_avatar){
		$conn = FT_Database::instance()->getConnection();
		$query = "INSERT INTO nguoi_dung(ten_nguoi_dung,ten_dang_nhap,mat_khau,avartar) VALUES ('". $name . "','".$user_name."','".$password."','".$name_avatar."')";
		$result = mysqli_query($conn, $query);
		if ($result) return true;
		else return false;
	}

	public function login($user_name, $password){
		$conn = FT_Database::instance()->getConnection();
		$query = "SELECT id_nguoi_dung, ten_nguoi_dung, ten_dang_nhap, mat_khau, avartar FROM nguoi_dung WHERE ten_dang_nhap = '" . $user_name . "' AND mat_khau = '" . $password . "'";
		$result = mysqli_query($conn, $query);

		if(!$result)
			die('Error: ');

		$row = mysqli_fetch_assoc($result);
        $user = new User_Model();
        $user->id_nguoi_dung = $row['id_nguoi_dung'];
        $user->ten_nguoi_dung= $row['ten_nguoi_dung'];
        $user->ten_dang_nhap = $row['ten_dang_nhap'];
        $user->mat_khau      = $row['mat_khau'];
        $user->avartar 		 = $row['avartar'];
        return $user;
	}

	public function getAvatarUserComment($id_post){
		$conn = FT_Database::instance()->getConnection();
		$query = "SELECT nguoi_dung.id_nguoi_dung, nguoi_dung.avartar FROM nguoi_dung, bai_dang, binh_luan WHERE nguoi_dung.id_nguoi_dung = binh_luan.id_nguoi_dung AND bai_dang.id_bai_dang = binh_luan.id_bai_dang AND binh_luan.id_bai_dang = " . $id_post . " GROUP BY nguoi_dung.id_nguoi_dung ORDER BY binh_luan.id_binh_luan DESC";
		$result = mysqli_query($conn, $query);

		if(!$result)
			die('Error: ');
		$list_avatar = array();
		while ($row = mysqli_fetch_assoc($result)){
			array_push($list_avatar, [
				"id" => $row['id_nguoi_dung'],
				"avartar" => $row["avartar"]
			]);
		}
		return $list_avatar;
	}

	public function getInfoUserFromID($id_nguoi_dung){
		$conn = FT_Database::instance()->getConnection();
		$sql = "SELECT nguoi_dung.id_nguoi_dung, nguoi_dung.ten_nguoi_dung, nguoi_dung.avartar FROM nguoi_dung WHERE id_nguoi_dung = $id_nguoi_dung";
		$result = mysqli_query($conn, $sql);

		$user = new User_Model();
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$user->id_nguoi_dung = $row['id_nguoi_dung'];
			$user->ten_nguoi_dung = $row['ten_nguoi_dung'];
			$user->avartar = $row['avartar'];

			return $user;
		}else return null;
	}
}