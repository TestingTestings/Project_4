<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    //拦截器 拦截非法登录
    public function _initialize(){
        $url=$_SERVER['REQUEST_URI'];
        cookie('url',$url);
//        if(substr($url, -5)!='login')
//        {
//            if(session('user')==null)
//            {
//                $this->error('请登录');
//            }
//        }
    }
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
                $this->success('登陆成功','welcome',1);
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
    //主界面
    public function welcome(){
        //读取菜单表
        $title=M('menu');
        $menu=$title->select();
        $this->assign('menu',$menu);
        //读取用户名
        $this->assign('user',session('user'));
        $this->display('welcome');
    }
    //警员管理
    public function police(){
        $search=I('get.search');
        $police=M("police");
        if(!empty($search))
        {
            $where['id']   = array('like', '%'.$search.'%');
            $where['name'] = array('like', '%'.$search.'%');
            $where['age'] = array('like', '%'.$search.'%');
            $where['area'] = array('like', '%'.$search.'%');
            $where['_logic']  = 'or';
            $map['_complex']  = $where;
            $count=$police->where($map)->count();//查询条数
            $Page= new \Think\Page($count,7);//创建分页
            $res= $police->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
            foreach($map as $key=>$val) {
                $Page->parameter .= "$key=".urlencode($val)."&";
            }
        }else
        {
            $count=$police->count();//查询条数
            $Page= new \Think\Page($count,7);//创建分页
            $res= $police->limit($Page->firstRow.','.$Page->listRows)->select();
        }
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme','%HEADER%%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%');
        $Page->setConfig('header','<p style="display: inline">共<b>%TOTAL_ROW%</b>条记录&nbsp;</p>');
        $show=$Page->show();
        $this->assign("police",$res);
        $this->assign("page",$show);
        $this->assign("search",$search);
        $this->display('police');
    }
    //违章管理
    public function peccancy(){

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
    //登出
    public function loginout(){
        session("user",null);
        echo U('index');
        $this->redirect('index', "",0);

    }
    //添加警员
    public function policeadd(){
        $policeid=M("police")->order('id desc')->limit(1)->select();
        $this->assign("id",$policeid[0]['id']+1);
        if(session("police")!=null)
        {
            $this->assign("police",session("police"));
            session("police",null);
        }
        $this->display("policeadd");
    }
    //添加警员信息详情
    public function detail($id,$password,$policename,$sex,$age,$area,$job,$imei){
        $police['id']=$id;
        $police['password']=$password;
        $police['policename']=$policename;
        $police['sex']=$sex;
        $police['age']=$age;
        $police['area']=$area;
        $police['job']=$job;
        $police['imei']=$imei;
        session("police",$police);
        $this->assign("police",$police);
        $this->display("detail");
    }
    //
    public function policewrite(){
        $police=M("police");
        $data['id']=session("police")['id'];
        $data['name']=session("police")['policename'];
        $data['password']=md5(session("police")['password']);
        $data['sex']=session("police")['sex'];
        $data['area']=session("police")['area'];
        $data['age']=session("police")['age'];
        $data['job']=session("police")['job'];
        $data['imei']=session("police")['imei'];
      //  $data['id']=session("police")['id'];
        $data['state']='normal';
        var_dump($data);
        $police->add($data);
        session("police",null);
        //$this->redirect('police');
    }
    public function law(){



    }

}

function check_verify($code){
    $verify = new \Think\Verify();
    return $verify->check($code);
}