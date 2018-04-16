<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$Blog = D('blog');
    	$Classify = D('classify');
    	$User = D('user');
        $Cate = D('cate');
    	$blog_data = $Blog->select();
        $Banner = D('banner');
        $banner_data = $Banner->select();
        $cate_data = $Cate->select();
    	$res1 = array();
        $res2 = array();
        $res3 = array();
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
        foreach ($banner_data as $key => $value) {
            $res2[$key]['id'] = $value['id']; 
            $res2[$key]['img'] = $value['img']; 
            $res2[$key]['url'] = $value['url'];
            $res2[$key]['title'] = $value['title']; 
        }
        foreach ($cate_data as $key => $value) {
            $res3[$key]['id'] = $value['id']; 
            $res3[$key]['name'] = $value['name']; 
            $res3[$key]['pid'] = $value['pid'];
        }
        $result=array(
            'banner' => $res2,
            'blog_lists' => $res1,
            'cate' => $res3     
            );
         _res($result);
            die();
	}
}