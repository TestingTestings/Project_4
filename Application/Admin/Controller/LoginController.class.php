<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {

    //登录界面
    public function index(){

        $this->display();
    }
    //登录判断
    public function login($username,$psd,$code){
        $user=M('admin');//查询管理员表
        $res=$user->where("name='{$username}'")->find();
        if(check_verify($code))
        {
            if($res['password']==md5($psd))
            {
                session('user',$username);//创建session作为登录凭据
                session("power",$res['power']);
                $this->success('登陆成功','/project_4/admin/index/welcome',1);
            }
            else{
                $this->error('登陆失败,账号或密码错误');//正确与错误的跳转
            }
        }
        else
        {
            $this->error('登陆失败,验证码错误');//正确与错误的跳转
        }
    }
    //验证码
    public function verify(){
        $config =    array(
            'fontSize'    =>    23,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数
            'imageW'      =>    150,
            'imageH'      =>    45,
            'useCurve'    =>    false,
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }
    public function criminal(){
        $crim=M('criminal');
        $res=$crim->where("state='在逃'")->select();
        echo json_encode($res);
    }

}
//验证码生成
function check_verify($code){
    $verify = new \Think\Verify();
    return $verify->check($code);
}
?>