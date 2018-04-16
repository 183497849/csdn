<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function doLogin(){
    	$User = D('user');
    	$phone = $_POST['phone'];
    	$password = $_POST['password'];

    	$phone_data = array(
    		'phone' => $phone
    		);
    	$phone_status = $User->where($phone_data)->find();
        // var_dump($phone_status);
        // die();
    	if (empty($phone_status)) {
    		_res($message='电话号码不存在',$error_code=1);
    		die();
    	}
    	if ($password = $phone_status['password']) {
    		$user_data = $User->where($phone_data)->find();
    		$user_res = array(
    			'userid' => $user_data['id'],
    			'username' => $user_data['uname'],
    			'userimg' => $user_data['userimg']
    			);
    		_res($user_res);
    		die();
    	}else{
    		_res($message='密码错误',$error_code=1);
    		die();
    	}
    }
    public function doReg(){
    	$User = D('user');
    	$uname = $_POST['uname'];
    	$password = $_POST['password'];
    	$phone = $_POST['phone'];
    	if (empty($uname)|| empty($password)|| empty($phone)) {
    		_res($message='参数填写错误',$error_code=1);
    		die();
    	}
    	$phone_data = array(
    		'phone' => $phone
    		);
    	$phone_status = $User->where($phone_data)->select();
    	if ($phone_status) {
    		_res($message='电话号重复',$error_code=1);
    		die();
    	}
    	$uname_data = array(
    		'uname' => $uname
    		);
    	$uname_status = $User->where($uname_data)->select();
    	if ($uname_status) {
    		_res($message='用户名重复',$error_code=1);
    		die();
    	}
    	$reg_data = array(
    		'uname' => $uname,
    		'password' => $password,
    		'phone' => $phone
    		);
    	$status = $User->add($reg_data);
    	if ($status) {
    		_res();
    		die();
    	}else{
    		_res($message='注册失败',$error_code=1);
    		die();
    	}
    }
}