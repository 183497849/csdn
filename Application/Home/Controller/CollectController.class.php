<?php
namespace Home\Controller;
use Think\Controller;
class CollectController extends Controller {
    public function add(){
		$user_id = $_POST['user_id'];
    	$blog_id = $_POST['blog_id'];
    	if (empty($user_id)||empty($blog_id)) {
    		_res($message='参数错误',$error_code=1);
    	}
    	$Collect = D('collect');
    	$time = date('Y-m-d H:i:s');
    	$collect_data = array(
    		'user_id' => $user_id,
    		'blog_id' => $blog_id,
    		'create_time' =>$time
    		);
    	$status = $Collect->add($collect_data);
    	if ($status) {
    		_res();
    		die();
    	}else{
    		_res($message='收藏失败',$error_code=1);
    		die();
    	}
    }

    public function lists(){
    	$user_id = $_GET['user_id'];
    	$User = D('user');
    	$Blog = D('blog');
    	$Cate = D('cate');
    	$Collect = D('collect');
    	$user_arr = array(
    		'id' => $user_id
    		);
    	$blog_arr = array();
    	$collect_arr = array(
    		'user_id' => $user_id
    		);
    	$res1 = array();
    	$collect_data = $Collect->where($collect_arr)->select();
    	foreach ($collect_data as $key => $value) {
    		 $blog_arr['id'] = $value['blog_id'];
    		 $blog_data[$key]  = $Blog->where($blog_arr)->find();
    	}
    	// var_dump($blog_data);
    	// die();
    	$user_data  = $User->where($user_arr)->find();
    	foreach ($blog_data as $key => $value) {
    		$res1[$key]['id'] = $value['id']; 
    		$res1[$key]['title'] = $value['title']; 
    		$res1[$key]['classify_id'] = $value['classify_id'];
    		$data2 = array(
    		'id' => $value['classify_id']
    		);
    		$data3 = array(
    		'id' => $value['user_id']
    		);
    		$classify_data = $Cate->where($data2)->find(); 
    		$user_data = $User->where($data3)->find(); 
    		$res1[$key]['classify_name'] = $classify_data['name']; 
    		$res1[$key]['author_name'] = $user_data['uname'];  		 
    		$res1[$key]['read_num'] = $value['read_num']; 
    		$res1[$key]['date'] = substr($value['create_time'], 0,10);   		
    	}
    	_res($res1);
    	die();
    }
}