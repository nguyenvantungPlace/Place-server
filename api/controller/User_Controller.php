<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class User_Controller extends Base_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo "string";
	}

	public function checkUserName()
		{
			//kiểm tra user name có tồn tại hay không
			$used = "";
			$this->model->load("User");
			$result = $this->model->User->findByUserName($_POST['user_name']);
			 if ($result == "") {
				echo "{\"status\":\"true\"}"; //tra ve true la co the su dung ten dang nhap nay
			}else{
				echo "{\"status\":\"false\"}"; //tra ve false la khong the su dung ten dang nhap nay
			}
		}

	public function registerPlace(){
		//convert image form base64 to image
		// $encoded_sttring = $_POST["encoded_image"];
	 // 	$image_name = $_POST["image_name"];
	 // 	$decoded_string = base64_decode($encoded_sttring);
	 // 	$path = 'public/image/avatar/place/' . $image_name;
	 // 	$file  = fopen($path, 'wb');
	 // 	$is_written = fwrite($file, $decoded_string);
	 // 	fclose($file);

		$endcode_string = $POST['endcode_string'];
		$image_name = $POST['image_name'];
		$path = "public/image/post/" . $image_name;
		file_put_contents($path, base64_decode($endcode_string));
		

	 	$this->model->load("User");
	 	$result = $this->model->User->register($_POST['name'],$_POST['user_name'], $_POST['password'], $image_name);

	 	if ($result) echo "{\"status\":\"true\"}";
	 	else echo "{\"status\":\"false\"}";
	}

	public function loginPlace(){
		$this->model->load('User');
		$user = $this->model->User->login($_POST['user_name'], $_POST['password']);

		// echo json_encode($user);
		echo "{\"id_nguoi_dung\":".$user->id_nguoi_dung.",\"ten_nguoi_dung\":\"".$user->ten_nguoi_dung."\",\"ten_dang_nhap\":\"".$user->ten_dang_nhap."\",\"mat_khau\":\"".$user->mat_khau."\",\"avatar\":\"".$user->avartar."\"}";
	}

	public function getAvatarUserComment(){
		$this->model->load('User');
		$result = $this->model->User->getAvatarUserComment($_POST['id_post']);

		echo json_encode($result);
	}

	public function getInfoUserFromID(){
		$this->model->load('User');
		$result = $this->model->User->getInfoUserFromID($_POST['id_nguoi_dung']);

		echo "{\"id_nguoi_dung\": $result->id_nguoi_dung, \"ten_nguoi_dung\": \"$result->ten_nguoi_dung\",\"avatar\": \"$result->avartar\"}";
		// echo json_encode($result);
	}
}

/* End of file User_Controller.php */
/* Location: ./application/controllers/User_Controller.php */