<?php
namespace Home\Controller;
use Think\Controller;
class InfoController extends Controller {
    public function index(){
    	$Blog = D('blog');
        $id = $_GET['id'];
        $data2 = array(
            'id' =>$id
            );
        $info_data = $Blog->where($data2)->find();
        $blog_data = $Blog->where($data2)->select();
        $data3 = array(
            'classify_id' => $info_data['classify_id']
            );
        $relate_data = $Blog->where($data3)->select();
    	$res1 = array();
        $res2 = array();
    	foreach ($blog_data as $key => $value) {
    		$res1[$key]['id'] = $value['id']; 
    		$res1[$key]['title'] = $value['title']; 
    		$res1[$key]['date'] = $value['create_time'];
    		$res1[$key]['read_num'] = $value['read_num']; 
    		$res1[$key]['content'] = $value['content']; 
    	}
        foreach ($relate_data as $key => $value) {
            $res2[$key]['id'] = $value['id']; 
            $res2[$key]['title'] = $value['title']; 
            $res2[$key]['date'] = $value['create_time'];
            $res2[$key]['read_num'] = $value['read_num']; 
        }
        $result=array(
            'blog_info' => $res1,
            'relate_data' => $res2
            );
         _res($result);
            die();
	}
}