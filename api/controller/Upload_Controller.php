<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

/**
 * 
 */
class Upload_Controller extends Base_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		echo "string";
	}

	public function image(){
		if(isset($_FILES['uploaded_file'])){

			$file_path = "public/image/post/";

			$file_path = $file_path . basename($_FILES['uploaded_file']['name']);
			if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path) ){
				echo "{\"status\":\"true\"}";
			} else{
				echo "{\"status\":\"false\"}";
			}
		}
	}
}
?>