<?php
function _res($data,$message='success',$flag=true,$error_code=0){
		$result = array(
			"error_code"=>$error_code,
			"message"   =>$message ,
			"data" 		=>array(),
		);
		if ($flag) {
			$result['data'] = $data;
		}
		else{
			$result['message'] = $data;

		}
		echo json_encode($result);
		die();
	}
