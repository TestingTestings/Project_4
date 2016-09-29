<?php
namespace App\Controller;

use Think\Controller;

class LoginController extends Controller
{
    public function login(){
        //后台再次防止输入为空的进来
        if(I('post.tpname')!==""&&I('post.tppwd')!==""){
            //var_dump(I('post.'));
            $police = M("police"); // 实例化User对象
            //$police->create();
            $condition['name'] = I('post.tpname');
            $condition['password'] = md5(I('post.tppwd'));
            // 把查询条件传入查询方法
            $result=$police->where($condition)->select();
            if(count($result)!=0){
                echo "success";
            }else{
                echo "input wrong";
            }
        }else{
            ECHO "FAIL";    
        }
        
    }
}

?>