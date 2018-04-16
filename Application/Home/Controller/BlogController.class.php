<?php
namespace Home\Controller;
use Think\Controller;
class BlogController extends Controller {
    public function doAdd(){
    	$Blog = D('blog');
    	$user_id = $_POST['user_id'];
    	$title = $_POST['title'];
    	$content = $_POST['content'];
    	$classify_id = $_POST['classify_id'];
    	if (empty($user_id)|| empty($title)|| empty($content)|| empty($classify_id)) {
    		_res($message='参数填写错误',$error_code=1);
    		die();
    	}	
    	$time = date('Y-m-d H:i:s');
    	$blog_arr = array(
    		'user_id' => $user_id,
    		'title' => $title,
    		'content' => $content,
    		'classify_id' => $classify_id,
    		'create_time' => $time
    		);
    	// var_dump($blog_arr);
    	// die();
    	$status = $Blog->add($blog_arr);
    	if ($status) {
    		_res();
    		die();
    	}else{
    		_res($message='发布失败',$error_code=1);
    		die();
    	}
    }

    public function lists(){
    	$user_id = $_POST['user_id'];
    	if (empty($user_id)) {
    		_res($message='参数填写错误',$error_code=1);
    		die();
    	}
    	$Blog  = D('blog');
    	$Cate = D('cate');
    	$User = D('user');
    	$blog_arr = array(
    		'user_id' => $user_id
    		);
    	$blog_data = $Blog->where($blog_arr)->select();
    	// var_dump($blog_data);
    	// die();
    	$res1 = array();
    	foreach ($blog_data as $key => $value) {
    		$res[$key]['id'] = $value['id']; 
    		$res[$key]['title'] = $value['title']; 
    		$res[$key]['classify_id'] = $value['classify_id'];
    		$data2 = array(
    		'id' => $value['classify_id']
    		);
    		$data3 = array(
    		'id' => $value['user_id']
    		);
    		$classify_data = $Cate->where($data2)->find(); 
    		$user_data = $User->where($data3)->find(); 
    		$res[$key]['classify_name'] = $classify_data['name']; 
    		$res[$key]['author_name'] = $user_data['uname'];  		 
    		$res[$key]['read_num'] = $value['read_num']; 
    		$res[$key]['date'] = substr($value['create_time'], 0,10);   		
    	}
    	$result=array(
            'lists' => $res    
            );
         _res($result);
            die();
    }

    public function info(){
    	$blog_id = $_POST['blog_id'];
    	if (empty($blog_id)) {
    		_res($message='参数填写错误',$error_code=1);
    		die();
    	}
    	$Blog = D('blog');
    	$Cate = D('cate');
    	$blog_arr = array(
    		'id' => $blog_id
    		);
    	$blog_data = $Blog->where($blog_arr)->find();
    	$cate_arr =array(
    		'id' => $blog_data['classify_id']
    		);
    	$cate_data = $Cate->where($cate_arr)->find();

    	$res = array(
    		'title' => $blog_data['title'],
    		'content' => $blog_data['content'],
    		'classify_name' => $cate_data['name'],
    		);
    	 $result=array(
            'info' => $res    
            );
         _res($result);
            die();
    }

    public function doUpdate(){
    	$Blog = D('blog');
    	$blog_id = $_POST['blog_id'];
    	$title = $_POST['title'];
    	$content = $_POST['content'];
    	$classify_id = $_POST['classify_id'];
    	if (empty($blog_id)|| empty($title)|| empty($content)|| empty($classify_id)) {
    		_res($message='参数填写错误',$error_code=1);
    		die();
    	}
    	$blog_arr = array(
    		'id' => $blog_id
    		);
    	$time = date('Y-m-d H:i:s');
    	$blog_data = array(
    		'title' => $title,
    		'content' => $content,
    		'classify_id' => $classify_id,
    		'create_time' => $time
    		);
    	$status = $Blog->where($blog_arr)->save($blog_data);
    	if ($status) {
    		_res($message='修改成功');
    		die();
    	}else{
    		_res($message='修改失败',$error_code=1);
    		die();
    	}
    }

    public function delete(){
    	$Blog = D('blog');
    	$blog_id = $_GET['blog_id'];
    	if (empty($blog_id)) {
    		_res($message='参数填写错误',$error_code=1);
    		die();
    	}
    	$blog_arr = array(
    		'id' => $blog_id
    		);
    	$status = $Blog->where($blog_arr)->delete();
    	if ($status) {
    		_res($message='删除成功');
    		die();
    	}else{
    		_res($message='删除失败',$error_code=1);
    		die();
    	}
    }
}